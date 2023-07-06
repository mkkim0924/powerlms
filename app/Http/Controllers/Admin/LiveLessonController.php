<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\CoursesRepositoryInterface;
use App\Models\LiveLesson;
use Illuminate\Http\Request;

class LiveLessonController extends Controller
{
    protected $coursesRepository;

    public function __construct(CoursesRepositoryInterface $coursesRepository)
    {
        $this->coursesRepository = $coursesRepository;
    }

    public function index(Request $Request)
    {
        $data = LiveLesson::byInstructor();
        $course_id = $Request->course_id;
        if ($course_id) {
            $data = $data->where('course_id', $course_id);
        }
        $live_lessons = $data->orderBy('id', 'DESC')->get();
        $courses = $this->coursesRepository->getCourseTitles();
        return view('admin.live_lesson.index', compact('courses', 'live_lessons'));
    }

    public function create()
    {
        $courses = $this->coursesRepository->getCourseTitles();
        return view('admin.live_lesson.create', compact('courses'));
    }

    public function store(Request $Request)
    {
        $this->validate($Request, [
            'course_id' => "required",
            'title' => "required",
            'description' => "required",
        ]);
        $requestData = $Request->all();
        $requestData['instructor_id'] = request()->user_id;
        LiveLesson::create($requestData);
        return redirect()->route(request()->user_type . '.live_lessons')->with('success', __('global.flash_message.data_created_successfully'));
    }

    public function edit($id)
    {
        $live_lesson = LiveLesson::byInstructor()->findOrFail($id);
            $courses = $this->coursesRepository->getCourseTitles();
            return view('admin.live_lesson.create', compact('courses', 'live_lesson'));
    }

    public function update($id, Request $Request)
    {
        $requestData = $Request->all();
        $data = LiveLesson::findOrFail($id);
        $data->update($requestData);
        return redirect()->route(request()->user_type . '.live_lessons')->with('success',__('global.flash_message.data_updated_successfully'));
    }

    public function delete($id)
    {
        if(LiveLesson::destroy($id)){
            return redirect()->route(request()->user_type . '.live_lessons')->with('success', __('global.flash_message.data_deleted_successfully'));
        }else{
            return redirect()->route(request()->user_type . '.live_lessons')->with('error', __('backend.live_lessons.error.somethings_went_wrong'));
        }

    }
}
