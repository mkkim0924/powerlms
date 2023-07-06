<?php

namespace Database\Seeders;

use App\Models\Locale;
use App\Models\SiteConfiguration;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sponsors')->truncate();
        $sponsors = [
            [
                'title' => 'Climb The Mountain',
                'image' => 'default-brand-1.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Golden',
                'image' => 'default-brand-2.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'CARA Indoors',
                'image' => 'default-brand-3.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Health Brand',
                'image' => 'default-brand-4.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => '100% Organic',
                'image' => 'default-brand-5.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Lifeguard',
                'image' => 'default-brand-6.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => "Chippy's",
                'image' => 'default-brand-7.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Vivarium',
                'image' => 'default-brand-8.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Classic Design Studio',
                'image' => 'default-brand-9.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

        ];

        DB::table('sponsors')->insert($sponsors);
    }
}
