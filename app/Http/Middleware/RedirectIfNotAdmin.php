<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAdmin
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
        if (!Auth::guard('admins')->check()) {
            return redirect()->route('admin.login');
        }
        $request->user_type = 'admin';
        $request->user_id = auth()->guard('admins')->user()->id;
        return $next($request);
    }
}
