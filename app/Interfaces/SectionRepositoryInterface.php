<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 09-02-2021
 * Time: 02:21 PM
 */

namespace App\Interfaces;

interface SectionRepositoryInterface
{
    public function getSections($request);

    public function storeSectionData($request);

    public function getSectionByCourse($course_id);

    public function getSectionDetail($id);

    public function updateSection($request, $id);

    public function updateActiveStatus($request);

    public function getSectionTitles($course_id = null);
}
