<?php

namespace App\Repositories;

use App\Interfaces\BannerRepositoryInterface;
use App\Models\Banner;

class BannerRepository implements BannerRepositoryInterface
{
    public function getAllBanner()
    {
        return Banner::orderBy('id', 'DESC')->get();
    }

    public function storeBanner($request): bool
    {
        $requestData = $request->all();
        if (isset($requestData['image'])) {
            $requestData['image'] = uploadFile($requestData['image'], 'banner', null, Banner::IMAGE_DIMENSION);
        }
        Banner::create($requestData);
        return true;
    }

    public function updateBanner($request, $id)
    {
        $requestData = $request->all();
        $banner = self::getBannerDetails($id);
        if (isset($requestData['image'])) {
            $requestData['image'] = uploadFile($requestData['image'], 'banner', $banner->image, Banner::IMAGE_DIMENSION);
        }
        $banner->update($requestData);
        return true;
    }

    public function getbannerDetails($id)
    {
        return Banner::where('id', $id)->first();
    }

    public function delete($id)
    {
        Banner::destroy($id);
        return true;
    }
}
