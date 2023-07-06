<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Categories;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAllCategory()
    {
        return Categories::orderBy('id', 'ASC')->get();
    }

    public function getCategoriesTitles()
    {
        return Categories::where('is_active', 1)->pluck('name', 'id')->toArray();
    }

    public function storeCategoryData($request): bool
    {
        $requestData = $request->all();
        if (isset($requestData['icon'])) {
            $requestData['icon'] = uploadFile($requestData['icon'], 'category', null, Categories::IMAGE_DIMENSION);
        }
        Categories::create($requestData);
        return true;
    }

    public function getCategoryDetails($id)
    {
        return Categories::where('id', $id)->first();
    }

    public function updateCategoryData($request, $id): bool
    {
        $requestData = $request->all();
        $category = self::getCategoryDetails($id);
        if (isset($requestData['icon'])) {
            $requestData['icon'] = uploadFile($requestData['icon'], 'category', $category->icon, Categories::IMAGE_DIMENSION);
        }
        $category->update($requestData);
        return true;
    }

    public function updateActiveStatus($request): bool
    {
        $cat = Categories::findOrFail($request->id);
        $cat->is_active = $request->is_active;
        $cat->save();
        return true;
    }
}
