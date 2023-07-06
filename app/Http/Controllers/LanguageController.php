<?php

namespace App\Http\Controllers;

use App\Models\Locale;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function swap($locale): \Illuminate\Http\RedirectResponse
    {
        $locales = Locale::get();
        $locales_list = $locales->pluck('short_name')->toArray();

        if (in_array($locale, $locales_list)) {
            $locale_data = $locales->where('short_name', '=', $locale)->first();
            Session::put('locale', $locale);
            Session::put('display_type', $locale_data->display_type);
        }
        return redirect()->back();
    }
}
