<?php

namespace App\Listeners;

use App\Events\SendResetPasswordMailEvent;
use App\Services\EmailService;

class SendResetPasswordEventHandler
{
    protected $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function handle(SendResetPasswordMailEvent $event)
    {
        $emailData = $event->data;
        $link = route('reset-password.link', $emailData['token']);
        $content_var_values = ['NAME' => $emailData['name'], 'URL' => $link,'DATE_TIME'=>date("Y-m-d h:i A")];
        $email_template = 'reset_password';
        $this->emailService->sendEmailToUser($emailData['email'], $email_template, $content_var_values);
    }
}
