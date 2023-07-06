<?php


namespace App\Services;

use App\Models\Course;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Stripe\Exception\ApiErrorException;
use Stripe\Price;
use Stripe\StripeClient;
use Stripe\Subscription;

class StripeService
{
    /**
     * @var StripeClient
     */

    protected StripeClient $stripeClient;

    public function __construct()
    {
        if (config('services.stripe.active') == 1){
            $this->stripeClient = new StripeClient(config('services.stripe.secret'));
        }
    }


    /*Customer API*/
    public function createOrUpdateStripeCustomerId($user): \Stripe\Customer
    {
        if (isset($user->stripe_customer_id)){
            try {
                return $this->stripeClient->customers->retrieve(
                    $user->stripe_customer_id,
                    []
                );
            } catch (\Exception $e) {
                return $this->createCustomer($user);
            }
        }
        return $this->createCustomer($user);
    }

    public function createCustomer($user): \Stripe\Customer
    {
        $customer = $this->stripeClient->customers->create([
            'name' => $user->name,
            'email' => $user->email,
        ]);
        $user->update(['stripe_customer_id' => $customer->id]);
        return $customer;
    }

    /**
     * @throws ApiErrorException
     */
    public function createCourse(Course $course)
    {
        try {
            $course = [
                'id' => $course->id,
                'name' => $course->name,
                /*'images' => [
                    showCourseImage($course->image)
                ],*/
                'description' => $course->tiny_description,
                'metadata' => [
                    'title' => $course->meta_title,
                    'description' => $course->meta_description,
                    'keywords' => $course->meta_keywords
                ]
            ];
            $course = array_filter($course);
            $stripeProduct = $this->stripeClient->products->create($course);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return $stripeProduct;
    }

    /**
     * @throws ApiErrorException
     */
    public function createOrUpdateCourseProduct(Course $course)
    {
        $courseArr = [
            'name' => $course->name ?? $course->id,
            'description' => $course->tiny_description,
            'metadata' => [
                'title' => $course->meta_title,
                'description' => $course->meta_description,
                'keywords' => $course->meta_keywords
            ]
        ];
        $courseArr = array_filter($courseArr);
        try {
            $this->stripeClient->products->update($course->id, $courseArr);
        } catch (\Exception $e) {
            Log::error($e->getMessage(), (array)$e);
            $courseArr['id'] = $course->id;
            $this->stripeClient->products->create($courseArr);
        }
        DB::table('courses')->where('id', $course->id)
            ->update([
                'stripe_price_id' => $this->updateOrCreateCourseRecurringPrice($course)->id ?? $course->stripe_price_id,
            ]);
    }

    /*Product API*/
    public function updateOrCreateCourseRecurringPrice(Course $course): ?Price
    {
        $recurringPrice = $this->getPrice($course->stripe_price_id);
        $params = [
            'unit_amount' => $course->subscription_price * 100,
            'currency' => config('app.currency'),
            'recurring' => [
                'interval' => $course->subscription_interval,
                'interval_count' => $course->subscription_interval_count,
                "usage_type" => "licensed",
            ],
            'product' => $course->id,
        ];
        $params = array_filter($params);
        $updatePrice = array_intersect(array_keys($course->getChanges()), ['subscription_price', 'subscription_interval', 'subscription_interval_count']);
        if ($course->subscription_price && $course->subscription_interval_count) {
            if ($recurringPrice == null || !empty($updatePrice)) {
                return $this->stripeClient->prices->create($params);
            }
            return $recurringPrice;
        }
        return null;
    }

    public function getPrice($priceId): ?Price
    {
        try {
            return $this->stripeClient->prices->retrieve($priceId);
        } catch (\Exception $e) {
            return null;
        }
    }

    public function createCourseCheckoutSession($params): \Stripe\Checkout\Session
    {
        return $this->stripeClient->checkout->sessions->create([
            'customer' => $params['stripe_customer_id'],
            'line_items' => [[
                'price' => $params['stripe_price_id'],
                'quantity' => 1
            ]],
            'mode' => 'subscription',
            'success_url' => url('/subscription-payment/success?session_id={CHECKOUT_SESSION_ID}'),
            'cancel_url' => url('/subscription-payment/cancel?session_id={CHECKOUT_SESSION_ID}'),
            'metadata' => $params
        ]);
    }

    public function getSession($sessionId): ?\Stripe\Checkout\Session
    {
        try {
            return $this->stripeClient->checkout->sessions->retrieve($sessionId);
        } catch (ApiErrorException $e) {
            return null;
        }
    }

    public function getSubscriptionDetails($sessionId): ?\Stripe\Subscription
    {
        try {
            return $this->stripeClient->subscriptions->retrieve($sessionId);
        } catch (\Exception $e) {
            return null;
        }
    }

    public function updateSubscription($subscriptionId, $params): Subscription
    {
        try {
            return $this->stripeClient->subscriptions->update($subscriptionId, array_filter($params));
        } catch (ApiErrorException $e) {
        }
    }

    public function cancelSubscription($subscriptionId): Subscription
    {
        try {
            return $this->stripeClient->subscriptions->cancel($subscriptionId);
        } catch (ApiErrorException $e) {
        }
    }
}
