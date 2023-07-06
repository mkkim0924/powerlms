@extends('front-end.layouts.master')
@section('content')
    <div id="breadcrumb" class="division">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('frontend.quiz_details.breadcrumb_item.home')</a></li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('course_detail', $course->slug) }}">{{ $course->name }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">@lang('frontend.quiz_details.breadcrumb_item.test')</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="ncp-desktop">
        <div class="container" id="unit-left-section">
            <div class="row pb-5 d-flex align-items-start">
                <div class="col-12 col-lg-7  mb-md-4" id="unit-left-col">
                    <section class="unit-meta unit-inner-section py-4">
                        <div class="row">
                            <div class="col-12">
                                <h2 class="unit-section-heading">{!! $quizDetails->name !!}</h2>
                            </div>
                        </div>
                    </section>
                    <section class="quiz-question-s2">
                        <div class="row mx-0">
                            <form method="POST" action="{{ route('course_status') }}">
                                @csrf
                                <input type="hidden" name="course_id" value="{{ $course->id }}">
                                <button class="btn btn-md btn-outline-rose tra-grey-hover  back-btn"><i
                                        class="fas fa-chevron-left"></i> @lang('frontend.quiz_details.back_to_course_button')
                                </button>
                            </form>
                            <h6 class="my-3 complete-quiz d-block d-sm-none">@lang('frontend.quiz_details.start_test_title')
                            </h6>
                            <div class="timer-section d-flex py-3 d-sm-none">
                                <div class="col-5">
                                    <a class="btn btn-sm p-2 btn-rose" href="javascript:;">
                                        <span class="current_question_number mb-0 my-auto"> 2 </span> @lang('frontend.quiz_details.of_5_questions_text')
                                    </a>
                                </div>
                                <div class="col-7">
                                    @php
                                        $minute = date('i', strtotime($quizDetails->time));
                                        $hours = date('H', strtotime($quizDetails->time));
                                        $seconds = date('s', strtotime($quizDetails->time));
                                    @endphp
                                    <div class="timerCount" data-tenths="10" data-minute="{{ $minute }}"
                                        data-hours="{{ $hours }}" data-seconds="{{ $seconds }}">
                                        <div class="row countdownTimer">
                                            <div class="col-4 text-center py-0 ps-2 timerBlock">
                                                <h4 class="mb-0 timerText timerHours"></h4>
                                                <span class="text-center timerUnit">@lang('frontend.quiz_details.hours_text')</span>
                                            </div>
                                            <div class="col-4 text-center py-0 timerBlock">
                                                <h4 class="mb-0 timerText timerMinutes"></h4>
                                                <span class="text-center timerUnit">@lang('frontend.quiz_details.minutes_text')</span>
                                            </div>
                                            <div class="col-4 text-center py-0">
                                                <h4 class="mb-0 timerText timerSeconds"></h4>
                                                <span class="text-center timerUnit">@lang('frontend.quiz_details.seconds_text')</span>
                                            </div>
                                        </div>
                                        <div class="row expiredTimer" style="display: none;">
                                            <div class="col-12">@lang('frontend.quiz_details.test_has_expired_text')</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('submit_quiz') }}" method="POST" id="quizForm">
                                @csrf
                                <input type="hidden" name="total_questions" value="{{ count($questions) }}">
                                <input type="hidden" name="curriculum_id" value="{{ $curriculumDetails->id }}">
                                <input type="hidden" name="course_id" value="{{ $course->id }}">
                                <input type="hidden" name="quiz_id" value="{{ $quizDetails->id }}">
                                <input type="hidden" name="course_slug" value="{{ $curriculumDetails->course_slug }}">
                                <input type="hidden" name="quiz_slug" value="{{ $curriculumDetails->curriculum_slug }}">
                                @foreach ($questions as $que_key => $question)
                                    <div class="quiz-questions mt-4 pb-4" id="que{{ $que_key + 1 }}"
                                        @if (!$loop->first) style="display: none;" @endif>
                                        <label class="quiz-label p-3 pb-1 d-flex">
                                            <span class="queNo">{{ $que_key + 1 }}</span>.
                                            {!! $question->title !!}
                                        </label>

                                        @if (!empty(strip_tags($question->que_description)))
                                            <div class="questn-detail p-2">
                                                {!! $question->que_description !!}
                                            </div>
                                        @endif

                                        <ol type="A" class="mt-2">
                                            @foreach ($question->relatedOptions as $option_id => $option)
                                                <div class="form-check">
                                                    @if ($question->type == 'single_choice')
                                                        <input class="form-check-input que{{ $que_key + 1 }}Option"
                                                            type="radio" name="question[{{ $question->id }}]"
                                                            id="checkbox{{ $que_key }}-{{ $option->id }}"
                                                            value="{{ $option_id + 1 }}">
                                                        @if ($option->is_correct_answer == 1)
                                                            <input type="hidden" name="qr[{{ $question->id }}]"
                                                                value="{{ $option_id + 1 }}">
                                                        @endif
                                                    @else
                                                        <input class="form-check-input que{{ $que_key + 1 }}Option"
                                                            name="question[{{ $question->id }}][{{ $option->id }}]"
                                                            type="checkbox" value="{{ $option_id + 1 }}"
                                                            id="checkbox{{ $que_key }}-{{ $option->id }}">
                                                        @if ($option->is_correct_answer == 1)
                                                            <input type="hidden"
                                                                name="qr[{{ $question->id }}][{{ $option->id }}]"
                                                                value="{{ $option_id + 1 }}">
                                                        @endif
                                                    @endif
                                                    <label class="form-check-label"
                                                        for="checkbox{{ $que_key }}-{{ $option->id }}">
                                                        {{ $option->content }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </ol>
                                        <div class="text-sm-end text-center ms-auto pe-2 me-1">
                                            @if (!$loop->first)
                                                <a class="btn btn-outline-rose gap-2 nextPreQuestion " href="javascript:;"
                                                    data-queNo="{{ $que_key }}"><i
                                                        class="fas fa-chevron-left  align-self-center"></i>
                                                    @lang('global.button.previous')</a>
                                            @endif
                                            @if (!$loop->last)
                                                <a class="btn btn-outline-rose gap-2 nextPreQuestion" href="javascript:;"
                                                    data-queNo="{{ $que_key + 2 }}">@lang('global.button.next')<i
                                                        class="fas fa-chevron-right  align-self-center ms-1"></i></a>
                                            @else
                                                <a class="btn btn-outline-rose gap-2 submitQuizBtn"
                                                    href="javascript:;">@lang('global.button.submit')</a>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </form>
                        </div>
                    </section>
                </div>
                <div class="col-lg-5 col-12  mx-md-auto unit-content  sticky-course sticky-top ms-sm-auto px-sm-5"
                    style="top:10rem;">
                    <div class="col-12  ms-sm-auto">
                        <div class="quiz-numbers-left-section pt-0">
                            <div
                                class="d-flex course-content rounded-top py-3 justify-content-between px-2 d-none d-sm-flex">
                                <h6 id="headingCourseContentOne" class="course-content-heading px-2 align-self-center text-white">
                                    <span id="currentQueNo">1</span> of {{ count($questions) }} @lang('frontend.quiz_details.questions_text')
                                </h6>
                                <div class="progress-wrapper">
                                    <div class="progress-bar" role="progressbar"
                                        style="width: {{ round($courseUserDetail->progress) }}%" aria-valuenow="100"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                    <div class="d-flex py-1 justify-content-between">
                                        <span
                                            class="align-self-center progress-percentage text-white">{{ round($courseUserDetail->progress) }}%
                                        </span>
                                        <div class="dropdown">
                                            <button class="btn dropdown-toggle p-0 ms-2 progress-dropdown text-white" type="button"
                                                id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                                @lang('frontend.quiz_details.your_progress_title')
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                <li>
                                                    <div class="row d-flex align-items-center">
                                                        <div class="col ">
                                                            <p
                                                                class="dropdown-item d-flex justify-content-between my-auto ">
                                                                @lang('frontend.quiz_details.chapters_text')</p>
                                                        </div>
                                                        <div class="col ">
                                                            <p class=" my-auto">
                                                                {{ $courseStatistics['total_completed_units'] }}
                                                                of {{ $courseStatistics['total_units'] }}
                                                                @lang('frontend.quiz_details.complete_text').</p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <hr>
                                                <li>
                                                    <div class="row d-flex align-items-center">
                                                        <div class="col">
                                                            <p
                                                                class="dropdown-item d-flex justify-content-between my-auto">
                                                                @lang('frontend.quiz_details.test_text')</p>
                                                        </div>
                                                        <div class="col">
                                                            <p class=" my-auto">
                                                                {{ $courseStatistics['total_completed_quizzes'] }}
                                                                of {{ $courseStatistics['total_quizzes'] }}
                                                                @lang('frontend.quiz_details.complete_text').</p>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="quiz-numbers-left">
                                @php
                                    $minute = date('i', strtotime($quizDetails->time));
                                    $hours = date('H', strtotime($quizDetails->time));
                                    $seconds = date('s', strtotime($quizDetails->time));
                                @endphp
                                <div class="timerCount timer-count mt-4 row d-none d-sm-block" data-tenths="10"
                                    data-minute="{{ $minute }}" data-hours="{{ $hours }}"
                                    data-seconds="{{ $seconds }}">
                                    <div class="col-6 mx-auto">
                                        <div class="row countdownTimer">
                                            <div class="col-4 text-center" style="border-right: #e3e3e3 solid 1px;">
                                                <h3 class="mb-0 timerHours" style="color:#283034;font-weight: 600;"></h3>
                                                <span style="font-size: 14px; color: #383838;">@lang('frontend.quiz_details.hours_text')</span>
                                            </div>
                                            <div class="col-4 text-center" style="border-right: #e3e3e3 solid 1px;">
                                                <h3 class="mb-0 timerMinutes" style="color:#283034;font-weight: 600;">
                                                </h3>
                                                <span style="font-size: 14px; color: #383838;">@lang('frontend.quiz_details.minutes_text')</span>
                                            </div>
                                            <div class="col-4 text-center">
                                                <h3 class="mb-0 timerSeconds" style="color:#283034; font-weight: 600;">
                                                </h3>
                                                <span style="font-size: 14px; color: #383838;">@lang('frontend.quiz_details.seconds_text')</span>
                                            </div>
                                        </div>
                                        <div class="row expiredTimer" style="display: none;">
                                            <div class="col-12">@lang('frontend.quiz_details.quiz_has_expired_text')</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <ul class="question-number my-4 px-sm-4 px-2 mx-auto ">
                                        @foreach ($questions as $que_key => $question)
                                            <li><a href="javascript:;" id="queNo{{ $que_key + 1 }}"
                                                    class="nextPreQuestion queNoStats @if ($loop->first) selected @endif"
                                                    data-queNo="{{ $que_key + 1 }}">{{ $que_key + 1 }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <ul class="question-number d-flex align-items-lg-baseline justify-content-center">
                                    <a class="completed d-flex">
                                        <li class="align-self-center">
                                        </li>
                                        <span class="px-2 align-self-center">@lang('frontend.quiz_details.completed_text')</span>
                                    </a>
                                    <a class="selected d-flex">
                                        <li></li>
                                        <span class="px-2 align-self-center">@lang('frontend.quiz_details.selected_text')</span>
                                    </a>
                                    <a class="remaining d-flex">
                                        <li>
                                        </li>
                                        <span class="px-2 align-self-center">@lang('frontend.quiz_details.remaining_text')</span>
                                    </a>
                                </ul>
                            </div>
                            <a href="javascript:;" class="btn btn-rose w-100 submitQuizBtn mt-3">@lang('global.button.submit')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr style="opacity:.1;">
@endsection
@push('css')
    <link href="{{ asset('frontend-assets/files/css/flaticon.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend-assets/unit-page/quiz.css') }}" />
@endpush
@push('footer_scripts')
    <script>
        $(document).ready(function() {
            'use strict';

            $('.quiz-option').click(function() {
                $('.quiz-option').removeClass('selected-option');
                $(this).addClass('selected-option');
                $('.radio-control').removeAttr('checked');
                $(this).find(':input').attr('checked', true);
            });

            $(document).on('click', '.nextPreQuestion', function() {
                var queNo = $(this).attr('data-queNo');
                $('.quiz-questions').hide();
                $("#que" + queNo).show();
                $("#queNo" + queNo).addClass('selected');
                $("#currentQueNo").text(queNo);

                $(".queNoStats").each(function() {
                    var queNoStats = $(this);
                    var currentQueNo = queNoStats.attr('data-queNo');
                    queNoStats.removeClass('completed selected');
                    if (queNo == currentQueNo) {
                        queNoStats.addClass('selected');
                    }
                    var completed = false;
                    $(".que" + currentQueNo + "Option").each(function() {
                        if ($(this).prop('checked') == true) {
                            completed = true;
                        }
                    })
                    if (completed) {
                        queNoStats.addClass('completed');
                    }
                });
            });

            if ($(".timerCount").length > 0) {
                $(".timerCount").each(function() {
                    const hoursInput = parseInt($(this).attr("data-hours")),
                        minutesInput = parseInt($(this).attr("data-minute")),
                        secondsInput = parseInt($(this).attr("data-seconds"));
                    let totalSeconds; // global variable to count down total seconds
                    let self = $(this);

                    totalSeconds = (hoursInput * 60 * 60) + (minutesInput * 60) +
                    secondsInput; // Sets initial value of totalSeconds based on user input
                    self.find(".timerHours").text(getHours(totalSeconds));
                    self.find(".timerMinutes").text(getMinutes(totalSeconds));
                    self.find(".timerSeconds").text(getSeconds(totalSeconds));

                    setInterval(function() {
                        if (totalSeconds > 0) {
                            self.find(".timerHours").text(getHours(totalSeconds));
                            self.find(".timerMinutes").text(getMinutes(totalSeconds));
                            self.find(".timerSeconds").text(getSeconds(totalSeconds));
                            totalSeconds--;
                        } else {
                            self.find(".expiredTimer").show();
                            self.find(".countdownTimer").hide();
                            $("#quizForm").submit();
                        }
                    }, 1000);
                })


                // Defines functions that get the hours, minutes and seconds for display
                function getHours(totalSeconds) {
                    let hours = Math.floor(totalSeconds / 3600); // Gets quotient rounded down
                    return (hours < 10 ? "0" + hours : hours) // Inserts "0" if needed
                }

                function getMinutes(totalSeconds) {
                    let hours = Math.floor(totalSeconds / 3600); // get hours
                    let minutes = Math.floor((totalSeconds - (hours * 3600)) / 60); // Gets quotient rounded down
                    return (minutes < 10 ? "0" + minutes : minutes) // Inserts "0" if needed
                }

                function getSeconds(totalSeconds) {
                    let hours = Math.floor(totalSeconds / 3600); // get hours
                    let minutes = Math.floor((totalSeconds - (hours * 3600)) / 60); // Gets quotient rounded down
                    let seconds = totalSeconds - (hours * 3600) - (minutes * 60); // Gets remainder after division
                    return (seconds < 10 ? "0" + seconds : seconds) // Inserts "0" if needed
                }
            }

            $(".submitQuizBtn").click(function() {
                $("#quizForm").submit();
            })
        });
    </script>
@endpush
