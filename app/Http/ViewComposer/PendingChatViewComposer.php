<?php

namespace App\Http\ViewComposer;

use App\Models\AdminModules;
use App\Models\AdminRole;
use App\Models\ChatThread;
use App\Models\InstructorPayoutLog;
use App\Models\Locale;
use App\Models\RoleWiseModuleAccess;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class PendingChatViewComposer
{
    public function compose(View $view)
    {
        $unreadChatThreads = [];
        if (auth()->check()){
            $unreadChatThreads = ChatThread::whereHas('unreadChatMessages')->orderBy('updated_at', 'DESC')->get();
        }
        $view->with([
            'unreadChatThreads' => $unreadChatThreads,
        ]);
    }
}
