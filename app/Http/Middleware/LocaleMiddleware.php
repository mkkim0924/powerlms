<?php

namespace App\Http\Middleware;

use App\Models\Locale;
use Barryvdh\TranslationManager\Manager;
use Barryvdh\TranslationManager\Models\Translation;
use Closure;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

/**
 * Class LocaleMiddleware.
 */
class LocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function __construct(Manager $manager)
    {
        $this->manager = $manager;
    }


    public function handle($request, Closure $next)
    {
        /*
         * Locale is enabled and allowed to be changed
         */
        $locales = Locale::get();

        $locales_list = null;
        if (Schema::hasTable('locales')) {
            $locales_list = Locale::pluck('short_name')->toArray();
        }
        if (session()->has('locale') && in_array(session()->get('locale'), $locales_list)) {

            /*
             * Set the Laravel locale
             */
            App::setLocale(session()->get('locale'));

            /*
             * setLocale for php. Enables ->formatLocalized() with localized values for dates
             */
            setlocale(LC_TIME, array_search(session()->get('locale'), $locales_list));

            /*
             * setLocale to use Carbon source locales. Enables diffForHumans() localized
             */
            Carbon::setLocale(array_search(session()->get('locale'), $locales_list));

            /*
             * Set the session variable for whether or not the app is using RTL support
             * for the current language being selected
             * For use in the blade directive in BladeServiceProvider
             */
            $locale_data = $locales->where('short_name', '=', session()->get('locale'))->first();
            if ($locale_data->display_type == 'rtl') {
                session(['display_type' => 'rtl']);
            } else {
                session(['display_type' => 'ltr']);
            }
        }

        return $next($request);
    }
}
