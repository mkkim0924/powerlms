<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $students = $this->userRepository->getAllStudents();
        return view('admin.student.index', compact('students'));
    }

    public function detail(Request $request, $id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $student = $this->userRepository->getUsersDetails($id);
        $courseDetails = $this->userRepository->getCourseUserDetail($id);
        return view('admin.student.detail', compact('student', 'courseDetails'));
    }

}
