@extends('admin.layouts.master')
@section('admin_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col lg 4 mt-1">
                                <h2 class="card-title text-capitalize">@lang('backend.chat.header')</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="container-fluid">
                            <div class="row my-2">
                                <div class="col-md-3 col-12 px-0">
                                    <div class="people-list" id="people-list">
                                        <ul class="list">
                                            @foreach($threads as $thread)
                                                <a href="{{ route('instructor.chat', ['thread_id' => $thread->id]) }}">
                                                    <li class="clearfix">
                                                        <div class="about @if(isset($currentThread) && $currentThread->id == $thread->id) active-chat @endif">
                                                            <div class="name">{{ $thread->courseDetail->name ?? "Course Title" }} @if((count($thread->unreadChatMessages) > 0) && (isset($currentThread) && $currentThread->id != $thread->id)) ({{ count($thread->unreadChatMessages) }}) @endif</div>
                                                            <div class="status">
                                                                <i class="fa fa-user"></i> {{ $thread->userDetail->name ?? 'Student' }}
                                                            </div>
                                                        </div>
                                                    </li>
                                                </a>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-9 col-12 px-0">
                                    @if(isset($currentThread))
                                        <div class="chat">
                                            <div class="chat-header clearfix send-msg-box">
                                                <img src="{{ getFileUrl($currentThread->courseDetail->image, 'course/images') }}" width="55px" height="55px"
                                                     alt="avatar"/>
                                                <div class="chat-about">
                                                    <div class="chat-with">{{ $currentThread->courseDetail->name ?? 'Course Title' }}</div>
                                                     <div class="chat-num-messages">{{ $currentThread->userDetail->name ?? 'Student' }}</div>
                                                </div>
                                            </div>
                                            <div class="chat-history">
                                                @php $last_message_id = null  @endphp
                                                <ul id="chatContainer">
                                                    @foreach($currentThread->chatMessages as $chatMessage)
                                                        @php $last_message_id = $chatMessage->id; @endphp
                                                        @if($chatMessage->user_id == $user->id)
                                                            <li class="clearfix">
                                                                <div class="message-data align-right">
                                                                    <span class="message-data-time timeago" datetime="{{ $chatMessage->created_at }}"></span> &nbsp; &nbsp;
                                                                    <span class="message-data-name">{{ $user->name }}</span>
                                                                </div>
                                                                <div class="message other-message float-right">
                                                                    {!! $chatMessage->body !!}
                                                                </div>
                                                            </li>
                                                        @else
                                                            <li class="clearfix">
                                                                <div class="message-data">
                                                                    <span class="message-data-name">{{ $currentThread->userDetail->name ?? 'Student' }}</span>
                                                                    <span class="message-data-time timeago" datetime="{{ $chatMessage->created_at }}"></span>
                                                                </div>
                                                                <div class="message my-message">
                                                                    {!! $chatMessage->body !!}
                                                                </div>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div> <!-- end chat-history -->
                                            <div class="chat-message clearfix send-msg-box">
                                                <input type="hidden" id="thread_id" value="{{ $currentThread->id }}">
                                                <input type="hidden" id="last_message_id" value="{{ $last_message_id }}"/>
                                                <textarea name="message" id="message" placeholder="@lang('backend.chat.type_your_message_text')" rows="3"></textarea>
                                                {{--                            <i class="fa fa-file-o"></i> &nbsp;&nbsp;&nbsp;--}}
                                                {{--                            <i class="fa fa-file-image-o"></i>--}}
                                                <button id="submitButton">
                                                    @lang('backend.chat.send_button')</button>
                                            </div> <!-- end chat-message -->
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('admin-assets/custom/css/chat.css') }}">
@endsection

@section('footer_scripts')
    <script src="{{ asset('admin-assets/assets/extra-libs/jquery-timeago-master/jquery.timeago.js') }}"></script>
    <script src="{{ asset('frontend-assets/js/chat.js') }}"></script>
    @if(file_exists('admin-assets/assets/extra-libs/jquery-timeago-master/locales/jquery.timeago.'.app()->getLocale().'.js'))
        <script src="{{ asset('admin-assets/assets/extra-libs/jquery-timeago-master/locales/jquery.timeago.'.app()->getLocale().'.js') }}"></script>
    @else
        <script src="{{ asset('admin-assets/assets/extra-libs/jquery-timeago-master/locales/jquery.timeago.de.js') }}"></script>
    @endif
@endsection
