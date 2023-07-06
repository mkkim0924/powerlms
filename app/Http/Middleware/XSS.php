<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier;

class XSS
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $requestData = $request->all();
        array_walk_recursive($requestData, function (&$requestData, $key) {
            $requestData = ($key == 'location_iframe') ? $requestData : Purifier::clean($requestData);
        });
        $request->merge($requestData);
        return $next($request);
    }
}
