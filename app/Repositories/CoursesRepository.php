<?php

namespace App\Repositories;

use App\Interfaces\CoursesRepositoryInterface;
use App\Models\Course;
use App\Models\Curriculum;
use App\Models\CurriculumReview;
use App\Services\NotificationService;
use App\Services\StripeService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CoursesRepository implements CoursesRepositoryInterface
{
    protected $stripeService;

    public function __construct(StripeService $stripeService)
    {
        $this->stripeService = $stripeService;
    }

    public function getCourseDetails($id)
    {
        return Course::byUserType()->where('id', $id)->first();
    }

    public function getCourses($request)
    {
        $courses = Course::byUserType();
        if (!empty($request->category_id)) {
            $courses = $courses->where('category_id', $request->category_id);
        }
        if (isset($request->course_status) && ($request->course_status) != '') {
            $courses = $courses->where('course_status', $request->course_status);
        }
        if (!empty($request->instructor_id)) {
            $courses = $courses->where('instructor_id', $request->instructor_id);
        }
        if (isset($request->is_free) && ($request->is_free) != '') {
            $courses = $courses->where('is_free', $request->is_free);
        }
        return $courses->orderBy('id', 'DESC')->get();
    }

    public function storeCourse($request)
    {
        try {
            $requestData = $request->all();
            $requestData['is_free'] = isset($requestData['is_free']) ? 1 : 0;
            $requestData['what_you_will_learn_points'] = array_values(array_filter($requestData['what_you_will_learn_points']));
            $requestData['who_this_course_is_for_points'] = array_values(array_filter($requestData['who_this_course_is_for_points']));
            $requestData['instructor_id'] = request()->user_id;
            $requestData['course_status'] = 5;
            $requestData['expiration_days'] = !empty($requestData['expiration_days']) && ($requestData['expiration_days'] > 0) ? $requestData['expiration_days'] : null;
            if (($requestData['is_free'] == 0) && ($requestData['price'] <= 0)) {
                $requestData['is_free'] = 1;
            }
            if ($requestData['is_free'] == 1) {
                $requestData['price'] = $requestData['discounted_price'] = $requestData['discount_flag'] = $requestData['subscription_interval'] = $requestData['subscription_price'] = 0;
                $requestData['subscription_interval_count'] = $requestData['subscription_installment_count'] = 1;
            } else {
                $requestData['discount_flag'] = isset($requestData['discount_flag']) ? 1 : 0;
                if (($requestData['discount_flag'] == 1) && ($requestData['discounted_price'] <= 0)) {
                    $requestData['discount_flag'] = 0;
                }
                $requestData['discounted_price'] = ($requestData['discount_flag'] == 1) ? $requestData['discounted_price'] : 0;
                $requestData['subscription_flag'] = isset($requestData['subscription_flag']) ? 1 : 0;
                $requestData['subscription_price'] = ($requestData['subscription_flag'] == 1) ? $requestData['subscription_price'] : 0;
                $requestData['subscription_interval_count'] = ($requestData['subscription_flag'] == 1) ? $requestData['subscription_interval_count'] : 0;
                $requestData['subscription_installment_count'] = ($requestData['subscription_flag'] == 1) ? $requestData['subscription_installment_count'] : 0;
                if (($requestData['subscription_flag'] == 1) && ($requestData['subscription_price'] < 1 || $requestData['subscription_interval_count'] < 1 || $requestData['subscription_installment_count'] < 1)) {
                    return ['status' => false, 'message' => __('backend.courses.flash_message.invalid_subscription_details')];
                }
            }
            if (isset($requestData['image'])) {
                $requestData['image'] = uploadFile($requestData['image'], 'course/images', null, Course::IMAGE_DIMENSION);
            }
            if (isset($requestData['intro_thumbnail_image'])) {
                $requestData['intro_thumbnail_image'] = uploadFile($requestData['intro_thumbnail_image'], 'course/thumbnail_images', null, Course::THUMBNAIL_IMAGE_DIMENSION);
            }
            Course::create($requestData);
            return ['status' => true];
        } catch (\Exception $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    public function updateCourseData($request, $id)
    {
        try {
            $requestData = $request->all();
            $course = self::getCourseDetails($id);
            $requestData['is_free'] = isset($requestData['is_free']) ? 1 : 0;
            $requestData['what_you_will_learn_points'] = array_values(array_filter($requestData['what_you_will_learn_points']));
            $requestData['who_this_course_is_for_points'] = array_values(array_filter($requestData['who_this_course_is_for_points']));
            $requestData['expiration_days'] = !empty($requestData['expiration_days']) && ($requestData['expiration_days'] > 0) ? $requestData['expiration_days'] : null;
            if (($requestData['is_free'] == 0) && ($requestData['price'] <= 0)) {
                $requestData['is_free'] = 1;
            }
            if ($requestData['is_free'] == 1) {
                $requestData['price'] = $requestData['discounted_price'] = $requestData['discount_flag'] = $requestData['subscription_interval'] = $requestData['subscription_price'] = 0;
                $requestData['subscription_interval_count'] = $requestData['subscription_installment_count'] = 1;
            } else {
                $requestData['discount_flag'] = isset($requestData['discount_flag']) ? 1 : 0;
                if (($requestData['discount_flag'] == 1) && ($requestData['discounted_price'] <= 0)) {
                    $requestData['discount_flag'] = 0;
                }
                $requestData['discounted_price'] = ($requestData['discount_flag'] == 1) ? $requestData['discounted_price'] : 0;
                $requestData['subscription_flag'] = isset($requestData['subscription_flag']) ? 1 : 0;
                $requestData['subscription_price'] = ($requestData['subscription_flag'] == 1) ? $requestData['subscription_price'] : 0;
                $requestData['subscription_interval_count'] = ($requestData['subscription_flag'] == 1) ? $requestData['subscription_interval_count'] : 0;
                $requestData['subscription_installment_count'] = ($requestData['subscription_flag'] == 1) ? $requestData['subscription_installment_count'] : 0;
                if (($requestData['subscription_flag'] == 1) && ($requestData['subscription_price'] < 1 || $requestData['subscription_interval_count'] < 1 || $requestData['subscription_installment_count'] < 1)) {
                    return ['status' => false, 'message' => __('backend.courses.flash_message.invalid_subscription_details')];
                }
            }
            if (isset($requestData['intro_video_url']) && $request->hasFile('intro_video_url')) {
                $requestData['intro_video_url'] = uploadFile($requestData['intro_video_url'], 'course/video', $course->intro_video_url);
            }
            if (isset($requestData['image'])) {
                $requestData['image'] = uploadFile($requestData['image'], 'course/images', $course->image, Course::IMAGE_DIMENSION);
            }
            if (isset($requestData['intro_thumbnail_image'])) {
                $requestData['intro_thumbnail_image'] = uploadFile($requestData['intro_thumbnail_image'], 'course/thumbnail_images', $course->intro_thumbnail_image, Course::THUMBNAIL_IMAGE_DIMENSION);
            }
            $course->update($requestData);
            return ['status' => true];
        } catch (\Exception $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    public function deleteCourse($id): bool
    {
        Course::destroy($id);
        return true;
    }

    public function updateActiveStatus($request)
    {
        $course = Course::findOrFail($request->id);
        $course->update(['course_status' => $request->status]);
        if ((request()->user_type == 'admin') && in_array($request->status, [0, 1, 3])) {
            $notificationService = new NotificationService();
            $notificationService->store(
                $course->instructor_id,
                ($request->status == 3) ? 'admin_course_review_submit' : (($request->status == 1) ? 'admin_marks_course_as_active' : 'admin_marks_course_as_pending'),
                ['id' => $course->id, 'name' => $course->name]
            );
        }
        return true;
    }

    public function getCourseTitles()
    {
        if (request()->user_type == 'instructor') {
            return Course::byUserType()->pluck('name', 'id')->toArray();
        } elseif (request()->user_type == 'admin') {
            return Course::pluck('name', 'id')->toArray();
        }
    }

    public function getCurriculumDetails($curriculum_id)
    {
        return Curriculum::with(['relatedComments'])->where('id', $curriculum_id)->first();
    }

    public function getCurriculumComments($request)
    {
        if (isset($request->curriculum_id)) {
            return CurriculumReview::where('curriculum_id', $request->curriculum_id)->get();
        } else {
            return CurriculumReview::whereNull('curriculum_id')->where('course_id', $request->course_id)->get();
        }
    }

    public function submitCurriculumReview($request)
    {
        $requestData = $request->all();
        CurriculumReview::create([
            'course_id' => $requestData['course_id'],
            'curriculum_id' => $requestData['curriculum_id'],
            'user_id' => request()->user_id,
            'user_type' => request()->user_type,
            'content' => $requestData['content'],
        ]);
        if (request()->user_type == 'admin' && isset($requestData['curriculum_id'])) {
            Curriculum::where('id', $requestData['curriculum_id'])->update(['has_pending_comments' => 1]);
        } elseif (request()->user_type == 'admin') {
            Course::where('id', $requestData['course_id'])->update(['has_pending_comments' => 1]);
        }
        if ($requestData['resolved_flag'] == "true" && isset($requestData['curriculum_id'])) {
            Curriculum::where('id', $requestData['curriculum_id'])->update(['has_pending_comments' => 0]);
        } elseif ($requestData['resolved_flag'] == "true") {
            Course::where('id', $requestData['course_id'])->update(['has_pending_comments' => 0]);
        }
        return true;
    }

    public function getCurriculumData($course_id): \Illuminate\Database\Eloquent\Collection|array
    {
        return Curriculum::with(['getSectionChildData'])->whereHas('getSectionChildData')->where('course_id', $course_id)->where('curriculum_type', 'section')->where('is_active', 1)->orderBy('sort_order')->get();
    }

    public function updateCurriculum($request): array
    {
        try {
            $requestData = $request->all();
            foreach ($requestData['sortSectionArray'] as $sortSectionOrder => $sectionId) {
                if (isset($sectionId)) {
                    Curriculum::where('id', $sectionId)->update(['sort_order' => $sortSectionOrder]);
                    foreach ($requestData['sortUnitsArray'][$sectionId] as $sortUnitOrder => $unitId) {
                        Curriculum::where('id', $unitId)->update(['sort_order' => $sortUnitOrder]);
                    }
                }
            } /*
            Curriculum::where('course_id', $requestData['courseId'])->update(['is_free' => 0]);
            if (isset($requestData['selectedCheckboxArray']) && !empty($requestData['selectedCheckboxArray'])) {
            Curriculum::whereIn('id', $requestData['selectedCheckboxArray'])->update(['is_free' => 1]);
            }*/
            return ['status' => true, 'message' => __('global.flash_message.data_updated_successfully')];
        } catch (\Exception$e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    public function getCoursesCount($instructor_id = null)
    {
        if ($instructor_id) {
            return Course::where('instructor_id', $instructor_id)->count();
        } else {
            return Course::pluck('id')->count();
        }

    }

    public function getCourseWiseRevenue($request)
    {
        $requestData = $request->all();
        //for date filter
        $startDate = $endDate = null;
        if ($request->enroll_date) {
            $dateArray = (explode(' - ', $request->enroll_date));
            $startDate = isset($dateArray[0]) ? date('Y-m-d', strtotime($dateArray[0])) : null;
            $endDate = isset($dateArray[1]) ? date('Y-m-d', strtotime($dateArray[1])) : null;
        } elseif(!in_array('enroll_date', array_keys($requestData))) {
            $startDate = Carbon::now()->subYear()->toDateString();
            $endDate = Carbon::now()->toDateString();
        }

        $query = Course::with(['instructorDetail' => function ($q) {
            $q->select('id', 'name');
        }])
            ->with(['paymentTransactionDetail' => function ($q) use ($startDate, $endDate) {
                if (isset($startDate) && isset($endDate)){
                    $q->select('course_id')->groupBy('course_id')
                        ->selectRaw('sum(instructor_revenue) instructor_revenue, sum(system_revenue) admin_revenue')->whereBetween('created_at', array($startDate . ' 00:00:00', $endDate . ' 23:59:59'));
                }else{
                    $q->select('course_id')->groupBy('course_id')
                        ->selectRaw('sum(instructor_revenue) instructor_revenue, sum(system_revenue) admin_revenue');
                }
            }])
            ->with(['courseUserDetail' => function ($course_user_query) use ($startDate, $endDate) {
                if (isset($startDate) && isset($endDate)){
                    $course_user_query->select('course_id')->groupBy('course_id')->selectRaw('count(id) total_enrollments')->whereBetween('created_at', array($startDate . ' 00:00:00', $endDate . ' 23:59:59'));
                }else{
                    $course_user_query->select('course_id')->groupBy('course_id')->selectRaw('count(id) total_enrollments');
                }
            }]);

        //for course filter
        if ($request->course_id) {
            $query = $query->where('id', $request->course_id);
        }
        $course_wise_revenue_report = $query->select('id', 'name', 'instructor_id', 'created_at', 'price')->groupBy('id')->get()->toArray();

        return $course_wise_revenue_report;
    }

}
