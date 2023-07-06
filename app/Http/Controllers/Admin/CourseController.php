<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\CoursesRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Models\Widget;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;

class CourseController extends Controller
{

    protected $coursesRepository, $categoryRepository, $userRepository;

    public function __construct(CoursesRepositoryInterface $coursesRepository, CategoryRepositoryInterface $categoryRepository, UserRepositoryInterface $userRepository)
    {
        $this->coursesRepository = $coursesRepository;
        $this->categoryRepository = $categoryRepository;
        $this->userRepository = $userRepository;
    }

    public function adminCourses(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $courses = $this->coursesRepository->getCourses($request);
        $categories = $this->categoryRepository->getCategoriesTitles();
        $users = $this->userRepository->getInstructorNames();
        return view('admin.courses.admin_courses_list', compact('courses', 'categories', 'users'));
    }

    public function index(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $courses = $this->coursesRepository->getCourses($request);
        $categories = $this->categoryRepository->getCategoriesTitles();
        return view('admin.courses.index', compact('courses', 'categories'));
    }

    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $courses = $this->coursesRepository->getCourseTitles();
        $categories = $this->categoryRepository->getCategoriesTitles();
        return view('admin.courses.create', compact('courses', 'categories'));
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        if (isset($request->intro_video_provider) && $request->intro_video_provider == 'video_file') {
            $this->validate($request, [
                'slug' => "required|unique:courses,slug",
                'intro_video_url' => 'required',
            ]);
        } else {
            $this->validate($request, [
                'slug' => "required|unique:courses,slug",
            ]);
        }
        $response = $this->coursesRepository->storeCourse($request);
        if ($response['status']) {
            return redirect()->route(request()->user_type . '.courses')->with('success', __('global.flash_message.data_created_successfully'));
        } else {
            return redirect()->back()->with('error', $response['message']);
        }
    }

    public function edit($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $course = $this->coursesRepository->getCourseDetails($id);
        if (isset($course) && ($course->course_status != 4)) {
            $courses = $this->coursesRepository->getCourseTitles();
            $categories = $this->categoryRepository->getCategoriesTitles();
            return view('admin.courses.edit', compact('courses', 'categories', 'course'));
        }
        abort(401, 'This action is unauthorized.');
    }

    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        if (isset($request->intro_video_provider) && $request->intro_video_provider == 'video_file') {
            $this->validate($request, [
                'intro_video_url' => 'required',
            ]);
        }
        $response = $this->coursesRepository->updateCourseData($request, $id);
        if ($response['status']) {
            return redirect()->route(request()->user_type . '.courses')->with('success', __('global.flash_message.data_updated_successfully'));
        } else {
            return redirect()->back()->with('error', $response['message']);
        }
    }

    public function delete($id): \Illuminate\Http\RedirectResponse
    {
        $this->coursesRepository->deleteCourse($id);
        return redirect()->route(request()->user_type . '.courses')->with('success', __('global.flash_message.data_deleted_successfully'));
    }

    public function calculateCoursePrice(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = calculateEarnings($request->price, auth()->user()->system_revenue_percentage);
        $returnHtml = view('admin.courses.ajax.price_calculation', compact('data'))->render();
        return response()->json(['status' => true, 'html' => $returnHtml]);
    }

    public function updateStatus(Request $request)
    {
        $this->coursesRepository->updateActiveStatus($request);
        return redirect()->route(request()->user_type . '.courses');
    }

    public function curriculumPage($course_id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $course = $this->coursesRepository->getCourseDetails($course_id);
        if (isset($course)) {
            $sections = $this->coursesRepository->getCurriculumData($course_id);
            return view('admin.courses.curriculum_review', compact('sections', 'course', 'course_id'));
        }
        abort(401, 'This action is unauthorized.');
    }

    public function getCurriculumComments(Request $request): \Illuminate\Http\JsonResponse
    {
        $curriculum_id = $request->curriculum_id;
        $course_id = $request->course_id;
        if (!empty($request->curriculum_id)) {
            $curriculum = $this->coursesRepository->getCurriculumDetails($curriculum_id);
        } else {
            $curriculum = $this->coursesRepository->getCourseDetails($course_id);
        }
        $comments = $this->coursesRepository->getCurriculumComments($request);
        $returnHtml = view('admin.courses.ajax.review_chat', compact('comments', 'curriculum', 'course_id', 'curriculum_id'))->render();
        return response()->json(['status' => true, 'html' => $returnHtml]);
    }

    public function curriculumDetails(Request $request): \Illuminate\Http\JsonResponse
    {
        if (isset($request->curriculum_id)) {
            $curriculum = $this->coursesRepository->getCurriculumDetails($request->curriculum_id);
            $returnHtml = "";
            if ($curriculum->curriculum_type == 'unit') {
                $unit = $curriculum->unitDetail;
                $returnHtml = view('admin.courses.ajax.unit_details', compact('curriculum', 'unit'))->render();
            } elseif ($curriculum->curriculum_type == 'quiz') {
                $quiz = $curriculum->quizDetail;
                $returnHtml = view('admin.courses.ajax.quiz_details', compact('curriculum', 'quiz'))->render();
            }
        } else {
            $course = $this->coursesRepository->getCourseDetails($request->course_id);
            $returnHtml = view('admin.courses.ajax.course_details', compact('course'))->render();
        }
        return response()->json(['status' => true, 'html' => $returnHtml]);
    }

    public function submitCurriculumReview(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->coursesRepository->submitCurriculumReview($request);
        return response()->json(['status' => true]);
    }

    public function getCurriculum($course_id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $course = $this->coursesRepository->getCourseDetails($course_id);
        if (isset($course) && ($course->course_status != 4)) {
            $sections = $this->coursesRepository->getCurriculumData($course_id);
            return view('admin.courses.curriculum', compact('sections', 'course', 'course_id'));
        }
        abort(401, 'This action is unauthorized.');
    }

    public function updateCurriculum(Request $request): \Illuminate\Http\JsonResponse
    {
        $response = $this->coursesRepository->updateCurriculum($request);
        return response()->json($response);
    }
}


