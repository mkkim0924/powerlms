<form method="post" action="{{ route('submit-user-course-review') }}" name="postReviewForm">
    @csrf
    <div class="text-center px-2 mt-4">
        <h4 class="fw-bold">@lang('frontend.review_modal_content.title_text')</h4>
        @lang('frontend.review_modal_content.share_your_reviews_text')

        <input type="hidden" name="course_id" value="{{ $course_id }}">
        @if(isset($user_review))
            <input type="hidden" name="review_id" value="{{ $user_review->id }}">
        @endif
        <div class="row" id="formInputDiv">
            <div class="col-md-12 form-group">
                <textarea name="comment" class="form-control inputField"
                          rows="5" maxlength="200" data-validation="required"
                          placeholder="@lang('frontend.review_modal_content.comment_placeholder')">{{ $user_review->comment ?? "" }}</textarea>
            </div>
            <div class="col-md-12 form-group">
                <label for="rating">@lang('frontend.review_modal_content.rate_us_text')</label>
                <div class="star_ratings d-flex justify-content-center mx-auto"></div>
                <input type="hidden" class="rating inputField" name="rating" value="{{ $user_review->rating ?? 5 }}">
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-sm-12">
                <button type="submit"
                        class="btn btn-sm btn-primary bg-primary">@lang('global.button.submit')
                </button>
            </div>
        </div>
    </div>
</form>
