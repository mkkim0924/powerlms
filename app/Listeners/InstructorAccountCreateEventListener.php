<?php

namespace App\Listeners;

use App\Services\EmailService;

class InstructorAccountCreateEventListener
{
    protected $emailService;
    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function handle($event)
    {
        $emailData = $event->emailData;
        $email = $emailData['email'];
        $password = $emailData['password'];
        $content_var_values = ['NAME' => $emailData['name'], 'EMAIL' => $email, 'PASSWORD' => $password];
        $email_template = 'admin_create_instructor_application';
        $this->emailService->sendEmailToUser($emailData['email'], $email_template, $content_var_values);
    }
}
