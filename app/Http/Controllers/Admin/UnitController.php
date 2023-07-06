<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\CoursesRepositoryInterface;
use App\Interfaces\SectionRepositoryInterface;
use App\Interfaces\UnitRepositoryInterface;
use App\Models\Units;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    protected $unitRepository, $coursesRepository, $sectionRepository;

    public function __construct(UnitRepositoryInterface $unitRepository, CoursesRepositoryInterface $coursesRepository, SectionRepositoryInterface $sectionRepository)
    {
        $this->unitRepository = $unitRepository;
        $this->coursesRepository = $coursesRepository;
        $this->sectionRepository = $sectionRepository;
    }

    public function index(Request $request)
    {
        $units = $this->unitRepository->getUnits($request);
        $courses = $this->coursesRepository->getCourseTitles();
        $sections = $request->course_id ? $this->sectionRepository->getSectionTitles($request->course_id) : [];
        return view('admin.units.index', compact('units', 'courses', 'sections'));
    }

    public function create(Request $request)
    {
        $courses = $this->coursesRepository->getCourseTitles();
        $sections = $request->course_id ? $this->sectionRepository->getSectionTitles($request->course_id) : [];
        return view('admin.units.create', compact('courses', 'sections'));
    }

    public function store(Request $request)
    {
        $response = $this->unitRepository->storeUnitData($request);
        if ($response['status']) {
            return redirect()->route(request()->user_type . '.units')->with('success', __('global.flash_message.data_created_successfully'));
        } else {
            return redirect()->route(request()->user_type . '.units')->with('error', $response['message']);
        }
    }

    public function edit($id)
    {
        $unit = $this->unitRepository->getUnitDetail($id);
        if (isset($unit)) {
            $courses = $this->coursesRepository->getCourseTitles();
            $sections = $this->sectionRepository->getSectionTitles($unit->course_id);
            return view('admin.units.edit', compact('unit', 'courses', 'sections'));
        }
        abort(401, 'This action is unauthorized.');
    }

    public function update(Request $request, $id)
    {
        $response = $this->unitRepository->updateUnit($request, $id);
        if ($response['status']) {
            return redirect()->route(request()->user_type . '.units')->with('success', __('global.flash_message.data_updated_successfully'));
        } else {
            return redirect()->route(request()->user_type . '.units')->with('error', $response['message']);
        }
    }

    public function delete($id)
    {
        Units::destroy($id);
        return redirect()->route(request()->user_type . '.units');
    }

    public function updateStatus(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->unitRepository->updateActiveStatus($request);
        return response()->json(['message' => __('global.flash_message.data_updated_successfully')]);
    }

    public function removeAttachment(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->unitRepository->removeAttachment($request);
        return response()->json(['message' => __('global.flash_message.data_deleted_successfully')]);
    }

}
