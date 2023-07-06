@extends('front-end.layouts.master')
@section('content')
    @if(count($banners) > 0 && in_array('banner_section', config('layout_sections')))
        <section id="hero-6" class="bg-scroll hero-section division"
                 style="background-image: url('/storage/banner/{{ $banners->first()->image }}') !important;">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-lg-6">
                        <div class="hero-txt @if($banners->first()->text_color == 'white') white-color @endif">
                            <h2 class="h2-xs">{{ $banners->first()->hero_text }}</h2>
                            @if(!empty($banners->first()->sub_text))
                                <p class="p-lg">{{ $banners->first()->sub_text }}</p>
                            @endif
                            @if($banners->first()->action_type == 'button')
                                <a href="{{ $banners->first()->button_url }}"
                                   class="btn btn-md btn-rose @if($banners->first()->text_color == 'white') tra-white-hover @else tra-black-hover @endif">{{ $banners->first()->button_text }}</a>
                            @elseif($banners->first()->action_type == 'search')
                                <form class="hero-form" action="{{ route('courses') }}">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search"
                                               placeholder="@lang('frontend.home_layout_6.placeholder_text')"
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
    @if(in_array('trending_categories_section', config('layout_sections')))
        <section id="hboxes-1" class="hero-boxes-section division">
            <div class="container">
                <div class="hero-boxes-holder">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-title">
                                <h4 class="h4-xl">@lang('frontend.home_layout_6.most_popular_categories_title')</h4>
                                {!! __('frontend.home_layout_6.most_popular_categories_note', ['courses ' => config('statistics.online_courses'), 'categories' => count($categories), ]) !!}

                                @if(count($categories) > 6)
                                    <div class="title-btn">
                                        <a href="{{ route('categories') }}" class="btn btn-sm btn-rose tra-black-hover">
                                            @lang('frontend.home_layout_6.view_all_categories_button') </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($categories->take(6) as $category)
                            <div class="col-md-4 col-lg-2">
                                <a href="{{ route('category_detail', $category->slug) }}">
                                    <div class="c2-box-txt text-center">
                                        <img class="img-70" src="{{ getFileUrl($category->icon, 'category') }}"
                                             alt="{{ $category->name }} Icon"/>
                                        <h5 class="h5-sm">{{ $category->name }}</h5>
                                        <p>{{ count($category->courses) }} @lang('frontend.home_layout_6.courses_text')</p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif
    @include('front-end.home.partials.transform_life_through_online_education_section')
    @if(in_array('website_feature_section', config('layout_sections')))
        <section id="services-2" class="bg-lightgrey wide-60 services-section division">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-3">
                        <div class="sbox-2">
                            <img class="img-75" src="{{ asset('frontend-assets/files/images/icons/trophy.png') }}"
                                 alt="service-icon"/>
                            <div class="sbox-2-txt">
                                <h5 class="h5-md">@lang('frontend.home_layout_6.trusted_content_title')</h5>
                                @lang('frontend.home_layout_6.trusted_content_note')

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="sbox-2">
                            <img class="img-75" src="{{ asset('frontend-assets/files/images/icons/classroom.png') }}"
                                 alt="service-icon"/>
                            <div class="sbox-2-txt">
                                <h5 class="h5-md">@lang('frontend.home_layout_6.certified_teachers_title')</h5>
                                @lang('frontend.home_layout_6.certified_teachers_note')

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="sbox-2">
                            <img class="img-75" src="{{ asset('frontend-assets/files/images/icons/mouse-1.png') }}"
                                 alt="service-icon"/>
                            <div class="sbox-2-txt">
                                <h5 class="h5-md">@lang('frontend.home_layout_6.lifetime_access_title')</h5>
                                @lang('frontend.home_layout_6.lifetime_access_note')

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="sbox-2">
                            <img class="img-75" src="{{ asset('frontend-assets/files/images/icons/certificate.png') }}"
                                 alt="service-icon"/>
                            <div class="sbox-2-txt">
                                <h5 class="h5-md">@lang('frontend.home_layout_6.sertification_title')</h5>
                                @lang('frontend.home_layout_6.sertification_note')

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    @if(in_array('top_rated_courses_section', config('layout_sections')))
        <section id="courses-3" class="wide-60 courses-section division">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title mb-60">
                            <h4 class="h4-xl">@lang('frontend.home_layout_6.highest_rated_courses_title')</h4>
                            @lang('frontend.home_layout_6.highest_rated_courses_note')

                            @if(count($courses) > 8)
                                <div class="title-btn">
                                    <a href="{{ route('courses') }}" class="btn btn-tra-grey rose-hover">
                                        @lang('frontend.home_layout_6.browse_all_courses_button')</a>
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

    @if(in_array('promotional_section_three_widget', config('layout_sections')))
        @include('front-end.home.partials.learn_something_new_everyday_section')
    @endif

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

    @if(in_array('popular_courses_section', config('layout_sections')))
        <section id="courses-5" class="courses-section division">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title mb-60">
                            <h4 class="h4-xl">@lang('frontend.home_layout_6.popular_courses_of_all_time_title')</h4>
                            @lang('frontend.home_layout_6.popular_courses_of_all_time_note')

                            @if(count($popularCourses) > 0)
                                <div class="title-btn">
                                    <a href="{{ route('courses') }}" class="btn btn-tra-grey rose-hover">
                                        @lang('frontend.home_layout_6.view_all_courses_button')</a>
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

    @include('front-end.home.partials.video_section')

    @include('front-end.home.partials.our_goal_section')
    {{--    @include('front-end.home.partials.pricing_section')--}}
    @include('front-end.home.partials.reviews_section')
    @include('front-end.home.partials.become_teacher_section')
    @include('front-end.home.partials.our_stories_and_news_section')
@endsection
