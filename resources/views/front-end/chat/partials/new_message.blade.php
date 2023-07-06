@if($type == 'sender')
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
            <span class="message-data-name">{{ $chatMessage->userDetails->name ?? 'User' }}</span>
            <span class="message-data-time timeago" datetime="{{ $chatMessage->created_at }}"></span>
        </div>
        <div class="message my-message">
            {!! $chatMessage->body !!}
        </div>
    </li>
@endif
