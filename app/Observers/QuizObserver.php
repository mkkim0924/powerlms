<?php

namespace App\Observers;

use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuizQuestionOption;
use App\Services\CurriculumService;

class QuizObserver
{
    public function created(Quiz $quiz)
    {
        $curriculumService = new CurriculumService();
        $curriculumService->store('quiz', $quiz);
        $curriculumService->updateCourseTime($quiz->course_id);
    }

    public function updated(Quiz $quiz)
    {
        $curriculumService = new CurriculumService();
        $curriculumService->update('quiz', $quiz);
        $curriculumService->updateCourseTime($quiz->course_id);
    }

    public function deleted(Quiz $quiz)
    {
        QuizQuestion::where('quiz_id', $quiz->id)->delete();
        QuizQuestionOption::where('quiz_id', $quiz->id)->delete();
        $curriculumService = new CurriculumService();
        $curriculumService->delete('quiz', $quiz->id);
    }

    public function restored(Quiz $quiz)
    {
    }

    public function forceDeleted(Quiz $quiz)
    {
    }
}
