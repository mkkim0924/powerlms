@extends('front-end.layouts.master')
@section('content')
    <section class="user-dashboard-area">
        <div class="container">
            @if(count($threads) > 0)
                <div class="row my-3">
                    <div class="col-md-3 col-12">
                        <div class="people-list" id="people-list">
                            <ul class="list">
                                @foreach($threads as $thread)
                                    <a href="{{ route('chat', ['thread_id' => $thread->id]) }}">
                                        <li class="clearfix">
                                            <div class="about @if(isset($currentThread) && $currentThread->id == $thread->id) active-chat @endif">
                                                <div class="name">{{ $thread->courseDetail->name ?? "Course Title" }} @if((count($thread->unreadChatMessages) > 0) && (isset($currentThread) && $currentThread->id != $thread->id)) ({{ count($thread->unreadChatMessages) }}) @endif</div>
                                                <div class="status">
                                                    <i class="fa fa-user"></i> {{ (auth()->user()->type == 0) ? ($thread->courseDetail->instructorDetail->name ?? 'Instructor') : $thread->userDetail->name }}
                                                </div>
                                            </div>
                                        </li>
                                    </a>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9 col-12">
                        @if(isset($currentThread))
                            <div class="chat">
                                <div class="chat-header clearfix send-msg-box">
                                    <img src="{{ getFileUrl($currentThread->courseDetail->image, 'course/images') }}" width="55px" height="55px"
                                         alt="avatar"/>
                                    <div class="chat-about">
                                        <div class="chat-with">{{ $currentThread->courseDetail->name ?? 'Course Title' }}</div>
                                        <div class="chat-num-messages">{{ $currentThread->courseDetail->instructorDetail->name ?? 'Instructor' }}</div>
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
                                                        <span class="message-data-name">{{ (auth()->user()->type == 0) ? ($currentThread->courseDetail->instructorDetail->name ?? 'Instructor') : $currentThread->userDetail->name }}</span>
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
                                    <textarea name="message" id="message" placeholder="@lang('frontend.chat.type_your_message_text')" rows="3"></textarea>
                                    <button id="submitButton">@lang('frontend.chat.send_button')</button>
                                </div> <!-- end chat-message -->
                            </div>
                        @endif
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-sm-10 col-12 mx-auto text-center my-4">
                        <h4 class="text-danger py-2">No conversation found</h4>
                        <h6 class="p-3"> Initiate the conversation with your course instructor and share your thoughts, comments, feedback, and discussions on class-specific topics.
                        </h6>
                        <img src="{{ asset('frontend-assets/images/Chat_img.png') }}" alt="" class="img-fluid w-75 py-3">
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('frontend-assets/css/chat.css') }}">
@endpush

@push('footer_scripts')
    <script src="{{ asset('admin-assets/assets/extra-libs/jquery-timeago-master/jquery.timeago.js') }}"></script>
    <script src="{{ asset('frontend-assets/js/chat.js') }}"></script>
    @if(file_exists('admin-assets/assets/extra-libs/jquery-timeago-master/locales/jquery.timeago.'.app()->getLocale().'.js'))
        <script src="{{ asset('admin-assets/assets/extra-libs/jquery-timeago-master/locales/jquery.timeago.'.app()->getLocale().'.js') }}"></script>
    @else
        <script src="{{ asset('admin-assets/assets/extra-libs/jquery-timeago-master/locales/jquery.timeago.de.js') }}"></script>
    @endif
@endpush
