<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();
        $categories = [
            [
                'name' => "Digital Marketing",
                'slug' => "digital-marketing",
                'icon' => "default-marketing.png",
                'is_active' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => "Web And Graphic Design",
                'slug' => "web-and-graphic-design",
                'icon' => "default-palette.png",
                'is_active' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => "Hardware And Networking",
                'slug' => "hardware-and-networking",
                'icon' => "default-network.png",
                'is_active' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => "Programming",
                'slug' => "programming",
                'icon' => "default-programming.png",
                'is_active' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => "Software Development",
                'slug' => "sciences",
                'icon' => "default-software-dev.png",
                'is_active' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];
        DB::table('categories')->insert($categories);
    }
}
