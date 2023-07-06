<?php

namespace App\Repositories\Front;

use App\Interfaces\Front\CourseRepositoryInterface;
use App\Models\Bundle;
use App\Models\BundleUser;
use App\Models\Course;
use App\Models\CourseUser;
use App\Models\Curriculum;
use App\Models\CurriculumUser;
use App\Models\LiveLessonSlot;
use App\Models\LiveLessonSlotUser;
use App\Models\QuestionAnswerUser;
use App\Models\QuizQuestion;
use App\Models\QuizQuestionOption;
use App\Models\Review;
use App\Models\Webinar;
use App\Models\WebinarUser;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CourseRepository implements CourseRepositoryInterface
{
    public function getActiveCourses(): \Illuminate\Database\Eloquent\Collection
    {
        return Course::byActive()->get();
    }

    public function getRandCourseReviews(): \Illuminate\Database\Eloquent\Collection
    {
        return Review::with(['courseDetail', 'userDetail'])->whereIn('rating', [4, 5])->limit(12)->get();
    }

    public function getPopularCourses(): \Illuminate\Database\Eloquent\Collection
    {
        return Course::byActive()->orderBy('total_enrollments', 'DESC')->get();
    }

    public function getUserEnrollCourses(): \Illuminate\Database\Eloquent\Collection
    {
        return CourseUser::whereHas('courseDetails', function ($q) {
            $q->byActive();
        })->where(function ($q){
            $q->whereNull('expire_at')->orWhere('expire_at', '>=', Carbon::now());
        })->where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->get();

    }

    public function getRandomBundles(): \Illuminate\Database\Eloquent\Collection
    {
        return Bundle::byActive()->inRandomOrder()->get();
    }

    public function getRandomCourses(): \Illuminate\Database\Eloquent\Collection
    {
        return Course::byActive()->inRandomOrder()->get();
    }

    public function getCourseDetailBySlug($slug)
    {
        return Course::byActive()->whereRaw("BINARY `slug`= ?", [$slug])->first();
    }

    public function getCourseDetailById($course_id)
    {
        return Course::byActive()->select('id', 'name', 'slug', 'price', 'discount_flag', 'discounted_price', 'subscription_price', 'subscription_installment_count','expiration_days')->where('id', $course_id)->first();
    }

    public function getCurriculumList($course_id): \Illuminate\Database\Eloquent\Collection | array
    {
        return Curriculum::with(['getSectionChildData'])->whereHas('getSectionChildData')->where('course_id', $course_id)->where('curriculum_type', 'section')->byActive()->orderBy('sort_order')->get();
    }

    public function getTotalLessonsByCourse($course_id)
    {
        return Curriculum::whereHas('sectionDetail', function ($q) {
            $q->where('is_active', 1);
        })->where('course_id', $course_id)->where('curriculum_type', '!=', 'section')->byActive()->count();
    }

    public function getCourseUserDetail($course_id, $user_id)
    {
        return CourseUser::where(['course_id' => $course_id, 'user_id' => $user_id])->first();
    }

    public function getBundleUserDetail($bundle_id, $user_id)
    {
        return BundleUser::where(['bundle_id' => $bundle_id, 'user_id' => $user_id])->first();
    }

    public function getUserCourseStatistics($course_id, $user_id): array
    {
        return (array) DB::selectOne("SELECT COUNT(CASE WHEN curriculum_type='unit' THEN 1 END) AS total_units, COUNT(CASE WHEN curriculum_type='quiz' THEN 1 END) AS total_quizzes,
	            COUNT(CASE WHEN curriculum_type='unit' AND `is_completed`=1 THEN 1 END) AS total_completed_units, COUNT(CASE WHEN curriculum_type='quiz' AND `is_completed`=1 THEN 1 END) AS total_completed_quizzes
            FROM (
                SELECT curriculum.id,curriculum_type,`curriculum_users`.`is_completed`
                FROM curriculum
                LEFT JOIN `curriculum_users` ON `curriculum_users`.`curriculum_id` = `curriculum`.`id` AND `user_id` = $user_id
                WHERE curriculum.course_id=$course_id AND curriculum.is_active=1 AND curriculum_type!='section' GROUP BY curriculum.id
            ) cc");
    }

    public function getRelatedCourses($course_ids)
    {
        return Course::byActive()->whereIn('id', $course_ids)->get();
    }

    public function getUpcomingWebinars()
    {
        return Webinar::byActive()->where('start_at', '>', Carbon::now())->get();
    }

    public function getPastWebinars($current_webinar_id)
    {
        return Webinar::byActive()->where('end_at', '<', Carbon::now())->where('id', '!=', $current_webinar_id)->get();
    }

    public function getWebinarUserDetails($webinar_id, $user_id)
    {
        return WebinarUser::where('webinar_id', $webinar_id)->where('user_id', $user_id)->first();
    }

    public function enrollWebinar($request)
    {
        return WebinarUser::firstOrCreate(['user_id' => auth()->user()->id, 'webinar_id' => $request->webinar_id]);
    }

    public function getCourseReviews($course_id): \Illuminate\Database\Eloquent\Collection | array
    {
        return Review::with('userDetail')->where('course_id', $course_id)->orderBy('id', 'DESC')->get();
    }

    public function getCourseWiseLiveLessonSlots($course_id, $user_id): \Illuminate\Database\Eloquent\Collection|array
    {
        return LiveLessonSlot::with(['slotUsers' => function($q){
            $q->where('user_id', auth()->user()->id);
        }])->where('course_id', $course_id)->where('end_at', '>=', Carbon::now())->get();
    }

    public function getCourseReviewsWithPaginate($course_id): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return Review::with('userDetail')->where('course_id', $course_id)->orderBy('id', 'DESC')->paginate(10);
    }

    public function enrollCourse($request)
    {
        return CourseUser::firstOrCreate(['course_id' => $request->course_id, 'user_id' => $request->user_id]);
    }

    public function attendLiveLessonSlot($request): bool
    {
        $liveLessonSlot = LiveLessonSlot::find($request->slot_id);
        if (isset($liveLessonSlot)){
            LiveLessonSlotUser::firstOrCreate([
                'user_id' => auth()->user()->id,
                'course_id' => $liveLessonSlot->course_id,
                'live_lesson_id' => $liveLessonSlot->live_lesson_id,
                'live_lesson_slot_id' => $liveLessonSlot->id
            ]);
        }
        return true;
    }

    public function getCurriculumDetailsBySlug($course_slug, $curriculum_slug)
    {
        return Curriculum::with(['courseDetail'])->byActive()->whereRaw("BINARY `course_slug`= ?", [$course_slug])->whereRaw("BINARY `curriculum_slug`= ?", [$curriculum_slug])->first();
    }

    public function getWebinarDetailsBySlug($slug)
    {
        return Webinar::byActive()->whereRaw("BINARY `slug`= ?", [$slug])->first();
    }

    public function getUserCourseCurriculumList($course_id, $user_id, $access_section_count = null)
    {
        $curriculum_list = $lessons = [];
        $sections = Curriculum::select('id', 'section_id', 'name', 'curriculum_type', 'curriculum_slug', 'course_slug', 'time')->where('course_id', $course_id)->where('curriculum_type', 'section')->byActive()->orderBy('sort_order')->get()->toArray();
        foreach ($sections as $sectionKey => $section) {
            $section['lessons'] = Curriculum::byActive()->select('curriculum.id', 'name', 'section_id', 'curriculum_list_id', 'curriculum_type', 'curriculum_slug', 'course_slug', 'time', DB::raw('if(curriculum_users.is_completed,curriculum_users.is_completed,0) as is_completed'))
                ->leftJoin('curriculum_users', function ($join) use ($user_id) {
                    $join->on('curriculum.id', 'curriculum_users.curriculum_id')->where('user_id', $user_id);
                })
                ->where('section_id', $section['section_id'])->where('curriculum_type', '!=', 'section')->groupBy('curriculum.id')->orderBy('sort_order', 'ASC')->orderBy('curriculum.id', 'ASC')->get()->toArray();
            if (!empty($section['lessons'])) {
                $section['user_access'] = is_null($access_section_count) || ($access_section_count >= ($sectionKey + 1));
                $curriculum_list[] = $section;
                if ($section['user_access']){
                    foreach ($section['lessons'] as $lesson) {
                        $lessons[] = $lesson;
                    }
                }
            }
        }
        return ['curriculum_list' => $curriculum_list, 'lessons' => $lessons];
    }

    public function getQuizWiseQuestions($quiz_id)
    {
        return QuizQuestion::where('quiz_id', $quiz_id)->get();
    }

    public function markUnitCompleted($request): array
    {
        try {
            $requestData = $request->all();
            if (isset($requestData['curriculum_id'])) {
                CurriculumUser::updateOrCreate([
                    'user_id' => $request->user_id,
                    'curriculum_id' => $requestData['curriculum_id'],
                ], [
                    'user_id' => $request->user_id,
                    'course_id' => $requestData['course_id'],
                    'curriculum_id' => $requestData['curriculum_id'],
                    'module_id' => $requestData['module_id'],
                    'module_type' => $requestData['module_type'],
                    'is_completed' => $requestData['is_completed'],
                ]);
            }
            $courseUserDetails = $this->getCourseUserDetail($requestData['course_id'], $request->user_id);
            $updatedProgress = $this->getCourseProgress($requestData['course_id'], $request->user_id);
            $redirect_to_complete_screen = ($courseUserDetails->progress != 100) && ($updatedProgress == 100);
            $courseUserDetails->update(['progress' => $updatedProgress]);
            return ['status' => true, 'course_progress' => round($updatedProgress), 'redirect_to_complete_screen' => $redirect_to_complete_screen, 'redirect_url' => route('course_complete', $courseUserDetails->courseDetails->slug)];
        } catch (\Exception$e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    public function submitQuiz($request): array
    {
        DB::beginTransaction();
        try {
            $requestData = $request->all();
            CurriculumUser::create([
                'user_id' => $request->user_id,
                'course_id' => $requestData['course_id'],
                'curriculum_id' => $requestData['curriculum_id'],
                'module_id' => $requestData['quiz_id'],
                'module_type' => 'quiz',
                'is_completed' => 1,
            ]);
            QuestionAnswerUser::where([
                'user_id' => $request->user_id,
                'quiz_id' => $requestData['quiz_id'],
            ])->delete();
            foreach ($requestData['qr'] as $que_id => $ansData) {
                $answerData = [
                    'user_id' => $request->user_id,
                    'course_id' => $requestData['course_id'],
                    'quiz_id' => $requestData['quiz_id'],
                    'question_id' => $que_id,
                ];
                if (isset($requestData['question'][$que_id]) && is_array($requestData['question'][$que_id])) {
                    $answerData['user_answer'] = implode(',', $requestData['question'][$que_id]);
                    $answerData['is_correct_answer'] = ($requestData['question'][$que_id] == $ansData) ? 1 : 0;
                } elseif (isset($requestData['question'][$que_id])) {
                    $answerData['user_answer'] = $requestData['question'][$que_id];
                    $answerData['is_correct_answer'] = ($requestData['question'][$que_id] == $ansData) ? 1 : 0;
                }
                QuestionAnswerUser::create($answerData);
            }
            $courseUserDetails = $this->getCourseUserDetail($requestData['course_id'], $request->user_id);
            $updatedProgress = $this->getCourseProgress($requestData['course_id'], $request->user_id);
            $course_completed = ($courseUserDetails->progress != 100) && ($updatedProgress == 100);
            $courseUserDetails->progress = $updatedProgress;
            $courseUserDetails->save();
            DB::commit();
            return ['status' => true, 'course_completed' => $course_completed];
        } catch (\Exception$e) {
            DB::rollBack();
            dd($e->getMessage());
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    public function getCourseProgress($course_id, $user_id): int | string
    {
        $curriculumStats = (array) DB::selectOne("SELECT COUNT(id) AS total_lessons,
	            COUNT(CASE WHEN `is_completed`=1 THEN 1 END) AS total_completed_lessons
            FROM (
                SELECT curriculum.id,curriculum_type,`curriculum_users`.`is_completed`
                FROM curriculum
                LEFT JOIN `curriculum_users` ON `curriculum_users`.`curriculum_id` = `curriculum`.`id` AND `user_id` = $user_id
                WHERE curriculum.course_id=$course_id AND curriculum.is_active=1 AND curriculum_type!='section' GROUP BY curriculum.id
            ) cc");
        return ($curriculumStats['total_completed_lessons'] > 0) ? number_format((($curriculumStats['total_completed_lessons'] * 100) / $curriculumStats['total_lessons']), 2, '.', ',') : 0;
    }

    public function getUserQuizResultData($quiz_id, $user_id): array
    {
        $returnData = [];
        $question_answers = DB::select("SELECT quiz_questions.id, quiz_questions.title, quiz_questions.que_description, question_answer_users.user_answer, question_answer_users.is_correct_answer, quiz_questions.type, correct_answers, uqos.content AS user_question_answers
            FROM question_answer_users
            LEFT JOIN `quiz_questions` ON quiz_questions.id=question_answer_users.question_id
            LEFT JOIN (SELECT question_id, GROUP_CONCAT(qos.content SEPARATOR ' || ') AS correct_answers
                FROM `quiz_question_options` qos WHERE is_correct_answer=1 GROUP BY question_id) x ON x.question_id = quiz_questions.id
            LEFT JOIN quiz_question_options as uqos ON uqos.question_id = quiz_questions.id AND uqos.option_id=question_answer_users.user_answer
            WHERE question_answer_users.quiz_id=$quiz_id AND question_answer_users.user_id=$user_id");
        $returnData['total_questions'] = count($question_answers);
        $returnData['correct_answers'] = $returnData['incorrect_answers'] = $returnData['unanswered_questions'] = 0;
        foreach ($question_answers as $question_answer) {
            if ($question_answer->type == 'multiple_choice' && !empty($question_answer->user_answer)) {
                $answers = QuizQuestionOption::where('question_id', $question_answer->id)->whereIn('option_id', explode(',', $question_answer->user_answer))->pluck('content')->toArray();
                $question_answer->user_question_answers = implode(' || ', $answers);
            }
            $returnData['questions'][] = (array) $question_answer;
            if (is_null($question_answer->user_answer)) {
                $returnData['unanswered_questions']++;
            } elseif ($question_answer->is_correct_answer == 1) {
                $returnData['correct_answers']++;
            }
        }
        $returnData['incorrect_answers'] = $returnData['total_questions'] - $returnData['correct_answers'] - $returnData['unanswered_questions'];
        $returnData['quiz_grade'] = ($returnData['correct_answers'] > 0) ? number_format((($returnData['correct_answers'] * 100) / $returnData['total_questions']), 2, '.', ',') : 0;
        return $returnData;
    }

    public function getLastQuizUserStatistics($quiz_id, $user_id): array
    {
        $result = DB::selectOne("SELECT COUNT(*) AS total_questions,COUNT(CASE WHEN question_answer_users.is_correct_answer =1 THEN 1 END) AS correct_answers
            FROM question_answer_users
            WHERE question_answer_users.quiz_id=$quiz_id AND question_answer_users.user_id=$user_id");
        $returnData = (array) $result;
        if ($returnData['total_questions'] == 0) {
            return [];
        } else {
            $returnData['quiz_grade'] = ($returnData['correct_answers'] > 0) ? number_format((($returnData['correct_answers'] * 100) / $returnData['total_questions']), 2, '.', ',') : 0;
            return $returnData;
        }
    }

    public function getAttemptQuizCount($quiz_id, $user_id)
    {
        return CurriculumUser::where(['user_id' => $user_id, 'module_id' => $quiz_id, 'module_type' => 'quiz'])->count();
    }

    public function getCourses($request)
    {
        $courses = Course::byActive()->byUserType();
        $category_id = $request->category_id;
        if ($category_id) {
            $courses = $courses->where('category_id', $category_id);
        }
        $search = $request->search;
        if ($search) {
            $courses = $courses->where('name', 'LIKE', '%' . $search . '%');
        }
        $orderBy = !empty($request->order_by) && in_array($request->order_by, ['id', 'total_enrollments', 'average_rating']) ? $request->order_by : 'id';
        return $courses->where('course_status', 1)->orderBy($orderBy, 'DESC')->paginate(8);
    }

    public function submitCourseReview($request): bool
    {
        $requestData = $request->except('_token');
        $user = getCurrentUser();
        if (isset($requestData['review_id'])) {
            Review::where('id', $requestData['review_id'])->update([
                'comment' => $requestData['comment'],
                'rating' => $requestData['rating'],
                'author_name' => $user->name,
            ]);
        } else {
            Review::create([
                'course_id' => $requestData['course_id'],
                'author_id' => $user->id,
                'comment' => $requestData['comment'],
                'rating' => $requestData['rating'],
                'author_name' => $user->name,
            ]);
        }

        return true;
    }
}
