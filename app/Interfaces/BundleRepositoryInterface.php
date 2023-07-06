<?php

namespace App\Interfaces;

interface BundleRepositoryInterface
{
    public function getAllBundles();

    public function storeBundlesData($request);

    public function getBundlesDetails($id);

    public function updateBundlesData($request, $id);

    public function delete($id);

    public function getBundlesTitles();

    public function updateActiveStatus($request);

    public function getBundleDetailBySlug($slug);

    public function getBundleDetailWithActiveCourses($bundle_id);

    public function getBundles($request);

}
