<?php

namespace App\Repositories;

use App\Interfaces\LocaleRepositoryInterface;
use App\Models\Locale;

class LocaleRepository implements LocaleRepositoryInterface
{
    public function getAllLocale()
    {
        return Locale::orderBy('id', 'DESC')->get();
    }

    public function storeLocale($request)
    {
        $requestData = $request->all();
        $requestData['name'] = config('languages')[$requestData['short_name']];
        if ($request->is_default == 1) {
            Locale::query()->update(['is_default' => 0]);
        }
        Locale::create($requestData);
        return true;
    }

    public function updateLocale($request, $id)
    {
        $requestData = $request->all();
        $locale = self::getLocaleDetails($id);
        $requestData['is_default'] = isset($requestData['is_default']) ? 1 : 0;
        $requestData['name'] = config('languages')[$requestData['short_name']];
        if ($requestData['is_default'] == 1) {
            Locale::where('id', '!=', $id)->update(['is_default' => 0]);
        }
        $locale->update($requestData);
        return true;
    }

    public function getLocaleDetails($id)
    {
        return Locale::where('id', $id)->first();
    }

    public function delete($id)
    {
        Locale::destroy($id);
        return true;
    }

    // public function getLanguageTitles()
    // {
    //     return Locale::pluck('name', 'name')->toArray();
    // }
}
