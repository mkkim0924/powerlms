<div class="cbox-1">
    <a href="{{ route('bundle_detail', $bundle->slug) }}">
        <img class="img-fluid w-100" src="{{ getFileUrl($bundle->image, 'bundle') }}"
             alt="{{ $bundle->name }}">
        <div class="cbox-1-txt">
            <!-- Course Tags -->
            <p class="course-tags">
                @if(isset($bundle->instructor_id))
                    <span>{{ $bundle->instructorDetail->name }}</span>@endif
                    <br><span>{{ count($bundle->relatedCourses) }} @lang('frontend.bundle_card.courses_text')</span>
            </p>
            <h5 class="h5-xs">{{ $bundle->name }}</h5>
            <span class="course-price">{{ formatPrice($bundle->price) }}</span>
        </div>
    </a>
</div>
