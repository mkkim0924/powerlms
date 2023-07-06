<?php

namespace App\Repositories;

use App\Interfaces\BlogRepositoryInterface;
use App\Models\Blog;
use App\Models\BlogCategory;

class BlogRepository implements BlogRepositoryInterface
{
    // BLog Categories
    public function getAllCategory()
    {
        return BlogCategory::orderBy('id', 'DESC')->get();
    }

    public function storeCategoryData($request)
    {
        $requestData = $request->all();
        BlogCategory::create($requestData);
        return true;
    }

    public function getCategoryDetails($id)
    {
        return BlogCategory::where('id', $id)->first();
    }

    public function updateCategoryData($request, $id)
    {
        $requestData = $request->all();
        $category = self::getCategoryDetails($id);
        $category->update($requestData);
        return true;
    }

    public function delete($id)
    {
        BlogCategory::destroy($id);
        return true;
    }

    public function getCategoryTitles()
    {
        return BlogCategory::pluck('name', 'id')->toArray();
    }

    // Blogs

    public function getAllBlogs()
    {
        return Blog::orderBy('id', 'DESC')->get();
    }

    public function storeBlogData($request)
    {
        $requestData = $request->all();
        if (isset($requestData['image'])) {
            $requestData['image'] = uploadFile($requestData['image'], 'blog', null, Blog::IMAGE_DIMENSION);
        }
        $requestData['author_name'] = getCurrentAdmin()->name;
        Blog::create($requestData);

        return true;
    }

    public function getBlogDetails($id)
    {
        return Blog::where('id', $id)->first();
    }

    public function updateBlogData($request, $id)
    {
        $requestData = $request->all();
        $blog = self::getBlogDetails($id);
        if (isset($requestData['image'])) {
            $requestData['image'] = uploadFile($requestData['image'], 'blog', $blog->image, Blog::IMAGE_DIMENSION);
        }
        $blog->update($requestData);
        return true;
    }

    public function deleteBlog($id)
    {
        Blog::destroy($id);

        return true;
    }
}
