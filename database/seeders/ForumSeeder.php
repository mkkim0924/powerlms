<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class ForumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('forum_categories')->truncate();
        DB::table('forum_posts')->truncate();
        DB::table('forum_threads')->truncate();
        DB::table('forum_threads_read')->truncate();

        DB::table('forum_categories')->insert([
            [
                'title' => 'Introductions',
                'author_id' => 1,
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eu.',
                'accepts_threads' => 1,
                'newest_thread_id' => 1,
                'latest_active_thread_id' => 1,
                'thread_count' => 1,
                'post_count' => 3,
                'is_private' => 0,
                '_lft' => 1,
                '_rgt' => 10,
                'color' => '#007bff',
                'parent_id' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'General',
                'author_id' => 1,
                'description' => null,
                'accepts_threads' => 1,
                'newest_thread_id' => 2,
                'latest_active_thread_id' => 2,
                'thread_count' => 1,
                'post_count' => 2,
                'is_private' => 0,
                '_lft' => 11,
                '_rgt' => 12,
                'color' => '#3A9B3E',
                'parent_id' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Feedback',
                'author_id' => 1,
                'description' => null,
                'accepts_threads' => 1,
                'newest_thread_id' => null,
                'latest_active_thread_id' => null,
                'thread_count' => 0,
                'post_count' => 0,
                'is_private' => 0,
                '_lft' => 13,
                '_rgt' => 14,
                'color' => '#892C4C',
                'parent_id' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Random',
                'author_id' => 1,
                'description' => null,
                'accepts_threads' => 1,
                'newest_thread_id' => null,
                'latest_active_thread_id' => null,
                'thread_count' => 0,
                'post_count' => 0,
                'is_private' => 0,
                '_lft' => 15,
                '_rgt' => 16,
                'color' => '#042549',
                'parent_id' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Rules',
                'author_id' => 1,
                'description' => null,
                'accepts_threads' => 1,
                'newest_thread_id' => null,
                'latest_active_thread_id' => null,
                'thread_count' => 0,
                'post_count' => 0,
                'is_private' => 0,
                '_lft' => 2,
                '_rgt' => 7,
                'color' => '#227ab5',
                'parent_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Basics',
                'author_id' => 1,
                'description' => null,
                'accepts_threads' => 1,
                'newest_thread_id' => null,
                'latest_active_thread_id' => null,
                'thread_count' => 0,
                'post_count' => 0,
                'is_private' => 0,
                '_lft' => 3,
                '_rgt' => 4,
                'color' => '#195a86',
                'parent_id' => 5,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Contribution',
                'author_id' => 1,
                'description' => null,
                'accepts_threads' => 1,
                'newest_thread_id' => null,
                'latest_active_thread_id' => null,
                'thread_count' => 0,
                'post_count' => 0,
                'is_private' => 0,
                '_lft' => 5,
                '_rgt' => 6,
                'color' => '#195a86',
                'parent_id' => 5,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'About',
                'author_id' => 1,
                'description' => null,
                'accepts_threads' => 1,
                'newest_thread_id' => null,
                'latest_active_thread_id' => null,
                'thread_count' => 0,
                'post_count' => 0,
                'is_private' => 0,
                '_lft' => 8,
                '_rgt' => 9,
                'color' => '#227ab5',
                'parent_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        DB::table('forum_threads')->insert([
            [
                'category_id' => 1,
                'author_id' => 1,
                'title' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
                'first_post_id' => 1,
                'last_post_id' => 3,
                'reply_count' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 2,
                'author_id' => 6,
                'title' => "General Thread",
                'first_post_id' => 4,
                'last_post_id' => 5,
                'reply_count' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);

        DB::table('forum_posts')->insert([
            [
                'thread_id' => 1,
                'author_id' => 1,
                'content' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer pretium semper lacus, id rutrum justo pellentesque ac",
                'post_id' => null,
                'sequence' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'thread_id' => 1,
                'author_id' => 3,
                'content' => "Cras efficitur, arcu eu sagittis hendrerit, ligula magna imperdiet turpis, quis sagittis neque felis at mi. Donec posuere magna tortor, at posuere tortor sodales at. Vivamus quam dolor, pellentesque et libero ut, rhoncus tristique tellus. Donec ultrices est et nisl eleifend suscipit. Cras fringilla tortor suscipit turpis egestas, eget pretium metus molestie. Vestibulum a finibus lorem, sed rutrum tellus. In eget nisl in leo tempus malesuada eget ac massa. Fusce ac est vitae felis dapibus tristique eget vitae nisi. Vestibulum hendrerit sollicitudin massa, in aliquam lorem lacinia sit amet. Vestibulum tincidunt faucibus nibh sollicitudin elementum. Proin risus augue, congue eget auctor at, dapibus ut magna. Vivamus facilisis accumsan velit cursus pretium. Phasellus quis maximus neque. Nullam ac vestibulum nisl.",
                'post_id' => null,
                'sequence' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'thread_id' => 1,
                'author_id' => 3,
                'content' => "Morbi interdum velit odio, in blandit metus rutrum eget. Morbi posuere ullamcorper neque. Praesent vitae suscipit ante, in fermentum neque. Cras sollicitudin metus ac ex tristique, at accumsan felis rhoncus. Sed eu sem in justo sollicitudin luctus quis sit amet nibh. Morbi mattis ante porta cursus vehicula. Nullam consectetur molestie tempor.",
                'post_id' => 1,
                'sequence' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'thread_id' => 2,
                'author_id' => 3,
                'content' => "Cras efficitur, arcu eu sagittis hendrerit, ligula magna imperdiet turpis, quis sagittis neque felis at mi. Donec posuere magna tortor, at posuere tortor sodales at.",
                'post_id' => null,
                'sequence' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'thread_id' => 2,
                'author_id' => 1,
                'content' => "Donec finibus porttitor mauris varius convallis. Curabitur auctor interdum diam, vitae luctus libero rhoncus sit amet. Suspendisse bibendum lorem quis nisl dapibus, sollicitudin condimentum ipsum laoreet. In eu tincidunt ligula. Nullam eget tempor elit. Quisque vel aliquet urna. Aliquam elementum tincidunt dolor id suscipit. Proin at porttitor massa, sit amet egestas purus. Suspendisse potenti. Praesent facilisis interdum nibh vitae varius. Sed fermentum orci turpis, sit amet ornare nibh sollicitudin eget. Duis non auctor lacus, ac tempor justo. Aliquam a ipsum eget risus ultricies aliquam. Maecenas molestie arcu at mi rutrum, quis molestie lacus pulvinar.",
                'post_id' => null,
                'sequence' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
        Artisan::call('forum:seed');
    }
}
