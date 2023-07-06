<?php

namespace App\Http\Controllers;

use App\Interfaces\Front\CategoryRepositoryInterface;
use App\Interfaces\Front\CourseRepositoryInterface;
use App\Models\Bundle;
use App\Models\Course;
use App\Models\Widget;

class CategoriesController extends Controller
{
    protected $categoryRepository, $courseRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository, CourseRepositoryInterface $courseRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->courseRepository = $courseRepository;
    }

    public function getAllCategories()
    {
        $categories = $this->categoryRepository->getActiveCategories();
        $reviews = $this->courseRepository->getRandCourseReviews();
        $widgets = Widget::get()->groupBy('identifier')->toArray();
        return view('front-end.category.all', compact('categories', 'reviews', 'widgets'));
    }

    public function getCategoryDetails($slug)
    {
        $category = $this->categoryRepository->getCategoryDetailBySlug($slug);
        if (isset($category)){
            $courses = Course::byActive()->where('category_id', $category->id)->paginate(8);
            $bundles = Bundle::byActive()->where('category_id', $category->id)->get();
            $widgets = Widget::get()->groupBy('identifier')->toArray();
            return view('front-end.category.single', compact('category', 'courses', 'bundles', 'widgets'));
        }
        return abort(404);
    }
}
