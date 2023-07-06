<div class="row">
    @foreach($categories->take(6) as $category)
        <div class="col-md-6 col-lg-4">
            <div class="c4-box">
                <div class="c4-box-ico mb-15 clearfix">
                    <div
                        class="c4-ico {{ array_random(['bg-blue', 'bg-green', 'bg-red', 'bg-teal', 'bg-yellow', 'bg-violet', 'bg-orange', 'bg-lightgreen', 'bg-skyblue']) }}">
                        <img
                            src="{{ getFileUrl($category->icon, 'category') }}"
                            alt="{{ $category->name }} Icon"/>
                    </div>
                    <h5 class="h5-md">{{ $category->name }}</h5>
                    <p>{{ count($category->courses) }} @lang('frontend.course_categories_section.courses_text')</p>
                </div>
                <div class="c4-box-txt">
                    <ul class="c4-box-list">
                        @foreach($category->courses->take(4)->pluck('name', 'slug') as $slug => $course_name)
                            <li><a href="{{ route('course_detail', $slug) }}">{{ $course_name }},</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endforeach
</div>
