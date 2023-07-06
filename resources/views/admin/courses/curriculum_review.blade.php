@extends('admin.layouts.master')
@section('css')
    <link href="{{ asset('admin-assets/modules/curriculum.css') }}" rel="stylesheet">
@endsection
@section('admin_content')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-4 col-6 d-flex align-items-center">
                                    <h2 class="card-title text-capitalize">@lang('backend.courses.header.curriculum')</h2>
                                </div>
                                <div class="col lg 4">
                                    <span
                                        class="pull-right d-inline-block @if (session('display_type') == 'rtl') float-left @else float-right @endif">
                                        <a href="{{ route(request()->user_type . '.courses') }}"
                                            class="btn btn-rounded btn-warning">
                                            <i class="fa fa-arrow-left" aria-hidden="true"></i> @lang('global.button.back')
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 px-1">
                                    <!-- Portlet card -->
                                    <div class="card text-secondary on-hover-action mb-2">
                                        <a href="javascript:;" class="curriculumDetails">
                                            <div class="card-body thinner-card-body d-flex align-items-center px-3 py-2 justify-content-between "
                                                style="border-radius: 15px;">
                                                <h5 class="card-title mb-0 ">
                                                    <span class="font-weight-light">@lang('backend.courses.course_text'): </span>
                                                    <span class="px-2 pe-0 curriculum-heads">{{ $course->name }}</span>
                                                </h5>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    @foreach ($sections as $section)
                                        <div class="card bg-light on-hover-action mb-2">
                                            <div class="card-body p-2">
                                                <h5 class="card-title">{{ $section->name }}</h5>
                                                <div class="clearfix"></div>
                                                @foreach ($section->getSectionChildData as $lesson)
                                                    <div class="col-md-12 px-1">
                                                        <!-- Portlet card -->
                                                        <div class="card text-secondary on-hover-action mb-2">
                                                            <a href="javascript:;" class="curriculumDetails"
                                                                id="curriculum{{ $lesson->id }}"
                                                                data-id="{{ $lesson->id }}">
                                                                <div class="card-body thinner-card-body d-flex align-items-center px-3 py-2 justify-content-between @if ($lesson->has_pending_comments == 1) alert-warning @endif"
                                                                    style="border-radius: 15px;">
                                                                    <h5 class="card-title mb-0 ">
                                                                        @if ($lesson->curriculum_type == 'unit')
                                                                            <span class="font-weight-light"><i
                                                                                    class="far fa-play-circle"></i></span>
                                                                        @elseif($lesson->curriculum_type == 'quiz')
                                                                            <span class="font-weight-light"><i
                                                                                    class="far fa-question-circle"></i></span>
                                                                        @endif
                                                                        <span
                                                                            class="px-2 pe-0 curriculum-heads">{{ $lesson->name }}</span>
                                                                    </h5>
                                                                    @if ($lesson->has_pending_comments == 1)
                                                                        <p><i class="fas fa-comment-dots"></i></p>
                                                                    @endif
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="col-12 col-lg-8" id="htmlDiv">
                                    @include('admin.courses.ajax.course_details')
                                </div>
                            </div>
                        </div>
                        @if (request()->user_type == 'admin' && $course->course_status == 2)
                            <div class="card-footer">
                                <a href="{{ route('admin.courses.updateStatus', [$course_id, 1]) }}"
                                    class="btn btn-success">@lang('global.button.approve')</a>
                                <a href="{{ route('admin.courses.updateStatus', [$course_id, 4]) }}" class="btn btn-danger">
                                    @lang('global.button.reject') </a>
                                <a href="{{ route('admin.courses.updateStatus', [$course_id, 3]) }}" class="btn btn-info">
                                    @lang('global.button.review_complete')</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer_scripts')
    <script type="text/javascript">
        var $course_id = {{ $course_id }}
        $(document).ready(function() {
            'use strict';
            $(document).on('click', '.curriculumReview', function() {
                var curriculum_id = $(this).data('id');
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: $app_url + '/{{ request()->user_type }}/course/getCurriculumComments',
                    data: {
                        curriculum_id: curriculum_id,
                        course_id: $course_id
                    },
                    beforeSend: function() {
                        $('#chatSection').html("");
                    },
                    success: function(data) {
                        $('#chatSection').html(data.html);
                    }
                });
            })

            $(document).on('click', '.curriculumDetails', function() {
                var curriculum_id = $(this).data('id');
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: $app_url + '/{{ request()->user_type }}/course/getCurriculumData',
                    data: {
                        curriculum_id: curriculum_id,
                        course_id: $course_id
                    },
                    beforeSend: function() {
                        $('#htmlDiv').html("");
                        $('.preloader').fadeIn();
                    },
                    success: function(data) {
                        $('#htmlDiv').html(data.html);
                        $('.preloader').fadeOut();
                        if ($(".dropify").length > 0) {
                            $(".dropify").dropify();
                        }
                    }
                });
            })

            $(document).on('click', '#sendComment', function() {
                if ($.trim($("#message").val()) == "") {
                    $("#message").focus();
                    return false;
                }
                var message = $("#message").val();
                messageSend(message, false);
            })

            $(document).on('click', '.ticketResolved', function() {
                var message = $(this).data('message');
                messageSend(message, true);
                $(this).remove();
            })
        })

        function messageSend(message, resolved_flag) {
            var curriculum_id = $("#curriculum_id").val();
            var user_type = '{{ request()->user_type }}';
            $.ajax({
                type: "POST",
                dataType: "json",
                url: $app_url + '/' + user_type + '/course/curriculum-review/submit',
                data: {
                    'content': message,
                    course_id: $course_id,
                    'curriculum_id': curriculum_id,
                    resolved_flag: resolved_flag
                },
                beforeSend: function() {
                    $('.preloader').fadeIn();
                },
                success: function() {
                    $('#chatDiv').append(
                        "<div class='media-user d-flex flex-row-reverse text-end'><div class='media-body mt-3'><div class='az-msg-wrapper'>" +
                        message + "</div></div></div>");
                    $('#message').val("");
                    if ((user_type == 'admin') && !$("#curriculum" + curriculum_id).find('.card-body').hasClass(
                            'alert-warning')) {
                        $("#curriculum" + curriculum_id).find('.card-body').addClass('alert-warning').append(
                            '<p><i class="fas fa-comment-dots"></i></p>')
                    }
                    if (resolved_flag) {
                        $("#curriculum" + curriculum_id).find('.card-body').removeClass('alert-warning');
                        $("#curriculum" + curriculum_id).find('.fa-comment-dots').remove();
                    }
                    $('.preloader').fadeOut();
                }
            });
        }
    </script>
@endsection
