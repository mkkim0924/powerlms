<?php

namespace App\Widgets;

use App\Models\Notification;
use Arrilot\Widgets\AbstractWidget;

class NotificationListWidget extends AbstractWidget
{
    public $reloadTimeout = 0;

    public function run()
    {
        $instructor = getCurrentUser();
        $notifications = Notification::where('instructor_id', $instructor->id)->orderBy('created_at', 'DESC')->get();
        return view('widgets.notification_list_widget', [
            'notifications' => $notifications,
            'instructor' => $instructor,
        ]);
    }
}
