<?php

namespace App\Interfaces;

interface QuizRepositoryInterface
{
    public function getQuizDetails($id);

    public function getQuiz($request);

    public function storeQuizData($request);

    public function updateQuiz($request, $id);

    public function updateActiveStatus($request);

    /*Quiz Questions*/
    public function getQuizQuestions($id);

    public function getQueDetails($id);

    public function storeQuizQuestion($request);

    public function updateQuizQuestion($request, $que_id);

    public function deleteQuizQuestion($id);
}
