@extends('front-end.layouts.master')

@section('content')
    <div class="main-wrapper">
        <div class="inner-wrapper">
            <div class="container">
                <div class="row align-items-center py-5 d-flex align-items-stretch">
                    @include('front-end.layouts.partials.flash_messages')
                    <div
                        class="col-lg-4 col-12 mb-md-3 mb-lg-0 text-center section-heading student-achievement d-flex flex-column justify-content-center align-items-center">
                        <img src="{{ getFileUrl(auth()->user()->image ?? 'default-placeholder.jpg', 'users') }}"
                             alt="User Image" class="student-image mt-5 mb-4" width="100" height="100">
                        <h2 class="m-0 text-white">@lang('frontend.course_completion.hi_text') {{ explode(' ',
                        auth()->user()->name)[0] ?? 'User' }},</h2>
                        <p class="py-3 text-white">@lang('frontend.course_completion.you_have_recently_completed_text'), {{
                        $course->name }}</p>
                        <a class="btn btn-outline-rose mb-4 px-4" href="{{ route('certificate.download', $course->slug) }}">
                            @lang('frontend.course_completion.download_certificate_button') <i
                                class="fas fa-download ps-2"></i></a>
                        <a href="javascript:;" class="btn btn-outline-rose mb-4 review-btn px-5 openReviewModal"
                           data-courseId="{{ $course->id }}">@lang('frontend.course_completion.write_a_review_button')
                            <i class="fas fa-plus-circle mx-2"></i>
                        </a>
                    </div>
                    <div class="col-12 col-lg-8 instructor-txt ">
                        <div class="row p-2 d-flex">
                            <div class="col-12 col-md-6 my-auto">
                                <img src="{{ url('frontend-assets/images/unit-page/study.jpg') }}" alt=""
                                     class="img-fluid ">
                            </div>
                            <div class="col-12 col-md-6 text-justify">
                                @lang('frontend.course_completion.note_1')

                            </div>
                        </div>
                        <div class="row p-2 d-flex">
                            <div class="col-12 col-md-6 text-justify m-order">
                                @lang('frontend.course_completion.note_2')

                            </div>
                            <div class="col-12 col-md-6 my-auto m-order-img">
                                <img src="{{ url('frontend-assets/images/unit-page/student.jpg') }}" alt=""
                                     class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(count($relatedCourses) > 0)
        <section id="courses-5" class="bg-whitesmoke courses-section division">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title mb-60">
                            <h4 class="h4-xl">@lang('frontend.course_completion.browse_similar_courses_text')</h4>
                            @lang('frontend.course_completion.browse_similar_courses_note')

                            <div class="title-btn">
                                <a href="{{ route('courses') }}" class="btn btn-tra-grey rose-hover">
                                    @lang('frontend.course_completion.view_all_courses_button')</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($relatedCourses as $relatedCourse)
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            @include('front-end.course.vertical_course_card', ['course' => $relatedCourse])
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    @include('front-end.modal.write_review')
    @if ($preSurveyModalOpen && (isset($survey) && count($survey->surveyQuestions) > 0))
        @include('front-end.curriculum_pages.partials.survey_model')
    @endif
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend-assets/unit-page/congrats.css') }}"/>
    <link rel="stylesheet" href="{{ asset('admin-assets/assets/extra-libs/rateyo/jquery.rateyo.min.css') }}"/>

@endpush
@push('footer_scripts')
    <script src="{{ asset('admin-assets/assets/extra-libs/rateyo/jquery.rateyo.min.js') }}"></script>
    <script src="{{ asset('admin-assets/assets/extra-libs/jquery-form-validator/jquery.form-validator.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            'use strict';
            $(document).on('click', '.openReviewModal', function () {
                var $courseId = $(this).attr("data-courseId");
                $.ajax({
                    url: $app_url + "/get-user-review-html",
                    type: "post",
                    data: {course_id: $courseId},
                    beforeSend: function () {
                        $("#reviewForm").html("")
                    },
                    success: function (data) {
                        $("#reviewForm").html(data.html);
                        $("#reviewModal").modal("show");
                        $(".star_ratings").rateYo({
                            rating: data.rating,
                            fullStar: !0,
                            ratedFill: "#FFC000",
                            onSet: function (a) {
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
