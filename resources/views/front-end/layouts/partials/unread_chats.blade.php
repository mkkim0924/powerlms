@if (auth()->check())
    <a href="{{ route('chat') }}"><i class="fas fa-comment me-0"></i>{{ (count($unreadChatThreads) > 0) ? count($unreadChatThreads) : '' }}</a>
@endif
