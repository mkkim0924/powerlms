<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class UserDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $factory = Factory::create();

        \App\Models\User::truncate();
        User::create([
            'name' => $factory->name,
            'email' => 'instructor@lms.com',
            'password' => '123456',
            'type' => 1,
            'bio' => $factory->paragraph(5),
            'experience' => $factory->paragraph(7),
            'social_links' => '{"facebook":"https:\/\/www.facebook.com\/","linkedin":"https:\/\/in.linkedin.com\/","twitter":"https:\/\/twitter.com\/","website":"http:\/\/powerlms.org\/"}',
            'instructor_application_status' => 1,
            'is_active' => 1,
            'image' => 'default-user-1.jpg',
            'enable_course_review' => '1',
            'email_verified_at' => \Carbon\Carbon::now(),
        ]);
        User::create([
            'name' => $factory->name,
            'email' => 'instructor2@lms.com',
            'password' => '123456',
            'type' => 1,
            'bio' => $factory->paragraph(5),
            'experience' => $factory->paragraph(7),
            'social_links' => '{"facebook":"https:\/\/www.facebook.com\/","linkedin":"https:\/\/in.linkedin.com\/","twitter":"https:\/\/twitter.com\/","website":"http:\/\/powerlms.org\/"}',
            'instructor_application_status' => 1,
            'is_active' => 1,
            'image' => 'default-user-2.jpg',
            'enable_course_review' => '1',
            'email_verified_at' => \Carbon\Carbon::now(),
        ]);
        User::create([
            'name' => $factory->name,
            'email' => 'instructor3@lms.com',
            'password' => '123456',
            'type' => 1,
            'bio' => $factory->paragraph(5),
            'experience' => $factory->paragraph(7),
            'social_links' => '{"facebook":"https:\/\/www.facebook.com\/","linkedin":"https:\/\/in.linkedin.com\/","twitter":"https:\/\/twitter.com\/","website":"http:\/\/powerlms.org\/"}',
            'instructor_application_status' => 1,
            'is_active' => 1,
            'image' => 'default-user-3.jpg',
            'enable_course_review' => '1',
            'email_verified_at' => \Carbon\Carbon::now(),
        ]);
        User::create([
            'name' => $factory->name,
            'email' => 'instructor4@lms.com',
            'password' => '123456',
            'type' => 1,
            'bio' => $factory->paragraph(5),
            'experience' => $factory->paragraph(7),
            'social_links' => '{"facebook":"https:\/\/www.facebook.com\/","linkedin":"https:\/\/in.linkedin.com\/","twitter":"https:\/\/twitter.com\/","website":"http:\/\/powerlms.org\/"}',
            'instructor_application_status' => 1,
            'is_active' => 1,
            'image' => 'default-user-4.jpg',
            'enable_course_review' => '1',
            'email_verified_at' => \Carbon\Carbon::now(),
        ]);

        for ($i = 1; $i <= 8; $i++){
            User::create([
                'name' => $factory->name,
                'email' => ($i == 1) ? 'student@lms.com' : "student$i@lms.com",
                'password' => '123456',
                'type' => 0,
                'is_active' => 1,
                'image' => "default-user-$i.jpg",
                'email_verified_at' => \Carbon\Carbon::now(),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }
        User::factory()->count(100)->create();
    }
}
