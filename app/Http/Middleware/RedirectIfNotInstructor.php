<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

class RedirectIfNotInstructor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }elseif (auth()->check() && auth()->user()->type != 1){
            return redirect()->route('home');
        }
        $user = auth()->user();
        $request->user_type = 'instructor';
        $request->user_id = $user->id;
        if (($user->instructor_application_status != 1) && !in_array(Route::currentRouteName(), ["instructor.become", "instructor.application.store"])){
            return redirect()->route('instructor.become');
        }
        if (!empty($user->instructor_zoom_details)){
            foreach ($user->instructor_zoom_details as $key => $value){
                Config::set('zoom.'.$key, $value);
            }
        }
        return $next($request);
    }
}
