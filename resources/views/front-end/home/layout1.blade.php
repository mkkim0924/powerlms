@extends('front-end.layouts.master')
@section('content')
    @if(count($banners) > 0 && in_array('banner_section', config('layout_sections')))
        <section id="hero-1" class="hero-section division">
            <div class="slider">
                <ul class="slides">
                    @foreach($banners as $banner)
                        <li id="slide-{{ $banner->id }}">
                            <img src="{{ getFileUrl($banner->image, 'banner') }}"
                                 alt="slide-background">
                            <div class="caption d-flex align-items-center left-align">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-8 col-lg-7">
                                            <div class="caption-txt @if($banner->text_color == 'white') white-color @endif">
                                                <h2 class="h2-sm">{{ $banner->hero_text }}</h2>
                                                @if(!empty($banner->sub_text))
                                                    <p class="p-lg">{{ $banner->sub_text }}</p>
                                                @endif
                                                @if($banner->action_type == 'button')
                                                    <a href="{{ $banner->button_url }}"
                                                       class="btn btn-md btn-rose @if($banner->text_color == 'white') tra-white-color @else tra-black-hover @endif ">{{ $banner->button_text }}</a>
                                                @elseif($banner->action_type == 'search')
                                                    <form class="hero-form" action="{{ route('courses') }}">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="search"
                                                                   placeholder="@lang('frontend.home_layout_1.placeholder_text')"
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
    @if(in_array('statistics_section', config('layout_sections')))
        <section id="about-1" class="bg-05 about-section division">
            <div class="white-color container">
                <div class="row d-flex align-items-center">
                    <div class="col-md-4">
                        <div class="abox-1 icon-xs">
                            <span class="flaticon-004-computer"></span>
                            <div class="abox-1-txt">
                                <h5 class="h5-md">{{ config('statistics.online_courses') }} @lang('frontend.home_layout_1.online_courses_text')</h5>
                                <p class="p-md">@lang('frontend.home_layout_1.Explore_a_variety_of_fresh_topics_text')</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="abox-1 icon-xs">
                            <span class="flaticon-028-learning-1"></span>
                            <div class="abox-1-txt">
                                <h5 class="h5-md">@lang('frontend.home_layout_1.expert_instruction_text')</h5>
                                <p class="p-md">@lang('frontend.home_layout_1.find_the_right_instructor_for_you_text')</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="abox-1 icon-xs">
                            <span class="flaticon-032-tablet"></span>
                            <div class="abox-1-txt">
                                <h5 class="h5-md">@lang('frontend.home_layout_1.lifetime_access_text')</h5>
                                <p class="p-md">@lang('frontend.home_layout_1.learn_on_your_schedule_text')</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @include('front-end.home.partials.transform_life_through_online_education_section')

    @if(in_array('popular_courses_section', config('layout_sections')))
        <section id="courses-3" class="bg-lightgrey wide-60 courses-section division">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title mb-60">
                            <h3 class="h3-sm">@lang('frontend.home_layout_1.popular_courses_title')</h3>
                            @lang('frontend.home_layout_1.popular_courses_note')

                            @if(count($popularCourses) > 8)
                                <div class="title-btn">
                                    <a href="{{ route('courses') }}"
                                       class="btn btn-tra-grey rose-hover">@lang('frontend.home_layout_1.view_all_courses_button')</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row courses-grid">
                    @foreach($popularCourses->take(8) as $course)
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            @include('front-end.course.vertical_course_card', ['course' => $course])
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @include('front-end.home.partials.learn_new_skills')

    @include('front-end.home.partials.website_features_section')

    @if(in_array('trending_categories_section', config('layout_sections')))
        <section id="categories-3" class="wide-100 categories-section division">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title mb-60">
                            <h3 class="h3-sm">@lang('frontend.home_layout_1.top_trending_categories_title')</h3>
                            @lang('frontend.home_layout_1.top_trending_categories_note')

                            @if(count($categories) > 5)
                                <div class="title-btn">
                                    <a href="{{ route('categories') }}"
                                       class="btn btn-tra-grey rose-hover">@lang('frontend.home_layout_1.view_all_categories_button')</a>
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
                                    class="{{ array_random(['bg-blue', 'bg-green', 'bg-red', 'bg-teal', 'bg-yellow', 'bg-violet', 'bg-orange', 'bg-lightgreen', 'bg-skyblue']) }} c3-box icon-md white-color text-center">
                                    <a href="{{ route('category_detail', $category->slug) }}">
                                        <div class="c3-box-icon">
                                            <img
                                                src="{{ getFileUrl($category->icon, 'category') }}"
                                                alt="category-icon"/>
                                        </div>
                                        <div class="cbox-3-txt">
                                            <h5 class="h5-md">{{ $category->name }}</h5>
                                            <p>{{ count($category->courses) }} @lang('frontend.home_layout_1.courses_text')</p>
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
    @include('front-end.home.partials.upcoming_webinars_section')

    @if(in_array('top_rated_courses_section', config('layout_sections')))
        <section id="courses-5" class="bg-lightgrey courses-section division">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title mb-60">
                            <h3 class="h3-sm">@lang('frontend.home_layout_1.highest_rated_online_courses_title')</h3>
                            @lang('frontend.home_layout_1.highest_rated_online_courses_note')

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

    @if(count($bundles) > 0 && in_array('bundle_courses_section', config('layout_sections')))
        <section id="courses-1" class="mt-1 mb-4 courses-section division">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title mb-60">
                            <h3 class="h3-sm">@lang('frontend.home_layout_1.bundle_courses_title')</h3>
                            @lang('frontend.home_layout_1.bundle_courses_note')

                            @if(count($bundles) > 8)
                                <div class="title-btn">
                                    <a href="{{ route('bundles') }}" class="btn btn-tra-grey rose-hover">
                                        @lang('frontend.home_layout_1.view_all_bundles_button')</a>
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

    @include('front-end.home.partials.become_teacher_section')

    @include('front-end.home.partials.our_goal_section')

    @if(isset($widgets['video_promotion_section_widget']) && in_array('video_promotion_section_widget', config('layout_sections')))
        @php $videoSectionData = $widgets['video_promotion_section_widget'][0]; @endphp
        <section id="video-3" class="video-section division bg-scroll">
            <div class="video-3-txt division bg-scroll">
                <div class="white-color container">
                    <div id="video-3-content" class="row">
                        <div class=" video-txt text-center  @if(session('display_type')=='rtl') col-lg-8 mx-auto @else col-lg-8 offset-lg-2 @endif">
                            <h3 class="h3-md">{{ $videoSectionData['title'][config('app.locale')] ?? ($videoSectionData['title'][$default_language_code] ?? "") }}</h3>
                            {!! $videoSectionData['description'][config('app.locale')] ?? ($videoSectionData['description'][$default_language_code] ?? "") !!}
                        </div>
                    </div>
                </div> <!-- End container -->
            </div> <!-- END VIDEO TEXT -->

            <!-- VIDEO LINK -->
            <div class="video-3-link division mb-40">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 video-link text-center">
                            <!-- Change the link HERE!!! -->
                            <div class="play-btn play-btn-rose text-center">
                                @if(!empty($videoSectionData['video_url']))
                                    <a class="video-popup3 video-play-button"
                                       href="{{ $videoSectionData['video_url'] }}">
                                        <span></span>
                                    </a>
                            @endif
                            <!-- Preview Image -->
                                <img class="img-fluid" src="{{ getFileUrl($videoSectionData['image'], 'widgets') }}"
                                     alt="video-preview">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    @if(in_array('partner_companies_section', config('layout_sections')) && count($sponsors) > 0)
        <div class="video-3-brands division">
            <div class="container">
                <div class="row">
                    <div class="col text-center">
                        <p class="p-md">@lang('frontend.home_layout_1.trusted_by_companies_of_all_sizes_text') :</p>
                        <div class="owl-carousel brands-carousel">
                            @foreach($sponsors as $sponsor)
                                <a @if(isset($sponsor->link)) href="{{ $sponsor->link }}" target="_blank" @else href="javascript:;" @endif>
                                    <div class="brand-logo">
                                        <img class="img-fluid" src="{{ getFileUrl($sponsor->image, 'sponsor') }}"
                                             alt="{{ $sponsor->title }}"/>
                                    </div>
                                </a>
                            @endforeach
                        </div><!-- Brands Carousel -->
                    </div> <!-- End col -->
                </div> <!-- End row -->
            </div> <!-- End container -->
        </div> <!-- END VIDEO-3 BRANDS -->
    @endif
    @if(in_array('learning_points_section', config('layout_sections')))
        <section id="services-5" class="bg-lightgrey wide-60 services-section division">
            <div class="container">
                <!-- SECTION TITLE -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title title-centered mb-60 text-center">

                            <!-- Title 	-->
                            <h3 class="h3-sm">@lang('frontend.home_layout_1.best_learning_opportunities_title')</h3>
                            @lang('frontend.home_layout_1.best_learning_opportunities_note')


                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-4">
                        <div class="sbox-5">
                            <img class="img-70" src="{{ asset('frontend-assets/files/images/icons/education.png') }}"
                                 alt="service-icon"/>
                            <div class="sbox-5-txt">
                                <h5 class="h5-md">@lang('frontend.home_layout_1.trending_courses_title')</h5>
                                @lang('frontend.home_layout_1.trending_courses_note')
                            </div>
                        </div>
                    </div> <!-- END SERVICE BOX #1 -->
                    <div class="col-md-6 col-lg-4">
                        <div class="sbox-5">
                            <img class="img-70" src="{{ asset('frontend-assets/files/images/icons/presentation.png') }}"
                                 alt="service-icon"/>
                            <div class="sbox-5-txt">
                                <h5 class="h5-md">@lang('frontend.home_layout_1.certified_teachers_title')</h5>
                                @lang('frontend.home_layout_1.certified_teachers_note')
                            </div>
                        </div>
                    </div> <!-- END SERVICE BOX #2 -->
                    <div class="col-md-6 col-lg-4">
                        <div class="sbox-5">
                            <img class="img-70" src="{{ asset('frontend-assets/files/images/icons/certificate.png') }}"
                                 alt="service-icon"/>
                            <div class="sbox-5-txt">
                                <h5 class="h5-md">@lang('frontend.home_layout_1.graduation_certificate_title')</h5>
                                @lang('frontend.home_layout_1.graduation_certificate_note')
                            </div>
                        </div>
                    </div> <!-- END SERVICE BOX #3 -->
                    <div class="col-md-6 col-lg-4">
                        <div class="sbox-5">
                            <img class="img-70" src="{{ asset('frontend-assets/files/images/icons/elearning-1.pn') }}g"
                                 alt="service-icon"/>
                            <div class="sbox-5-txt">
                                <h5 class="h5-md">@lang('frontend.home_layout_1.online_course_facilities_title')</h5>
                                @lang('frontend.home_layout_1.online_course_facilities_note')
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="sbox-5">
                            <img class="img-70" src="{{ asset('frontend-assets/files/images/icons/reading.png') }}"
                                 alt="service-icon"/>
                            <div class="sbox-5-txt">
                                <h5 class="h5-md">@lang('frontend.home_layout_1.free_books_library_title')</h5>
                                @lang('frontend.home_layout_1.free_books_library_note')
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="sbox-5">
                            <img class="img-70" src="{{ asset('frontend-assets/files/images/icons/bookshelf.png') }}"
                                 alt="service-icon"/>
                            <div class="sbox-5-txt">
                                <h5 class="h5-md">@lang('frontend.home_layout_1.free_study_materials_title')</h5>
                                @lang('frontend.home_layout_1.free_study_materials_note')

                            </div>
                        </div>
                    </div> <!-- END SERVICE BOX #6 -->
                </div> <!-- End row -->
            </div> <!-- End container -->
        </section> <!-- End SERVICES-5 -->
    @endif

    @include('front-end.home.partials.our_stories_and_news_section')
    @if(in_array('promotional_section_three_widget', config('layout_sections')))
        @include('front-end.home.partials.learn_something_new_everyday_section')
    @endif
@endsection
