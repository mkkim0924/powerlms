<?php


namespace App\Services;


use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Razorpay\Api\Api;

class RazorpayService
{

    private $razorPay;

    public function __construct()
    {
        $this->razorPay = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
    }

    public function order($currency, $amount)
    {
        $receiptId = Str::random(32);
        $order = $this->razorPay->order->create(array('receipt' => $receiptId, 'amount' => $amount, 'currency' => $currency));
        return $order['id'];
    }

    public function verifySignature($attributes)
    {
        try {
            $this->razorPay->utility->verifyPaymentSignature($attributes);
            return true;
        } catch (\Exception $e) {
            Log::info($e->getMessage() . ' for id = ' . auth()->user()->id);
            return false;
        }
    }

    /**
     * @throws Exception
     */
    public function capturePaymentDetail()
    {
        try {
            $razorpay_payment_id = request()->razorpay_payment_id ?? null;
            if ($razorpay_payment_id == null)
                throw new Exception('Please Provide Razorpay Payment Id');
            return $this->razorPay->payment->fetch($razorpay_payment_id);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
