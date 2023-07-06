<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\AdminUserRoleRepositoryInterface;
use App\Models\AdminRole;
use Illuminate\Http\Request;

class AdminUserRoleController extends Controller
{
    protected $adminUserRoleRepository;

    public function __construct(adminUserRoleRepositoryInterface $adminUserRoleRepository)
    {
        $this->adminUserRoleRepository = $adminUserRoleRepository;
    }

    public function index()
    {
        $admin_role = AdminRole::get();
        return view('admin.admin-user-role.index', compact('admin_role'));
    }

    public function create()
    {
        $lms_modules = $this->adminUserRoleRepository->getAdminModules();
        return view('admin.admin-user-role.create', compact('lms_modules', ));
    }

    public function store(Request $request)
    {
        $this->adminUserRoleRepository->storeAllData($request);
        return redirect()->route('admin.admin_role')->with('success', __('global.flash_message.data_created_successfully'));
    }

    public function edit($id)
    {
        $adminRole = $this->adminUserRoleRepository->getAdminRoleDetails($id);
        $lms_modules = $this->adminUserRoleRepository->getAdminModules();
        $current_selected_modules = $this->adminUserRoleRepository->getSelectedModule($id);
        return view('admin.admin-user-role.edit', compact('lms_modules', 'current_selected_modules', 'adminRole'));
    }

    public function update(Request $request, $id)
    {
        $this->adminUserRoleRepository->updateAdminModule($request, $id);
        return redirect()->route('admin.admin_role')->with('success', __('global.flash_message.data_updated_successfully'));

    }
    public function delete($id)
    {
        AdminRole::destroy($id);
        return redirect()->route('admin.admin_role');
    }

}
