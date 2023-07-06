<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\LocaleRepositoryInterface;
use Illuminate\Http\Request;

class LocaleController extends Controller
{
    protected $LocaleRepository;
    public function __construct(localeRepositoryInterface $LocaleRepository)
    {
        $this->LocaleRepository = $LocaleRepository;
    }

    public function index()
    {
        $locale = $this->LocaleRepository->getAllLocale();
        return view('admin.language.index', compact('locale'));
    }

    public function create()
    {
        return view('admin.language.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'short_name' => "required|unique:locales,short_name",
        ], [
            'short_name.required' => __('validation.required', ['attribute' => strtolower(__('backend.languages.label.language_name'))]),
            'short_name.unique' => __('validation.unique', ['attribute' => strtolower(__('backend.languages.label.language_name'))]),
        ]);
        $this->LocaleRepository->storeLocale($request);
        return redirect()->route('admin.language')->with('success', __('global.flash_message.data_created_successfully'));
    }

    public function edit($id)
    {
        $locale = $this->LocaleRepository->getLocaleDetails($id);
        return view('admin.language.edit', compact('locale'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'short_name' => 'required|unique:locales,short_name,' . $request->id,
        ], [
            'short_name.required' => __('validation.required', ['attribute' => strtolower(__('backend.languages.label.language_name'))]),
            'short_name.unique' => __('validation.unique', ['attribute' => strtolower(__('backend.languages.label.language_name'))]),
        ]);
        $this->LocaleRepository->updateLocale($request, $id);
        return redirect()->route('admin.language')->with('success', __('global.flash_message.data_updated_successfully'));
    }

    public function delete($id)
    {
        $this->LocaleRepository->delete($id);
        return redirect()->route('admin.language');
    }

}
