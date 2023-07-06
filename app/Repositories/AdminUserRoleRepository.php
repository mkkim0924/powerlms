<?php

namespace App\Repositories;

use App\Interfaces\AdminUserRoleRepositoryInterface;
use App\Models\AdminModules;
use App\Models\AdminRole;
use App\Models\RoleWiseModuleAccess;

class AdminUserRoleRepository implements AdminUserRoleRepositoryInterface
{
    public function getAdminModules(): \Illuminate\Database\Eloquent\Collection|array
    {
        return AdminModules::with('child')->where('parent_module', 0)->get();
    }

    public function storeAllData($request)
    {
        $requestData = $request->except('_token');
        $requestData['is_super_admin'] = ($requestData['user_type'] == "super_admin") ? 1 : 0;
        $role = AdminRole::create($requestData);
        $role_id = $role->id;
        if ($requestData['user_type'] != 'super_admin' && isset($requestData['lms_modules'])) {
            self::roleWiseAccess($request, $role_id);
        }
        return true;
    }

    public function roleWiseAccess($request, $role_id)
    {
        foreach ($request['lms_modules'] as $data) {
            RoleWiseModuleAccess::create([
                'role_id' => $role_id,
                'module_key' => $data]);
        }
    }

    public function getAllUserRole()
    {
        return AdminRole::orderBy('id', 'DESC')->get();
    }

    public function getAdminRoleDetails($id)
    {
        return AdminRole::where('id', $id)->first();
    }

    public function getSelectedModule($id)
    {
        return RoleWiseModuleAccess::where('role_id', $id)->pluck('module_key')->toArray();
    }

    public function updateAdminModule($request, $id)
    {
        $requestData = $request->except('_token');
        $requestData['is_super_admin'] = ($requestData['user_type'] == "super_admin") ? 1 : 0;
        $data = self::getAdminRoleDetails($id);
        if ($data->user_type != 'super_admin' && $requestData['user_type'] == 'super_admin') {
            RoleWiseModuleAccess::where('role_id', $id)->delete();
        }
        $data->update($requestData);

        RoleWiseModuleAccess::where('role_id', $id)->delete();
        if ($requestData['user_type'] != 'super_admin' && isset($requestData['lms_modules'])) {
            self::roleWiseAccess($request, $id);
        }
        return true;
    }

    public function getRoleTitles()
    {
        return AdminRole::pluck('name', 'id')->toArray();
    }
}
