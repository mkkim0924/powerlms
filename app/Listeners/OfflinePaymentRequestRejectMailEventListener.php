<?php

namespace App\Listeners;

use App\Services\EmailService;

class OfflinePaymentRequestRejectMailEventListener
{
    protected $emailService;
    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function handle($event)
    {
        $data = $event->emailData;
        $content_var_values = ['NAME' => $data['name'], 'TITLE' => $data['title'], 'AMOUNT' => $data['amount']];
        $email_template = 'offline_payment_request_reject_mail';
        $this->emailService->sendEmailToUser($data['email'], $email_template, $content_var_values);
    }
}
