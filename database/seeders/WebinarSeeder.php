<?php

namespace Database\Seeders;

use App\Models\Webinar;
use App\Models\WebinarUser;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WebinarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Webinar::truncate();
        WebinarUser::truncate();
        $webinar_data = [
            [
                'category_id' => 5,
                'instructor_id' => 1,
                'name' => 'Webinar on Software Development',
                'slug' => 'webinar-on-sciences',
                'short_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'related_courses' => '',
                'duration' => 30,
                'start_at' => Carbon::today()->subMonths(4)->addHours(8),
                'end_at' => Carbon::today()->subMonths(4)->addHours(8)->addMinutes(30),
                'live_streaming_url' => 'https://www.youtube.com/embed/SGHjY_tfo7U',
                'intro_video_url' => 'https://www.youtube.com/watch?v=SGHjY_tfo7U',
                'image' => 'default-webinar-5-img.jpg',
                'total_enrollments' => '',
                'meta_title' => 'Software Development',
                'meta_description' => 'Software Development',
                'meta_keywords' => 'Software Development',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'category_id' => 1,
                'instructor_id' => 1,
                'name' => 'Webinar on SEO 2023: Complete SEO Training',
                'slug' => 'webinar-on-seo-2023-complete-seo-training',
                'short_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'related_courses' => '',
                'duration' => 30,
                'start_at' => Carbon::today()->subMonths(3)->addHours(8),
                'end_at' => Carbon::today()->subMonths(3)->addHours(8)->addMinutes(30),
                'live_streaming_url' => 'https://www.youtube.com/embed/1FOgP6Ndsgk',
                'intro_video_url' => 'https://www.youtube.com/watch?v=1FOgP6Ndsgk',
                'image' => 'default-webinar-6-img.jpg',
                'total_enrollments' => '',
                'meta_title' => 'SEO 2023: Complete SEO Training',
                'meta_description' => 'SEO 2023: Complete SEO Training',
                'meta_keywords' => 'SEO 2023: Complete SEO Training',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'category_id' => 2,
                'instructor_id' => 2,
                'name' => 'Webinar on Graphic Design Bootcamp: Photoshop, Illustrator, InDesign',
                'slug' => 'webinar-on-graphic-design-bootcamp-photoshop-illustrator-indesign',
                'short_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'related_courses' => '',
                'duration' => 30,
                'start_at' => Carbon::today()->subMonths(2)->addHours(8),
                'end_at' => Carbon::today()->subMonths(2)->addHours(8)->addMinutes(30),
                'live_streaming_url' => 'https://www.youtube.com/embed/1FOgP6Ndsgk',
                'intro_video_url' => 'https://www.youtube.com/watch?v=1FOgP6Ndsgk',
                'image' => 'default-webinar-4-img.jpg',
                'total_enrollments' => '',
                'meta_title' => 'Graphic Design Bootcamp: Photoshop, Illustrator, InDesign',
                'meta_description' => 'Graphic Design Bootcamp: Photoshop, Illustrator, InDesign',
                'meta_keywords' => 'Graphic Design Bootcamp: Photoshop, Illustrator, InDesign',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'category_id' => 3,
                'instructor_id' => 1,
                'name' => 'Webinar on Linux for Network Engineers: Practical Linux with GNS3',
                'slug' => 'webinar-on-linux-for-network-engineers-practical-linux-with-gns3',
                'short_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'related_courses' => '',
                'duration' => 30,
                'start_at' => Carbon::today()->addHours(14),
                'end_at' => Carbon::today()->addHours(14)->addMinutes(30),
                'live_streaming_url' => 'https://www.youtube.com/embed/SGHjY_tfo7U',
                'intro_video_url' => 'https://www.youtube.com/watch?v=SGHjY_tfo7U',
                'image' => 'default-webinar-3-img.jpg',
                'total_enrollments' => '',
                'meta_title' => 'Linux for Network Engineers: Practical Linux with GNS3',
                'meta_description' => 'Linux for Network Engineers: Practical Linux with GNS3',
                'meta_keywords' => 'Linux for Network Engineers: Practical Linux with GNS3',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'category_id' => 1,
                'instructor_id' => 3,
                'name' => 'Webinar on digital marketing',
                'slug' => 'webinar-on-digital-marketing',
                'short_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'related_courses' => '',
                'duration' => 20,
                'start_at' => Carbon::today()->addMonth()->addHours(8),
                'end_at' => Carbon::today()->addMonth()->addHours(8)->addMinutes(20),
                'live_streaming_url' => 'https://www.youtube.com/embed/SGHjY_tfo7U',
                'intro_video_url' => 'https://www.youtube.com/watch?v=SGHjY_tfo7U',
                'image' => 'default-webinar-1-img.jpg',
                'total_enrollments' => '',
                'meta_title' => 'Digital Marketing Webinar',
                'meta_description' => 'Digital Marketing Webinar',
                'meta_keywords' => 'Digital Marketing Webinar',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'category_id' => 2,
                'instructor_id' => 1,
                'name' => 'Webinar on Web And Graphic Design',
                'slug' => 'webinar-on-web-and-graphic-design',
                'short_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'related_courses' => '',
                'duration' => 30,
                'start_at' => Carbon::today()->addMonths(2),
                'end_at' => Carbon::today()->addMonths(2)->addMinutes(30),
                'live_streaming_url' => 'https://www.youtube.com/embed/1FOgP6Ndsgk',
                'intro_video_url' => 'https://www.youtube.com/watch?v=1FOgP6Ndsgk',
                'image' => 'default-webinar-2-img.jpg',
                'total_enrollments' => '',
                'meta_title' => 'Web And Graphic Design',
                'meta_description' => 'Web And Graphic Design',
                'meta_keywords' => 'Web And Graphic Design',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'category_id' => 3,
                'instructor_id' => 4,
                'name' => 'Webinar on Hardware And Networking',
                'slug' => 'webinar-on-hardware-and-networking',
                'short_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'related_courses' => '',
                'duration' => 30,
                'start_at' => Carbon::today()->addMonths(3)->addHours(8),
                'end_at' => Carbon::today()->addMonths(3)->addHours(8)->addMinutes(30),
                'live_streaming_url' => 'https://www.youtube.com/embed/1FOgP6Ndsgk',
                'intro_video_url' => 'https://www.youtube.com/watch?v=1FOgP6Ndsgk',
                'image' => 'default-webinar-3-img.jpg',
                'total_enrollments' => '',
                'meta_title' => 'Hardware And Networking',
                'meta_description' => 'Hardware And Networking',
                'meta_keywords' => 'Hardware And Networking',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'category_id' => 4,
                'instructor_id' => 3,
                'name' => 'Webinar on Programming',
                'slug' => 'webinar-on-programming',
                'short_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'related_courses' => '',
                'duration' => 30,
                'start_at' => Carbon::today()->addMonths(4)->addHours(8),
                'end_at' => Carbon::today()->addMonths(4)->addHours(8)->addMinutes(30),
                'live_streaming_url' => 'https://www.youtube.com/embed/SGHjY_tfo7U',
                'intro_video_url' => 'https://www.youtube.com/watch?v=SGHjY_tfo7U',
                'image' => 'default-webinar-2-img.jpg',
                'total_enrollments' => '',
                'meta_title' => 'Programming',
                'meta_description' => 'Programming',
                'meta_keywords' => 'Programming',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]
        ];
        Webinar::insert($webinar_data);

        DB::table('webinar_users')->insert([
           [
               'user_id' => 5,
               'webinar_id' => 1,
           ],
           [
               'user_id' => 5,
               'webinar_id' => 3,
           ],
           [
               'user_id' => 5,
               'webinar_id' => 4,
           ],
           [
               'user_id' => 5,
               'webinar_id' => 5,
           ],
           [
               'user_id' => 5,
               'webinar_id' => 6,
           ],
           [
               'user_id' => 5,
               'webinar_id' => 7,
           ],
        ]);
    }
}
