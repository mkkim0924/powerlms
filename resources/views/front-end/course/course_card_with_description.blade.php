<div class="cbox-2">
    <a href="{{ route('course_detail', $course->slug) }}">
        <div class="course-data">
            <img class="img-fluid" src="{{ getFileUrl($course->image, 'course/images') }}" alt="course-preview" />
            <span class="course-price bg-rose white-color">{{ ($course->is_free == 1) ? __('frontend.vertical_course_card.free_course_text') : (($course->discount_flag == 1) ? formatPrice($course->discounted_price) : formatPrice($course->price)) }}</span>
        </div>
        <div class="cbox-2-txt">
            <h5 class="h5-md course-heading">{{ $course->name }}</h5>
            <p class="course-tags">
                @if(isset($course->instructor_id))<span>{{ $course->instructorDetail->name }}</span>@endif
                <span>{{ getTotalCourseHours($course->time) }}</span>
            </p>
            <p class="p-sm course-desc">{{ $course->tiny_description }}</p>
            <div class="course-rating clearfix">
                {!! getStarRatingHtml($course->average_rating) !!}
                <span>{{ $course->average_rating }} ({{ $course->total_reviews }} @lang('frontend.course_card_with_description.ratings_text'))</span>
            </div>
        </div>
    </a>
</div>
