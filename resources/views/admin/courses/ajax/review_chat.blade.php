<div class="card bg-light on-hover-action chat-section h-100 mb-2">
    <div class="card-body px-2 py-4">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title align-self-center mb-0">{{--<span
                    class="font-weight-light px-2">Section 1</span>:--}} {{ $curriculum->name }}
            </h5>
            @if(request()->user_type == 'instructor' && $curriculum->has_pending_comments == 1)
                <a type="button"
                        class="btn waves-effect waves-light btn-rounded btn-outline-success px-3 py-2 ticketResolved" data-message="Resolved">
                    Resolved
                </a>
            @endif
        </div>
        <hr class="mb-0">
        <div class="clearfix"></div>
        <div class="col-md-12 pb-5" id="chatDiv" style="overflow-y: auto;height: 355px;">
            @foreach($comments as $comment)
                @if(request()->user_type == $comment->user_type)
                    <div class="media-user d-flex flex-row-reverse text-end">
                        <div class="media-body mt-3">
                            <div class="az-msg-wrapper">
                                {{ $comment->content }}
                            </div>
                        </div>
                    </div>
                @else
                    <div class="media-admin">
                        <div class="media-body mt-3">
                            <div class="az-msg-wrapper">
                                {{ $comment->content }}
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="az-chat-footer mx-2 mt-5">
            <input type="hidden" id="course_id" value="{{ $course_id }}">
            <input type="hidden" id="curriculum_id" value="{{ $curriculum_id }}">
            <input type="text" class="form-control" id="message"
                   placeholder="@lang('backend.review_chat.placeholder_text')">
            <a href="javascript:;" class="az-msg-send" id="sendComment"><i class="far fa-paper-plane"></i></a>
        </div>
    </div>
</div>
