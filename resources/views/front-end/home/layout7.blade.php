@extends('front-end.layouts.master')
@section('content')
    @if(count($banners) > 0 && in_array('banner_section', config('layout_sections')))
        <section id="hero-7" class="bg-scroll hero-section division">
            <div class="slider blue-nav">
                <ul class="slides">
                    @foreach($banners as $banner)
                        <li id="slide-{{ $banner->id }}">
                            <img src="{{ getFileUrl($banner->image, 'banner') }}" alt="slide-background">
                            <div class="caption d-flex align-items-center center-align">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div
                                                class="caption-txt @if($banner->text_color == 'white') white-color @endif">
                                                <h2>{{ $banner->hero_text }}</h2>
                                                @if(!empty($banner->sub_text))
                                                    <p>{{ $banner->sub_text }}</p>
                                                @endif
                                                @if($banner->action_type == 'button')
                                                    <a href="{{ $banner->button_url }}"
                                                       class="btn btn-md btn-rose tra-black-hover">{{ $banner->button_text }}</a>
                                                @elseif($banner->action_type == 'search')
                                                    <form class="hero-form" action="{{ route('courses') }}">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="search"
                                                                   placeholder="@lang('frontend.home_layout_7.placeholder_text')"
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
                            </div>
                        </li>
                    @endforeach
                </ul>
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
                                <h4 class="h4-xl">@lang('frontend.home_layout_7.most_popular_Courses_title')</h4>
                                {!! __('frontend.home_layout_7.most_popular_Courses_note', ['courses ' => config('statistics.online_courses'), 'categories' => count($categories), ]) !!}

                                @if(count($popularCourses) > 4)
                                    <div class="title-btn">
                                        <a href="{{ route('courses') }}" class="btn btn-sm btn-tra-grey rose-hover">
                                            @lang('frontend.home_layout_7.view_all_courses_button')</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="owl-carousel owl-theme owl-loaded courses-carousel">
                                @foreach($popularCourses->take(8) as $course)
                                    @include('front-end.course.vertical_course_card')
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    @if(in_array('trending_categories_section', config('layout_sections')))
        <section id="categories-2" class="wide-70 categories-section division">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title mb-60">
                            <h4 class="h4-xl">@lang('frontend.home_layout_7.top_trending_categories_title')</h4>
                            @lang('frontend.home_layout_7.top_trending_categories_note')

                            @if(count($categories) > 6)
                                <div class="title-btn">
                                    <a href="{{ route('categories') }}" class="btn btn-tra-grey rose-hover">
                                        @lang('frontend.home_layout_7.view_all_categories_button')</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($categories->take(12) as $category)
                        <div class="col-sm-6 col-lg-3 col-xl-2">
                            <a href="{{ route('category_detail', $category->slug) }}">
                                <div class="c2-box text-center">
                                    <img class="img-70" src="{{ getFileUrl($category->icon, 'category') }}"
                                         alt="{{ $category->name }} Icon"/>
                                    <h5 class="h5-sm">{{ $category->name }}</h5>
                                    <p>{{ count($category->courses) }} @lang('frontend.home_layout_7.courses_text')</p>
                                </div>
                            </a>
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
    @include('front-end.home.partials.learn_new_skills')
    @include('front-end.home.partials.statistics')

    @if(in_array('top_rated_courses_section', config('layout_sections')))
        <section id="courses-3" class="wide-60 courses-section division">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title mb-60">
                            <h4 class="h4-xl">@lang('frontend.home_layout_7.highest_rated_courses_title')</h4>
                            @lang('frontend.home_layout_7.highest_rated_courses_note')

                            @if(count($courses) > 8)
                                <div class="title-btn">
                                    <a href="{{ route('courses') }}" class="btn btn-rose tra-black-hover">
                                        @lang('frontend.home_layout_7.browse_all_courses_button')</a>
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

    @include('front-end.home.partials.website_features_section')

    @include('front-end.home.partials.our_goal_section')

    @if(in_array('blogs_section', config('layout_sections')))
        <section id="news-1" class="bg-whitesmoke pt-100 news-section division">
            @include('front-end.home.partials.blog_listing_with_images_section')
        </section>
    @endif

    @include('front-end.home.partials.reviews_section')
    @include('front-end.home.partials.become_teacher_section')
@endsection
