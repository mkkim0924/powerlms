<?php


namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/';
    public const ADMIN = '/admin/dashboard';


    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapAdminRoutes();

        $this->mapInstructorRoutes();

        $this->mapWebRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware(['web', 'XSS'])
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }


    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }


    /**
     * Define the "admin" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapAdminRoutes()
    {
        Route::middleware(['admin', 'XSS'])
            ->namespace($this->namespace)
            ->group(base_path('routes/admin.php'));
    }


    protected function mapInstructorRoutes()
    {
        Route::middleware(['XSS'])->namespace($this->namespace)
            ->group(base_path('routes/instructor.php'));
    }


    /**
     * Define the "user" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */

    protected function configureRateLimiting()
    {
        RateLimiter::for('checklimit', function (Request $request) {
            dd('$request->all()');
            return Limit::perMinute(10)->by($request->user()->id ?? $request->ip());
        });
    }

}
