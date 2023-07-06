<?php

namespace App\Listeners;

use App\Services\EmailService;

class InstructorApplicationRejectEventListener
{
    protected $emailService;
    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function handle($event)
    {
        $user = $event->user;
        $reason = $user['application_reject_reason'];
        $content_var_values = ['NAME' => $user['name'], 'REASON' => $reason, 'URL' => route('login')];
        $email_template = 'instructor_application_reject';
        $this->emailService->sendEmailToUser($user['email'], $email_template, $content_var_values);
    }
}
