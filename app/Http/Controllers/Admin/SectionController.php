<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\CoursesRepositoryInterface;
use App\Interfaces\SectionRepositoryInterface;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    protected $coursesRepository, $sectionRepository;

    public function __construct(CoursesRepositoryInterface $coursesRepository, sectionRepositoryInterface $sectionRepository)
    {
        $this->coursesRepository = $coursesRepository;
        $this->sectionRepository = $sectionRepository;
    }

    public function index(Request $request)
    {
        $sections = $this->sectionRepository->getSections($request);
        $courses = $this->coursesRepository->getCourseTitles();
        return view('admin.section.index', compact('courses', 'sections'));
    }

    public function create()
    {
        $courses = $this->coursesRepository->getCourseTitles();
        return view('admin.section.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'course_id' => "required",
            'name' => "required",
        ]);
        $this->sectionRepository->storeSectionData($request);
        return redirect()->route(request()->user_type . '.sections')->with('success', __('global.flash_message.data_created_successfully'));
    }

    public function edit($id)
    {
        $section = $this->sectionRepository->getSectionDetail($id);
        if (isset($section)) {
            $courses = $this->coursesRepository->getCourseTitles();
            return view('admin.section.edit', compact('section', 'courses'));
        }
        abort(401, 'This action is unauthorized.');
    }

    public function update(Request $request, $id)
    {
        $this->sectionRepository->updateSection($request, $id);
        return redirect()->route(request()->user_type . '.sections')->with('success', __('global.flash_message.data_updated_successfully'));
    }

    public function getSectionByCourse(Request $request)
    {
        return $this->sectionRepository->getSectionByCourse($request->courseId);
    }

    public function updateStatus(Request $request)
    {
        $this->sectionRepository->updateActiveStatus($request);
        return response()->json(['message' => __('global.flash_message.data_updated_successfully')]);
    }

}
