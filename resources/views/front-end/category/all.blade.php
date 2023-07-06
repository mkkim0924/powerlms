@extends('front-end.layouts.master')
@section('content')
    <div id="breadcrumb" class="division">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a
                                    href="{{ route('home') }}">@lang('frontend.categories.breadcrumb_item.home')</a>
                            </li>
                            <li class="breadcrumb-item active"
                                aria-current="page">@lang('frontend.categories.breadcrumb_item.course_categories')</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <section class="bg-05 page-hero-section division">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="hero-txt white-color">
                        <h3 class="h3-xs">@lang('frontend.categories.page_header_text')</h3>
                        <div class="share-list">
                            <ul class="share-social-icons text-center clearfix">
                                <li>
                                    {!! __('frontend.categories.found_in_text', ['courses' => config('statistics.online_courses'), 'categories' => count($categories), ]) !!}

                                </li>
                                
                            </ul>
                        </div>

                        <p>{!! __('frontend.categories.learning_online_text', ['students' => config('statistics.students'), ]) !!}{{ config('app.name') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="categories-2" class="wide-70 categories-section division">
        <div class="container">
            <div class="row">
                @foreach($categories as $category)
                    <div class="col-sm-6 col-lg-3 col-xl-2">
                        <a href="{{ route('category_detail', $category->slug) }}">
                            <div class="c2-box text-center">
                                <img class="img-70"
                                     src="{{ getFileUrl($category->icon, 'category') }}"
                                     alt="{{ $category->name }} Icon"/>
                                <h5 class="h5-sm">{{ $category->name }}</h5>
                                <p>{{ count($category->courses) }} @lang('frontend.categories.courses_text')</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @include('front-end.home.partials.our_goal_section')
    <section id="reviews-1" class="wide-100 reviews-section division">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title mb-60">
                        <h3 class="h3-sm">@lang('frontend.categories.what_our_students_say_text')</h3>
                        @lang('frontend.categories.what_our_students_say_note')
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
    @include('front-end.home.partials.learn_something_new_everyday_section')
@endsection
