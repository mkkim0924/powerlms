@extends('front-end.layouts.master')
@section('content')
    @if(count($banners) > 0 && in_array('banner_section', config('layout_sections')))
        <section id="hero-8" class="bg-scroll hero-section division"
                 style="background-image: url('/storage/banner/{{ $banners->first()->image }}') !important;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div
                            class="hero-txt text-center @if($banners->first()->text_color == 'white') white-color @endif">
                            @if(!empty($banners->first()->sub_text))
                                <h4 class="h4-xs">{{ $banners->first()->sub_text }}</h4>
                            @endif
                            <h2 class="h2-md">{{ $banners->first()->hero_text }}</h2>
                            @if($banners->first()->action_type == 'button')
                                <a href="{{ $banners->first()->button_url }}"
                                   class="btn btn-md btn-rose @if($banners->first()->text_color == 'white') tra-white-hover @else tra-black-hover @endif">{{ $banners->first()->button_text }}</a>
                            @elseif($banners->first()->action_type == 'search')
                                <form class="hero-form" action="{{ route('courses') }}">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search"
                                               placeholder="@lang('frontend.home_layout_8.placeholder_text')"
                                               aria-label="Search" autocomplete="off">
                                        <span class="input-group-btn">
                                                        <button type="submit" class="btn"><i class="fa fa-search"
                                                                                             aria-hidden="true"></i></button>
                                                        </span>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    @if(in_array('statistics_section', config('layout_sections')))
        <section id="hboxes-2" class="hero-boxes-section division">
            <div class="container">
                <div class="hero-boxes-holder">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="statistic-block">
                                <h5 class="statistic-number"><span
                                        class="count-element">{{ config('statistics.online_courses') }}</span></h5>
                                <div class="statistic-block-txt">
                                    <h5 class="h5-lg">@lang('frontend.home_layout_8.online_courses_title')</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="statistic-block">
                                <h5 class="statistic-number"><span
                                        class="count-element">{{ config('statistics.total_instructors') }}</span></h5>
                                <div class="statistic-block-txt">
                                    <h5 class="h5-lg">@lang('frontend.home_layout_8.available_instructors_title')</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="statistic-block">
                                <h5 class="statistic-number"><span
                                        class="count-element">{{ config('statistics.students') }}</span></h5>
                                <div class="statistic-block-txt">
                                    <h5 class="h5-lg">@lang('frontend.home_layout_8.happy_students_title')</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    @include('front-end.home.partials.transform_life_through_online_education_section')

    @if(in_array('trending_categories_section', config('layout_sections')))
        <section id="categories-3" class="bg-whitesmoke wide-100 categories-section division">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title mb-60">
                            <h3 class="h3-sm">@lang('frontend.home_layout_8.top_trending_categories_title')</h3>
                            @lang('frontend.home_layout_8.top_trending_categories_note')

                            @if(count($categories) > 8)
                                <div class="title-btn">
                                    <a href="{{ route('categories') }}" class="btn btn-tra-grey rose-hover">
                                        @lang('frontend.home_layout_8.view_all_categories_button')</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="owl-carousel owl-theme owl-loaded categories-carousel">
                            @foreach($categories as $category)
                                <div
                                    class="{{ array_random(['bg-blue', 'bg-green', 'bg-red', 'bg-teal', 'bg-yellow', 'bg-violet', 'bg-orange', 'bg-lightgreen', 'bg-skyblue']) }} c3-box text-center icon-md white-color">
                                    <a href="{{ route('category_detail', $category->slug) }}">
                                        <div class="c3-box-icon">
                                            <img
                                                src="{{ getFileUrl($category->icon, 'category') }}"
                                                alt="category-icon"/>
                                        </div>
                                        <div class="cbox-3-txt">
                                            <h5 class="h5-md">{{ $category->name }}</h5>
                                            <p>{{ count($category->courses) }}  @lang('frontend.home_layout_7.courses_text')</p>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if(in_array('popular_courses_section', config('layout_sections')))
        <section id="courses-5" class="courses-section division">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title mb-60">
                            <h3 class="h3-sm">@lang('frontend.home_layout_8.best_courses_of_all_time_title')</h3>
                            @lang('frontend.home_layout_8.best_courses_of_all_time_note')

                            @if(count($popularCourses) > 8)
                                <div class="title-btn">
                                    <a href="{{ route('courses') }}" class="btn btn-tra-grey rose-hover">
                                        @lang('frontend.home_layout_8.view_all_courses_button')</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($popularCourses as $course)
                        <div class="col-lg-6">
                            @include('front-end.course.horizontal_course_card', ['course' => $course])
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if(in_array('promotional_section_three_widget', config('layout_sections')))
        @include('front-end.home.partials.learn_something_new_everyday_section')
    @endif

    @if(in_array('top_rated_courses_section', config('layout_sections')))
        <section id="courses-3" class="wide-60 courses-section division">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title title-centered1 mb-60">
                            <h3 class="h3-sm">@lang('frontend.home_layout_8.highest_rated_courses_title')</h3>
                            @lang('frontend.home_layout_8.highest_rated_courses_note')

                            @if(count($courses) > 8)
                                <div class="title-btn">
                                    <a href="{{ route('courses') }}" class="btn btn-rose tra-black-hover">
                                        @lang('frontend.home_layout_8.view_all_courses_button')</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row courses-grid">
                    @foreach($courses->take(8) as $course)
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            @include('front-end.course.vertical_course_card', ['course' => $course])
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @include('front-end.home.partials.video_section')
    @include('front-end.home.partials.upcoming_webinars_section')

    @if(count($bundles) > 0 && in_array('bundle_courses_section', config('layout_sections')))
        <section id="courses-1" class="bg-whitesmoke wide-100 courses-section division">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title mb-60">
                            <h4 class="h4-xl">@lang('frontend.home_layout_6.bundle_courses_title')</h4>
                            @lang('frontend.home_layout_6.bundle_courses_note')

                            @if(count($bundles) > 8)
                                <div class="title-btn">
                                    <a href="{{ route('bundles') }}" class="btn btn-tra-grey rose-hover">
                                        @lang('frontend.home_layout_6.browse_all_bundles_button')</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="owl-carousel owl-theme owl-loaded courses-carousel">
                            @foreach($bundles->take(8) as $bundle)
                                @include('front-end.bundle.bundle_card', ['bundle' => $bundle])
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    @include('front-end.home.partials.our_goal_section')
    @include('front-end.home.partials.register_form_section')
    @include('front-end.home.partials.reviews_section')
    @include('front-end.home.partials.become_teacher_section')
    @include('front-end.home.partials.our_stories_and_news_section')
@endsection
