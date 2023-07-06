<?php

use App\Http\Controllers\Admin\BundleController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FaqsController;
use App\Http\Controllers\Admin\LiveLessonController;
use App\Http\Controllers\Admin\LiveLessonSlotController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\WebinarController;
use App\Http\Controllers\Admin\ChatController;
use App\Http\Controllers\Admin\CourseInterviewQuestionController;
use App\Http\Controllers\Admin\CourseSurveyController;
use App\Http\Controllers\Admin\ReviewController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'instructor/', 'as' => 'instructor.', 'middleware' => ['web', 'instructorAccess']], function () {

    Route::get('/dashboard', [DashboardController::class, 'instructorDashboard'])->name('dashboard');

    Route::get('profile', [ProfileController::class, 'getInstructorProfile'])->name('profile');
    Route::post('profile/update', [ProfileController::class, 'updateInstructorProfile'])->name('profile.update');

    Route::get('notifications', [ProfileController::class, 'getInstructorNotifications'])->name('notifications');
    Route::get('notification/read/{id}', [ProfileController::class, 'readInstructorNotification'])->name('notification.read');

    Route::get('chat', [ChatController::class, 'index'])->name('chat');

    Route::get('reviews', [ReviewController::class, 'index'])->name('reviews');

    //courses
    Route::controller(CourseController::class)->group(function () {
        Route::get('courses', 'index')->name('courses');
        Route::get('course/create', 'create')->name('courses.create');
        Route::post('course/store', 'store')->name('courses.store');
        Route::get('course/edit/{id}', 'edit')->name('courses.edit');

        Route::post('course/update/{id}', 'update')->name('courses.update');
        Route::get('course/delete/{id}', 'delete')->name('courses.delete');
        Route::get('course/status/update', 'updateStatus')->name('courses.update.status');
        Route::get('course/curriculum/{id}', 'getCurriculum')->name('courses.curriculum');
        Route::post('course/curriculum/update', 'updateCurriculum')->name('courses.curriculum_update');

        Route::post('course/price-calculation', 'calculateCoursePrice')->name('courses.price-calculation');

        Route::get('course/review/{id}', 'curriculumPage')->name('courses.review');
        Route::post('course/getCurriculumComments', 'getCurriculumComments')->name('courses.getCurriculumComments');
        Route::post('course/getCurriculumData', 'curriculumDetails')->name('courses.curriculumDetails');
        Route::post('course/curriculum-review/submit', 'submitCurriculumReview')->name('courses.submitCurriculumReview');

        Route::get('course/update-status/{id}/{status}', 'updateStatus')->name('courses.updateStatus');
    });

    // Lessons
    Route::controller(SectionController::class)->group(function () {
        Route::get('lessons', 'index')->name('sections');
        Route::get('lessons/create', 'create')->name('sections.create');
        Route::post('lessons/store', 'store')->name('sections.store');
        Route::get('lessons/edit/{id}', 'edit')->name('sections.edit');
        Route::post('lessons/update/{id}', 'update')->name('sections.update');
        Route::get('lessons/delete/{id}', 'delete')->name('sections.delete');
        Route::get('lessons/status/update', 'updateStatus')->name('sections.update.status');
        Route::get('get-sections-by-course', 'getSectionByCourse')->name('getSectionByCourse');
    });

    // Units
    Route::controller(UnitController::class)->group(function () {
        Route::get('chapters', 'index')->name('units');
        Route::get('chapters/create', 'create')->name('units.create');
        Route::post('chapters/store', 'store')->name('units.store');
        Route::get('chapters/edit/{id}', 'edit')->name('units.edit');
        Route::post('chapters/update/{id}', 'update')->name('units.update');
        Route::get('chapters/delete/{id}', 'delete')->name('units.delete');
        Route::get('chapters/status/update', 'updateStatus')->name('units.update.status');
        Route::post('chapters/remove-attachment', 'removeAttachment')->name('units.removeAttachment');
    });

    // Quiz
    Route::controller(QuizController::class)->group(function () {
        Route::get('tests', 'index')->name('quiz');
        Route::get('test/create', 'create')->name('quiz.create');
        Route::post('test/store', 'store')->name('quiz.store');
        Route::get('test/edit/{id}', 'edit')->name('quiz.edit');
        Route::post('test/update/{id}', 'update')->name('quiz.update');
        Route::get('test/delete/{id}', 'delete')->name('quiz.delete');
        Route::get('test/status/update', 'updateStatus')->name('quiz.update.status');

        Route::get('test/questions/{quiz_id}', 'getQuizQuestions')->name('quiz.questions');
        Route::get('test/questions/create/{quiz_id}', 'createQuizQuestion')->name('quiz.question_create');
        Route::post('test/questions/store', 'storeQuizQuestion')->name('quiz.question_store');
        Route::get('test/questions/edit/{que_id}', 'editQuizQuestion')->name('quiz.question_edit');
        Route::post('test/questions/update/{que_id}', 'updateQuizQuestion')->name('quiz.question_update');
        Route::get('test/questions/delete/{que_id}', 'deleteQuizQuestion')->name('quiz.question_delete');
    });

    // FAQS
    Route::controller(FaqsController::class)->group(function () {
        Route::get('faqs', 'index')->name('faqs');
        Route::get('faqs/create', 'create')->name('faqs.create');
        Route::post('faqs/store', 'store')->name('faqs.store');
        Route::get('faqs/edit/{id}', 'edit')->name('faqs.edit');
        Route::post('faqs/update/{id}', 'update')->name('faqs.update');
        Route::get('faqs/delete/{id}', 'delete')->name('faqs.delete');
        Route::get('get-question-by-course{course_id}', 'getFaqsByCourse')->name('faqs.getFaqsByCourse');

    });

    Route::controller(ReportController::class)->group(function () {
        Route::get('course-report', 'courseReport')->name('course_report');
        Route::get('sales-report', 'salesReport')->name('sales_report');
        Route::get('course-survey-report', 'courseSurveyReport')->name('course_survey_report');
        Route::get('course-survey-report/details/{id}', 'courseSurveyReportDetails')->name('course_survey_report.details');
        Route::get('payout-report', 'instructorPayoutReport')->name('payout_report');
        Route::post('payout-request/store', 'storePayoutRequest')->name('payout_request.store');
        Route::get('payout-request/delete/{id}', 'deletePayoutRequest')->name('payout_request.delete');

        Route::get('course-report/export', 'exportCourseReport')->name('course_report.export');
        Route::get('sales-report/export', 'exportSalesReport')->name('sales_report.export');
        Route::get('payout-report/export', 'exportInstructorPayoutReport')->name('payout_report.export');

        Route::get('course-report/progress/{id}', 'getUserCourseProgressReport')->name('course_report.getUserCourseProgressReport');
        Route::post('course-report/progress/quiz-result', 'quizResult')->name('course_report.quizResult');
    });

    Route::controller(BundleController::class)->group(function () {
        Route::get('bundles', 'index')->name('bundle');
        Route::get('bundle/create', 'create')->name('bundle.create');
        Route::post('bundle/store', 'store')->name('bundle.store');
        Route::get('bundle/edit/{id}', 'edit')->name('bundle.edit');
        Route::post('bundle/update/{id}', 'update')->name('bundle.update');
        Route::get('bundle/delete/{id}', 'delete')->name('bundle.delete');
        Route::get('bundle/status/update', 'updateStatus')->name('bundle.update.status');
    });

    Route::controller(LiveLessonController::class)->group(function () {
        Route::get('live-lessons', 'index')->name('live_lessons');
        Route::get('live-lessons/create', 'create')->name('live_lessons.create');
        Route::post('live-lessons/store', 'store')->name('live_lessons.store');
        Route::get('live-lessons/edit/{id}', 'edit')->name('live_lessons.edit');
        Route::post('live-lessons/update/{id}', 'update')->name('live_lessons.update');
        Route::get('live-lessons/delete/{id}', 'delete')->name('live_lessons.delete');
    });

    Route::controller(LiveLessonSlotController::class)->group(function () {
        Route::get('live-lessons-slot', 'index')->name('liveLessonSlots');
        Route::get('live-lessons-slot/create', 'create')->name('liveLessonSlots.create');
        Route::post('live-lessons-slot/store', 'store')->name('liveLessonSlots.store');
        Route::get('live-lessons-slot/edit/{id}', 'edit')->name('liveLessonSlots.edit');
        Route::post('live-lessons-slot/update/{id}', 'update')->name('liveLessonSlots.update');
        Route::get('live-lessons-slot/delete/{id}', 'delete')->name('liveLessonSlots.delete');
        Route::get('live-lessons-slot/attendees/{id}', 'attendees')->name('liveLessonSlots.attendees');

        Route::get('zoom-settings', 'getZoomSettings')->name('zoomSettings');
        Route::post('zoom-settings/update', 'updateZoomSettings')->name('updateZoomSettings');

    });
    Route::controller(WebinarController::class)->group(function () {
        Route::get('webinars', 'index')->name('webinar');
        Route::get('webinar/create', 'create')->name('webinar.create');
        Route::post('webinar/store', 'store')->name('webinar.store');
        Route::get('webinar/edit/{id}', 'edit')->name('webinar.edit');
        Route::post('webinar/update/{id}', 'update')->name('webinar.update');
        Route::get('webinar/delete/{id}', 'delete')->name('webinar.delete');
    });
    Route::controller(CourseSurveyController::class)->group(function () {
        Route::get('surveys', 'index')->name('surveys');
        Route::get('survey/create', 'create')->name('survey.create');
        Route::post('survey/store', 'store')->name('survey.store');
        Route::get('survey/edit/{id}', 'edit')->name('survey.edit');
        Route::post('survey/update/{id}', 'update')->name('survey.update');
        Route::get('survey/delete/{id}', 'delete')->name('survey.delete');

        Route::get('survey/status/update', 'updateStatus')->name('survey.update.status');

        Route::get('survey/questions/{survey_id}', 'getSurveyQuestions')->name('survey.questions');
        Route::get('survey/questions/create/{survey_id}', 'createSurveyQuestion')->name('survey.question_create');
        Route::post('survey/questions/store', 'storeSurveyQuestion')->name('survey.question_store');
        Route::get('survey/questions/edit/{que_id}', 'editSurveyQuestion')->name('survey.question_edit');
        Route::post('survey/questions/update/{que_id}', 'updateSurveyQuestion')->name('survey.question_update');
        Route::get('survey/questions/delete/{que_id}', 'deleteSurveyQuestion')->name('survey.question_delete');
    });
    Route::controller(CourseInterviewQuestionController::class)->group(function () {
        Route::get('course_interview_questions', 'index')->name('course_interview_questions');
        Route::get('course_interview_question/create', 'create')->name('course_interview_question.create');
        Route::post('course_interview_question/store', 'store')->name('course_interview_question.store');
        Route::get('course_interview_question/edit/{id}', 'edit')->name('course_interview_question.edit');
        Route::post('course_interview_question/update/{id}', 'update')->name('course_interview_question.update');
        Route::get('course_interview_question/delete/{id}', 'delete')->name('course_interview_question.delete');
    });
});
