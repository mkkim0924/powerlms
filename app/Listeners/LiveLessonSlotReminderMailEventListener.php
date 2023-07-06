<?php

namespace App\Listeners;

use App\Services\EmailService;

class LiveLessonSlotReminderMailEventListener
{
    protected $emailService;
    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function handle($event)
    {
        $data = $event->emailData;
        $content_var_values = ['NAME' => $data['name'], 'TITLE' => $data['title'],'START_AT' => $data['start_at'], 'MEETING_ID' => $data['meeting_id'],
            'PASSWORD' => $data['password'], 'JOIN_URL' => $data['join_url'], 'DURATION' => $data['duration']];
        $email_template = 'live_lesson_slot_reminder_mail';
        $this->emailService->sendEmailToUser($data['email'], $email_template, $content_var_values);
    }
}
