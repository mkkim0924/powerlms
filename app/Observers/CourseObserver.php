<?php

namespace App\Observers;

use App\Models\Course;
use App\Models\CurriculumUser;
use App\Models\Quiz;
use App\Models\Sections;
use App\Models\Units;
use App\Services\StripeService;
use Illuminate\Support\Facades\DB;
use Stripe\Exception\ApiErrorException;

class CourseObserver
{
    protected StripeService $stripeService;

    public function __construct()
    {
        $this->stripeService = new StripeService();
    }

    public function created(Course $course)
    {
        if ($course->subscription_flag == 1) {
            $this->stripeService->createOrUpdateCourseProduct($course);
        }
    }

    public function updated(Course $course)
    {
        if ($course->subscription_flag == 1) {
            $this->stripeService->createOrUpdateCourseProduct($course);
        }
    }

    public function deleted(Course $course)
    {
        Units::where('course_id', $course->id)->delete();
        Quiz::where('course_id', $course->id)->delete();
        Sections::where('course_id', $course->id)->delete();
        CurriculumUser::where('course_id', $course->id)->delete();
    }

    public function restored(Course $course)
    {
    }

    public function forceDeleted(Course $course)
    {
    }
}
