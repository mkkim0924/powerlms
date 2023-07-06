<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailTemplates extends Model
{
    const EMAIL_ACTION = [
        'reset_password' => 'Reset Password',
        'activation_link' => 'Activation Link',
        'admin_set_password_mail' => 'Admin Set Password Mail',
        'instructor_application_approve' => 'Instructor Application Approval Mail',
        'instructor_application_reject' => 'Instructor Application Reject Mail',
        'admin_create_instructor_application' => 'Instructor account open Mail',
        'live_lesson_slot_details_mail' => 'Live Lesson Slot Details Mail',
        'live_lesson_slot_reminder_mail' => 'Live Lesson Slot Reminder Mail',
        'live_lesson_slot_update_mail' => 'Live Lesson Slot Update Mail',
        'live_lesson_slot_delete_mail' => 'Live Lesson Slot Delete Mail',
        'offline_payment_request_reject_mail' => 'Offline Payment Request Reject Mail',
        'offline_payment_request_approve_mail' => 'Offline Payment Request Approve Mail',
        'payment_success_mail' => 'Payment Success Mail',
    ];

    protected $table = 'email_templates';

    protected $primaryKey = 'id';

    protected $fillable = ['identifier', 'title', 'subject', 'content', 'attachment'];
}
