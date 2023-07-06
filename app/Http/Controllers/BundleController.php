<?php

namespace App\Http\Controllers;

use App\Interfaces\BundleRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\Front\CourseRepositoryInterface;
use App\Models\Review;
use App\Models\Widget;
use Illuminate\Http\Request;

class BundleController extends Controller
{
    protected $bundleRepository, $categoryRepository, $courseRepository;

    public function __construct(BundleRepositoryInterface $bundleRepository, CategoryRepositoryInterface $categoryRepository, CourseRepositoryInterface $courseRepository)
    {
        $this->bundleRepository = $bundleRepository;
        $this->courseRepository = $courseRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function index(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $bundles = $this->bundleRepository->getBundles($request);
        $categories = $this->categoryRepository->getCategoriesTitles();
        $widgets = Widget::get()->groupBy('identifier')->toArray();
        return view('front-end.bundle.all', compact('bundles', 'categories', 'widgets'));
    }

    public function detail($slug)
    {
        $bundle = $this->bundleRepository->getBundleDetailBySlug($slug);
        if (isset($bundle)) {
            $bundleUser = null;
            if (auth()->check()) {
                $bundleUser = $this->courseRepository->getBundleUserDetail($bundle->id, auth()->user()->id);
            }
            $reviews = Review::whereIn('course_id', $bundle->relatedCourses->pluck('course_id')->toArray())->latest()->take(5)->get();
            return view('front-end.bundle.single', compact('bundle', 'reviews', 'bundleUser'));
        }
        return abort(404);
    }
}
