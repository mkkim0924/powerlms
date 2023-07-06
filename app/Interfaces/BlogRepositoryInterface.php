<?php
namespace App\Interfaces;

interface BlogRepositoryInterface
{

    // Blog Categories
    public function getAllCategory();
    public function storeCategoryData($request);
    public function getCategoryDetails($id);
    public function updateCategoryData($request, $id);
    public function delete($id);
    public function getCategoryTitles();


    public function getAllBlogs();
    public function storeBlogData($request);
    public function getBlogDetails($id);
    public function updateBlogData($request, $id);
    public function deleteBlog($id);

}
