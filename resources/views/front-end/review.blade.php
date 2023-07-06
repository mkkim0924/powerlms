@extends('front-end.layouts.master')

@section('content')
    <div id="breadcrumb" class="division">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('frontend.reviews.breadcrumb_item.home')</a></li>
                            @if(isset($course))
                                <li class="breadcrumb-item"><a href="{{ route('course_detail', $course->slug) }}">{{ $course->name }}</a></li>
                            @endif
                            <li class="breadcrumb-item active" aria-current="page">@lang('frontend.reviews.breadcrumb_item.review')</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <section id="reviews-2" class="wide-60 reviews-section division">
        <div class="container">
            <div class="row">
                <div class="col-md-12 reviews-grid">
                    <div class="masonry-wrap grid-loaded">
                        @foreach($reviews as $review)
                            <div class="review-2 masonry-item">
                                <div class="review-2-txt">
                                    <p>{{ $review->comment }}</p>
                                    <div class="review-2-author d-flex align-items-center">
                                        <div class="author-avatar">
                                            <img class="img-fluid" src="{{ getFileUrl($review->userDetail->image ?? 'default-placeholder.jpg', 'users') }}"
                                                 alt="review-author-avatar"/>
                                        </div>
                                        <div class="review-author">
                                            <div class="tst-rating">
                                                {!! getStarRatingHtml($review->rating) !!}
                                            </div>
                                            <h5 class="h5-xs">{{ $review->author_name }}</h5>
                                            @if(!isset($course))
                                                <span>{{ $review->courseDetail->name ?? "" }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if($reviews->total() > 10)
        <div class="page-pagination division">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        {!! $reviews->links("pagination.html") !!}
                    </div>
                </div>
            </div>
        </div>
    @endif
    @include('front-end.home.partials.learn_something_new_everyday_section')
@endsection
