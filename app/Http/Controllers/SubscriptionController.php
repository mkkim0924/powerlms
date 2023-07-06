<?php

namespace App\Http\Controllers;


use App\Interfaces\Front\CourseRepositoryInterface;
use App\Models\Course;
use App\Models\CourseUser;
use App\Models\CourseUserAccessibility;
use App\Models\PaymentTransaction;
use App\Models\SubscriptionHistory;
use App\Models\Users;
use App\Services\StripeService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Stripe\StripeClient;

class SubscriptionController extends Controller
{
    protected $courseRepository, $stripeService;

    public function __construct(CourseRepositoryInterface $courseRepository, StripeService $stripeService)
    {
        $this->courseRepository = $courseRepository;
        $this->stripeService = $stripeService;
    }

    public function createStripeSession($slug)
    {
        $course = $this->courseRepository->getCourseDetailBySlug($slug);
        if (isset($course)) {
            // grab the user
            $user = getCurrentUser();
            $this->stripeService->createOrUpdateStripeCustomerId($user);
            $params = [
                'stripe_customer_id' => $user->stripe_customer_id,
                'customer_email' => $user->email,
                'course_id' => $course->id,
                'stripe_price_id' => $course->stripe_price_id,
            ];
            $session = $this->stripeService->createCourseCheckoutSession($params);
            return Redirect::intended($session->url);
        } else {
            return abort(404);
        }
    }

    public function successPayment(Request $request)
    {
        $user = getCurrentUser();
        try {
            DB::beginTransaction();
            $stripeSession = $this->stripeService->getSession($request->session_id);
            if ($stripeSession->payment_status != 'paid') {
                abort(402, "Payment not received. Please try again.");
            }
            $course = $this->courseRepository->getCourseDetailById($stripeSession->metadata->course_id);
            $subscription_id = $stripeSession->subscription;
            $subscription = $this->stripeService->getSubscriptionDetails($subscription_id);

            $courseUser = CourseUser::create([
                'course_id' => $course->id,
                'user_id' => $user->id,
                'subscription_payment' => 1,
                'access_sections_count' => 1,
                'expire_at' => isset($course->expiration_days) ? Carbon::now()->addDays($course->expiration_days) : null
            ]);

            $priceData = calculateEarnings($course->subscription_price, $course->instructorDetail->system_revenue_percentage ?? null);
            PaymentTransaction::create([
                'course_id' => $course->id,
                'user_id' => $user->id,
                'module_type' => 'course',
                'module_user_id' => $courseUser->id,
                'price' => $course->subscription_price,
                'system_revenue' => $priceData['system_revenue'],
                'system_revenue_percentage' => $priceData['system_revenue_percentage'],
                'tax_percentage' => $priceData['tax_value_percentage'],
                'system_revenue_tax_price' => $priceData['system_revenue_tax_value'],
                'tax_price' => $priceData['total_tax'],
                'instructor_revenue' => $priceData['instructor_total_earning'],
                'payment_type' => 'stripe_subscription',
                'payment_id' => $subscription_id,
                'payment_response' => json_encode($subscription),
            ]);

            SubscriptionHistory::create([
                'user_id' => $user->id,
                'course_id' => $course->id,
                'course_user_id' => $courseUser->id,
                'subscription_id' => $subscription_id,
                'subscription_price' => $course->subscription_price,
                'plan_id' => $stripeSession->metadata->stripe_price_id,
                'stripe_customer_id' => $subscription->customer,
                'subscription_start_date' => $subscription->created ?? now()->toDateString(),
                'subscription_end_date' => $subscription->canceled_at ?? null,
                'subscription_installment_count' => $course->subscription_installment_count,
                'status' => $subscription->status ?? $stripeSession->status
            ]);
            if ($course->subscription_installment_count == 1) {
                $this->stripeService->cancelSubscription($subscription_id);
            }
            DB::commit();
            return redirect()->route('course_detail', $course->slug)->with('success', __('backend.subscriptions.flash_message.course_subscribe_successfully'));
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }

    public function cancelPayment(Request $request)
    {
        dd($request->all());
    }

    public function webhook(Request $request)
    {
        try {
            Log::info('STRIPE WEBHOOK Request', $request->all());
            // Handle the event
            switch ($request->type) {
                case "invoice.payment_succeeded":
                    $subscription_id = $request->data['object']['subscription'];
                    if (isset($subscription_id) && $subscription_id != null) {
                        $subscriptionDetails = SubscriptionHistory::where('subscription_id', $subscription_id)->first();
                        if (isset($subscriptionDetails)) {
                            $this->stripeService->updateSubscription($subscription_id, ['collection_method' => 'charge_automatically']);
                            $param = $request['data']['object'];
                            $customer_id = $subscriptionDetails->user_id;
                            if ($customer_id == null) {
                                $status = 201;
                                throw new \Exception("Customer Not found with Stripe Customer ID:" . $param['customer']);
                            }
                            $response = [];

                            $courseUserDetails = $subscriptionDetails->courseUserDetails;
                            $courseUserDetails->access_sections_count = $courseUserDetails->access_sections_count + 1;
                            $courseUserDetails->save();

                            $priceData = calculateEarnings($subscriptionDetails->subscription_price, $course->instructorDetail->system_revenue_percentage ?? null);
                            PaymentTransaction::create([
                                'course_id' => $subscriptionDetails->course_id,
                                'user_id' => $subscriptionDetails->user_id,
                                'module_type' => 'course',
                                'module_user_id' => $subscriptionDetails->course_user_id,
                                'price' => $subscriptionDetails->subscription_price,
                                'system_revenue' => $priceData['system_revenue'],
                                'system_revenue_percentage' => $priceData['system_revenue_percentage'],
                                'tax_percentage' => $priceData['tax_value_percentage'],
                                'system_revenue_tax_price' => $priceData['system_revenue_tax_value'],
                                'tax_price' => $priceData['total_tax'],
                                'instructor_revenue' => $priceData['instructor_total_earning'],
                                'payment_type' => 'stripe_subscription',
                                'payment_id' => $subscription_id,
                                'payment_response' => json_encode(['id' => $subscription_id]),
                            ]);

                            if ($courseUserDetails->access_sections_count == $subscriptionDetails->subscription_installment_count) {
                                $this->stripeService->cancelSubscription($subscription_id);
                                $courseUserDetails->update(['paid_status' => now()->toDateString(), 'payment_completed_at' => now()->toDateString()]);
                            }
                        }
                    }
                    break;
                case "invoice.payment_failed":
                    /*$param = $request->data->object;
                    $courseUser = CourseUser::where('stripe_customer_id', $param['customer'])->first();
                    if ($courseUser) {
                        CourseUserAccessibility::create([
                            'course_user_id' => $courseUser->id,
                            'payment_status' => 1,
                            'invoice_id' => $request->data->object['id'] ?? null
                        ]);
                        $courseUser->paid_status = 0;
                        $courseUser->save();
                    }*/
                    break;
            }
            return response()->json(['status' => 200, 'message' => 'Success', 'data' => $response ?? null]);
        } catch (\Exception $e) {
            $message = $e->getMessage() . ' At Line number: ' . $e->getLine() . ' in File' . $e->getFile();
            Log::error($message);
            return response()->json(['status' => $status ?? 100, 'message' => $message], $status ?? 500);
        }
    }
}
