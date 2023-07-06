<?php

namespace App\Repositories\Front;

use App\Interfaces\Front\CategoryRepositoryInterface;
use App\Models\Categories;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getActiveCategories()
    {
        return Categories::whereHas('courses', function ($q){
            $q->byActive();
        })->with(['courses' => function ($q) {
            $q->byActive();
        }])->byActive()->get();

        //->whereHas('courses', function ($q) {
        //    $q->byActive();
        // })
    }

    public function getCategoryDetailBySlug($slug)
    {
        return Categories::with(['courses' => function ($q) {
            $q->byActive();
        }])->where('slug', $slug)->first();
    }

    public function getCategoriesTitles()
    {
        return Categories::where('is_active', 1)->pluck('name', 'id')->toArray();
    }
}
