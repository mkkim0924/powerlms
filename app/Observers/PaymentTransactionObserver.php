<?php

namespace App\Observers;

use App\Events\PaymentSuccessEmailEvent;
use App\Models\InstructorPayoutLog;
use App\Models\OfflinePaymentRequest;
use App\Models\PaymentTransaction;

class PaymentTransactionObserver
{
    public function created(PaymentTransaction $paymentTransaction)
    {
        if ($paymentTransaction->instructor_revenue > 0) {
            InstructorPayoutLog::create([
                'instructor_id' => $paymentTransaction->courseDetails->instructor_id,
                'course_id' => $paymentTransaction->course_id,
                'payment_transaction_id' => $paymentTransaction->id,
                'payment_type' => 'credit',
                'price' => $paymentTransaction->instructor_revenue,
            ]);
        }

        if ($paymentTransaction->payment_type != 'offline_payment'){
            OfflinePaymentRequest::where(['user_id' => $paymentTransaction->user_id, 'module_id' => $paymentTransaction->course_id, 'module_type' => $paymentTransaction->module_type])->delete();
        }
        if (auth()->check()){
            event(new PaymentSuccessEmailEvent($paymentTransaction));
        }
    }
}
