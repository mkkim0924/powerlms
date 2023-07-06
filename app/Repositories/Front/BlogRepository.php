<?php

namespace App\Repositories\Front;

use App\Interfaces\Front\BlogRepositoryInterface;
use App\Models\Blog;
use App\Models\BlogCategory;

class BlogRepository implements BlogRepositoryInterface
{
    public function getBlogCategories(): \Illuminate\Database\Eloquent\Collection
    {
        return BlogCategory::whereHas('relatedBlogs')->get();
    }

    public function getRandomBlogs(): \Illuminate\Database\Eloquent\Collection
    {
        return Blog::inRandomOrder()->get();
    }

    public function getBlogCategoryDetails($slug)
    {
        return BlogCategory::where('slug', $slug)->first();
    }

    public function getBlogList($paginate = 10)
    {
        return Blog::orderBy('id', 'DESC')->paginate($paginate);
    }

    public function getBlogListByCategory($slug, $paginate = 10)
    {
        return Blog::whereHas('categoryDetail', function ($q) use ($slug) {
            $q->where('slug', $slug);
        })->orderBy('id', 'DESC')->paginate($paginate);
    }

    public function getBlogDetails($slug)
    {
        return Blog::where('slug', $slug)->first();
    }

    public function getRelatedBlogs($category_id)
    {
        return Blog::where('category_id', $category_id)->get();
    }
}
