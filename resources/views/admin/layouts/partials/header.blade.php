<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header">
            <!-- This is for the sidebar toggle which is visible on mobile only -->
            <a class="nav-toggler d-block d-md-none" href="javascript:void(0)">
                <i class="ti-menu ti-close"></i>
            </a>
            <div class="navbar-brand">
                @if (request()->user_type == 'admin' or request()->user_type == 'instructor')
                    <a href="{{ route(request()->user_type . '.dashboard') }}" class="logo">
                        <img src="{{ getFileUrl(config('admin_logo'), 'logos') }}" alt="homepage" class="light-logo"
                             height="30px"/>
                    </a>
                @else
                    <a href="{{ route('home') }}" class="logo">
                        <img src="{{ getFileUrl(config('admin_logo'), 'logos') }}" alt="homepage" class="light-logo"
                             height="30px"/>
                    </a>
                @endif
            </div>
            <!-- ============================================================== -->
            <!-- Toggle which is visible on mobile only -->
            <!-- ============================================================== -->
            <a class="topbartoggler d-block d-md-none" href="javascript:void(0)" data-toggle="collapse"
               data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
               aria-label="Toggle navigation">
                <i class="ti-more"></i>
            </a>
        </div>
        @php $admin = (request()->user_type == 'admin') ? getCurrentAdmin() : auth()->user(); @endphp
        <div class="navbar-collapse collapse justify-content-end py-1" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto float-right">
                @if ((request()->user_type == 'admin') & ($admin->instructor_id != null))
                    <li class="nav-item">
                        <a href="{{ route('admin.login_as_instructor', $admin->id) }}" class="nav-link dropdown-toggle">
                            <span class="d-none d-md-block">
                                @lang('backend.navbar.view_as_instructor')
                            </span>
                        </a>
                    </li>
                @endif
            </ul>
            <ul class="navbar-nav ms-auto float-right">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="btn btn-sm bg-light rounded-pill" target="_blank">
                        <i class="fas fa-globe"></i>
                        <span class="text-dark">
                            @lang('backend.navbar.visit_website')
                        </span>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto float-right">
                <li class="nav-item dropdown mx-2">
                    <a class="nav-link dropdown-toggle badge bg-light text-dark" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-none d-md-block">@lang('backend.navbar.languages') ({{ app()->getLocale() }})
                            <i class="fa fa-chevron-down text-sm mt-2"></i>
                        </span>
                        <span class="d-block d-md-none">@lang('backend.navbar.languages') ({{ app()->getLocale() }})</span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach ($locale_list as $lang => $lang_name)
                            @if (app()->getLocale() != $lang)
                                <a class="dropdown-item"
                                   href="{{ route('language.swap', $lang) }}">{{ $lang_name }}</a>
                            @endif
                        @endforeach
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav float-right">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-dark pro-pic badge bg-light d-flex align-items-center" href="javascript:;"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-none d-sm-inline-block text-dark px-1">
                            {{ $admin->name }}
                        </span>
                        <img src="{{ getFileUrl($admin->image ?? 'default-placeholder.jpg', 'users/') }}"
                             alt="user" class="rounded-circle user-avatar">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                        <div class="d-flex no-block align-items-center bg-light mb-2 p-3">
                            <div class="">
                                <img src="{{ getFileUrl($admin->image ?? 'default-placeholder.jpg', 'users/') }}"
                                     alt="user" class="rounded-circle" width="60" height="60">
                            </div>
                            <div class="ml-2">
                                <h4 class="mb-0">{{ $admin->name }} </h4>
                                <p class="mb-0">{{ $admin->email }} </p>
                            </div>
                        </div>
                        <div class="profile-dis scrollable">
                            @if (request()->user_type == 'admin' ||
                                (request()->user_type == 'instructor' && $admin->instructor_application_status == 1))
                                <a class="dropdown-item" href="{{ route(request()->user_type . '.profile') }}">
                                    <i class="ti-user mx-1"></i> @lang('backend.navbar.my_profile')</a>
                            @endif
                            @if (request()->user_type == 'admin')
                                <a class="dropdown-item" href="{{ route('admin.configurations') }}">
                                    <i class="ti-settings mx-1"></i> @lang('backend.navbar.site_settings')</a>
                                <a class="dropdown-item" href="{{ url('admin/log-viewer') }}">
                                    <i class="ti-list mx-1"></i> @lang('backend.navbar.log_manager')</a>
                            @elseif(request()->user_type == 'instructor' && $admin->instructor_application_status == 1)
                                <a class="dropdown-item" href="{{ route('instructor.zoomSettings') }}">
                                    <i class="ti-settings mx-1"></i>@lang('backend.navbar.zoom_settings')</a>
                            @endif
                            <a class="dropdown-item"
                               href="{{ request()->user_type == 'admin' ? route('admin.logout') : route('logout') }}">
                                <i class="fa fa-power-off mx-1" type="submit"></i> @lang('backend.navbar.logout')
                            </a>
                        </div>
                    </div>
                </li>
            @if (request()->user_type == 'instructor')
                <!-- ============================================================== -->
                    <!-- ===================== Notifications ========================== -->
                    <!-- ============================================================== -->
                    <li class="nav-item dropdown px-1 position-relative">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark text-dark bg-light badge rounded-circle "  href=""
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bell text-success"></i>
                        </a>
                        {!! AsyncWidget::unreadNotificationCountWidget() !!}
                        <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown">
                            {!! AsyncWidget::notificationListWidget() !!}
                        </div>
                    </li>
                    <!-- ============================================================== -->
                    <!-- ===================== End Notifications =====================  -->
                    <!-- ============================================================== -->

                    <!-- ============================================================== -->
                    <!-- Messages -->
                    <!-- ============================================================== -->

                    <li class="nav-item dropdown px-1">
                        <a class="nav-link dropdown-toggle waves-effect waves-dark text-dark bg-light badge rounded-circle " href=""
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-comment"></i>
                        </a>
                        @if(count($unreadChatThreads) > 0)
                            <span class="badge badge-pill badge-danger noti unreadCountSpan position-absolute">{{ count($unreadChatThreads) }}</span>
                        @endif
                        <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown">
                            <ul class="list-style-none">
                                @if(count($unreadChatThreads) > 0)
                                    <li>
                                        <div class="drop-title bg-light">
                                            <h4 class="mb-0 mt-1">@lang('backend.navbar.unread_chats.title_text')</h4>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="message-center message-body">
                                            @foreach($unreadChatThreads as $unreadThread)
                                                <a href="{{ route('instructor.chat', ['thread_id' => $unreadThread->id]) }}" class="message-item">
                                                <span class="user-img">
                                                    <img src="{{ getFileUrl($unreadThread->userDetail->image ?? 'default-placeholder.jpg', 'users/') }}" alt="user" class="rounded-circle">
                                                </span>
                                                    <div class="mail-contnet">
                                                        <h5 class="message-title">{{ $unreadThread->userDetail->name ?? "student" }} </h5>
                                                        {{--                                                    <span class="badge badge-pill badge-danger">{{ count($unreadThread->unreadChatMessages) }}</span>--}}
                                                        <span class="mail-desc">{{ $unreadThread->courseDetail->name ?? "Course" }}</span>
                                                        <span class="time">{{ formatDate($unreadThread->updated_at) }}</span>
                                                    </div>
                                                </a>
                                            @endforeach
                                        </div>
                                    </li>
                                @else
                                    <li>
                                        <div class="drop-title bg-light">
                                            <h4 class="mb-0 mt-1">@lang('backend.navbar.unread_chats.empty_record_text')</h4>
                                        </div>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
</header>
