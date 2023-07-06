@extends('front-end.layouts.master')
@section('content')
    @php
        $meta['meta_title'] = $webinarDetails->meta_title ?? null;
        $meta['meta_description'] = $webinarDetails->meta_description ?? null;
        $meta['meta_keywords'] = $webinarDetails->meta_keywords ?? null;
    @endphp
    <div id="breadcrumb" class="division">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('frontend.webinars.breadcrumb_item.home')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">@lang('frontend.webinars.breadcrumb_item.webinar_details')</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row d-flex align-items-start">
            <div class="col-lg-7 col-12">
                <section class="ncp-desktop-s1  my-4" id="Overview">
                    <div class="m-order d-none d-lg-block">
                        <p class="webinar-text mb-1">@lang('frontend.webinars.webinar_topic_title')</p>
                        <h3 class="section-heading  h3-sm">{{ $webinarDetails->name }}</h3>
                    </div>
                    @if(isset($webinarDetails->short_description))
                        <p>{{ $webinarDetails->short_description }}</p>
                    @endif
                    <div class="row webinar-info pt-5 pb-4">
                        <div class="col-6 pe-0 trainer-one">
                            <h5 class="heading-blue">@lang('frontend.webinars.teacher_label')</h5>
                            <div class="d-flex">
                                <img src="{{ getFileUrl($webinarDetails->instructorDetail->image ?? 'default-placeholder.jpg', 'users')  }}"
                                     alt="{{ $webinarDetails->instructorDetail->name }}" width="50"
                                     height="50">
                                <div class="trainer-info ps-3">
                                    <span class="semi-bold">{{ $webinarDetails->instructorDetail->name }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <h5 class="heading-blue">@lang('frontend.webinars.date_time_label')</h5>
                            <p class="semi-bold my-2"><i
                                    class="far fa-calendar"></i> {{ formatDate($webinarDetails->start_at, 'd M, Y') }}
                            </p>
                            <p class="my-2 fw-9"><i
                                    class="fas fa-clock"></i> {{ formatDate($webinarDetails->start_at, 'h:i A') }}
                                @lang('frontend.webinars.onwards_text')</p>
                        </div>
                    </div>
                </section>
                @if(!empty($webinarDetails->description))
                    <section class="ncp-desktop-s2 my-2 my-sm-5" id="course-overview">
                        <div class="course-overview">
                            <h4 class="heading-blue">@lang('frontend.webinars.about_the_webinar_title')</h4>
                            {!! $webinarDetails->description !!}
                        </div>
                    </section>
                @endif
            </div>

            <div class="col-lg-5 col-12 webinar-video row sticky-course sticky-top ms-sm-auto mx-auto">
                <div class="m-order d-lg-none d-block mt-3">
                    <p class="webinar-text mb-1">@lang('frontend.webinars.webinar_topic_title')</p>
                    <h3 class="section-heading  h3-sm">{{ $webinarDetails->name }}</h3>
                </div>
                <div class="card px-0">
                    <div class="play-btn play-btn-rose text-center">
                        @if(isset($webinarDetails->intro_video_url))
                            <a class="video-popup3 video-play-button" href="{{ $webinarDetails->intro_video_url }}">
                                <span></span>
                            </a>
                        @endif
                        <img class="img-fluid" src="{{ getFileUrl($webinarDetails->image, 'webinar') }}"
                             alt="video-preview">
                    </div>
                    <div class="p-2">
                        @if(new DateTime() > new DateTime($webinarDetails->start_at) && new DateTime() < new DateTime($webinarDetails->end_at))
                            <div class="row my-2 webinar-details">
                                <div class="col-4 d-flex gap-2 align-items-center webinar-meta">
                                <span class="semi-bold"><img
                                        src="{{ asset('frontend-assets/images/unit-page/vedio.svg')}}" alt=""
                                        class="svg-img"></span>
                                    <div class=" align-self-center">
                                        <p class="mb-0">@lang('frontend.webinars.webinar_text')</p>
                                        <a href="javascript:;"
                                           class="btn btn-red-live me-auto py-0 justify-content-center px-3">
                                            <span class="btn-live-webinar ">@lang('frontend.webinars.Live_text')</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-4 d-flex gap-2 align-items-center view-meta">
                                <span class="semi-bold"><img
                                        src="{{ asset('frontend-assets/images/unit-page/people.svg')}}" alt=""
                                        class="svg-img"></span>
                                    <div class=" align-self-center">
                                        <p class="mb-0">@lang('frontend.webinars.total_students_title')</p>
                                        <h6 class="fw-bold">{{ $webinarDetails->total_enrollments }}</h6>
                                    </div>
                                </div>
                                <div class="col-4 d-flex gap-2 align-items-center time-meta">
                                <span class="semi-bold"><img
                                        src="{{ asset('frontend-assets/images/unit-page/bx_time-five.svg')}}"
                                        alt="" class="svg-img"></span>
                                    <div class=" align-self-center">
                                        <p class="mb-0">@lang('frontend.webinars.duration_title')</p>
                                        <h6 class="fw-bold">{{ getMinutesToHour($webinarDetails->duration) }} @lang('frontend.webinars.hrs_text')</h6>
                                    </div>
                                </div>
                            </div>
                        @elseif(new DateTime() < new DateTime($webinarDetails->start_at))
                            <div class="row my-2 webinar-details">
                                <div class="col-8 d-flex gap-2 align-items-center webinar-meta">
                                <span class="semi-bold"><img
                                        src="{{ asset('frontend-assets/images/unit-page/vedio.svg')}}" alt=""
                                        class="svg-img"></span>
                                    <div class="align-self-start">
                                        <p class="mb-0">@lang('frontend.webinars.webinar_text')</p>
                                        <h6 class="fw-bold">@lang('frontend.webinars.Live_in_text')
                                            <span class="deals_timer_box text-danger text-start w-100"
                                                  data-target-time="{{date('M d, Y H:i:s',strtotime($webinarDetails->start_at))}}">
                                                <span class="deals_timer_days"></span> @lang('frontend.webinars.days_text')
                                                <span class="deals_timer_hr"></span>:<span
                                                    class="deals_timer_min"></span>:<span
                                                    class="deals_timer_sec"></span> @lang('frontend.webinars.hours_text')
                                            </span>
                                        </h6>
                                    </div>
                                </div>
                                <div class="col-4 d-flex gap-2 align-items-center view-meta">
                                <span class="semi-bold"><img
                                        src="{{ asset('frontend-assets/images/unit-page/people.svg')}}" alt=""
                                        class="svg-img"></span>
                                    <div class="align-self-center">
                                        <p class="mb-0">@lang('frontend.webinars.total_students_title')</p>
                                        <h6 class="fw-bold">{{ $webinarDetails->total_enrollments }}</h6>
                                    </div>
                                </div>
                            </div>
                        @elseif(new DateTime() > new DateTime($webinarDetails->end_at))
                            <div class="row my-2 webinar-details">
                                <div class="col-4 d-flex gap-2 align-items-center webinar-meta pe-0">
                                <span class="semi-bold"><img
                                        src="{{ asset('frontend-assets/images/unit-page/vedio.svg')}}" alt=""
                                        class="svg-img"></span>
                                    <div class="align-self-start">
                                        <p class="mb-0">@lang('frontend.webinars.webinar_text')</p>
                                        <h6 class="fw-bold">@lang('frontend.webinars.pre_recorded_text')</h6>
                                    </div>
                                </div>
                                <div class="col-4 d-flex gap-2 align-items-center view-meta">
                                <span class="semi-bold"><img
                                        src="{{ asset('frontend-assets/images/unit-page/people.svg')}}" alt=""
                                        class="svg-img"></span>
                                    <div class="align-self-center">
                                        <p class="mb-0">@lang('frontend.webinars.total_students_title')</p>
                                        <h6 class="fw-bold">{{ $webinarDetails->total_enrollments }}</h6>
                                    </div>
                                </div>
                                <div class="col-4 d-flex gap-2 align-items-center time-meta">
                                <span class="semi-bold"><img
                                        src="{{ asset('frontend-assets/images/unit-page/bx_time-five.svg')}}"
                                        alt="" class="svg-img"></span>
                                    <div class=" align-self-center">
                                        <p class="mb-0">@lang('frontend.webinars.duration_title')</p>
                                        <h6 class="fw-bold">{{ getMinutesToHour($webinarDetails->duration) }} @lang('frontend.webinars.hrs_text')</h6>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="course-data-links">
                            @if(!auth()->check())
                                <a href="{{ route('login') }}"
                                   class="btn btn-md btn-rose tra-grey-hover">@lang('frontend.webinars.enroll_now_text')</a>
                            @elseif(empty($webinarUser))
                                <form method="POST" action="{{ route('enroll_webinar') }}">
                                    @csrf
                                    <input type="hidden" name="webinar_id" value="{{ $webinarDetails->id }}">
                                    <button class="btn btn-md btn-rose tra-grey-hover">
                                        @lang('frontend.webinars.enroll_now_text')
                                    </button>
                                </form>
                            @elseif(isset($webinarUser) && (new DateTime() < new DateTime($webinarDetails->start_at)))
                                <a href="javascript:;" class="btn btn-md btn-rose tra-grey-hover"
                                   style="cursor: default;">@lang('frontend.webinars.will_start_on_text')
                                    {{ date('h:i A \o\n jS M',strtotime($webinarDetails->start_at))}}</a>
                            @else
                                <a href="{{ route('webinar_live_stream', $webinarDetails->slug) }}" class="btn btn-md btn-rose tra-grey-hover"
                                   style="cursor: default;">@lang('frontend.webinars.join_now_text')</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(count($relatedCourses) > 0)
            <section class="ncp-desktop-s10 my-2 my-sm-5 ">
                <div class="recommended-courses py-3">
                    <h4 class="py-2 heading-blue fw-bold">@lang('frontend.webinars.recommended_course_related_to_this_webinar_text')</h4>
                    <div class="owl-carousel owl-theme owl-loaded courses-carousel my-4" id="course-slides">
                        @foreach($relatedCourses as $course)
                            @include('front-end.course.vertical_course_card', ['course' => $course])
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
        @if(count($pastWebinars) > 0)
            <section class=" my-2 my-sm-5">
                <h4 class="py-2 heading-black fw-bold">@lang('frontend.webinars.other_past_webinars_text')</h4>
                <div class="owl-carousel owl-theme webinar-carousel owl-loaded owl-drag py-3" id="pastWebinars">
                    @foreach($pastWebinars as $webinar)
                        <a href="{{ route('webinar_detail', $webinar->slug) }}">
                            <div class="item text-white me-3">
                                <div class="sbox-5 bg-05">
                                    <div class="sbox-5-txt">
                                        <h4 class="h5-md text-white">{{ $webinar->name }}</h4>
                                        <p class="grey-color text-white me-2 py-2 "><i class="fas fa-user "></i><span
                                                class="ms-2 text-white">{{ $webinar->instructorDetail->name }}</span>
                                        </p>
                                        <p class=" py-2"><i
                                                class="fas fa-calendar-alt me-2"></i>{{ formatDate($webinar->start_at, 'd M, Y') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend-assets/unit-page/webinar.css') }}"/>
@endpush
@push('footer_scripts')
    <script type="text/javascript">
        $(function () {
            'use strict';
            initWebinarCountdown();
        });

        function initWebinarCountdown() {
            if ($('.deals_timer_box').length) {
                var timers = $('.deals_timer_box');
                timers.each(function () {
                    var timer = $(this);
                    var targetTime;
                    var target_date;
                    if (timer.data('target-time') !== "") {
                        targetTime = timer.data('target-time');
                        target_date = new Date(targetTime).getTime();
                    } else {
                        var date = new Date();
                        date.setDate(date.getDate() + 2);
                        target_date = date.getTime();
                    }

                    // variables for time units
                    var days, hours, minutes, seconds;

                    var d = timer.find('.deals_timer_days');
                    var h = timer.find('.deals_timer_hr');
                    var m = timer.find('.deals_timer_min');
                    var s = timer.find('.deals_timer_sec');

                    setInterval(function () {
                        // find the amount of "seconds" between now and target
                        var current_date = new Date().getTime();
                        var seconds_left = (target_date - current_date) / 1000;

                        if (seconds_left > 0) {
                            days = parseInt(seconds_left / 86400);
                            seconds_left = seconds_left % 86400;

                            hours = parseInt(seconds_left / 3600);

                            seconds_left = seconds_left % 3600;


                            minutes = parseInt(seconds_left / 60);
                            seconds = parseInt(seconds_left % 60);

                            if (days.toString().length < 2) {
                                days = "0" + days;
                            }

                            if (hours.toString().length < 2) {
                                hours = "0" + hours;
                            }
                            if (minutes.toString().length < 2) {
                                minutes = "0" + minutes;
                            }
                            if (seconds.toString().length < 2) {
                                seconds = "0" + seconds;
                            }

                            // display results
                            d.text(days);
                            h.text(hours);
                            m.text(minutes);
                            s.text(seconds);
                            // Show join now button before 5 minutes of webinar start time.
                            if (days == 0 && hours == 0 && minutes < 5) {
                                $('.joinNowEnable').show();
                                $('.willStartTimer').hide();
                            }
                        } else {
                            d.text('00');
                            h.text('00');
                            m.text('00');
                            s.text('00');
                        }
                    }, 1000);
                });
            }
        }
    </script>
@endpush
