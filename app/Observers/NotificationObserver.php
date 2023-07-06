<?php

namespace App\Observers;

use App\Models\Course;
use App\Models\CurriculumUser;
use App\Models\Notification;
use App\Models\Quiz;
use App\Models\Sections;
use App\Models\Units;
use App\Models\User;
use App\Services\StripeService;
use Illuminate\Support\Facades\DB;
use Stripe\Exception\ApiErrorException;

class NotificationObserver
{
    public function created(Notification $notification)
    {
        User::where('id', $notification->instructor_id)->increment('unread_notifications_count');
    }

    public function updated(Notification $notification)
    {
        User::where('id', $notification->instructor_id)->decrement('unread_notifications_count');
    }
}
