<?php

namespace App\Observers;

use App\Models\Webinar;
use App\Models\WebinarUser;

class WebinarUserObserver
{
    public function created(WebinarUser $webinarUser)
    {
        Webinar::where('id', $webinarUser->webinar_id)->increment('total_enrollments');
    }
}
