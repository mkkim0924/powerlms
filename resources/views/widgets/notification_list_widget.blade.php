<ul class="list-style-none">
    @if(count($notifications) > 0)
        @if($instructor->unread_notifications_count > 0)
            <li>
                <div class="drop-title bg-light">
                    <h4 class="mb-0 mt-1">{{ $instructor->unread_notifications_count }} @lang('backend.notification_list_widget.header')</h4>
                </div>
            </li>
        @endif
        <li>
            <div class="message-center notifications">
                @foreach($notifications->take(5) as $notification)
                    <a href="javascript:void(0)" class="message-item @if($notification->mark_as_read == 0) bg-lightgrey @endif" data-id="{{ $notification->id }}">
                        <div class="mail-contnet">
                            <h5 class="message-title">{{ __('notifications.'.$notification->identifier.'_title') }}</h5>
                            <span
                                class="mail-desc">{{ __('notifications.'.$notification->identifier.'_description',[
                                                    'course_name' => $notification->params['name'] ?? "",
                                                    'bundle_name' => $notification->params['name'] ?? "",
                                                    'student_name' => $notification->params['student'] ?? "",
                                                    'amount' => !empty($notification->params['amount']) ? formatPrice($notification->params['amount']) : "",
                                                    ]) }}</span>
                            <span class="time">{{ formatDate($notification->created_at, 'd M, Y h:i A') }}</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </li>
        @if(count($notifications) > 5)
            <li>
                <a class="nav-link text-center m-b-5 text-dark" href="{{ route('instructor.notifications') }}">
                    <strong>@lang('backend.notification_list_widget.check_all_notifications_text')</strong>
                    <i class="fa fa-angle-right"></i>
                </a>
            </li>
        @endif
    @else
        <li>
            <div class="drop-title bg-light">
                <h4 class="mb-0 mt-1">@lang('backend.notification_list_widget.no_records_found_text')</h4>
            </div>
        </li>
    @endif
</ul>
