<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannerSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banners')->truncate();
        $banners = [
            [
                'name' => "25K+ STUDENTS TRUST OUR ONLINE COURSES",
                'hero_text' => "25K+ STUDENTS TRUST OUR ONLINE COURSES",
                'sub_text' => "Feugiat primis ligula gravida auctor egestas augue viverra mauri tortor in iaculis placerat an eugiat mauris ipsum undo viverra tortor gravida purus lorem in tortor a viverr",
                'text_color' => "black",
                'action_type' => "button",
                'button_text' => "View Categories",
                'button_url' => route('categories'),
                'image' => 'default-slide-1.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => "2,769 ONLINE COURSES FROM THE BEST TUTORS",
                'hero_text' => "2,769 ONLINE COURSES FROM THE BEST TUTORS",
                'sub_text' => "Feugiat primis ligula gravida auctor egestas augue viverra mauri tortor in iaculis placerat an eugiat mauris ipsum undo viverra tortor gravida purus lorem in tortor a viverr",
                'text_color' => "white",
                'action_type' => "search",
                'button_text' => null,
                'button_url' => null,
                'image' => 'default-slide-2.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => "HIGH QUALITY COURSES FROM THE LEADING EXPERTS",
                'hero_text' => "HIGH QUALITY COURSES FROM THE LEADING EXPERTS",
                'sub_text' => "Feugiat primis ligula gravida auctor egestas augue viverra mauri tortor in iaculis placerat an eugiat mauris ipsum undo viverra tortor gravida purus lorem in tortor a viverr",
                'text_color' => "black",
                'action_type' => "button",
                'button_text' => "View Categories",
                'button_url' => route('categories'),
                'image' => 'default-slide-3.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];
        DB::table('banners')->insert($banners);
    }
}
