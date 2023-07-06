<?php

namespace App\Listeners;

use App\Services\EmailService;

class InstructorApplicationApproveEventListener
{
    protected $emailService;
    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function handle($event)
    {
        $user = $event->user;
        $link = route('login');
        $content_var_values = ['NAME' => $user['name'], 'URL' => $link];
        $email_template = 'instructor_application_approve';
        $this->emailService->sendEmailToUser($user['email'], $email_template, $content_var_values);
    }
}
