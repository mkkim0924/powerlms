<?php
namespace App\Interfaces;

interface BannerRepositoryInterface
{
    public function getAllBanner();

    public function storeBanner($request);

    public function getBannerDetails($id);

    public function updateBanner($request, $id);

    public function delete($id);
}
