<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\AdminUserRepositoryInterface;
use App\Interfaces\AdminUserRoleRepositoryInterface;
use App\Models\Admins;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    protected $adminUserRepository, $adminUserRoleRepository;

    public function __construct(adminUserRepositoryInterface $adminUserRepository, adminUserRoleRepositoryInterface $adminUserRoleRepository)
    {
        $this->adminUserRepository = $adminUserRepository;
        $this->adminUserRoleRepository = $adminUserRoleRepository;

    }

    public function index(Request $request)
    {
        $admins = $this->adminUserRepository->getAllAdmins($request);
        return view('admin.admin-users.index', compact('admins'));
    }

    public function createNewAdmin()
    {
        $roles = $this->adminUserRoleRepository->getRoleTitles();
        return view('admin.admin-users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => "required|unique:admins",
            'role_id' => "required",
        ]);
        $response = $this->adminUserRepository->storeAdmin($request);
        if ($response['status']) {
            return redirect()->route('admin.admin_users')->with('success', __('backend.admin.manage_admins.flash_message.data_created'));
        } else {
            return redirect()->back()->with('error', $response['message']);
        }
    }

    public function edit($id)
    {
        $admin = $this->adminUserRepository->getAdminDetail($id);
        $roles = $this->adminUserRoleRepository->getRoleTitles();
        return view('admin.admin-users.edit', compact('admin', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $this->adminUserRepository->updateAdmin($request, $id);
        return redirect()->route('admin.admin_users')->with('success', __('global.flash_message.data_updated_successfully'));
    }

    public function delete($id)
    {
        Admins::destroy($id);
        return redirect()->route('admin.admin_users');
    }

    public function setPasswordLink($token)
    {
        $user = $this->adminUserRepository->getByActivationToken($token);
        is_null($user) ? abort(403, 'Unauthorized action.') : null;
        return view('admin.admin-users.add_password', compact('user'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'activation_token' => 'required',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required_with:password|same:password|min:6',
        ]);
        $requestData = $request->all();
        $user = $this->adminUserRepository->getByActivationToken($request->activation_token);
        if (isset($user)) {
            $requestData['is_active'] = 1;
            $requestData['activation_token'] = null;
            $requestData['activation_date'] = Carbon::today()->toDateString();
            $user->update($requestData);
            Auth::guard('admins')->loginUsingId($user->id);
            return redirect()->route('admin.dashboard')->with('success', __('backend.admin.manage_admins.flash_message.password_created'));
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    public function updateStatus(Request $request)
    {
        $this->adminUserRepository->updateActiveStatus($request);
        return response()->json(['message' => __('global.flash_message.data_updated_successfully')]);
    }

}
