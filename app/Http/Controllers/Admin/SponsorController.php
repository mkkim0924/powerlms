<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sponsor;
use Illuminate\Http\Request;

class SponsorController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $sponsors = Sponsor::all();
        return view('admin.sponsor.index', compact('sponsors'));
    }

    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.sponsor.create');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $requestData = $request->all();
        if (isset($requestData['image'])) {
            $requestData['image'] = uploadFile($requestData['image'], 'sponsor', null, Sponsor::IMAGE_DIMENSION);
        }
        Sponsor::create($requestData);
        return redirect()->route('admin.sponsors')->with('success', __('global.flash_message.data_created_successfully'));
    }

    public function edit($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $sponsor = Sponsor::findOrFail($id);
        return view('admin.sponsor.edit', compact('sponsor'));

    }

    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $requestData = $request->all();
        $sponsor = Sponsor::findOrFail($id);
        if (isset($requestData['image'])) {
            $requestData['image'] = uploadFile($requestData['image'], 'sponsor', $sponsor->image, Sponsor::IMAGE_DIMENSION);
        }
        $sponsor->update($requestData);
        return redirect()->route('admin.sponsors')->with('success', __('global.flash_message.data_updated_successfully'));
    }

    public function delete($id): \Illuminate\Http\RedirectResponse
    {
        Sponsor::destroy($id);
        return redirect()->route('admin.sponsors')->with('success', __('global.flash_message.data_deleted_successfully'));
    }
}
