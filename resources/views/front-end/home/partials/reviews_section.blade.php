@if(count($reviews) > 0 && in_array('student_testimonial_section', config('layout_sections')))
    <section id="reviews-1" class="wide-100 reviews-section division">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title mb-60">
                        <h3 class="h3-sm"> @lang('frontend.reviews_section.what_our_students_say_title')</h3>
                        @lang('frontend.reviews_section.what_our_students_say_note')

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="owl-carousel owl-theme reviews-holder">
                        @foreach($reviews->take(25) as $review)
                            <div class="review-1">
                                <div class="quote-ico"><img
                                        src="{{ asset('frontend-assets/files/images/left-quote.png') }}"
                                        alt="quote-image"/></div>
                                <p title="{{ $review->comment }}">{{ str_limit($review->comment, 200) }}</p>
                                <div class="review-1-author d-flex align-items-center">
                                    <div class="author-avatar">
                                        <img class="img-fluid"
                                             src="{{ getFileUrl($review->userDetail->image ?? 'default-placeholder.jpg', 'users') }}"
                                             alt="review-author-avatar"/>
                                    </div>
                                    <div class="review-author">
                                        <div class="tst-rating">
                                            {!! getStarRatingHtml($review->rating) !!}
                                        </div>
                                        <h5 class="h5-xs">{{ $review->author_name }}</h5>
                                        <span>{{ $review->courseDetail->name ?? "" }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
