<div class="cbox-5 b-bottom">
    <a href="{{ route('course_detail', $course->slug) }}">
        <div class="row">
            <div class="col-sm-7 cbox-5-txt">
                <h5 class="h5-xs">{{ $course->name }}</h5>
                <p class="p-sm grey-color">{{ getTotalCourseHours($course->time) }}</p>
                <div class="course-rating">
                    {!! getStarRatingHtml($course->average_rating) !!}
                    <span class="cr-rating">{{ $course->average_rating }} ({{ $course->total_reviews }} @lang('frontend.horizontal_course.ratings_text'))</span>
                </div>
            </div>
            <div class="col-sm-3 cbox-5-data text-center clearfix">
                <p class="grey-color"><i class="fas fa-users"></i> {{ $course->total_enrollments }}</p>
            </div>
            <div class="col-sm-2 cbox-5-price text-right clearfix">
                @if($course->is_free == 1)
                    <span class="course-price">@lang('frontend.horizontal_course.free_course_text')</span>
                @elseif($course->discount_flag == 1)
                    <span class="course-price">{{ formatPrice($course->discounted_price) }}</span>
                    <span class="old-price">{{ formatPrice($course->price) }}</span>
                @else
                    <span class="course-price">{{ formatPrice($course->price) }}</span>
                @endif
            </div>
        </div>
    </a>
</div>
