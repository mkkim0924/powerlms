<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FrontMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('front_menu_items')->truncate();
        $menuItems = [
            [
                'label' => 'About',
                'link' => 'about',
                'sort' => 1,
                'source_type' => "default",
                'source_type_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'label' => 'Categories',
                'link' => 'categories',
                'sort' => 2,
                'source_type' => "default",
                'source_type_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'label' => 'Bundles',
                'link' => 'bundles',
                'sort' => 3,
                'source_type' => "default",
                'source_type_id' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'label' => 'Forums',
                'link' => 'forum',
                'sort' => 4,
                'source_type' => "default",
                'source_type_id' => 4,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'label' => 'Blogs',
                'link' => 'blogs',
                'sort' => 5,
                'source_type' => "default",
                'source_type_id' => 5,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'label' => 'Contact',
                'link' => 'contact',
                'sort' => 6,
                'source_type' => "default",
                'source_type_id' => 6,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];
        DB::table('front_menu_items')->insert($menuItems);
    }
}
