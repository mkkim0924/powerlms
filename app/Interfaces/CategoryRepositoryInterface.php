<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 08-02-2021
 * Time: 02:23 PM
 */

namespace App\Interfaces;

interface CategoryRepositoryInterface
{
    public function getAllCategory();

    public function getCategoriesTitles();

    public function storeCategoryData($request);

    public function getCategoryDetails($id);

    public function updateCategoryData($request, $id);

    public function updateActiveStatus($request);
}
