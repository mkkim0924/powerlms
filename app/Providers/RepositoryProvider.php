<?php

namespace App\Providers;

use App\Interfaces\AdminUserRepositoryInterface;
use App\Interfaces\AdminUserRoleRepositoryInterface;
use App\Interfaces\BadgeRepositoryInterface;
use App\Interfaces\BannerRepositoryInterface;
use App\Interfaces\BlogRepositoryInterface;
use App\Interfaces\BundleRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\CoursesRepositoryInterface;
use App\Interfaces\EmailTemplatesRepositoryInterface;
use App\Interfaces\FaqsRepositoryInterface;
use App\Interfaces\Front\BlogRepositoryInterface as FrontBlogRepositoryInterface;
use App\Interfaces\Front\CategoryRepositoryInterface as FrontCategoryRepositoryInterface;
use App\Interfaces\Front\CourseRepositoryInterface as FrontCoursesRepositoryInterface;
use App\Interfaces\Front\PageRepositoryInterface;
use App\Interfaces\Front\PaymentRepositoryInterface;
use App\Interfaces\LocaleRepositoryInterface;
use App\Interfaces\PagesRepositoryInterface;
use App\Interfaces\PaymentsRepositoryInterface;
use App\Interfaces\QuizRepositoryInterface;
use App\Interfaces\SectionRepositoryInterface;
use App\Interfaces\SiteConfigurationsRepositoryInterface;
use App\Interfaces\UnitRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\AdminUserRepository;
use App\Repositories\AdminUserRoleRepository;
use App\Repositories\BadgeRepository;
use App\Repositories\BannerRepository;
use App\Repositories\BlogRepository;
use App\Repositories\BundleRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\CoursesRepository;
use App\Repositories\EmailTemplatesRepository;
use App\Repositories\FaqsRepository;
use App\Repositories\Front\BlogRepository as FrontBlogRepository;
use App\Repositories\Front\CategoryRepository as FrontCategoryRepository;
use App\Repositories\Front\CourseRepository as FrontCoursesRepository;
use App\Repositories\Front\PageRepository;
use App\Repositories\Front\PaymentRepository;
use App\Repositories\LocaleRepository;
use App\Repositories\PagesRepository;
use App\Repositories\PaymentsRepository;
use App\Repositories\QuizRepository;
use App\Repositories\SectionRepository;
use App\Repositories\SiteConfigurationsRepository;
use App\Repositories\UnitRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(SiteConfigurationsRepositoryInterface::class, function ($app) {
            return $app->make(SiteConfigurationsRepository::class);
        });

        $this->app->bind(AdminUserRoleRepositoryInterface::class, function ($app) {
            return $app->make(AdminUserRoleRepository::class);
        });

        $this->app->bind(AdminUserRepositoryInterface::class, function ($app) {
            return $app->make(AdminUserRepository::class);
        });

        $this->app->bind(CategoryRepositoryInterface::class, function ($app) {
            return $app->make(CategoryRepository::class);
        });

        $this->app->bind(CoursesRepositoryInterface::class, function ($app) {
            return $app->make(CoursesRepository::class);
        });

        $this->app->bind(UnitRepositoryInterface::class, function ($app) {
            return $app->make(UnitRepository::class);
        });

        $this->app->bind(FaqsRepositoryInterface::class, function ($app) {
            return $app->make(FaqsRepository::class);
        });

        $this->app->bind(SectionRepositoryInterface::class, function ($app) {
            return $app->make(SectionRepository::class);
        });

        $this->app->bind(QuizRepositoryInterface::class, function ($app) {
            return $app->make(QuizRepository::class);
        });

        $this->app->bind(BlogRepositoryInterface::class, function ($app) {
            return $app->make(BlogRepository::class);
        });

        $this->app->bind(BadgeRepositoryInterface::class, function ($app) {
            return $app->make(BadgeRepository::class);
        });

        $this->app->bind(EmailTemplatesRepositoryInterface::class, function ($app) {
            return $app->make(EmailTemplatesRepository::class);
        });

        $this->app->bind(PagesRepositoryInterface::class, function ($app) {
            return $app->make(PagesRepository::class);
        });

        $this->app->bind(BannerRepositoryInterface::class, function ($app) {
            return $app->make(BannerRepository::class);
        });

        $this->app->bind(LocaleRepositoryInterface::class, function ($app) {
            return $app->make(LocaleRepository::class);
        });

        $this->app->bind(UserRepositoryInterface::class, function ($app) {
            return $app->make(UserRepository::class);
        });

        $this->app->bind(PaymentsRepositoryInterface::class, function ($app) {
            return $app->make(PaymentsRepository::class);
        });

        $this->app->bind(BundleRepositoryInterface::class, function ($app) {
            return $app->make(BundleRepository::class);
        });

        /*FRONT*/
        $this->app->bind(FrontBlogRepositoryInterface::class, function ($app) {
            return $app->make(FrontBlogRepository::class);
        });
        $this->app->bind(FrontCoursesRepositoryInterface::class, function ($app) {
            return $app->make(FrontCoursesRepository::class);
        });
        $this->app->bind(FrontCategoryRepositoryInterface::class, function ($app) {
            return $app->make(FrontCategoryRepository::class);
        });
        $this->app->bind(PaymentRepositoryInterface::class, function ($app) {
            return $app->make(PaymentRepository::class);
        });

        $this->app->bind(PageRepositoryInterface::class, function ($app) {
            return $app->make(PageRepository::class);
        });
    }
}
