@extends('front-end.layouts.master')
@section('content')
    @if(count($banners) > 0 && in_array('banner_section', config('layout_sections')))
        <section id="hero-2" class="bg-scroll hero-section division" style="background-image: url('/storage/banner/{{ $banners->first()->image }}') !important;">

            <div class="container">
                <div class="row d-flex align-items-center">
                    <div class="col-md-8 col-lg-6">
                        <div class="hero-txt mb-40 @if($banners->first()->text_color == 'white') white-color @endif">
                            <h3>{{ $banners->first()->hero_text }}</h3>
                            @if(!empty($banners->first()->sub_text))
                                <p class="p-md">{{ $banners->first()->sub_text }}</p>
                            @endif
                            @if($banners->first()->action_type == 'button')
                                <a href="{{ $banners->first()->button_url }}"
                                   class="btn btn-md btn-rose @if($banners->first()->text_color == 'white') tra-white-hover @else tra-black-hover @endif">{{ $banners->first()->button_text }}</a>
                            @elseif($banners->first()->action_type == 'search')
                                <form class="hero-form" action="{{ route('courses') }}">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search"
                                               placeholder="@lang('frontend.home_layout_2.placeholder_text')"
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
{{--                    <div class="col-md-4 col-lg-6">--}}
{{--                        <div class="hero-2-img mb-40 text-center">--}}
{{--                            <img class="img-fluid" src="{{ getFileUrl($banners->first()->image, 'banner') }}"--}}
{{--                                 alt="hero-image">--}}
{{--                        </div>--}}
{{--                    </div>--}}
        </section>
    @endif

    @include('front-end.home.partials.transform_life_through_online_education_section')

    @if(in_array('trending_categories_section', config('layout_sections')))
        <section id="categories-4" class="bg-whitesmoke wide-60 categories-section division">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title mb-80">
                            <h3 class="h3-sm">@lang('frontend.home_layout_2.top_trending_categories_title')</h3>
                            @lang('frontend.home_layout_2.top_trending_categories_note')

                            @if(count($categories) > 6)
                                <div class="title-btn">
                                    <a href="{{ route('categories') }}" class="btn btn-tra-grey rose-hover">
                                        @lang('frontend.home_layout_2.view_all_categories_button')</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                @include('front-end.home.partials.course_categories', ['categories' => $categories])
            </div>
        </section>
    @endif

    @if(count($bundles) > 0 && in_array('bundle_courses_section', config('layout_sections')))
        <section id="courses-1" class="wide-100 courses-section division">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title mb-60">
                            <h3 class="h3-sm">@lang('frontend.home_layout_2.bundle_courses_title')</h3>
                            @lang('frontend.home_layout_2.bundle_courses_note')

                            @if(count($bundles) > 8)
                                <div class="title-btn">
                                    <a href="{{ route('bundles') }}" class="btn btn-tra-grey rose-hover">
                                        @lang('frontend.home_layout_2.view_all_bundles_button')</a>
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

    @if(in_array('promotional_section_three_widget', config('layout_sections')))
        @include('front-end.home.partials.learn_something_new_everyday_section')
    @endif

    @if(in_array('top_rated_courses_section', config('layout_sections')))
        <section id="courses-3" class="wide-60 courses-section division">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title mb-60">
                            <h3 class="h3-sm">@lang('frontend.home_layout_2.highest_rated_online_courses_title')</h3>
                            @lang('frontend.home_layout_2.highest_rated_online_courses_note')

                            @if(count($courses) > 8)
                                <div class="title-btn">
                                    <a href="{{ route('courses') }}" class="btn btn-tra-grey rose-hover">
                                        @lang('frontend.home_layout_2.view_all_courses_button')</a>
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

    @include('front-end.home.partials.upcoming_webinars_section')

    @if(in_array('popular_courses_section', config('layout_sections')))
        <section id="courses-5" class="bg-whitesmoke courses-section division">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title mb-60">
                            <h3 class="h3-sm">@lang('frontend.home_layout_2.popular_courses_title')</h3>
                            @lang('frontend.home_layout_2.popular_courses_note')

                            @if(count($courses) > 8)
                                <div class="title-btn">
                                    <a href="{{ route('courses') }}" class="btn btn-tra-grey rose-hover">
                                        @lang('frontend.home_layout_2.view_all_courses_button')</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($popularCourses->take(8) as $course)
                        <div class="col-lg-6">
                            @include('front-end.course.horizontal_course_card', ['course' => $course])
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @include('front-end.home.partials.learn_new_skills')
    @include('front-end.home.partials.reviews_section')
    @include('front-end.home.partials.become_teacher_section')
    @include('front-end.home.partials.our_stories_and_news_section')
@endsection
