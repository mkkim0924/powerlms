<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function getAllStudents();

    public function getAllInstructorApplications();

    public function updateApplicationStatus($user_id, $status);

    public function getInstructorNames();

    public function getUsersDetails($id);

    public function updateProfile($request);

    public function storeInstructor($request);

    public function updateUser($request, $id);

    public function getAllInstructor();

    public function delete($id);

    public function getCourseUserDetail($id);

    public function getCourseUsers($request);

    public function getActiveStudents();
}
