<div class="cbox-1">
    <a href="{{ route('course_detail', $course->slug) }}">
        <img class="img-fluid"
             src="{{ getFileUrl($course->image, 'course/images') }}"
             alt="{{ $course->name }} Img"/>
        @if(isset($course->badge_id))
        <div class="trend-badge-2 text-center text-uppercase">
            <i class="fas fa-bolt"></i>
            <span>{{ $course->badgeDetail->name }}</span>
        </div>
        @endif
        <div class="cbox-1-txt">
            <!-- Course Tags -->
            <p class="course-tags">
                @if(isset($course->instructor_id))<span>{{ $course->instructorDetail->name }}</span>@endif
                   @if(session('display_type')=='rtl')  <br>  @endif
                <span>{{ getTotalCourseHours($course->time) }}</span>
            </p>
            <h5 class="h5-xs">{{ $course->name }}</h5>
            <div class="course-rating clearfix">
                {!! getStarRatingHtml($course->average_rating) !!}
                <span>{{ $course->average_rating }} ({{ $course->total_reviews }} @lang('frontend.vertical_course_card.ratings_text') )</span>
            </div>
            <span class="course-price">
                @if($course->is_free == 1)
                @lang('frontend.vertical_course_card.free_course_text')
                @elseif($course->discount_flag == 1)
                    <span class="old-price">{{ formatPrice($course->price) }}</span>
                    {{ formatPrice($course->discounted_price) }}
                @else
                    {{ formatPrice($course->price) }}
                @endif
                {{ $course->course_id }}
            </span>
        </div>
    </a>
</div>
