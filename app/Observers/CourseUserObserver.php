<?php

namespace App\Observers;

use App\Models\Course;
use App\Models\CourseUser;

class CourseUserObserver
{
    public function created(CourseUser $courseUser)
    {
        Course::where('id', $courseUser->course_id)->increment('total_enrollments');
    }
}
