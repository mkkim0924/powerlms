<?php

namespace App\Providers;


use App\Http\ViewComposer\AdminViewComposer;
use App\Http\ViewComposer\FrontViewComposer;
use App\Http\ViewComposer\PendingChatViewComposer;
use Carbon\Laravel\ServiceProvider;

class ViewComposerProvider extends ServiceProvider
{
    public function boot()
    {
        view()->composer(['admin.layouts.partials.nav'], AdminViewComposer::class);
        view()->composer(['admin.layouts.partials.header', 'admin.dashboard.partials.pending_chat', 'front-end.layouts.partials.unread_chats'], PendingChatViewComposer::class);
        view()->composer(['front-end.layouts.partials.nav', 'front-end.layouts.partials.footer'], FrontViewComposer::class);
    }
}
