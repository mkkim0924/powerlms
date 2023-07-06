<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_modules')->truncate();
        $data = [
            [
                'module_key' => 'dashboard_menu', // parent_id =1
                'module_title' => 'Dashboard',
                'icon_class' => null,
                'route_name' => 'dashboard',
                'description' => 'Dashboard',
                'parent_module' => 0,
            ],
            [
                'module_key' => 'course_catalog_menu', // parent_id =2
                'module_title' => 'Course Catalog',
                'icon_class' => 'has-arrow',
                'route_name' => null,
                'description' => 'Course Catalog',
                'parent_module' => 0,
            ],
            [
                'module_key' => 'system_menu', // parent_id =3
                'module_title' => 'System',
                'icon_class' => 'has-arrow',
                'route_name' => null,
                'description' => 'System',
                'parent_module' => 0,
            ],
            [
                'module_key' => 'users_menu', // parent_id =4
                'module_title' => 'Users',
                'icon_class' => 'has-arrow',
                'route_name' => null,
                'description' => 'Users',
                'parent_module' => 0,
            ],

            [
                'module_key' => 'reports_menu', // parent_id =5
                'module_title' => 'Reports',
                'icon_class' => 'has-arrow',
                'route_name' => null,
                'description' => 'Reports',
                'parent_module' => 0,
            ],

            [
                'module_key' => 'course_report',
                'module_title' => 'Reports',
                'icon_class' => null,
                'route_name' => 'course_report',
                'description' => 'Reports',
                'parent_module' => 5,
            ],

            // 4
            [
                'module_key' => 'admins_sub_menu',
                'module_title' => 'Admins',
                'icon_class' => null,
                'route_name' => null,
                'description' => 'Admins',
                'parent_module' => 4,
            ],
            [
                'module_key' => 'instructors_sub_menu',
                'module_title' => 'Instructors',
                'icon_class' => null,
                'route_name' => null,
                'description' => 'Instructors',
                'parent_module' => 4,
            ],
            [
                'module_key' => 'admin_users',
                'module_title' => 'Manage Admins',
                'icon_class' => null,
                'route_name' => 'admin_users',
                'description' => 'Admin Users',
                'parent_module' => 7,
            ],
            [
                'module_key' => 'admin_roles',
                'module_title' => 'Manage Roles',
                'icon_class' => null,
                'route_name' => 'admin_role',
                'description' => 'Admin Users Role',
                'parent_module' => 7,
            ],
            [
                'module_key' => 'manage_instructors',
                'module_title' => 'Manage Instructors',
                'icon_class' => null,
                'route_name' => 'instructors',
                'description' => 'Manage Instructors',
                'parent_module' => 8,
            ],
            [
                'module_key' => 'instructor_payout',
                'module_title' => 'Instructor Payout',
                'icon_class' => null,
                'route_name' => 'instructor_payout',
                'description' => 'Instructor Payout',
                'parent_module' => 8,
            ],
            [
                'module_key' => 'instructor_applications',
                'module_title' => 'Applications',
                'icon_class' => null,
                'route_name' => 'instructor_applications',
                'description' => 'Applications',
                'parent_module' => 8,
            ],
            [
                'module_key' => 'students',
                'module_title' => 'Students',
                'icon_class' => null,
                'route_name' => 'students',
                'description' => 'Students',
                'parent_module' => 4,
            ],

            // 2
            [
                'module_key' => 'categories',
                'module_title' => 'Categories',
                'icon_class' => 'has-arrow',
                'route_name' => 'categories',
                'description' => 'Categories',
                'parent_module' => 2,
            ],
            [
                'module_key' => 'courses_catalog',
                'module_title' => 'Courses',
                'icon_class' => null,
                'route_name' => 'courses',
                'description' => 'Courses',
                'parent_module' => 2,
            ],
            [
                'module_key' => 'badges',
                'module_title' => 'Course Badges',
                'icon_class' => null,
                'route_name' => 'badge',
                'description' => 'badge',
                'parent_module' => 2,
            ],
            // 3
            [
                'module_key' => 'blog_categories',
                'module_title' => 'Blog Categories',
                'icon_class' => null,
                'route_name' => 'blog_categories',
                'description' => 'Blog Categories',
                'parent_module' => 3,
            ],

            [
                'module_key' => 'blogs',
                'module_title' => 'Blog',
                'icon_class' => null,
                'route_name' => 'blog',
                'description' => 'Blog',
                'parent_module' => 3,
            ],

            [
                'module_key' => 'pages',
                'module_title' => 'Pages',
                'icon_class' => null,
                'route_name' => 'page',
                'description' => 'Pages',
                'parent_module' => 3,
            ],
            [
                'module_key' => 'configurations',
                'module_title' => 'Configuration',
                'icon_class' => null,
                'route_name' => 'configurations',
                'description' => 'Configuration',
                'parent_module' => 3,
            ],
            [
                'module_key' => 'translations',
                'module_title' => 'Translations',
                'icon_class' => null,
                'route_name' => 'translations',
                'description' => 'Translations',
                'parent_module' => 3,
            ],
            [
                'module_key' => 'widgets',
                'module_title' => 'Widgets',
                'icon_class' => null,
                'route_name' => 'widgets',
                'description' => 'Widgets',
                'parent_module' => 3,
            ],
            [
                'module_key' => 'menu_manager',
                'module_title' => 'Menu Manager',
                'icon_class' => null,
                'route_name' => 'menu_manager',
                'description' => 'Menu Manager',
                'parent_module' => 3,
            ],
            [
                'module_key' => 'email_templates',
                'module_title' => 'Email Templates',
                'icon_class' => null,
                'route_name' => 'email-templates',
                'description' => 'Email Templates',
                'parent_module' => 3,
            ],
            [
                'module_key' => 'languages',
                'module_title' => 'Languages',
                'icon_class' => null,
                'route_name' => 'language',
                'description' => 'Languages',
                'parent_module' => 3,
            ],
            [
                'module_key' => 'banners',
                'module_title' => 'Banner',
                'icon_class' => null,
                'route_name' => 'banner',
                'description' => 'Banner',
                'parent_module' => 3,
            ],
            [
                'module_key' => 'sponsors',
                'module_title' => 'Sponsors',
                'icon_class' => null,
                'route_name' => 'sponsors',
                'description' => 'Sponsors',
                'parent_module' => 3,
            ],
            [
                'module_key' => 'update_theme',
                'module_title' => 'Update',
                'icon_class' => null,
                'route_name' => 'update_theme',
                'description' => 'Update',
                'parent_module' => 3,
            ],
            [
                'module_key' => 'backup',
                'module_title' => 'Backup',
                'icon_class' => null,
                'route_name' => 'backup',
                'description' => 'Backup',
                'parent_module' => 3,
            ],
            [
                'module_key' => 'sales_report',
                'module_title' => 'Sales Report',
                'icon_class' => null,
                'route_name' => 'sales_report',
                'description' => 'Sales Report',
                'parent_module' => 5,
            ],
            [
                'module_key' => 'course_wise_revenue_report',
                'module_title' => 'Course Wise Revenue Report',
                'icon_class' => null,
                'route_name' => 'course_wise_revenue_report',
                'description' => 'Course Wise Revenue Report',
                'parent_module' => 5,
            ],
            [
                'module_key' => 'offline_payment_requests',
                'module_title' => 'Offline Payment Requests',
                'icon_class' => null,
                'route_name' => 'offline_payment_requests',
                'description' => 'Offline Payment Requests',
                'parent_module' => 5,
            ],
            [
                'module_key' => 'student_reviews',
                'module_title' => 'Student Reviews',
                'icon_class' => null,
                'route_name' => 'reviews',
                'description' => 'Student Reviews',
                'parent_module' => 5,
            ],
        ];
        DB::table('admin_modules')->insert($data);

        DB::table('role_wise_module_accesses')->where('role_id', 1)->delete();
        foreach ($data as $datum) {
            DB::table('role_wise_module_accesses')->insert([
                'role_id' => 1,
                'module_key' => $datum['module_key'],
            ]);
        }
    }
}
