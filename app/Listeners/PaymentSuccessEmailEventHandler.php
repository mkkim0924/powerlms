<?php

namespace App\Listeners;

use App\Events\PaymentSuccessEmailEvent;
use App\Services\EmailService;

class PaymentSuccessEmailEventHandler
{
    protected $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function handle(PaymentSuccessEmailEvent $event)
    {
        $transactionDetail = $event->paymentTransaction;
        $title = ($transactionDetail->module_type == 'course') ? $transactionDetail->courseDetails->name : $transactionDetail->bundleDetails->name;
        $content_var_values = ['NAME' => $transactionDetail->userDetails->name, 'TITLE' => $title, 'AMOUNT' => formatPrice($transactionDetail->price), 'DATE_TIME' => formatDate($transactionDetail->created_at)];
        $email_template = 'payment_success_mail';
        $this->emailService->sendEmailToUser($transactionDetail->userDetails->email, $email_template, $content_var_values);
    }
}
