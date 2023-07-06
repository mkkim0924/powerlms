@extends('front-end.layouts.master')
@section('content')
    <div id="breadcrumb" class="division">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('frontend.about.breadcrumb_item.home')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">@lang('frontend.about.breadcrumb_item.about') {{ config('app.name') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    @include('front-end.home.partials.transform_life_through_online_education_section')
    @include('front-end.home.partials.statistics')

    <section id="courses-3" class="wide-60 courses-section division">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title title-centered mb-60">
                        <h3 class="h3-sm">@lang('frontend.about.the_best_online_courses_title')</h3>
                        @lang('frontend.about.the_best_online_courses_note')

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
            @if(count($popularCourses) > 8)
                <div class="row">
                    <div class="col-md-12">
                        <div class="all-courses-btn">
                            <a href="{{ route('courses') }}" class="btn btn-md btn-tra-grey rose-hover">
                                @lang('frontend.about.view_all_courses_button') </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

@include('front-end.home.partials.video_section')


    <section id="categories-4" class="wide-60 categories-section division">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title title-centered mb-80">
                        <h3 class="h3-sm">@lang('frontend.about.our_online_course_categories_title')</h3>
                        @lang('frontend.about.our_online_course_categories_note')

                    </div>
                </div>
            </div>
            @include('front-end.home.partials.course_categories')
            @if(count($categories) > 6)
                <div class="row">
                    <div class="col-md-12">
                        <div class="all-courses-btn">
                            <a href="{{ route('categories') }}" class="btn btn-tra-grey rose-hover">
                                @lang('frontend.about.browse_all_categories_button')</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    @include('front-end.home.partials.register_form_section')

    <section id="services-5" class="wide-60 services-section division">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title title-centered mb-60">
                        <h3 class="h3-sm">@lang('frontend.about.best_learning_opportunities_title')</h3>
                        @lang('frontend.about.best_learning_opportunities_note')

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="sbox-5">
                        <img class="img-70" src="{{ asset('frontend-assets/files/images/icons/education.png') }}" alt="service-icon"/>
                        <div class="sbox-5-txt">
                            <h5 class="h5-md">@lang('frontend.about.trending_courses_title')</h5>
                            @lang('frontend.about.trending_courses_note')
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="sbox-5">
                        <img class="img-70" src="{{ asset('frontend-assets/files/images/icons/presentation.png') }}" alt="service-icon"/>
                        <div class="sbox-5-txt">
                            <h5 class="h5-md">@lang('frontend.about.certified_teachers_title')</h5>
                            @lang('frontend.about.certified_teachers_note')
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="sbox-5">
                        <img class="img-70" src="{{ asset('frontend-assets/files/images/icons/certificate.png') }}" alt="service-icon"/>
                        <div class="sbox-5-txt">
                            <h5 class="h5-md">@lang('frontend.about.graduation_certificate_title')</h5>
                            @lang('frontend.about.graduation_certificate_note')
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="sbox-5">
                        <img class="img-70" src="{{ asset('frontend-assets/files/images/icons/elearning-1.png') }}" alt="service-icon"/>
                        <div class="sbox-5-txt">
                            <h5 class="h5-md">@lang('frontend.about.online_course_facilities_title')</h5>
                            @lang('frontend.about.online_course_facilities_note')
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="sbox-5">
                        <img class="img-70" src="{{ asset('frontend-assets/files/images/icons/reading.png') }}" alt="service-icon"/>
                        <div class="sbox-5-txt">
                            <h5 class="h5-md">@lang('frontend.about.free_books_library_title')</h5>
                            @lang('frontend.about.free_books_library_note')
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="sbox-5">
                        <img class="img-70" src="{{ asset('frontend-assets/files/images/icons/bookshelf.png') }}" alt="service-icon"/>
                        <div class="sbox-5-txt">
                            <h5 class="h5-md">@lang('frontend.about.free_study_materials_title')</h5>
                            @lang('frontend.about.free_study_materials_note')

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="news-1" class="pt-100 news-section division">
        @include('front-end.home.partials.blog_listing_with_images_section')
    </section>

    @if(count($reviews))
        <section id="reviews-1" class="wide-100 reviews-section division">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title title-centered mb-60">
                            <h3 class="h3-sm"> @lang('frontend.about.success_stories_from_our_students_title')</h3>
                            @lang('frontend.about.success_stories_from_our_students_note')

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="owl-carousel owl-theme reviews-holder">
                            @foreach($reviews->take(25) as $review)
                                <div class="review-1">
                                    <div class="quote-ico"><img
                                            src="{{ asset('frontend-assets/files/images/left-quote.png') }}"
                                            alt="quote-image"/></div>
                                    <p title="{{ $review->comment }}">{{ str_limit($review->comment, 200) }}</p>
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
        @include('front-end.home.partials.learn_something_new_everyday_section')
@endsection
