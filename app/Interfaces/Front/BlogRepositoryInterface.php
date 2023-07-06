<?php

namespace App\Interfaces\Front;

interface BlogRepositoryInterface
{
    public function getBlogCategories();

    public function getRandomBlogs();

    public function getBlogCategoryDetails($slug);

    public function getBlogList($paginate = 10);

    public function getBlogListByCategory($slug, $paginate = 10);

    public function getBlogDetails($slug);

    public function getRelatedBlogs($category_id);
}
