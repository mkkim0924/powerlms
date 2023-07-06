@extends('front-end.layouts.master')
@section('content')
    @if (count($banners) > 0 && in_array('banner_section', config('layout_sections')))
        <section id="hero-2" class="bg-scroll hero-section division"
            style="background-image: url('/storage/banner/{{ $banners->first()->image }}') !important;">
            <div class="container">
                <div class="row d-flex align-items-center">
                    <div class="col-md-8 col-lg-6">
                        <div class="hero-txt mb-40 @if ($banners->first()->text_color == 'white') white-color @endif">
                            <h3>{{ $banners->first()->hero_text }}</h3>
                            @if (!empty($banners->first()->sub_text))
                                <p class="p-md">{{ $banners->first()->sub_text }}</p>
                            @endif
                            @if ($banners->first()->action_type == 'button')
                                <a href="{{ $banners->first()->button_url }}"
                                    class="btn btn-md btn-rose @if ($banners->first()->text_color == 'white') tra-white-hover @else tra-black-hover @endif">{{ $banners->first()->button_text }}</a>
                            @elseif($banners->first()->action_type == 'search')
                                <form class="hero-form" action="{{ route('courses') }}">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search"
                                            placeholder="@lang('frontend.home_layout_9.placeholder_text')" aria-label="Search" autocomplete="off">
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn">
                                                <i class="fa fa-search" aria-hidden="true"></i>
                                            </button>
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

    @include('front-end.home.partials.transform_life_through_online_education_section')
    @if (in_array('learning_points_section', config('layout_sections')))
        <section id="services-2" class="bg-whitesmoke wide-60 services-section division">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-3">
                        <div class="sbox-2">
                            <img class="img-65" src="{{ asset('frontend-assets/files/images/icons/bookshelf.png') }}"
                                alt="service-icon" />
                            <div class="sbox-2-txt">
                                <h5 class="h5-md">@lang('frontend.home_layout_9.learn_anything_title')</h5>
                                @lang('frontend.home_layout_9.learn_anything_note')
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="sbox-2">
                            <img class="img-65" src="{{ asset('frontend-assets/files/images/icons/classroom.png') }}"
                                alt="service-icon" />
                            <div class="sbox-2-txt">
                                <h5 class="h5-md">@lang('frontend.home_layout_9.learn_together_title')</h5>
                                @lang('frontend.home_layout_9.learn_together_note')
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="sbox-2">
                            <img class="img-65" src="{{ asset('frontend-assets/files/images/icons/international.png') }}"
                                alt="service-icon" />
                            <div class="sbox-2-txt">
                                <h5 class="h5-md">@lang('frontend.home_layout_9.learn_with_experts_title')</h5>
                                @lang('frontend.home_layout_9.learn_with_experts_note')
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="sbox-2">
                            <img class="img-65" src="{{ asset('frontend-assets/files/images/icons/certificate.png') }}"
                                alt="service-icon" />
                            <div class="sbox-2-txt">
                                <h5 class="h5-md">@lang('frontend.home_layout_9.certification_title')</h5>
                                @lang('frontend.home_layout_9.certification_note')

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    @if (in_array('trending_categories_section', config('layout_sections')))
        <section id="categories-4" class="wide-60 categories-section division">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title mb-80">
                            <h3 class="h3-sm">@lang('frontend.home_layout_9.our_course_categories_title')</h3>
                            @lang('frontend.home_layout_9.our_course_categories_note')

                            @if (count($categories) > 6)
                                <div class="title-btn">
                                    <a href="{{ route('categories') }}" class="btn btn-tra-grey rose-hover">
                                        @lang('frontend.home_layout_9.view_all_categories_button')</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                @include('front-end.home.partials.course_categories', ['categories' => $categories])
            </div>
        </section>
    @endif
    @include('front-end.home.partials.website_features_section')
    @if (in_array('popular_courses_section', config('layout_sections')))
        <section id="courses-2" class="wide-60 courses-section division">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title mb-60">
                            <h3 class="h3-sm">@lang('frontend.home_layout_9.most_popular_courses_title')</h3>
                            @lang('frontend.home_layout_9.most_popular_courses_note')

                            @if (count($popularCourses) > 6)
                                <div class="title-btn">
                                    <a href="{{ route('courses') }}" class="btn btn-tra-grey rose-hover">
                                        @lang('frontend.home_layout_9.view_all_courses_button')</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($popularCourses->take(6) as $course)
                        <div class="col-md-6 col-lg-4">
                            @include('front-end.course.course_card_with_description', [
                                'course' => $course,
                            ])
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif


    @if (count($reviews) > 0 && in_array('student_testimonial_section', config('layout_sections')))
        <section id="reviews-1" class="bg-whitesmoke wide-100 reviews-section division">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title title-centered mb-60">
                            <h3 class="h3-sm">@lang('frontend.home_layout_9.success_stories_from_our_students_title')</h3>
                            @lang('frontend.home_layout_9.success_stories_from_our_students_note')

                            {{-- Button
                                <div class="title-btn">
                                    <a href="reviews.html" class="btn btn-tra-grey rose-hover">@lang('frontend.home_layout_9.read_all_reviews_button')</a>
                                </div>  --}}

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="owl-carousel owl-theme reviews-holder">
                            @foreach ($reviews as $review)
                                <div class="review-1">
                                    <div class="quote-ico"><img
                                            src="{{ asset('frontend-assets/files/images/left-quote.png') }}"
                                            alt="quote-image" /></div>
                                    <p>{{ $review->comment }}
                                    </p>
                                    <div class="review-1-author d-flex align-items-center">
                                        <div class="author-avatar">
                                            <img class="img-fluid"
                                                src="{{ getFileUrl($review->userDetail->image ?? 'default-placeholder.jpg', 'users') }}"
                                                alt="review-author-avatar" />
                                        </div>
                                        <div class="review-author">
                                            <div class="tst-rating">
                                                {!! getStarRatingHtml($review->rating) !!}
                                            </div>
                                            <h5 class="h5-xs">{{ $review->author_name }}</h5>
                                            <span>{{ $review->courseDetail->name ?? '' }}</span>
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
    @include('front-end.home.partials.upcoming_webinars_section')

    @include('front-end.home.partials.learn_new_skills')

    @if (isset($widgets['video_promotion_section_widget']) &&
        in_array('video_promotion_section_widget', config('layout_sections')))
        @php $videoSectionData = $widgets['video_promotion_section_widget'][0]; @endphp
        <div id="video-2" class="bg-scroll video-section division">
            <div class="container white-color">
                <div class="row">
                    <div
                        class="@if (session('display_type') == 'rtl') col-md-10 mx-auto col-lg-8 @else col-md-10 offset-md-1 offset-lg-2 col-lg-8 @endif">
                        @if (!empty($videoSectionData['video_url']))
                            <div class="play-btn play-btn-rose text-center">
                                <a class="video-popup3 video-play-button" href="{{ $videoSectionData['video_url'] }}">
                                    <span></span>
                                </a>
                            </div>
                        @endif
                        <div class="video-txt text-center">
                            <h3 class="h3-sm">
                                {{ $videoSectionData['title'][config('app.locale')] ?? ($videoSectionData['title'][$default_language_code] ?? '') }}
                            </h3>
                            {!! $videoSectionData['description'][config('app.locale')] ??
                                ($videoSectionData['description'][$default_language_code] ?? '') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if (in_array('top_rated_courses_section', config('layout_sections')))
        <section id="courses-5" class="courses-section division">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title mb-60">
                            <h3 class="h3-sm">@lang('frontend.home_layout_9.top_rated_courses_title')</h3>
                            @lang('frontend.home_layout_9.top_rated_courses_note')

                            @if (count($courses) > 8)
                                <div class="title-btn">
                                    <a href="{{ route('courses') }}" class="btn btn-tra-grey rose-hover">
                                        @lang('frontend.home_layout_9.view_all_courses_button')</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($courses->take(8) as $course)
                        <div class="col-lg-6">
                            @include('front-end.course.horizontal_course_card', ['course' => $course])
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    @if (count($bundles) > 0 && in_array('bundle_courses_section', config('layout_sections')))
        <section id="courses-1" class="bg-whitesmoke wide-100 courses-section division">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title mb-60">
                            <h4 class="h4-xl">@lang('frontend.home_layout_6.bundle_courses_title')</h4>
                            @lang('frontend.home_layout_6.bundle_courses_note')

                            @if (count($bundles) > 8)
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
                            @foreach ($bundles->take(8) as $bundle)
                                @include('front-end.bundle.bundle_card', ['bundle' => $bundle])
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    @include('front-end.home.partials.statistics')

    @include('front-end.home.partials.our_goal_section')
    {{--    @include('front-end.home.partials.pricing_section') --}}
    @include('front-end.home.partials.our_stories_and_news_section')
    @include('front-end.home.partials.become_teacher_section')
@endsection
