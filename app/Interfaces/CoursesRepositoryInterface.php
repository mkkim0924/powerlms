<?php

namespace App\Interfaces;

interface CoursesRepositoryInterface
{
    public function storeCourse($request);

    public function getCourseDetails($id);

    public function getCourses($request);

    public function updateCourseData($request, $id);

    public function deleteCourse($id);

    public function updateActiveStatus($request);

    public function getCourseTitles();

    public function getCurriculumDetails($curriculum_id);
    public function getCurriculumComments($request);

    public function submitCurriculumReview($request);

    public function getCurriculumData($course_id);

    public function updateCurriculum($request);

    public function getCoursesCount($instructor_id = null);

    public function getCourseWiseRevenue($request);

}
