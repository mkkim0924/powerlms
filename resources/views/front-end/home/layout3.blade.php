@extends('front-end.layouts.master')
@section('content')
    @if(count($banners) > 0 && in_array('banner_section', config('layout_sections')))
        <section id="hero-3" class="bg-scroll hero-section division"
                 style="background-image: url('/storage/banner/{{ $banners->first()->image }}') !important;">
            <div class="container">
                <div class="row">
                    <div class="  @if(session('display_type')=='rtl') col-lg-8 mx-auto @else col-lg-8 offset-lg-2  @endif">
                        <div
                            class="hero-txt text-center @if($banners->first()->text_color == 'white') white-color @endif">
                            <h2 class="h2-xs">{{ $banners->first()->hero_text }}</h2>
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
                                               placeholder="@lang('frontend.home_layout_3.placeholder_text')"
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
    @if(in_array('popular_courses_section', config('layout_sections')))
        <section id="hboxes-1" class="hero-boxes-section division">
            <div class="container">
                <div class="hero-boxes-holder">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-title">
                                <h4 class="h4-xl">@lang('frontend.home_layout_3.most_popular_courses_title')</h4>
                                {!! __('frontend.home_layout_3.most_popular_courses_note', ['courses' => config('statistics.online_courses'), 'categories' => count($categories), ]) !!}

                                @if(count($popularCourses) > 8)
                                    <div class="title-btn">
                                        <a href="{{ route('courses') }}" class="btn btn-sm btn-rose tra-grey-hover">
                                            @lang('frontend.home_layout_3.view_all_courses_button')</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="owl-carousel owl-theme owl-loaded courses-carousel">
                                @foreach($popularCourses->take(8) as $course)
                                    @include('front-end.course.vertical_course_card', ['course' => $course])
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    @include('front-end.home.partials.learn_new_skills')
    @if(in_array('trending_categories_section', config('layout_sections')))
        <section id="categories-2" class="bg-whitesmoke wide-70 categories-section division">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title mb-60">
                            <h4 class="h4-xl">@lang('frontend.home_layout_3.top_trending_categories_title')</h4>
                            @lang('frontend.home_layout_3.top_trending_categories_note')

                            @if(count($categories) > 6)
                                <div class="title-btn">
                                    <a href="{{ route('categories') }}" class="btn btn-tra-grey rose-hover">
                                        @lang('frontend.home_layout_3.view_all_categories_button')</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($categories as $category)
                        <div class="col-sm-6 col-lg-3 col-xl-2">
                            <a href="{{ route('category_detail', $category->slug) }}">
                                <div class="c2-box text-center">
                                    <img class="img-70"
                                         src="{{ getFileUrl($category->icon, 'category') }}"
                                         alt="{{ $category->name }} Icon"/>
                                    <h5 class="h5-sm">{{ $category->name }}</h5>
                                    <p>{{ count($category->courses) }}  @lang('frontend.home_layout_3.courses_text')</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if(in_array('top_rated_courses_section', config('layout_sections')))
        <section id="courses-5" class="courses-section division">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title mb-60">
                            <h4 class="h4-xl"> @lang('frontend.home_layout_3.highest_rated_online_courses_title')</h4>
                            @lang('frontend.home_layout_3.highest_rated_online_courses_note')

                            @if(count($courses) > 8)
                                <div class="title-btn">
                                    <a href="{{ route('courses') }}" class="btn btn-tra-grey rose-hover">
                                        @lang('frontend.home_layout_3.view_all_courses_button')</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($courses->take(8) as $course)
                        <div class="col-lg-6">
                            @include('front-end.course.horizontal_course_card', ['course' => $course])
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    @include('front-end.home.partials.website_features_section')
    @if(count($bundles) > 0 && in_array('bundle_courses_section', config('layout_sections')))
        <section id="courses-3" class="wide-60 courses-section division">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title mb-60">
                            <h4 class="h4-xl">@lang('frontend.home_layout_3.bundle_courses_title')</h4>
                            @lang('frontend.home_layout_3.bundle_courses_note')

                            @if(count($bundles) > 8)
                                <div class="title-btn">
                                    <a href="{{ route('bundles') }}" class="btn btntra-grey rose-hover">
                                        @lang('frontend.home_layout_3.view_all_bundles')</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row courses-grid">
                    @foreach($bundles->take(8) as $bundle)
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            @include('front-end.bundle.bundle_card', ['bundle' => $bundle])
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    @include('front-end.home.partials.upcoming_webinars_section')

    @include('front-end.home.partials.video_section')
    @include('front-end.home.partials.our_goal_section')

    @include('front-end.home.partials.reviews_section')
    @include('front-end.home.partials.become_teacher_section')

    @if(in_array('blogs_section', config('layout_sections')))
        <section id="news-1" class="pt-100 news-section division">
            @include('front-end.home.partials.blog_listing_with_images_section')
        </section>
    @endif
@endsection
