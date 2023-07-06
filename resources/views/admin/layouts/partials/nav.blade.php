<aside class="left-sidebar">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                @foreach ($admin_module as $data)
                    @if ($is_super_admin || in_array($data->module_key, $module_access))
                        <li class="sidebar-item">
                            <a href="{{ $data->route_name && (!is_null($data->route_name) || $data->route_name == 'NULL') ? route('admin.' . $data->route_name) : 'javascript:;' }}"
                               class="sidebar-link {{ $data->icon_class }} waves-effect waves-dark @if (!$data->route_name) with-sub @endif">
                                <span class="hide-menu"> @lang("backend.navbar.$data->module_key")
                                    @if (($pending_application_count + $pending_payout_requests) > 0 &&
                                        in_array($data->module_key, ['instructors_sub_menu', 'users_menu']))
                                        <span class="badge badge-danger">{{ $pending_application_count + $pending_payout_requests }}</span>
                                    @endif
                                </span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level">
                                @foreach ($data->child as $childModule)
                                    <li class="sidebar-item">
                                        @if (($is_super_admin || in_array($childModule->module_key, $module_access)) &&
                                            $childModule->parent_module == $data->id)
                                            @if (count($childModule->child) > 0)
                                                <a class="has-arrow sidebar-link" href="javascript:void(0);"
                                                   aria-expanded="false">
                                                    <span class="hide-menu"> @lang("backend.navbar.$childModule->module_key")
                                                        @if (($pending_application_count + $pending_payout_requests) > 0 &&
                                                                in_array($childModule->module_key, ['instructors_sub_menu']))
                                                            <span class="badge badge-danger">{{ ($pending_application_count + $pending_payout_requests) }}</span>
                                                        @endif
                                                    </span>
                                                </a>
                                                <ul aria-expanded="false" class="collapse second-level">
                                                    @foreach ($childModule->child as $subChildModule)
                                                        <li class="sidebar-item">
                                                            @if (($is_super_admin || in_array($subChildModule->module_key, $module_access)) &&
                                                                $subChildModule->parent_module == $childModule->id)
                                                                <a href="{{ $subChildModule->route_name ? route('admin.' . $subChildModule->route_name) : 'javascript:;' }}"
                                                                   class="sidebar-link">
                                                                    <span class="hide-menu"> @lang("backend.navbar.$subChildModule->module_key")
                                                                        @if ($pending_application_count > 0 &&
                                                                            in_array($subChildModule->module_key, ['instructor_applications']))
                                                                            <span
                                                                                class="badge badge-danger">{{ $pending_application_count }}</span>
                                                                        @endif
                                                                        @if ($pending_payout_requests > 0 &&
                                                                            in_array($subChildModule->module_key, ['instructor_payout']))
                                                                            <span
                                                                                class="badge badge-danger">{{ $pending_payout_requests }}</span>
                                                                        @endif
                                                                    </span>
                                                                </a>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                <a href="{{ $childModule->route_name ? route('admin.' . $childModule->route_name) : 'javascript:;' }}"
                                                   class="sidebar-link">
                                                    <span class="hide-menu"> @lang("backend.navbar.$childModule->module_key")</span>
                                                </a>
                                            @endif
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                @endforeach
            </ul>
        </nav>
    </div>
</aside>
