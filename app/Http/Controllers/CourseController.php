<?php

namespace App\Http\Controllers;

use App\Interfaces\Front\CategoryRepositoryInterface;
use App\Interfaces\Front\CourseRepositoryInterface;
use App\Models\CourseSurvey;
use App\Models\CourseUser;
use App\Models\UnitAttachment;
use App\Models\UserCourseSurvey;
use App\Models\UserCourseSurveyHistory;
use App\Models\Webinar;
use App\Models\Widget;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    protected $courseRepository, $categoryRepository;

    public function __construct(CourseRepositoryInterface $courseRepository, CategoryRepositoryInterface $categoryRepository)
    {
        $this->courseRepository = $courseRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllCourses(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $courses = $this->courseRepository->getCourses($request);
        $categories = $this->categoryRepository->getCategoriesTitles();
        $widgets = Widget::get()->groupBy('identifier')->toArray();
        return view('front-end.course.all', compact('courses', 'categories','widgets'));
    }

    public function getCourseDetails($slug)
    {
        $course = $this->courseRepository->getCourseDetailBySlug($slug);
        if (isset($course)) {
            $sections = $this->courseRepository->getCurriculumList($course->id);
            $totalLessons = $this->courseRepository->getTotalLessonsByCourse($course->id);
            $relatedCourses = $this->courseRepository->getRelatedCourses($course->related_courses ?? []);
            $reviews = $this->courseRepository->getCourseReviews($course->id);
            $ratingsArray = getCourseWiseRatingsArray($course->id);
            $courseUserDetail = null;
            $liveLessonSlots = [];
            if (auth()->check()) {
                $courseUserDetail = CourseUser::where(['course_id' => $course->id, 'user_id' => auth()->user()->id])->where(function($q){
                    $q->whereNull('expire_at')->orWhere('expire_at', '>=', Carbon::now());
                })->first();
                if(isset($courseUserDetail)){
                    $liveLessonSlots = $this->courseRepository->getCourseWiseLiveLessonSlots($course->id, auth()->user()->id);
                }
            }
            return view('front-end.course.single', compact('course', 'sections', 'relatedCourses', 'courseUserDetail', 'reviews', 'ratingsArray', 'totalLessons', 'liveLessonSlots'));
        }
        return abort(404);
    }

    public function completeCourse($slug): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $course = $this->courseRepository->getCourseDetailBySlug($slug);
        if (isset($course)) {
            $courseUserDetail = $this->courseRepository->getCourseUserDetail($course->id, auth()->user()->id);
            if (isset($courseUserDetail) && $courseUserDetail->progress == 100) {
                $relatedCourses = $this->courseRepository->getRelatedCourses($course->related_courses ?? []);

                $survey = CourseSurvey::byActive()->where('survey_type','post')->where('course_id',$course->id)->first();
                $recordExist = null;
                if(isset($survey)){
                    $recordExist = UserCourseSurvey::where('survey_id', $survey->id)->where('user_id', auth()->user()->id)->first();
                }
                $preSurveyModalOpen = is_null($recordExist);
                return view('front-end.course.congratulations', compact('survey','preSurveyModalOpen','course', 'relatedCourses'));
            }
            return redirect()->route('course_detail', $course->slug);
        }
        return redirect()->route('courses');
    }

    public function getCourseReviews($slug)
    {
        $course = $this->courseRepository->getCourseDetailBySlug($slug);
        if (isset($course)) {
            $reviews = $this->courseRepository->getCourseReviewsWithPaginate($course->id);
            $widgets = Widget::get()->groupBy('identifier')->toArray();
            return view('front-end.review', compact('course', 'reviews','widgets'));
        }
        return abort(404);
    }

    public function courseStatus(Request $request): \Illuminate\Http\RedirectResponse
    {
        $courseUserDetail = $this->courseRepository->enrollCourse($request);
        $access_section_count = ($courseUserDetail->subscription_payment == 1) ? $courseUserDetail->access_sections_count : null;
        $courseCurriculumData = $this->courseRepository->getUserCourseCurriculumList($request->course_id, $request->user_id, $access_section_count);
        if (!empty($courseCurriculumData['lessons'])) {
            foreach ($courseCurriculumData['lessons'] as $lesson) {
                if ($lesson['is_completed'] == 0) {
                    $lastWatched = $lesson;
                    break;
                }
            }
            if (empty($lastWatched)) {
                $lastWatched = $courseCurriculumData['lessons'][0];
            }
            return redirect()->route('curriculum_detail', [$lastWatched['course_slug'], $lastWatched['curriculum_slug']]);
        }
        return redirect()->back()->with('error', __('backend.courses.error.lesson_not_available'));
    }

    public function attendLiveLessonSlot(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->courseRepository->attendLiveLessonSlot($request);
        return response()->json(['status' => true, 'button_text' =>  __('backend.courses.error.already_in')]);
    }

    public function getWebinarDetails($slug)
    {
        $webinarDetails = $this->courseRepository->getWebinarDetailsBySlug($slug);
        if (isset($webinarDetails)) {
            $relatedCourses = $this->courseRepository->getRelatedCourses($webinarDetails->related_courses ?? []);
            $pastWebinars = $this->courseRepository->getPastWebinars($webinarDetails->id);
            $webinarUser = null;
            if (auth()->check()) {
                $webinarUser = $this->courseRepository->getWebinarUserDetails($webinarDetails->id, auth()->user()->id);
            }
            return view('front-end.webinar.details', compact('webinarDetails', 'relatedCourses', 'pastWebinars', 'webinarUser'));
        }
        return abort(404);
    }

    public function getWebinarLiveStreamDetails($slug)
    {
        $webinarDetails = $this->courseRepository->getWebinarDetailsBySlug($slug);
        if (isset($webinarDetails)) {
            $webinarUser = $this->courseRepository->getWebinarUserDetails($webinarDetails->id, auth()->user()->id);
            if (!empty($webinarUser)){
                $relatedCourses = $this->courseRepository->getRelatedCourses($webinarDetails->related_courses ?? []);
                $pastWebinars = $this->courseRepository->getPastWebinars($webinarDetails->id);
                return view('front-end.webinar.live_stream', compact('webinarDetails', 'relatedCourses', 'pastWebinars'));
            }
            return redirect()->route('webinar_detail', $webinarDetails->slug);
        }
        return abort(404);
    }

    public function enrollWebinar(Request $request): \Illuminate\Http\RedirectResponse
    {
        $this->courseRepository->enrollWebinar($request);
        $webinarDetails = Webinar::find($request->webinar_id);
        if (Carbon::now() < Carbon::parse($webinarDetails->start_at)){
            return redirect()->back();
        }else{
            return redirect()->route('webinar_live_stream', $webinarDetails->slug);
        }
    }

    public function curriculumDetails($course_slug, $curriculum_slug)
    {
        $curriculumDetails = $this->courseRepository->getCurriculumDetailsBySlug($course_slug, $curriculum_slug);
        if (isset($curriculumDetails)) {
            $course = $curriculumDetails->courseDetail;
            $courseUserDetail = $this->courseRepository->getCourseUserDetail($course->id, auth()->user()->id);
            if (!empty($courseUserDetail)) {
                $courseStatistics = $this->courseRepository->getUserCourseStatistics($course->id, auth()->user()->id);
                $quizUserDetails = [];
                $reAttemptBtnEnable = false;
                if ($curriculumDetails->curriculum_type == 'unit') {
                    $lessonDetail = $curriculumDetails->unitDetail;
                } else {
                    $lessonDetail = $curriculumDetails->quizDetail;
                    $lessonDetail->relatedAttachments = [];
                    $quizUserDetails = $this->courseRepository->getLastQuizUserStatistics($lessonDetail->id, auth()->user()->id);
                    $attemptQuizCount = $this->courseRepository->getAttemptQuizCount($lessonDetail->id, auth()->user()->id);
                    $reAttemptBtnEnable = ($lessonDetail->retake >= $attemptQuizCount);
                }
                $access_section_count = ($courseUserDetail->subscription_payment == 1) ? $courseUserDetail->access_sections_count : null;
                $courseCurriculumData = $this->courseRepository->getUserCourseCurriculumList($curriculumDetails->course_id, auth()->user()->id, $access_section_count);
                $curriculumList = $courseCurriculumData['curriculum_list'];
                $all_lessons = $courseCurriculumData['lessons'];
                $pagination = [];
                foreach ($all_lessons as $key => $lesson) {
                    if ($lesson['curriculum_slug'] == $curriculum_slug) {
                        $pagination['current'] = $lesson;
                        if (isset($all_lessons[$key - 1])) {
                            $pagination['prev'] = $all_lessons[$key - 1];
                        }
                        if (isset($all_lessons[$key + 1])) {
                            $pagination['next'] = $all_lessons[$key + 1];
                        }
                        break;
                    }
                }
                $relatedCourses = $this->courseRepository->getRelatedCourses($course->related_courses ?? []);
                $survey = CourseSurvey::byActive()->where('survey_type','pre')->where('course_id',$course->id)->first();
                $recordExist = null;
                if(isset($survey)){
                    $recordExist = UserCourseSurvey::where('survey_id', $survey->id)->where('user_id', auth()->user()->id)->first();
                }
                $preSurveyModalOpen = is_null($recordExist);
                return view('front-end.curriculum_pages.curriculum_details', compact('preSurveyModalOpen','survey','curriculumDetails', 'lessonDetail', 'course', 'curriculumList', 'relatedCourses', 'courseUserDetail', 'courseStatistics', 'quizUserDetails', 'pagination', 'reAttemptBtnEnable'));
            }
            return redirect()->route('course_detail', $course_slug)->with('error', __('backend.courses.error.not_enrolled'));
        }
        return abort(404);
    }

    public function getQuizDetails($course_slug, $curriculum_slug)
    {
        $curriculumDetails = $this->courseRepository->getCurriculumDetailsBySlug($course_slug, $curriculum_slug);
        if (isset($curriculumDetails)) {
            $course = $curriculumDetails->courseDetail;
            $courseUserDetail = $this->courseRepository->getCourseUserDetail($course->id, auth()->user()->id);
            if (!empty($courseUserDetail)) {
                $courseStatistics = $this->courseRepository->getUserCourseStatistics($course->id, auth()->user()->id);
                $quizDetails = $curriculumDetails->quizDetail;
                $questions = $this->courseRepository->getQuizWiseQuestions($quizDetails->id);
                return view('front-end.curriculum_pages.quiz_details', compact('curriculumDetails', 'quizDetails', 'course', 'questions', 'courseUserDetail', 'courseStatistics'));
            }
            return redirect()->route('course_detail', $course_slug)->with('error', __('backend.courses.error.not_enrolled'));
        }
        return abort(404);
    }

    public function markUnitCompleted(Request $request): \Illuminate\Http\JsonResponse
    {
        $response = $this->courseRepository->markUnitCompleted($request);
        return response()->json($response);
    }

    public function submitQuiz(Request $request): \Illuminate\Http\RedirectResponse
    {
        $response = $this->courseRepository->submitQuiz($request);
        if ($response['status']) {
            if ($response['course_completed']) {
                return redirect()->route('quiz_result', [$request->course_slug, $request->quiz_slug, 'course_complete' => 'true']);
            } else {
                return redirect()->route('quiz_result', [$request->course_slug, $request->quiz_slug]);
            }
        } else {
            return redirect()->back();
        }
    }

    public function quizResult($course_slug, $quiz_slug)
    {
        $curriculumDetails = $this->courseRepository->getCurriculumDetailsBySlug($course_slug, $quiz_slug);
        if (isset($curriculumDetails)) {
            $courseUserDetail = $this->courseRepository->getCourseUserDetail($curriculumDetails->course_id, auth()->user()->id);
            $resultData = $this->courseRepository->getUserQuizResultData($curriculumDetails->curriculum_list_id, request()->user_id);

            $access_section_count = ($courseUserDetail->subscription_payment == 1) ? $courseUserDetail->access_sections_count : null;
            $courseCurriculumData = $this->courseRepository->getUserCourseCurriculumList($curriculumDetails->course_id, request()->user_id, $access_section_count);
            $pagination = [];
            $attemptQuizCount = $this->courseRepository->getAttemptQuizCount($curriculumDetails->curriculum_list_id, request()->user_id);
            $reAttemptBtnEnable = ($curriculumDetails->quizDetail->retake >= $attemptQuizCount);
            foreach ($courseCurriculumData['lessons'] as $key => $lesson) {
                if ($lesson['curriculum_slug'] == $quiz_slug) {
                    $pagination['current'] = $lesson;
                    if (isset($courseCurriculumData['lessons'][$key - 1])) {
                        $pagination['prev'] = $courseCurriculumData['lessons'][$key - 1];
                    }
                    if (isset($courseCurriculumData['lessons'][$key + 1])) {
                        $pagination['next'] = $courseCurriculumData['lessons'][$key + 1];
                    }
                    break;
                }
            }
            return view('front-end.curriculum_pages.quiz_result', compact('curriculumDetails', 'resultData', 'pagination', 'reAttemptBtnEnable'));
        }
        return abort(404);
    }

    public function downloadAttachment($attachmentId)
    {
        $user = auth()->user();
        $enrollCourses = CourseUser::where('user_id', $user->id)->pluck('course_id')->toArray();
        $data = UnitAttachment::whereHas('unitDetail.courseDetail', function ($q) use ($enrollCourses){
            $q->whereIn('id', $enrollCourses);
        })->where('id', $attachmentId)->first();
        if (isset($data)){
            $fileUrl = getFileUrl($data->attachment, 'unit/attachments');
            $tempImage = tempnam(sys_get_temp_dir(), $data->attachment);
            copy($fileUrl, $tempImage);

            $nameArray = explode('.', $data->attachment);

            return response()->download($tempImage, $data->title.'.'.end($nameArray))->deleteFileAfterSend(true);
        }else{
            return abort(404);
        }
    }

    public function storeSurveyResults(Request $request)
    {
        $request_data = $request->all();
        $request_data['user_id'] = getCurrentUser()->id;
        $user_course_survey_id = UserCourseSurvey::create($request_data);
        foreach ($request_data['question'] as $key => $value) {
            if(is_array($value)){
                foreach ($value as $sub_key => $sub_value) {
                    $answer_data[] = [
                        'user_course_survey_id' => $user_course_survey_id->id ?? '',
                        'question_id' => $key ?? '',
                        'answers' => $sub_value ?? '',
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];
                }
            }else{
                $answer_data[] = [
                    'user_course_survey_id' => $user_course_survey_id->id ?? '',
                    'question_id' => $key ?? '',
                    'answers' => $value ?? '',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
        }
        UserCourseSurveyHistory::insert($answer_data);
        return redirect()->back();
    }
    public function updateSurveySkipped($survey_id)
    {
        UserCourseSurvey::create(['is_skipped' => 1,'user_id' => getCurrentUser()->id,'survey_id' => $survey_id]);
        return redirect()->back();
    }
}
