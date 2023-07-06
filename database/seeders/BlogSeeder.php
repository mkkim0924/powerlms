<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blog_categories')->truncate();
        BlogCategory::factory()->count(10)->create();

        DB::table('blogs')->truncate();
        Blog::factory()->count(30)->create();
    }
}
