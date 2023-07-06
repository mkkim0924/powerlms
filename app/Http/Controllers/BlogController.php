<?php

namespace App\Http\Controllers;

use App\Interfaces\Front\BlogRepositoryInterface;

class BlogController extends Controller
{
    protected $blogRepository;

    public function __construct(BlogRepositoryInterface $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    public function getAllBlogs(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $blogs = $this->blogRepository->getBlogList(10);
        $blog_categories = $this->blogRepository->getBlogCategories();
        return view('front-end.blog.all', compact('blogs', 'blog_categories'));
    }

    public function getBlogDetails($slug)
    {
        $blog = $this->blogRepository->getBlogDetails($slug);
        if (isset($blog)) {
            $relatedBlogs = $this->blogRepository->getRelatedBlogs($blog->category_id)->take(4);
            return view('front-end.blog.single', compact('blog', 'relatedBlogs'));
        } else {
            return abort(404);
        }
    }

    public function getBlogCategoryDetails($slug)
    {
        $blog_category = $this->blogRepository->getBlogCategoryDetails($slug);
        if (isset($blog_category)) {
            $blogs = $this->blogRepository->getBlogListByCategory($slug, 10);
            $blog_categories = $this->blogRepository->getBlogCategories();
            return view('front-end.blog.all', compact('blogs', 'blog_categories', 'blog_category'));
        } else {
            return abort(404);
        }
    }
}
