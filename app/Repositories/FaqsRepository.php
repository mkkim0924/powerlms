<?php

namespace App\Repositories;

use App\Interfaces\FaqsRepositoryInterface;
use App\Models\Faqs;

class FaqsRepository implements FaqsRepositoryInterface
{
    public function storeFaqData($request)
    {
        $requestData = $request->except("_token");
        foreach ($requestData['question'] as $key => $question) {
            if (isset($question)) {
                $data = [
                    'course_id' => $requestData['course_id'],
                    'question' => $requestData['question'][$key],
                    'answer' => $requestData['answer'][$key],
                ];
                Faqs::create($data);
            }
        }
        return true;
    }

    public function getFaqDetail($id)
    {
        return Faqs::where('id', $id)->first();
    }

    public function updateFaqData($request, $id)
    {
        $requestData = $request->all();
        $unit = self::getFaqDetail($id);
        $unit->update($requestData);
        return true;
    }

    public function getFaqs($request)
    {
        $faqs = Faqs::query();
        $course_id = $request->course_id;
        if ($course_id) {
            $faqs = $faqs->where('course_id', $course_id);
        }
        return $faqs->orderBy('id', 'DESC')->get();
    }

    public function getFaqsByCourse($course_id)
    {
        $returnData = [];
        if (isset($course_id)) {
            $faqs = Faqs::where('course_id', $course_id)->get();
            foreach ($faqs as $faq) {
                $returnData[] = ['id' => $faq->id, 'question' => $faq->question];
            }
        }
        return $returnData;
    }
}
