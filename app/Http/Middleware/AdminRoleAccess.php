<?php

namespace App\Http\Middleware;

use App\Models\AdminModules;
use App\Models\RoleWiseModuleAccess;
use Closure;
use Illuminate\Http\Request;

class AdminRoleAccess
{
    public function handle(Request $request, Closure $next)
    {
        $user = getCurrentAdmin();
        if (!isset($user->relatedRole) || $user->relatedRole->is_super_admin == 1) {
            return $next($request);
        }
        $module_access = RoleWiseModuleAccess::where('role_id', $user->role_id)->pluck('module_key')->toArray();
        $currentPath = \Request::route()->getName();
        $words = explode(".", $currentPath);
        /*if (isset($words[2]) && $words[2] != "") {
            array_splice($words, -1);
            $route_name = implode(".", $words);
        } else {
        }*/
        $route_name = $words[1];
        $pageName = AdminModules::where('route_name', $route_name)->select('id', 'module_key')->get()->toArray();
        if (!empty($pageName)) {
            $accessUrl = $pageName[0]['module_key'];
            if (in_array($accessUrl, $module_access)) {
                return $next($request);
            } else {
                abort(401, 'This action is unauthorized.');
            }
        } else {
            return $next($request);
        }
    }
}
