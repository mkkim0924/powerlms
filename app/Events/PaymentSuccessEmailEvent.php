<?php

namespace App\Events;

use App\Models\PaymentTransaction;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaymentSuccessEmailEvent implements ShouldQueue
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $paymentTransaction;


    public function __construct(PaymentTransaction $paymentTransaction)
    {
        $this->paymentTransaction = $paymentTransaction;
    }
}
