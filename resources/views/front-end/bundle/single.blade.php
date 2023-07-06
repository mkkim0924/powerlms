@extends('front-end.layouts.master')
@section('content')
    @php
        $meta['meta_title'] = $bundle->meta_title ?? null;
        $meta['meta_description'] = $bundle->meta_description ?? null;
        $meta['meta_keywords'] = $bundle->meta_keywords ?? null;
    @endphp
    <div id="breadcrumb" class="division">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a
                                    href="{{ route('home') }}">@lang('frontend.bundle_details.breadcrumb_item.home')</a>
                            </li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('bundles') }}">@lang('frontend.bundle_details.breadcrumb_item.all_bundles')</a>
                            </li>
                            <li class="breadcrumb-item active"
                                aria-current="page">@lang('frontend.bundle_details.breadcrumb_item.bundle_details')</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <section id="course-details" class="wide-40 course-section division">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="course-txt pr-30">
                        <h3 class="h3-sm d-lg-block d-none mt-2">{{ $bundle->name }} </h3>
                        <p class="p-md"> {!! $bundle->description !!} </p>
                        <p class="course-short-data">
                            @lang('frontend.bundle_details.created_by_text'): {{ $bundle->instructorDetail->name }}
                        </p>
                        <div class="course-rating clearfix">
                            <span>{{ $bundle->total_enrollments }} @lang('frontend.bundle_details.students_enrolled_text')</span>
                        </div>
                        <div class="bundle-course mt-5">
                            <h4>@lang('frontend.bundle_details.courses_title')</h4>
                            <div class="row d-sm-flex mt-4">
                                @foreach ($bundle->relatedCourses as $item)
                                    <div class="col-md-4 col-12">
                                        @include('front-end.course.vertical_course_card', [
                                            'course' => $item->courseDetails,
                                        ])
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="cs-rating cd-block">
                            <h5 class="h5-xl">@lang('frontend.bundle_details.courses_reviews_title')</h5>
                            @lang('frontend.bundle_details.courses_reviews_note')
                        </div>
                        @foreach ($reviews as $ratings)
                            <div class="review-list">
                                <div class="review-4">
                                    <div class="review-4-txt">
                                        <p> {{ $ratings->comment }}</p>
                                        <div class="review-4-author d-flex align-items-center">
                                            <div class="author-avatar">
                                                <img class="img-fluid"
                                                     src="{{ getFileUrl($ratings->userDetail->image ?? 'default-placeholder.jpg', 'users') }}"
                                                     alt="review-author-avatar"/>
                                            </div>
                                            <div class="review-author">
                                                <div class="tst-rating">
                                                    {!! getStarRatingHtml($ratings->rating) !!}
                                                </div>
                                                <h5 class="h5-xs">{{ $ratings->author_name }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div> <!-- END COURSE DESCRIPTION -->
                <div class="col-lg-4">
                    <h3 class="h3-sm d-block d-lg-none mt-2">@lang('frontend.bundle_details.course_name_title')</h3>
                    <div class="course-data sticky-course-card">
                        <div class="play-btn play-btn-rose text-center">
                            <a>
                                <img class="img-fluid" src="{{ getFileUrl($bundle->image, 'bundle') }}">
                            </a>
                        </div>
                        <div class="course-data-price text-center">
                            {{ formatPrice($bundle->price) }}
                        </div>
                        <div class="course-data-links">
                            @if(isset($bundleUser))
                                <a href="javascript:;"
                                   class="btn btn-md btn-rose tra-grey-hover">@lang('frontend.bundle_details.already_paid_button')</a>
                            @else
                                <a href="{{ route('payment.bundle', $bundle->slug) }}"
                                   class="btn btn-md btn-rose tra-grey-hover">@lang('frontend.bundle_details.buy_now_button')</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend-assets/unit-page/bundle.css') }}"/>
@endpush
