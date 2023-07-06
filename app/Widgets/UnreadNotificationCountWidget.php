<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

class UnreadNotificationCountWidget extends AbstractWidget
{
    public $reloadTimeout = 2;

    public function run()
    {
        $instructor = getCurrentUser();
        if ($instructor->unread_notifications_count > 0){
            return '<span class="badge badge-pill badge-danger noti unreadCountSpan position-absolute">'.$instructor->unread_notifications_count.'</span>';
        }else{
            return '';
        }
    }
}
