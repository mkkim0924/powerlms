<?php

namespace App\Repositories;

use App\Interfaces\QuizRepositoryInterface;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuizQuestionOption;
use Illuminate\Support\Facades\DB;

class QuizRepository implements QuizRepositoryInterface
{

    public function getQuizDetails($id)
    {
        return Quiz::whereHas('courseDetail', function ($q) {
            $q->byUserType();
        })->where('id', $id)->first();
    }

    public function getQuiz($request)
    {
        $quiz = Quiz::whereHas('courseDetail', function ($q) {
            $q->byUserType();
        });
        $course_id = $request->course_id;
        $section_id = $request->section_id;
        if ($course_id) {
            $quiz = $quiz->where('course_id', $course_id);
        }
        if ($section_id) {
            $quiz = $quiz->where('section_id', $section_id);
        }
        return $quiz->orderBy('id', 'DESC')->get();
    }

    public function storeQuizData($request): array
    {
        $requestData = $request->all();
        $slugExist = checkSlugExist($requestData['course_id'], $requestData['slug']);
        if ($slugExist) {
            return ['status' => false, 'message' => __('backend.quiz.flash_message.slug_already_exist')];
        }
        Quiz::create($requestData);
        return ['status' => true];
    }

    public function updateQuiz($request, $id): bool
    {
        $requestData = $request->all();
        $quiz = self::getQuizDetails($id);
        $quiz->update($requestData);
        return true;
    }

    public function updateActiveStatus($request): bool
    {
        $quiz = Quiz::findOrFail($request->id);
        $quiz->update(['is_active' => $request->is_active]);
        return true;
    }

    /*Quiz Questions*/
    public function getQuizQuestions($id)
    {
        return QuizQuestion::whereHas('courseDetail', function ($q) {
            $q->byUserType();
        })->where('quiz_id', $id)->get();
    }

    public function getQueDetails($id)
    {
        return QuizQuestion::whereHas('courseDetail', function ($q) {
            $q->byUserType();
        })->where('id', $id)->first();
    }

    public function storeQuizQuestion($request): array
    {
        DB::beginTransaction();
        try {
            $requestData = $request->all();
            $quiz = self::getQuizDetails($requestData['quiz_id']);
            $quizQuestion = QuizQuestion::create([
                'course_id' => $quiz->course_id,
                'section_id' => $quiz->section_id,
                'quiz_id' => $quiz->id,
                'title' => $requestData['title'],
                'que_description' => $requestData['que_description'],
                'type' => $requestData['type'],
            ]);
            if ($requestData['type'] == 'multiple_choice') {
                foreach ($requestData['options_data'] as $key => $options_datum) {
                    QuizQuestionOption::create([
                        'quiz_id' => $quiz->id,
                        'question_id' => $quizQuestion->id,
                        'option_id' => $key,
                        'content' => $options_datum['title'],
                        'is_correct_answer' => isset($options_datum['right_answer']) ? 1 : 0,
                    ]);
                }
            } else {
                foreach ($requestData['options'] as $key => $option) {
                    QuizQuestionOption::create([
                        'quiz_id' => $quiz->id,
                        'question_id' => $quizQuestion->id,
                        'option_id' => $key,
                        'content' => $option,
                        'is_correct_answer' => ($key == $requestData['right_answer']) ? 1 : 0,
                    ]);
                }
            }
            DB::commit();
            return ['status' => true];
        } catch (\Exception$e) {
            DB::rollBack();
            dd($e->getMessage());
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    public function updateQuizQuestion($request, $id): array
    {
        DB::beginTransaction();
        try {
            $requestData = $request->all();
            $question = self::getQueDetails($id);
            $question->update([
                'title' => $requestData['title'],
                'que_description' => $requestData['que_description'],
                'type' => $requestData['type'],
            ]);
            QuizQuestionOption::where('question_id', $id)->delete();
            if ($requestData['type'] == 'multiple_choice') {
                foreach ($requestData['options_data'] as $key => $options_datum) {
                    QuizQuestionOption::create([
                        'quiz_id' => $question->quiz_id,
                        'question_id' => $question->id,
                        'option_id' => $key,
                        'content' => $options_datum['title'],
                        'is_correct_answer' => isset($options_datum['right_answer']) ? 1 : 0,
                    ]);
                }
            } else {
                foreach ($requestData['options'] as $key => $option) {
                    QuizQuestionOption::create([
                        'quiz_id' => $question->quiz_id,
                        'question_id' => $question->id,
                        'option_id' => $key,
                        'content' => $option,
                        'is_correct_answer' => ($key == $requestData['right_answer']) ? 1 : 0,
                    ]);
                }
            }
            DB::commit();
            return ['status' => true];
        } catch (\Exception$e) {
            DB::rollBack();
            dd($e->getMessage());
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    public function deleteQuizQuestion($id)
    {
        QuizQuestion::where('id', $id)->delete();
        QuizQuestionOption::where('question_id', $id)->delete();
        return true;
    }
}
