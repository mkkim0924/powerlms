<?php

use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminUserRoleController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BackupController;
use App\Http\Controllers\Admin\BadgeController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\SponsorController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EmailTemplatesController;
use App\Http\Controllers\Admin\LocaleController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\SiteConfigurationsController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\UpdateController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\WidgetController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

// Forget Password Routes

Route::controller(AuthController::class)->group(function () {
    Route::get('admin/login', 'index')->name('admin.login');
    Route::post('admin/login/authenticate', 'authenticate')->middleware(['throttle:4,1,checklimit'])->name('admin.authenticate');
});
Route::get('admin-user/add-password/{token}', [AdminUserController::class, 'setPasswordLink'])->name('admin.set_password');
Route::post('admin-user/add-password', [AdminUserController::class, 'resetPassword'])->name('admin-user.password.store');

Route::group(['prefix' => 'admin/', 'middleware' => ['web', 'admins', 'roleAccess'], 'as' => 'admin.'], function () {
    Route::get('admin/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('instructor-login', [LoginController::class, 'loginRedirection'])->name('instructor.auth');
    //reviews And Ratings
    Route::get('reviews', [ReviewController::class, 'index'])->name('reviews');

    // configurations

    // Admin User
    Route::controller(SiteConfigurationsController::class)->group(function () {
        Route::get('troubleshoot', 'troubleshoot')->name('troubleshoot');

        Route::get('configurations', 'index')->name('configurations');
        Route::post('configurations/update', 'update')->name('configurations.update');
        Route::get('get-sections/{layout}', 'getSectionsByLayout')->name('configurations.getSectionsByLayout');
    });

    // Admin User
    Route::controller(AdminUserController::class)->group(function () {
        Route::get('admin-users', 'index')->name('admin_users');
        Route::get('admin-user/create', 'createNewAdmin')->name('admin_users.create');
        Route::post('admin-user/store', 'store')->name('admin_users.store');
        Route::get('admin-user/delete/{id}', 'delete')->name('admin_users.delete');
        Route::get('admin-user/edit/{id}', 'edit')->name('admin_users.edit');
        Route::post('admin-user/update/{id}', 'update')->name('admin_users.update');
        Route::get('admin-user/status/update', 'updateStatus')->name('admin-user.status');
    });

    // AdminUser Role
    Route::controller(AdminUserRoleController::class)->group(function () {
        Route::get('admin-roles', 'index')->name('admin_role');
        Route::get('admin-role/create', 'create')->name('admin_role.create');
        Route::post('admin-role/store', 'store')->name('admin_role.store');
        Route::get('admin-role/edit/{id}', 'edit')->name('admin_role.edit');
        Route::post('admin-role/update/{id}', 'update')->name('admin_role.update');
        Route::get('admin-role/delete/{id}', 'delete')->name('admin_role.delete');
    });

    // Categories
    Route::controller(CategoryController::class)->group(function () {
        Route::get('categories', 'index')->name('categories');
        Route::get('categories/create', 'create')->name('categories.create');
        Route::post('category/store', 'store')->name('categories.store');
        Route::get('category/edit/{id}', 'edit')->name('categories.edit');
        Route::post('category/update/{id}', 'update')->name('categories.update');
        Route::get('category/status/update', 'updateStatus')->name('categories.update.status');
    });

    // Profile
    Route::get('translations', function () {
        return true;
    })->name('translations');

    Route::get('profile', [ProfileController::class, 'getProfile'])->name('profile');
    Route::post('profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');

    //courses
    Route::controller(CourseController::class)->group(function () {
        Route::get('courses', 'adminCourses')->name('courses');
        Route::get('course/delete/{id}', 'delete')->name('courses.delete');
        Route::get('course/review/{id}', 'curriculumPage')->name('courses.review');
        Route::post('course/getCurriculumComments', 'getCurriculumComments')->name('courses.getCurriculumReview');
        Route::post('course/getCurriculumData', 'curriculumDetails')->name('courses.curriculumDetails');
        Route::post('course/curriculum-review/submit', 'submitCurriculumReview')->name('courses.submitCurriculumReview');
        Route::get('course/update-status/{id}/{status}', 'updateStatus')->name('courses.updateStatus');
    });

    // Blog Categories
    Route::controller(BlogCategoryController::class)->group(function () {
        Route::get('blog-categories', 'index')->name('blog_categories');
        Route::get('blog-category/create', 'create')->name('blog_categories.create');
        Route::post('blog-category/store', 'store')->name('blog_category.store');
        Route::get('blog-category/edit/{id}', 'edit')->name('blog_category.edit');
        Route::post('blog-category/update/{id}', 'update')->name('blog_category.update');
        Route::get('blog-category/delete/{id}', 'delete')->name('blog_category.delete');
    });

    // Blog
    Route::controller(BlogController::class)->group(function () {
        Route::get('blogs', 'index')->name('blog');
        Route::get('blog/create', 'create')->name('blog.create');
        Route::post('blog/store', 'store')->name('blog.store');
        Route::get('blog/edit/{id}', 'edit')->name('blog.edit');
        Route::post('blog/update/{id}', 'update')->name('blog.update');
        Route::get('blog/delete/{id}', 'delete')->name('blog.delete');
    });

    // badge
    Route::controller(BadgeController::class)->group(function () {
        Route::get('badges', 'index')->name('badge');
        Route::get('badge/create', 'create')->name('badge.create');
        Route::post('badge/store', 'store')->name('badge.store');
        Route::get('badge/edit/{id}', 'edit')->name('badge.edit');
        Route::post('badge/update/{id}', 'update')->name('badge.update');
        Route::get('badge/delete/{id}', 'delete')->name('badge.delete');
    });

    Route::controller(EmailTemplatesController::class)->group(function () {
        Route::get('email-templates', 'index')->name('email-templates');
        Route::get('email-templates/create', 'create')->name('email-templates.create');
        Route::post('email-templates/store', 'store')->name('email-templates.store');
        Route::get('email-templates/edit/{id}', 'edit')->name('email-templates.edit');
        Route::post('email-templates/update/{id}', 'update')->name('email-templates.update');
    });

    // Pages
    Route::controller(PageController::class)->group(function () {
        Route::get('pages', 'index')->name('page');
        Route::get('page/create', 'create')->name('page.create');
        Route::post('page/store', 'store')->name('page.store');
        Route::get('page/edit/{id}', 'edit')->name('page.edit');
        Route::post('page/update/{id}', 'update')->name('page.update');
        Route::get('page/delete/{id}', 'delete')->name('page.delete');
    });

    // Banner
    Route::controller(BannerController::class)->group(function () {
        Route::get('banners', 'index')->name('banner');
        Route::get('banner/create', 'create')->name('banner.create');
        Route::post('banner/store', 'store')->name('banner.store');
        Route::get('banner/edit/{id}', 'edit')->name('banner.edit');
        Route::post('banner/update/{id}', 'update')->name('banner.update');
        Route::get('banner/delete/{id}', 'delete')->name('banner.delete');
    });

    Route::controller(SponsorController::class)->group(function () {
        Route::get('sponsors', 'index')->name('sponsors');
        Route::get('sponsor/create', 'create')->name('sponsor.create');
        Route::post('sponsor/store', 'store')->name('sponsor.store');
        Route::get('sponsor/edit/{id}', 'edit')->name('sponsor.edit');
        Route::post('sponsor/update/{id}', 'update')->name('sponsor.update');
        Route::get('sponsor/delete/{id}', 'delete')->name('sponsor.delete');
    });

    // Language
    Route::controller(LocaleController::class)->group(function () {
        Route::get('languages', 'index')->name('language');
        Route::get('language/create', 'create')->name('language.create');
        Route::post('language/store', 'store')->name('language.store');
        Route::get('language/edit/{id}', 'edit')->name('language.edit');
        Route::post('language/update/{id}', 'update')->name('language.update');
        Route::get('language/delete/{id}', 'delete')->name('language.delete');
    });

    // instructors
    Route::controller(UsersController::class)->group(function () {
        Route::get('instructor-applications', 'instructorApplications')->name('instructor_applications');
        Route::get('instructor-application/{user_id}/{status}', 'instructorApplicationStatus')->name('instructor_applications.status');
        Route::post('instructor-application/reject', 'rejectInstructorApplication')->name('instructor_applications.reject');


        Route::get('instructors', 'getInstructorList')->name('instructors');
        Route::get('instructor/create', 'create')->name('instructor.create');
        Route::post('instructor/store', 'store')->name('instructor.store');
        Route::get('instructor/edit/{id}', 'edit')->name('instructor.edit');
        Route::post('instructor/update/{id}', 'update')->name('instructor.update');
        Route::get('instructor/delete/{id}', 'delete')->name('instructor.delete');


        Route::get('instructor/details/{id}', 'bank_credentials')->name('instructor.details');
        Route::get('login-as-instructor/{id}', 'instructorLogin')->name('login_as_instructor');

    });

    Route::controller(StudentController::class)->group(function () {
        Route::get('students', 'index')->name('students');
        Route::get('student_details/{id}', 'detail')->name('student_details.index');
    });

    Route::controller(ReportController::class)->group(function () {
        Route::get('course-report', 'courseReport')->name('course_report');
        Route::get('course-report/manual-enroll', 'manualCourseEnroll')->name('course_report.manual_enroll');
        Route::post('course-report/manual-enroll-store', 'storeManualCourseEnroll')->name('course_report.manual_enroll_store');

        Route::get('sales-report', 'salesReport')->name('sales_report');
        Route::get('instructor-payout', 'allPayoutRequests')->name('instructor_payout');
        Route::get('payout-request/process/{id}', 'processPayoutRequest')->name('instructor_payout.process');
        Route::get('user-reports', 'userReports')->name('user_reports');
        Route::get('payment-reports', 'paymentReports')->name('payments_reports');
        Route::get('course-wise-revenue-report', 'courseWiseRevenueReport')->name('course_wise_revenue_report');

        Route::get('course-report/export', 'exportCourseReport')->name('course_report.export');
        Route::get('sales-report/export', 'exportSalesReport')->name('sales_report.export');
        Route::get('course-wise-revenue-report/export', 'exportCourseWiseRevenueReport')->name('course_wise_revenue_report.export');

        Route::get('course-report/progress/{id}', 'getUserCourseProgressReport')->name('course_report.getUserCourseProgressReport');
        Route::post('course-report/progress/quiz-result', 'quizResult')->name('course_report.quizResult');

        Route::get('offline-payment-requests', 'getOfflinePaymentRequests')->name('offline_payment_requests');
        Route::get('offline-payment-requests/status/{id}/{status}', 'updatePaymentRequestStatus')->name('offline_payment_requests.status');
    });

    Route::controller(UpdateController::class)->group(function () {
        Route::get('update-theme', 'index')->name('update_theme');
        Route::post('update-theme/update', 'listFiles')->name('update_theme.update');
        Route::post('update-files', 'updateTheme')->name('update-files');
    });

    Route::controller(BackupController::class)->group(function () {
        Route::get('backup', 'index')->name('backup');
        Route::post('backup/update-settings', 'updateSettings')->name('backup.updateSettings');
    });

    Route::controller(WidgetController::class)->group(function () {
        Route::get('widgets', 'index')->name('widgets');
        Route::get('widgets/edit/{id}', 'edit')->name('widgets.edit');
        Route::post('widget/update/{id}', 'update')->name('widgets.update');
    });

    Route::controller(MenuController::class)->group(function () {
        Route::get('menu-manager', 'index')->name('menu_manager');
        Route::post('menu-manager/store', 'store')->name('menu_manager.store');
        Route::get('menu-manager/delete/{id}', 'delete')->name('menu_manager.delete');
        Route::post('menu-manager/update-sort', 'update')->name('menu_manager.update_sort');
    });
});
