<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminUserDataSeeder::class);
        $this->call(AdminModuleSeeder::class);
        $this->call(LocaleSeeder::class);
        $this->call(CurrencySeeder::class);
        $this->call(SiteConfigurationsSeeder::class);
        $this->call(FrontMenuSeeder::class);
        $this->call(CountryTableSeeder::class);
        $this->call(PageSeeder::class);

        $this->call(BannerSeeder::class);
        $this->call(EmailTemplateSeeder::class);
        $this->call(WidgetDataSeeder::class);
        $this->call(SponsorSeeder::class);

        Artisan::call('translations:import');
        Artisan::call('storage:link');
    }
}
