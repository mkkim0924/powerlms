@extends('front-end.layouts.master')
@section('content')
    @if(count($banners) > 0 && in_array('banner_section', config('layout_sections')))
        <section id="hero-4" class="bg-scroll hero-section division"
                 style="background-image: url('/storage/banner/{{ $banners->first()->image }}') !important;">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-lg-6">
                        <div class="hero-txt @if($banners->first()->text_color == 'white') white-color1 @endif">
                            <h2 class="h2-md">{{ $banners->first()->hero_text }}</h2>
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
                                               placeholder="@lang('frontend.home_layout_4.placeholder_text')"
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

    <section id="courses-1" class="wide-100 courses-section division">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title mb-40">
                        <h3 class="h3-sm">@lang('frontend.home_layout_4.most_popular_courses_title')</h3>
                        @lang('frontend.home_layout_4.most_popular_courses_note')

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

    @include('front-end.home.partials.our_goal_section')
    @include('front-end.home.partials.upcoming_webinars_section')
    @include('front-end.home.partials.website_features_section')

    @if(count($bundles) > 0 && in_array('bundle_courses_section', config('layout_sections')))
        <section id="courses-3" class="wide-60 courses-section division">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title mb-40">
                            <h3 class="h3-sm">@lang('frontend.home_layout_4.bundle_courses_title')</h3>
                            @lang('frontend.home_layout_4.bundle_courses_note')

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

    @include('front-end.home.partials.video_section')
        @include('front-end.home.partials.learn_new_skills')
    @include('front-end.home.partials.statistics')

    @if(in_array('top_rated_courses_section', config('layout_sections')))
        <section id="courses-5" class="courses-section division">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title mb-40">
                            <h3 class="h3-sm">@lang('frontend.home_layout_4.highest_rated_courses_title')</h3>
                            @lang('frontend.home_layout_4.highest_rated_courses_note')

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
    @include('front-end.home.partials.reviews_section')
    @include('front-end.home.partials.our_stories_and_news_section')

    @if(in_array('promotional_section_three_widget', config('layout_sections')))
        @include('front-end.home.partials.learn_something_new_everyday_section')
    @endif
@endsection
