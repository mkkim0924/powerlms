<?php

namespace App\Listeners;

use App\Services\EmailService;

class AdminSetPasswordEventListener
{
    protected $emailService;
    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function handle($event)
    {
        $user = $event->admin;
        $link = route('admin.set_password', $user['activation_token']);
        $content_var_values = ['NAME' => $user['name'], 'URL' => $link];
        $email_template = 'admin_set_password_mail';
        $this->emailService->sendEmailToUser($user['email'], $email_template, $content_var_values);
    }
}
