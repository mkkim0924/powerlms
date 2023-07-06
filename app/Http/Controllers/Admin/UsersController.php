<?php

namespace App\Http\Controllers\Admin;

use App\Events\InstructorApplicationRejectEvent;
use App\Http\Controllers\Controller;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getInstructorList(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $users = $this->userRepository->getAllInstructor();
        return view('admin.user.instructor', compact('users'));
    }

    public function bank_credentials($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $users = $this->userRepository->getUsersDetails($id);
        return view('admin.user.instructor_details', compact('users'));
    }

    public function instructorApplications(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $applications = $this->userRepository->getAllInstructorApplications();
        return view('admin.user.instructor_application', compact('applications'));
    }

    public function instructorApplicationStatus($user_id, $status): \Illuminate\Http\RedirectResponse
    {
        $this->userRepository->updateApplicationStatus($user_id, $status);
        return redirect()->route('admin.instructor_applications')->with('success', __('backend.instructor_applications.flash_message.application_status_updated'));
    }

    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.user.instructor.create');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'email' => "required|unique:users",
        ]);
        $response = $this->userRepository->storeInstructor($request);
        if ($response['status']){
            return redirect()->route('admin.instructors')->with('success', __('global.flash_message.data_created_successfully'));
        }else{
            return redirect()->back()->with('error', $response['message']);
        }
    }

    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $this->userRepository->updateUser($request, $id);
        return redirect()->route('admin.instructors')->with('success', __('global.flash_message.data_updated_successfully'));
    }

    public function edit($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $instructor = $this->userRepository->getUsersDetails($id);
        return view('admin.user.instructor.edit', compact('instructor'));
    }

    public function delete($id): \Illuminate\Http\RedirectResponse
    {
        $this->userRepository->delete($id);
        return redirect()->route('admin.instructors');
    }

    public function instructorLogin($id): \Illuminate\Http\RedirectResponse
    {
        Auth::loginUsingId($id);
        return redirect()->route('instructor.dashboard');
    }

    public function rejectInstructorApplication(Request $request): \Illuminate\Http\RedirectResponse
    {
        $requestData = $request->except(['_token']);
        $requestData['instructor_application_status'] = 3;
        $instructor = User::where('id', $requestData['id'])->first();
        $instructor->update($requestData);
        event(new InstructorApplicationRejectEvent($instructor));
        return redirect()->route('admin.instructor_applications')->with('success', __('backend.instructor_applications.flash_message.application_rejected'));
    }
}
