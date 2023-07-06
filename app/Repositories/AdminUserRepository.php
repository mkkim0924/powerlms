<?php

namespace App\Repositories;

use App\Events\AdminSetPasswordEvent;
use App\Interfaces\AdminUserRepositoryInterface;
use App\Models\Admins;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminUserRepository implements AdminUserRepositoryInterface
{
    public function updateProfile($request)
    {
        $requestData = $request->all();
        $currentAdmin = getCurrentAdmin();
        if (isset($requestData['image'])) {
            $requestData['image'] = uploadFile($requestData['image'], 'users/', $currentAdmin->image);
        }
        $currentAdmin->update($requestData);
        return true;
    }

    public function getAllAdminNames()
    {
        return Admins::pluck('name', 'id')->toArray();

    }

    public function getAllCRMUser()
    {
        return Admins::whereHas('relatedRole', function ($q) {
            $q->where('is_super_admin', 0);
            $q->where('user_type', 'crm');
        })->where('id')->pluck('name', 'id')->toArray();
    }

    public function getAllAdmins($request)
    {
        return Admins::orderBy('id', 'ASC')->get();
    }

    public function storeAdmin($request): array
    {
        DB::beginTransaction();
        try {
            $requestData = $request->except('_token');
            $requestData['activation_token'] = Str::random(10);
            $requestData['is_active'] = 0;
            // dd($requestData);
            $admin = Admins::create($requestData);
            event(new AdminSetPasswordEvent($admin));
            DB::commit();
            return ['status' => true];
        } catch (\Exception$e) {
            DB::rollBack();
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    public function getAdminDetail($id)
    {
        return Admins::where('id', $id)->first();
    }

    public function getRoleType()
    {
        return Admins::pluck('type', 'id')->toArray();
    }

    public function updateAdmin($request, $id): bool
    {
        $requestData = $request->all();
        $admin = self::getAdminDetail($id);
        if (isset($admin)) {
            $admin->update($requestData);
        }
        return true;
    }

    public function getByActivationToken($token)
    {
        return Admins::where('activation_token', $token)->first();
    }

    public function updateActiveStatus($request)
    {
        $cat = Admins::findOrFail($request->id);
        $cat->is_active = $request->is_active;
        $cat->save();
        return true;
    }

}
