<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserDataSeeder::class);
        $this->call(BlogSeeder::class);
        $this->call(ForumSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(CourseCatalogSeeder::class);
        $this->call(CourseEnrolledSeeder::class);
        $this->call(WebinarSeeder::class);
        $this->call(CourseSurveySeeder::class);
        $this->call(ChatSeeder::class);
    }
}
