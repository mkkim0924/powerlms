<?php

namespace App\Listeners;

use App\Events\UserRegistrationEvent;
use App\Services\EmailService;
use Carbon\Carbon;

class UserRegistrationEventHandler
{
    protected $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function handle(UserRegistrationEvent $event)
    {
        $user = $event->user;
        $link = route('user.activation-process', $user->activation_token);
        $content_var_values = ['NAME' => $user->name, 'URL' => $link,'DATE_TIME'=> Carbon::now()->format("d-m-Y h:i A")];
        $email_template = 'activation_link';
        $this->emailService->sendEmailToUser($user->email, $email_template, $content_var_values);
    }
}
