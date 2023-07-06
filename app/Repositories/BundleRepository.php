<?php

namespace App\Repositories;

use App\Interfaces\BundleRepositoryInterface;
use App\Models\Bundle;
use App\Models\BundleCourse;

class BundleRepository implements BundleRepositoryInterface
{
    public function getAllBundles()
    {
        return Bundle::orderBy('id', 'DESC')->get();
    }

    public function storeBundlesData($request)
    {
        $requestData = $request->all();
        $requestData['instructor_id'] = request()->user_id;
        if (isset($requestData['image'])) {
            $requestData['image'] = uploadFile($requestData['image'], 'bundle', null, Bundle::IMAGE_DIMENSION);
        }
        $bundle = Bundle::create($requestData);
        if (isset($requestData['related_courses'])) {
            foreach ($requestData['related_courses'] as $key => $course_id) {
                $bundle_id = $bundle['id'];
                $data = [
                    'course_id' => $course_id,
                    'bundle_id' => $bundle_id,
                ];
                BundleCourse::create($data);
            }
        }
        return true;
    }

    public function getBundlesDetails($id)
    {
        return Bundle::where('id', $id)->first();
    }

    public function updateBundlesData($request, $id)
    {
        $requestData = $request->all();
        $Bundles = self::getBundlesDetails($id);
        if (isset($requestData['image'])) {
            $requestData['image'] = uploadFile($requestData['image'], 'bundle', $Bundles->image, Bundle::IMAGE_DIMENSION);
        }
        $Bundles->update($requestData);
        if (isset($requestData['related_courses'])) {
            $bundleCourse = $id;
            BundleCourse::where('bundle_id', '=', $id)->delete();
            foreach ($requestData['related_courses'] as $key => $course_id) {
                $bundle_id = $Bundles['id'];
                $data = [
                    'course_id' => $course_id,
                    'bundle_id' => $bundle_id,
                ];
                BundleCourse::create($data);
            }
        }
        return true;
    }

    public function delete($id)
    {
        Bundle::destroy($id);
        return true;
    }

    public function getBundlesTitles()
    {
        return Bundle::pluck('name', 'id')->toArray();
    }

    public function updateActiveStatus($request): bool
    {
        $cat = Bundle::findOrFail($request->id);
        $cat->is_active = $request->is_active;
        $cat->save();
        return true;
    }

    public function getBundleDetailBySlug($slug)
    {
        return Bundle::with(['relatedCourses' => function($q){
            $q->whereHas('courseDetails', function ($qq){
                $qq->byActive();
            });
        }])->byActive()->whereRaw("BINARY `slug`= ?", [$slug])->first();
    }

    public function getBundleDetailWithActiveCourses($bundle_id)
    {
        return Bundle::with(['relatedCourses' => function($q){
            $q->whereHas('courseDetails', function ($qq){
                $qq->byActive();
            });
        }])->byActive()->where('id', $bundle_id)->first();
    }

    public function getBundles($request)
    {
        $bundle = Bundle::byActive();
        $category_id = $request->category_id;
        if ($category_id) {
            $bundle = $bundle->where('category_id', $category_id);
        }
        $search = $request->search;
        if ($search) {
            $bundle = $bundle->where('name', 'LIKE', '%' . $search . '%');
        }
        return $bundle->paginate(8);
    }
}
