<?php

namespace App\Http\Controllers;

use App\Interfaces\BundleRepositoryInterface;
use App\Interfaces\Front\CourseRepositoryInterface;
use App\Interfaces\Front\PaymentRepositoryInterface;
use App\Models\OfflinePaymentRequest;
use App\Services\PayuMoneyService;
use App\Services\RazorpayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Omnipay\Omnipay;
use Stripe\StripeClient;

class PaymentController extends Controller
{
    protected $courseRepository, $paymentRepository, $bundleRepository;

    public function __construct(CourseRepositoryInterface $courseRepository, PaymentRepositoryInterface $paymentRepository, BundleRepositoryInterface $bundleRepository)
    {
        $this->courseRepository = $courseRepository;
        $this->paymentRepository = $paymentRepository;
        $this->bundleRepository = $bundleRepository;
    }

    public function index($slug)
    {
        $course = $this->courseRepository->getCourseDetailBySlug($slug);
        if (isset($course)) {
            $type = 'course';
            return view('front-end.payment.index', compact('course', 'type'));
        }
        return redirect()->route('courses');
    }

    public function bundlePayment($slug)
    {
        $course = $this->bundleRepository->getBundleDetailBySlug($slug);
        if (isset($course)) {
            $type = 'bundle';
            return view('front-end.payment.index', compact('course', 'type'));
        }
        return redirect()->route('courses');
    }

    public function stripePayment(Request $request): \Illuminate\Http\RedirectResponse
    {
        $requestData = $request->all();
        $user = getCurrentUser();
        if ($requestData['type'] == 'course') {
            $course = $this->courseRepository->getCourseDetailById($request->course_id);
            $amount = ($course->discount_flag == 1) ? $course->discounted_price : $course->price;
        } elseif ($requestData['type'] == 'bundle') {
            $course = $this->bundleRepository->getBundleDetailWithActiveCourses($request->course_id);
            $amount = $course->price;
        }

        if (empty(request()->get('stripeToken'))) {
            session()->flash('error', __('backend.payments.error.some_error_while_making'));
            return redirect()->back();
        }

        $stripe = new StripeClient(config('services.stripe.secret'));

        $token = $request->stripeToken;

        try {
            /** Add customer to stripe, Stripe customer */
            $customer = $stripe->customers->create([
                'name' => $user->name,
                'email' => $user->email,
                'source' => $token
            ]);
        } catch (\Exception $e) {
            $apiError = $e->getMessage();
        }

        if (empty($apiError) && $customer) {
            try {
                /** Stripe charge class */
                $currency = config('app.currency');
                $charge = $stripe->charges->create([
                    'customer' => $customer->id,
                    'amount' => $amount * 100,
                    'currency' => $currency,
                    'description' => $course->name
                ]);
            } catch (\Exception $e) {
                $apiError = $e->getMessage();
            }

            if (empty($apiError) && $charge) {
                $paymentDetails = $charge->jsonSerialize();
                if ($paymentDetails['amount_refunded'] == 0 && empty($paymentDetails['failure_code']) && $paymentDetails['paid'] == 1 && $paymentDetails['captured'] == 1) {
                    if ($requestData['type'] == 'course') {
                        $this->paymentRepository->purchaseCourse($user->id, $course, $charge, 'stripe');
                    } elseif ($requestData['type'] == 'bundle') {
                        $this->paymentRepository->purchaseBundle($user->id, $course, $charge, 'stripe');
                    }
                    return redirect()->route('payment.thank_you', [$requestData['type'], $course->slug]);
                }
            } else {
                session()->flash('error', 'Error in capturing amount: ' . $apiError);
                return redirect()->back();
            }
        } else {
            session()->flash('error', 'Invalid card details: ' . $apiError);
            return redirect()->back();
        }
    }

    public function razorpayPayment(Request $request): \Illuminate\Http\RedirectResponse
    {
        $requestData = $request->all();
        $amount = 0;
        if ($requestData['type'] == 'course') {
            $course = $this->courseRepository->getCourseDetailById($request->course_id);
            $amount = ($course->discount_flag == 1) ? $course->discounted_price : $course->price;
        } elseif ($requestData['type'] == 'bundle') {
            $bundle = $this->bundleRepository->getBundleDetailWithActiveCourses($request->course_id);
            $amount = $bundle->price;
        }
        $currency = config('app.currency');
        $amount = $amount * 100;
        $razorWrapper = new RazorpayService();
        $orderId = $razorWrapper->order($currency, $amount);
        $user = auth()->user();
        $cart = [
            'order_id' => $orderId,
            'amount' => $amount,
            'currency' => $currency,
            'description' => $user->name,
            'name' => $user->name,
            'email' => $user->email,
        ];
        return redirect()->back()->with(['razorpay' => $cart]);
    }

    public function createRazorpayPayment(Request $request): \Illuminate\Http\RedirectResponse
    {
        if ($request->type == 'course') {
            $course = $this->courseRepository->getCourseDetailById($request->course_id);
        } elseif ($request->type == 'bundle') {
            $course = $this->bundleRepository->getBundleDetailWithActiveCourses($request->course_id);
        }
        $attributes = ['razorpay_signature' => $request->razorpay_signature, 'razorpay_payment_id' => $request->razorpay_payment_id, 'razorpay_order_id' => $request->razorpay_order_id];
        $razorWrapper = new RazorpayService();
        if ($razorWrapper->verifySignature($attributes)) {
            $payment = $razorWrapper->capturePaymentDetail();
            if ($request->type == 'course') {
                $this->paymentRepository->purchaseCourse(request()->user_id, $course, $payment->toArray(), 'razorpay');
            } elseif ($request->type == 'bundle') {
                $this->paymentRepository->purchaseBundle(request()->user_id, $course, $payment->toArray(), 'razorpay');
            }
            return redirect()->route('payment.thank_you', [$request->type, $course->slug]);
        } else {
            return redirect()->route('payment.' . $request->type, $course->slug);
        }
    }

    public function storeOfflinePayment(Request $request): \Illuminate\Http\RedirectResponse
    {
        $user_id = auth()->user()->id;
        $data = ['user_id' => $user_id, 'module_id' => $request->module_id, 'module_type' => $request->module_type];
        $requestExist = OfflinePaymentRequest::where($data)->first();
        if (empty($requestExist)) {
            OfflinePaymentRequest::create($data);
            return redirect()->route('course_detail', $request->course_slug)->with('success', __('backend.payments.error.request_received_successfully_check'));
        }
        return redirect()->back()->with('error', __('backend.payments.error.you_already_sent_a_request'));
    }

    public function paypalRedirection(Request $request)
    {
        $gateway = Omnipay::create('PayPal_Rest');
        $gateway->setClientId(config('paypal.client_id'));
        $gateway->setSecret(config('paypal.secret'));
        $mode = (config('paypal.settings.mode') == 'sandbox');
        $gateway->setTestMode($mode);

        $requestData = $request->all();
        $amount = 0;
        if ($requestData['type'] == 'course') {
            $course = $this->courseRepository->getCourseDetailById($request->course_id);
            $amount = ($course->discount_flag == 1) ? $course->discounted_price : $course->price;
        } elseif ($requestData['type'] == 'bundle') {
            $course = $this->bundleRepository->getBundleDetailWithActiveCourses($request->course_id);
            $amount = $course->price;
        }

        $currency = config('app.currency');
        try {
            $response = $gateway->purchase([
                'amount' => $amount,
                'currency' => $currency,
                'description' => $course->name,
                'cancelUrl' => route('payment.paypal.cancel', ['course_id' => $request->course_id]),
                'returnUrl' => route('payment.paypal.success', ['course_id' => $request->course_id]),
            ])->send();
            if ($response->isRedirect()) {
                return Redirect::away($response->getRedirectUrl());
            }
            return redirect()->back()->with('error', $response->getMessage());
        } catch (\Exception$e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function paypalSuccess(Request $request)
    {
        if ($request->type == 'course') {
            $course = $this->courseRepository->getCourseDetailById($request->course_id);
            $this->paymentRepository->purchaseCourse(request()->user_id, $course, ['id' => $request->paymentId], 'paypal');
        } elseif ($request->type == 'bundle') {
            $bundle = $this->bundleRepository->getBundleDetailWithActiveCourses($request->course_id);
            $this->paymentRepository->purchaseBundle(request()->user_id, $bundle, ['id' => $request->paymentId], 'paypal');
        }
        return redirect()->route('payment.thank_you', [$request->type, $course->slug]);
    }

    public function payuPayment(Request $request)
    {
        $requestData = $request->all();
        $payumoneyWrapper = new PayuMoneyService();
        if ($requestData['type'] == 'course') {
            $course = $this->courseRepository->getCourseDetailById($request->course_id);
            $amount = ($course->discount_flag == 1) ? $course->discounted_price : $course->price;
        } elseif ($requestData['type'] == 'bundle') {
            $course = $this->bundleRepository->getBundleDetailWithActiveCourses($request->course_id);
            $amount = $course->price;
        }
        $parameter = [
            'amount' => $amount,
            'firstname' => $requestData['user_name'],
            'productinfo' => $course->name,
            'email' => $requestData['user_email'],
            'phone' => $requestData['user_phone'],
            'type' => $requestData['type'],
            'course_id' => $requestData['course_id'],
            'surl' => route('payment.payu_status', ['type' => $requestData['type'], 'course_id' => $requestData['course_id']]),
            'furl' => route('payment.payu_status', ['type' => $requestData['type'], 'course_id' => $requestData['course_id']]),
        ];
        return $payumoneyWrapper->request($parameter);
    }

    public function getPayUStatus(Request $request)
    {
        $payumoneyWrapper = new PayuMoneyService();
        $response = $payumoneyWrapper->response($request);
        if ($request->type == 'course') {
            $course = $this->courseRepository->getCourseDetailById($request->course_id);
        } elseif ($request->type == 'bundle') {
            $course = $this->bundleRepository->getBundleDetailWithActiveCourses($request->course_id);
        }
        if (is_array($response) && $response['status'] == 'success') {
            if ($request->type == 'course') {
                $this->paymentRepository->purchaseCourse(request()->user_id, $course, ['id' => $response['payuMoneyId']], 'payu');
            } elseif ($request->type == 'bundle') {
                $this->paymentRepository->purchaseBundle(request()->user_id, $course, ['id' => $response['payuMoneyId']], 'payu');
            }
            return redirect()->route('payment.thank_you', [$request->type, $course->slug]);
        }
        return redirect()->route('payment.' . $request->type, $course->slug)->with('error', __('backend.payments.error.transaction_cancelled'));
    }

    public function thankYouPage($type, $slug): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        if ($type == 'course') {
            $course = $this->courseRepository->getCourseDetailBySlug($slug);
            if (isset($course)) {
                $courseUserDetails = $this->courseRepository->getCourseUserDetail($course->id, auth()->user()->id);
                if (isset($courseUserDetails) && ($courseUserDetails->paid_status == 1)) {
                    $price = $courseUserDetails->price;
                    return view('front-end.payment.thank_you', compact('slug', 'course', 'courseUserDetails', 'price'));
                }
                return redirect()->route('course_detail', $slug);
            }
        } elseif ($type == 'bundle') {
            $course = $this->bundleRepository->getBundleDetailBySlug($slug);
            if (isset($course)) {
                $courseUserDetails = $this->courseRepository->getBundleUserDetail($course->id, auth()->user()->id);
                if (isset($courseUserDetails)) {
                    $price = $course->price;
                    return view('front-end.payment.thank_you', compact('slug', 'course', 'courseUserDetails', 'price'));
                }
                return redirect()->route('course_detail', $slug);
            }
        }
        return redirect()->route('courses');
    }

    // Purchase
    public function userPurchaseHistory(Request $request)
    {
        $purchase = $this->paymentRepository->getUserPurchasesHistory();
        return view('front-end.user.purchase', compact('purchase'));
    }

    public function invoice($id)
    {
        $invoice = $this->paymentRepository->getPurchaseDetails($id);
        if (isset($invoice)){
            return view('front-end.user.invoice', compact('invoice'));
        }
        return abort(404);
    }
}
