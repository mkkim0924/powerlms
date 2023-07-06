<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseUser;
use App\Models\User;

class InstructorController extends Controller
{
    public function getInstructorList(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $instructors = User::where('type', 1)->paginate(12);
        return view('front-end.instructors.list', compact('instructors'));
    }

    public function getInstructorDetails($encryptStr)
    {
        try{
            $data = decrypt($encryptStr);
            if (isset($data['id'])) {
                $instructor_id = $data['id'];
                $instructor = User::byActive()->where('type', 1)->where('id', $instructor_id)->first();
                if (isset($instructor)){
                    $instructor_course = Course::byActive()->where('instructor_id', $instructor_id)->paginate(8);
                    $total_students = CourseUser::whereHas('courseDetails', function ($q) use ($instructor_id) {
                        $q->byActive()->where('instructor_id', $instructor_id);
                    })->selectRaw('COUNT(id) as total_students')->get()->toArray();
                    $links = json_decode($instructor['social_links']);
                    return view('front-end.instructors.details', compact('links', 'instructor', 'instructor_course', 'total_students'));
                }
            }
            return abort(404);
        }catch (\Exception $e){
            return abort(404);
        }
    }
}
