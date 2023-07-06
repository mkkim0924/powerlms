<?php

namespace App\Interfaces\Front;

interface CourseRepositoryInterface
{
    public function getActiveCourses();

    public function getRandCourseReviews();

    public function getPopularCourses();

    public function getUserEnrollCourses();

    public function getRandomBundles();

    public function getRandomCourses();

    public function getCourseDetailBySlug($slug);

    public function getCourseDetailById($course_id);

    public function getCurriculumList($course_id);

    public function getTotalLessonsByCourse($course_id);

    public function getCourseUserDetail($course_id, $user_id);

    public function getBundleUserDetail($bundle_id, $user_id);

    public function getUserCourseStatistics($course_id, $user_id);

    public function getRelatedCourses($course_ids);

    public function getUpcomingWebinars();

    public function getPastWebinars($current_webinar_id);

    public function getWebinarUserDetails($webinar_id, $user_id);

    public function enrollWebinar($request);

    public function getCourseReviews($course_id);

    public function getCourseWiseLiveLessonSlots($course_id, $user_id);

    public function getCourseReviewsWithPaginate($course_id);

    public function enrollCourse($request);

    public function attendLiveLessonSlot($request);

    public function getCurriculumDetailsBySlug($course_slug, $curriculum_slug);

    public function getWebinarDetailsBySlug($slug);

    public function getUserCourseCurriculumList($course_id, $user_id, $access_section_count = null);

    public function getQuizWiseQuestions($quiz_id);

    public function markUnitCompleted($request);

    public function submitQuiz($request);

    public function getUserQuizResultData($quiz_id, $user_id);

    public function getLastQuizUserStatistics($quiz_id, $user_id);

    public function getAttemptQuizCount($quiz_id, $user_id);

    public function getCourses($request);

    public function submitCourseReview($request);
}

