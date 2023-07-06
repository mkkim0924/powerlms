<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\CoursesRepositoryInterface;
use App\Models\CourseInterviewQuestion;
use Illuminate\Http\Request;

class CourseInterviewQuestionController extends Controller
{

    protected $coursesRepository;

    public function __construct(CoursesRepositoryInterface $coursesRepository)
    {
        $this->coursesRepository = $coursesRepository;
    }

    public function index(Request $request)
    {
        $questions = CourseInterviewQuestion::query();
        if (isset($request->course_id)) {
            $questions = $questions->where('course_id',$request->course_id);
        }
        $questions = $questions->get();
        $courses = $this->coursesRepository->getCourseTitles();
        return view('admin.course_interview_questions.index',compact('questions','courses'));
    }

    public function create()
    {
        $courses = $this->coursesRepository->getCourseTitles();
        return view('admin.course_interview_questions.create',compact('courses'));
    }

    public function store(Request $request)
    {
        $request_data = $request->all();
        CourseInterviewQuestion::create($request_data);
        return to_route('instructor.course_interview_questions')->with('success',__('global.flash_message.data_created_successfully'));
    }

    public function edit($id)
    {
        $courses = $this->coursesRepository->getCourseTitles();
        $data = CourseInterviewQuestion::findOrFail($id);
        return view('admin.course_interview_questions.edit',compact('data','courses'));
    }

    public function update(Request $request, $id)
    {
        $request_data = $request->all();
        $old_data = CourseInterviewQuestion::findOrFail($id);
        $old_data->update($request_data);
        return to_route('instructor.course_interview_questions')->with('success',__('global.flash_message.data_updated_successfully'));
    }

    public function delete($id)
    {
        CourseInterviewQuestion::findOrFail($id)->delete();
        return to_route('instructor.course_interview_questions')->with('success',__('global.flash_message.data_deleted_successfully'));
    }
}
