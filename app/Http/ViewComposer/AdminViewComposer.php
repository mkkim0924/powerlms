<?php

namespace App\Http\ViewComposer;

use App\Models\AdminModules;
use App\Models\AdminRole;
use App\Models\InstructorPayoutLog;
use App\Models\Locale;
use App\Models\RoleWiseModuleAccess;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class AdminViewComposer
{
    public function compose(View $view)
    {
        $user = getCurrentAdmin();
        $admin_role = AdminRole::get();
        $data = AdminModules::where('parent_module', 0)->get();
        $module_access = RoleWiseModuleAccess::where('role_id', $user->role_id)->pluck('module_key')->toArray();
        $is_super_admin = ($user->relatedRole->is_super_admin == 1);
        $pending_application_count = User::where('type', 1)->where('instructor_application_status', User::INSTRUCTOR_APPLICATION_PENDING_STATUS)->count();
        $pending_payout_requests = InstructorPayoutLog::where('payout_request_status', 0)->where('payment_type', 'debit')->count();
        $view->with([
            'admin_role' => $admin_role,
            'admin_module' => $data,
            'module_access' => $module_access,
            'is_super_admin' => $is_super_admin,
            'pending_application_count' => $pending_application_count,
            'pending_payout_requests' => $pending_payout_requests,
        ]);
    }
}
