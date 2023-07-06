<?php

namespace App\Http\Controllers;

use App\Interfaces\Front\CourseRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Models\Review;
use App\Models\User;
use App\Models\WebinarUser;
use App\Models\Widget;
use App\Repositories\Front\BlogRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    protected $userRepository, $courseRepository, $blogRepository;

    public function __construct(UserRepositoryInterface $userRepository, CourseRepositoryInterface $courseRepository, BlogRepository $blogRepository)
    {
        $this->userRepository = $userRepository;
        $this->courseRepository = $courseRepository;
        $this->blogRepository = $blogRepository;
    }
    public function index()
    {
        $user = auth()->user();
        return view('front-end.user.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $this->userRepository->updateProfile($request);
        return redirect()->route('profile')->with(['successes' =>  __('global.flash_message.data_updated_successfully'), 'current_tab' => 'profile']);
    }

    public function updateImage(Request $request)
    {
        $user = auth()->user();
        $requestData = $request->all();
        if ($request->file('image')) {
            $updateData['image'] = uploadFile($requestData['image'], 'users', $user->image, User::IMAGE_DIMENSION);
            $user->update($updateData);
            return response()->json(['status' => true, 'image' => getFileUrl($updateData['image'] ?? 'default-placeholder.jpg', 'users')]);
        }
        return response()->json(['status' => false]);
    }

    public function passwordUpdate(Request $request)
    {
        $this->userRepository->updateProfile($request);
        return redirect()->route('profile')->with('success',  __('backend.users.flash_message.password_updated_successfully'));
    }

    public function getUserEnrollCourses(): \Illuminate\Contracts\View\Factory | \Illuminate\Contracts\View\View | \Illuminate\Contracts\Foundation\Application
    {
        $courseUsers = $this->courseRepository->getUserEnrollCourses();
        return view('front-end.user.my_courses', compact('courseUsers'));
    }

    public function getUserEnrollWebinars(): \Illuminate\Contracts\View\Factory | \Illuminate\Contracts\View\View | \Illuminate\Contracts\Foundation\Application
    {
        $futureWebinars = WebinarUser::whereHas('webinarDetails', function ($q) {
            $q->where('start_at', '>', Carbon::now());
        })->where('user_id', request()->user_id)->get();
        $pastWebinars = WebinarUser::whereHas('webinarDetails', function ($q) {
            $q->where('start_at', '<', Carbon::now());
        })->where('user_id', request()->user_id)->get();
        return view('front-end.user.my_webinar', compact('futureWebinars', 'pastWebinars'));
    }

    public function getUserReviewHtml(Request $request): \Illuminate\Http\JsonResponse
    {
        $course_id = $request->course_id;
        $user_review = Review::where('course_id', $course_id)->where('author_id', request()->user_id)->first();
        $returnHtml = view('front-end.modal.ajax.review_modal_content', compact('course_id', 'user_review'))->render();
        return response()->json(['status' => true, 'html' => $returnHtml, 'rating' => $user_review->rating ?? 5]);
    }

    public function submitCourseReview(Request $request): \Illuminate\Http\RedirectResponse
    {
        $this->courseRepository->submitCourseReview($request);
        return redirect()->back()->with('success',  __('backend.users.flash_message.review_submitted_successfully'));
    }

    public function password(Request $request)
    {
        if (!(Hash::check($request->get('current-password'), auth()->user()->password))) {
            // The passwords matches
            return redirect()->back()->with(['error' =>  __('backend.users.flash_message.your_current_password_does'), 'current_tab' => 'password']);
        }

        $user = auth()->user();
        $user->update(['password' => $request->get('password')]);
        return redirect()->back()->with(['success' =>  __('backend.users.flash_message.password_successfully_changed'), 'current_tab' => 'password']);
    }

    public function becomeInstructor()
    {
        $blogs = $this->blogRepository->getRandomBlogs();
        $widgets = Widget::get()->groupBy('identifier')->toArray();
        return view('front-end.become-a-teacher', compact('blogs', 'widgets'));
    }
}
