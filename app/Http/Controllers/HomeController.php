<?php

namespace App\Http\Controllers;

use App\Interfaces\Front\BlogRepositoryInterface;
use App\Interfaces\Front\CategoryRepositoryInterface;
use App\Interfaces\Front\CourseRepositoryInterface;
use App\Models\Banner;
use App\Models\Bundle;
use App\Models\Course;
use App\Models\Sponsor;
use App\Models\Webinar;
use App\Models\Widget;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $courseRepository, $blogRepository, $categoryRepository;

    public function __construct(CourseRepositoryInterface $courseRepository, CategoryRepositoryInterface $categoryRepository, BlogRepositoryInterface $blogRepository)
    {
        $this->courseRepository = $courseRepository;
        $this->blogRepository = $blogRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function index(CourseRepositoryInterface $courseRepository): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $banners = Banner::get();
        $popularCourses = $this->courseRepository->getPopularCourses();
        $upcomingWebinars = $this->courseRepository->getUpcomingWebinars();
        $bundles = $this->courseRepository->getRandomBundles();
        $courses = $this->courseRepository->getRandomCourses();
        $categories = $this->categoryRepository->getActiveCategories();
        $blogs = $this->blogRepository->getRandomBlogs();
        $reviews = $this->courseRepository->getRandCourseReviews();
        $widgets = Widget::get()->groupBy('identifier')->toArray();
        $sponsors = Sponsor::all();
        return view('front-end.home.'.config('front_home_layout'), compact('banners', 'bundles', 'courses', 'popularCourses', 'upcomingWebinars', 'categories', 'blogs', 'reviews', 'widgets', 'sponsors'));
    }


    public function layoutPreview($id)
    {
        if (!in_array($id, range(1, 9))){
            return abort(404);
        }
        $banners = Banner::get();
        $popularCourses = $this->courseRepository->getPopularCourses();
        $upcomingWebinars = $this->courseRepository->getUpcomingWebinars();
        $bundles = $this->courseRepository->getRandomBundles();
        $courses = $this->courseRepository->getRandomCourses();
        $categories = $this->categoryRepository->getActiveCategories();
        $blogs = $this->blogRepository->getRandomBlogs();
        $reviews = $this->courseRepository->getRandCourseReviews();
        $widgets = Widget::get()->groupBy('identifier')->toArray();
        $sponsors = Sponsor::all();
        return view('front-end.home.layout'.$id, compact('banners', 'bundles', 'courses', 'popularCourses', 'upcomingWebinars', 'categories', 'blogs', 'reviews', 'widgets', 'sponsors'));
    }

    public function aboutPage(CourseRepositoryInterface $courseRepository): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $popularCourses = $this->courseRepository->getPopularCourses();
        $categories = $this->categoryRepository->getActiveCategories();
        $blogs = $this->blogRepository->getRandomBlogs();
        $reviews = $this->courseRepository->getRandCourseReviews();
        $widgets = Widget::get()->groupBy('identifier')->toArray();
        return view('front-end.about', compact('popularCourses', 'categories', 'blogs', 'reviews', 'widgets'));
    }

    public function search(Request $request)
    {
        $courses = Course::byActive()->where('name', 'Like', '%'.$request->search.'%')->get();
        $webinars = Webinar::byActive()->where('name', 'Like', '%'.$request->search.'%')->get();
        $bundles = Bundle::byActive()->where('name', 'Like', '%'.$request->search.'%')->get();
        $returnHtml = view('front-end.layouts.ajax.search', compact('courses', 'webinars', 'bundles'))->render();
        return response()->json(['html' => $returnHtml]);
    }
}
