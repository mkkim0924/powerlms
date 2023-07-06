<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 09-02-2021
 * Time: 02:21 PM
 */

namespace App\Interfaces;

interface FaqsRepositoryInterface
{

    public function storeFaqData($request);

    public function getFaqDetail($id);

    public function updateFaqData($request, $id);

    public function getFaqs($request);

    public function getFaqsByCourse($course_id);

}
