@extends('front-end.layouts.master')
@section('content')
    @if(count($banners) > 0 && in_array('banner_section', config('layout_sections')))
        <section id="hero-5" class="hero-section division">
            <div class="slider blue-nav">
                <ul class="slides">
                    @foreach($banners as $banner)
                        <li id="slide-1">
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
                                                       class="btn btn-md btn-rose tra-white-hover">{{ $banner->button_text }}</a>
                                                @elseif($banner->action_type == 'search')
                                                    <form class="hero-form" action="{{ route('courses') }}">
                                                        <div class="input-group rtl-dir">
                                                            <input type="text" class="form-control" name="search"
                                                                   placeholder="@lang('frontend.home_layout_5.placeholder_text')"
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

    @include('front-end.home.partials.learn_new_skills')

    @if(in_array('website_feature_section', config('layout_sections')))
        <section id="services-2" class="bg-lightgrey wide-60 services-section division">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-3">
                        <div class="sbox-2">
                            <img class="img-75" src="{{ asset('frontend-assets/files/images/icons/trophy.png') }}"
                                 alt="service-icon"/>
                            <div class="sbox-2-txt">
                                <h5 class="h5-md">@lang('frontend.home_layout_5.trusted_content_title')</h5>
                                @lang('frontend.home_layout_5.trusted_content_note')

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="sbox-2">
                            <img class="img-75" src="{{ asset('frontend-assets/files/images/icons/classroom.png') }}"
                                 alt="service-icon"/>
                            <div class="sbox-2-txt">
                                <h5 class="h5-md"> @lang('frontend.home_layout_5.certified_teachers_title')</h5>
                                @lang('frontend.home_layout_5.certified_teachers_note')

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="sbox-2">
                            <img class="img-75" src="{{ asset('frontend-assets/files/images/icons/mouse-1.png') }}"
                                 alt="service-icon"/>
                            <div class="sbox-2-txt">
                                <h5 class="h5-md"> @lang('frontend.home_layout_5.lifetime_access_title')</h5>
                                @lang('frontend.home_layout_5.lifetime_access_note')

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="sbox-2">
                            <img class="img-75" src="{{ asset('frontend-assets/files/images/icons/certificate.png') }}"
                                 alt="service-icon"/>
                            <div class="sbox-2-txt">
                                <h5 class="h5-md"> @lang('frontend.home_layout_5.sertification_title')</h5>
                                @lang('frontend.home_layout_5.sertification_note')

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    @if(in_array('trending_categories_section', config('layout_sections')))
        <section id="categories-4" class="wide-60 categories-section division">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title title-centered mb-80">
                            <h3 class="h3-sm"> @lang('frontend.home_layout_5.trusted_categories_title')</h3>
                            @lang('frontend.home_layout_5.trusted_categories_note')

                        </div>
                    </div>
                </div>
                @include('front-end.home.partials.course_categories', ['categories' => $categories])
                <div class="row">
                    <div class="col-md-12">
                        <div class="all-courses-btn">
                            <a href="{{ route('courses') }}" class="btn btn-md btn-tra-grey rose-hover">
                                @lang('frontend.home_layout_5.browse_all_courses_button')</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    @if(in_array('statistics_section', config('layout_sections')))
        <div id="statistic-2" class="bg-01 statistic-section division">
            <div class="container white-color">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <div class="statistic-block text-center">
                            <h5 class="statistic-number"><span
                                    class="count-element">{{ config('statistics.online_courses') }}</span></h5>
                            <p class="p-md"> @lang('frontend.home_layout_5.online_courses_text')</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="statistic-block text-center">
                            <h5 class="statistic-number"><span
                                    class="count-element">{{ config('statistics.free_tutorials') }}</span></h5>
                            <p class="p-md">@lang('frontend.home_layout_5.free_tutorials_text')</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="statistic-block text-center">
                            <h5 class="statistic-number"><span
                                    class="count-element">{{ config('statistics.students') }}</span></h5>
                            <p class="p-md">@lang('frontend.home_layout_5.happy_students_text')</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if(in_array('popular_courses_section', config('layout_sections')))
        <section id="courses-1" class="wide-100 courses-section division">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title title-centered mb-60">
                            <h3 class="h3-sm">@lang('frontend.home_layout_5.popular_courses_title')</h3>
                            @lang('frontend.home_layout_5.popular_courses_note')

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
        </section>
    @endif

    @include('front-end.home.partials.video_section')
    @include('front-end.home.partials.upcoming_webinars_section')
    @if(count($bundles) > 0 && in_array('bundle_courses_section', config('layout_sections')))
        <section id="courses-3" class="wide-60 courses-section division">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title title-centered mb-60">
                            <h3 class="h3-sm">@lang('frontend.home_layout_5.bundle_courses_title')</h3>
                            @lang('frontend.home_layout_5.bundle_courses_note')

                            <!-- Button
                                <div class="title-btn">
                                    <a href="course-list" class="btn btn-rose tra-black-hover">View All Courses</a>
                                </div> -->
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
                @if(count($bundles) > 8)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="all-courses-btn">
                                <a href="{{ route('bundles') }}" class="btn btn-md btn-rose tra-black-hover">
                                    @lang('frontend.home_layout_5.browse_all_bundles_button')</a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </section>
    @endif

    @include('front-end.home.partials.register_form_section')

    @if(in_array('top_rated_courses_section', config('layout_sections')))
        <section id="courses-5" class="courses-section division">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title title-centered mb-60">
                            <h3 class="h3-sm">@lang('frontend.home_layout_5.best_online_courses_of_all_time_title')</h3>
                            @lang('frontend.home_layout_5.best_online_courses_of_all_time_note')

                            <!-- Button
                                <div class="title-btn">
                                    <a href="course-list" class="btn btn-rose tra-black-hover">View All Courses</a>
                                </div>-->
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

    @if(count($reviews) > 0 && in_array('student_testimonial_section', config('layout_sections')))
        <section id="reviews-1" class="bg-whitesmoke wide-100 reviews-section division">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title title-centered mb-60">
                            <h3 class="h3-sm">@lang('frontend.home_layout_5.success_stories_from_our_students_title')</h3>
                            @lang('frontend.home_layout_5.success_stories_from_our_students_note')

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="owl-carousel owl-theme reviews-holder">
                            @foreach($reviews as $review)
                                <div class="review-1">
                                    <div class="quote-ico"><img
                                            src="{{ asset('frontend-assets/files/images/left-quote.png') }}"
                                            alt="quote-image"/></div>
                                    <p>{{ $review->comment }}
                                    </p>
                                    <div class="review-1-author d-flex align-items-center">
                                        <div class="author-avatar">
                                            <img class="img-fluid"
                                                 src="{{ getFileUrl($review->userDetail->image ?? 'default-placeholder.jpg', 'users') }}"
                                                 alt="review-author-avatar"/>
                                        </div>
                                        <div class="review-author">
                                            <div class="tst-rating">
                                                {!! getStarRatingHtml($review->rating) !!}
                                            </div>
                                            <h5 class="h5-xs">{{ $review->author_name }}</h5>
                                            <span>{{ $review->courseDetail->name ?? "" }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @include('front-end.home.partials.our_stories_and_news_section')
    @include('front-end.home.partials.become_teacher_section')
@endsection
