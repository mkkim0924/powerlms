<?php

namespace App\Interfaces\Front;

interface CategoryRepositoryInterface
{
    public function getActiveCategories();
    public function getCategoryDetailBySlug($slug);
    public function getCategoriesTitles();

}
