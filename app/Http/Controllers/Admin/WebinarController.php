<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\CoursesRepositoryInterface;
use App\Interfaces\Front\CategoryRepositoryInterface;
use App\Models\Webinar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WebinarController extends Controller
{

    protected $categoryRepository, $coursesRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository, CoursesRepositoryInterface $coursesRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->coursesRepository = $coursesRepository;
    }

    public function index(Request $request)
    {
        $webinar = Webinar::all();
        $categories = $this->categoryRepository->getCategoriesTitles();
        return view('admin.webinar.index', compact('categories', 'webinar'));
    }

    public function create()
    {
        $categories = $this->categoryRepository->getCategoriesTitles();
        $courses = $this->coursesRepository->getCourseTitles();
        return view('admin.webinar.create', compact('categories', 'courses'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'slug' => "required|unique:webinars,slug",
        ]);
        $requestData = $request->all();
        $requestData['instructor_id'] = request()->user_id;
        if (isset($requestData['image'])) {
            $requestData['image'] = uploadFile($requestData['image'], 'webinar');
        }
        $requestData['end_at'] = Carbon::parse($requestData['start_at'])->addMinutes($requestData['duration']);
        Webinar::create($requestData);
        return redirect()->route('instructor.webinar')->with('success', __('global.flash_message.data_created_successfully'));
    }

    public function edit($id)
    {
        $webinar = Webinar::byInstructor()->findOrFail($id);
        $courses = $this->coursesRepository->getCourseTitles();
        $categories = $this->categoryRepository->getCategoriesTitles();
        return view('admin.webinar.edit', compact('categories', 'webinar', 'courses'));
    }

    public function update($id, Request $request)
    {
        $requestData = $request->all();
        $data = Webinar::findOrFail($id);
        $requestData['instructor_id'] = request()->user_id;
        if (isset($requestData['image'])) {
            $requestData['image'] = uploadFile($requestData['image'], 'webinar', $data->image);
        }
        $requestData['end_at'] = Carbon::parse($requestData['start_at'])->addMinutes($requestData['duration']);
        $data->update($requestData);
        return redirect()->route('instructor.webinar')->with('success', __('global.flash_message.data_updated_successfully'));
    }

    public function delete($id)
    {
        if (Webinar::destroy($id)) {
            return redirect()->route(request()->user_type . '.webinar')->with('success', __('global.flash_message.data_deleted_successfully'));
        } else {
            return redirect()->route(request()->user_type . '.webinar')->with('error', __('backend.webinars.flash_message.somethings_went_wrong'));
        }

    }
}
