<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminUserDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_roles')->truncate();
        DB::table('admin_roles')->insert([
            'name' => 'Super Admin',
            'is_super_admin' => 1,
            'user_type' => "super_admin",
        ]);

        \App\Models\Admins::truncate();
        $admin = [
            'name' => 'Admin User',
            'email' => 'admin@lms.com',
            'password' => '123456',
            'is_active' => 1,
            'role_id' => 1,
            'image' => 'default-user-1.jpg',
            'activation_date' => \Carbon\Carbon::now(),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ];
        \App\Models\Admins::create($admin);
    }
}
