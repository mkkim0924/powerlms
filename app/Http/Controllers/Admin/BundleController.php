<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\BundleRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\CoursesRepositoryInterface;
use App\Models\BundleCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BundleController extends Controller
{
    protected $bundleRepository, $categoryRepository, $coursesRepository;
    public function __construct(BundleRepositoryInterface $bundleRepository, CategoryRepositoryInterface $categoryRepository, CoursesRepositoryInterface $coursesRepository)
    {
        $this->bundleRepository = $bundleRepository;
        $this->coursesRepository = $coursesRepository;
        $this->categoryRepository = $categoryRepository;

    }

    public function index()
    {
        $bundles = $this->bundleRepository->getAllBundles();
        $categories = $this->categoryRepository->getCategoriesTitles();
        return view('admin.bundle.index', compact('bundles', 'categories'));
    }

    public function create()
    {
        $courses = $this->coursesRepository->getCourseTitles();
        $categories = $this->categoryRepository->getCategoriesTitles();
        return view('admin.bundle.create', compact('courses', 'categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'slug' => "required|unique:courses,slug",
        ]);
        $this->bundleRepository->storeBundlesData($request);
        return redirect()->route('instructor.bundle')->with('success', __('global.flash_message.data_created_successfully'));
    }

    public function edit($id)
    {
        $bundle = $this->bundleRepository->getBundlesDetails($id);
        $courses = $this->coursesRepository->getCourseTitles();
        $bundleCourse = BundleCourse::where('bundle_id', '=', $id)->pluck('course_id', 'course_id');
        $categories = $this->categoryRepository->getCategoriesTitles();
        return view('admin.bundle.edit', compact('bundle', 'categories', 'courses', 'bundleCourse'));
    }

    public function update(Request $request, $id)
    {
        $this->bundleRepository->updateBundlesData($request, $id);
        return redirect()->route('instructor.bundle')->with('success', __('global.flash_message.data_updated_successfully'));
    }

    public function delete($id)
    {
        $this->bundleRepository->delete($id);
        return redirect()->route('instructor.bundle');
    }

    public function updateStatus(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->bundleRepository->updateActiveStatus($request);
        return response()->json(['message' => __('global.flash_message.data_updated_successfully')]);
    }
}
