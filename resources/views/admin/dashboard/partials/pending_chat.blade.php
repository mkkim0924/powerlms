@if(count($unreadChatThreads) > 0)
    <div class="col-lg-6 mt-2">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">@lang('backend.instructor.dashboard.title.unread_chats')</h4>
            </div>
            <div class="comment-widgets scrollable" style="max-height:573px;">
                @foreach($unreadChatThreads as $unreadThread)
                    <a href="{{ route('instructor.chat', ['thread_id' => $unreadThread->id]) }}">
                        <div class="d-flex flex-row comment-row m-t-0">
                            <div class="p-2">
                                <img src="{{ getFileUrl($unreadThread->userDetail->image ?? 'default-placeholder.jpg', 'users/') }}" alt="user" width="50" class="rounded-circle">
                            </div>
                            <div class="comment-text w-100">
                                <h6 class="font-medium">{{ $unreadThread->userDetail->name ?? "student" }} <span class="badge badge-pill badge-danger float-right">{{ count($unreadThread->unreadChatMessages) }}</span></h6>
                                <span class="m-b-15 d-block">{{ $unreadThread->courseDetail->name ?? "Course" }}</span>
                                <div class="comment-footer">
                                    <span class="text-muted">{{ formatDate($unreadThread->updated_at) }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endif
