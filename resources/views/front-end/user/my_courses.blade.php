@extends('front-end.layouts.master')

@section('content')
    @include('front-end.user.partials.navbar', ['current_tab' => 'my-courses'])
    <section class="user-dashboard-area">
        <div class="container">
            <div class="row mx-0">
                <section id="courses-3" class="courses-section division">
                    @include('front-end.layouts.partials.flash_messages')
                    <div class="row mx-0">
                        <div class="col-md-12 px-sm-2 px-0">
                            <div class="d-flex justify-content-between px-sm-0 mb-3 px-2">
                                <h3 class="">@lang('frontend.my_courses.my_courses_title')</h3>
                            </div>
                        </div>
                    </div>
                    @if (count($courseUsers) > 0)
                        <div class="row courses-grid mx-0">
                            @foreach ($courseUsers as $courseUser)
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="cbox-1 position-relative bg-light">
                                        <a href="{{ route('course_detail', $courseUser->courseDetails->slug) }}">
                                            <img class="img-fluid"
                                                src="{{ getFileUrl($courseUser->courseDetails->image, 'course/images') }}"
                                                alt="{{ $courseUser->courseDetails->name }}">
                                            <div class="progress-wrapper">
                                                <div class="progress-bar" role="progressbar"
                                                    style="width: {{ round($courseUser->progress) }}%"
                                                    aria-valuenow="{{ round($courseUser->progress) }}" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                            <div class="cbox-1-txt d-flex flex-column ">
                                                <!-- Course Tags -->
                                                <p class="course-tags">
                                                    <span>{{ $courseUser->courseDetails->instructorDetail->name ?? '' }}</span>
                                                    <span>{{ getTotalCourseHours($courseUser->courseDetails->time) }}</span>
                                                </p>
                                                <h5 class="h5-xs fw-bold">{{ $courseUser->courseDetails->name }}</h5>
                                                <div class="mt-auto">
{{--                                                    <a href="" class=" mb-2 me-2 share-text d-flex justify-content-end align-items-center">--}}
{{--                                                        <i class="fas fa-share-alt mx-2"></i> Share Certificate--}}
{{--                                                    </a>--}}
                                                    @if ($courseUser->progress == 0)
                                                        <form method="POST" action="{{ route('course_status') }}">
                                                            @csrf
                                                            <input type="hidden" name="course_id"
                                                                value="{{ $courseUser->course_id }}">
                                                            <button class="btn btn-start w-100 mb-2" href="">
                                                                @lang('frontend.my_courses.start_course_button')
                                                            </button>
                                                        </form>

                                                    @elseif($courseUser->progress == 100)
                                                        <a class="btn btn-start w-100 mb-2 px-2 bg-white"
                                                            href="{{ route('certificate.download', $courseUser->courseDetails->slug) }}">
                                                            <i class="fas fa-download ps-2"></i> @lang('frontend.my_courses.download_certificate_button')
                                                        </a>
                                                    @else
                                                        <form method="POST" action="{{ route('course_status') }}">
                                                            @csrf
                                                            <input type="hidden" name="course_id"
                                                                value="{{ $courseUser->course_id }}">
                                                            <button class="btn btn-start w-100 mb-2" href="">
                                                                @lang('frontend.my_courses.continue_course_button')
                                                            </button>
                                                        </form>
                                                    @endif
                                                    <a href="javascript:;"
                                                        class="btn btn-start mb-4 review-btn w-100 openReviewModal bg-white"
                                                        data-courseId="{{ $courseUser->course_id }}">
                                                        <i class="fas fa-plus-circle mx-2"></i> @lang('frontend.my_courses.write_a_review_button')
                                                    </a>

                                                    <a href="{{route('chat',['id'=>$courseUser->id])}}"
                                                        class="btn btn-start mb-2 review-btn w-100 bg-white">
                                                        <i class="fas fa-message mx-2"></i> @lang('frontend.my_courses.chat_with_instructor_button')
                                                    </a>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                    <div class="row mx-0">
                        <div class="alert alert-danger text-center py-2">@lang('frontend.my_courses.no_record_found_text')</div>
                    </div>
                    @endif
                </section>
            </div>
        </div>
    </section>
    <hr style="opacity:.1;">
    @include('front-end.modal.write_review')
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend-assets/unit-page/mycourses.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin-assets/assets/extra-libs/rateyo/jquery.rateyo.min.css') }}" />
@endpush
@push('footer_scripts')
    <script src="{{ asset('admin-assets/assets/extra-libs/rateyo/jquery.rateyo.min.js') }}"></script>
    <script src="{{ asset('admin-assets/assets/extra-libs/jquery-form-validator/jquery.form-validator.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            'use strict';

            $(document).on('click', '.openReviewModal', function() {
                var $courseId = $(this).attr("data-courseId");
                $.ajax({
                    url: $app_url + "/get-user-review-html",
                    type: "post",
                    data: {
                        course_id: $courseId
                    },
                    beforeSend: function() {
                        $("#reviewForm").html("")
                    },
                    success: function(data) {
                        $("#reviewForm").html(data.html);
                        $("#reviewModal").modal("show");
                        $(".star_ratings").rateYo({
                            rating: data.rating,
                            fullStar: !0,
                            ratedFill: "#FFC000",
                            onSet: function(a) {
                                $(this).next().text(a), $(".rating").val(a)
                            }
                        });
                        $.validate({
                            scrollToTopOnError: false
                        });
                    }
                })
            })
        })
    </script>
@endpush
