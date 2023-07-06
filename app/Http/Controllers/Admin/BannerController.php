<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\BannerRepositoryInterface;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    protected $bannerRepository;

    public function __construct(BannerRepositoryInterface $bannerRepository)
    {
        $this->bannerRepository = $bannerRepository;
    }
    public function index()
    {
        $bannerdetails = $this->bannerRepository->getAllbanner();
        return view('admin.banner.index', compact('bannerdetails'));
    }

    public function create()
    {
        return view('admin.banner.create');
    }

    public function store(Request $request)
    {
        $this->bannerRepository->storeBanner($request);
        return redirect()->route('admin.banner')->with('success', __('global.flash_message.data_created_successfully'));
    }

    public function edit($id)
    {
        $banner = $this->bannerRepository->getBannerDetails($id);
        return view('admin.banner.edit', compact('banner'));

    }

    public function update(Request $request, $id)
    {
        $this->bannerRepository->updateBanner($request, $id);
        return redirect()->route('admin.banner')->with('success', __('global.flash_message.data_updated_successfully'));
    }

    public function delete($id)
    {
        $this->bannerRepository->delete($id);
        return redirect()->route('admin.banner');
    }
}
