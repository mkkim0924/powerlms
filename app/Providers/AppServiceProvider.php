<?php

namespace App\Providers;

use App\Models\Locale;
use App\Models\SiteConfiguration;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */

    /*
        * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        try{
            Schema::defaultStringLength(191);

            if (Schema::hasTable('site_configuration')) {
                $siteConfigurations = SiteConfiguration::get();
                foreach ($siteConfigurations as $siteConfiguration) {
                    if ($siteConfiguration->identifier_key == 'layout_sections') {
                        Config::set($siteConfiguration->identifier, isset($siteConfiguration->configuration_value) ? json_decode($siteConfiguration->configuration_value, true) : []);
                    } else {
                        Config::set($siteConfiguration->identifier, $siteConfiguration->configuration_value);
                    }
                }
            }
            Carbon::setLocale(config('app.locale'));
            App::setLocale(config('app.locale'));

            if (Schema::hasTable('currencies')) {
                $appCurrency = getCurrency();
                //            View::share('appCurrency', $appCurrency);
                Config::set('currency_symbol', $appCurrency['symbol'] ?? '₹');
            }
            $locales = $locale_list = [];
            $default_language_code = 'en';
            if (Schema::hasTable('locales')) {
                $locale_list = Locale::pluck('name', 'short_name')->toArray();
                $locales = array_keys($locale_list);
                $defaultLanguage = Locale::where('is_default', 1)->first();
                $default_language_code = $defaultLanguage->short_name ?? $default_language_code;
            }
            Config::set('system_default_language', $default_language_code);
            View::share('locales', $locales);
            View::share('locale_list', $locale_list);
            View::share('default_language_code', $default_language_code);
        }catch (\Exception $e){
            abort(500, $e->getMessage());
        }
    }
}
