@extends('front-end.layouts.master')
@section('content')
    @php
        $meta['meta_title'] = $course->meta_title ?? null;
        $meta['meta_description'] = $course->meta_description ?? null;
        $meta['meta_keywords'] = $course->meta_keywords ?? null;
        $meta['schema_script'] = $lessonDetail->schema_script ?? null;
    @endphp
    <div id="breadcrumb" class="division">
        <div class="container">
            <div class="row">
                @include('front-end.layouts.partials.flash_messages')
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a
                                    href="{{ route('home') }}">@lang('frontend.courses_details.breadcrumb_item.home')</a>
                            </li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('courses') }}">@lang('frontend.courses_details.breadcrumb_item.all_courses')</a>
                            </li>
                            <li class="breadcrumb-item active"
                                aria-current="page">@lang('frontend.courses_details.breadcrumb_item.course_details')</li>
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
                        <h3 class="h3-sm">{{ $course->name }}</h3>
                        <p class="p-md text-break">{{ $course->tiny_description }}</p>
                        @if (isset($course->instructor_id))
                            <p class="course-short-data">
                                @lang('frontend.courses_details.created_by_text'): {{ $course->instructorDetail->name }}
                            </p>
                        @endif
                        <div class="course-rating clearfix">
                            {!! getStarRatingHtml($course->average_rating) !!}
                            <span>{{ $course->average_rating }} ({{ $course->total_reviews }} @lang('frontend.courses_details.ratings_text')) &bull;
                                {{ $course->total_enrollments }} @lang('frontend.courses_details.students_enrolled_text')</span>
                        </div>
                        @if (!empty($course->what_you_will_learn_points))
                            <div class="what-you-learn">
                                <h5 class="h5-xl">@lang('frontend.courses_details.what_you_will_learn_title')</h5>
                                <div class="row">
                                    @foreach ($course->what_you_will_learn_points as $what_you_will_learn_point)
                                        <div class="col-lg-6">
                                            <ul class="txt-list">
                                                <li>{{ $what_you_will_learn_point }}</li>
                                            </ul>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        @if (!empty($course->requirements))
                            <div class="cs-requirements cd-block">
                                <h5 class="h5-xl">@lang('frontend.courses_details.requirements_title')</h5>
                                {!! $course->requirements !!}
                            </div>
                        @endif
                        @if (!empty($course->content))
                            <div class="cs-description cd-block">
                                <h5 class="h5-xl">@lang('frontend.courses_details.course_description_title')</h5>
                                {!! $course->content !!}
                            </div>
                        @endif
                        @if (!empty($course->who_this_course_is_for_points))
                            <div class="cs-target cd-block">
                                <h5 class="h5-xl">@lang('frontend.courses_details.who_this_course_is_for_title'):</h5>
                                <ul class="txt-list">
                                    @foreach ($course->who_this_course_is_for_points as $who_this_course_is_for_point)
                                        <li>{{ $who_this_course_is_for_point }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (count($sections) > 0)
                            <div class="cs-content cd-block">
                                <h5 class="h5-xl">@lang('frontend.courses_details.course_content_title')</h5>
                                <p class="p-md">Level {{ $course->course_level }} &bull; {{ $totalLessons }} @lang('frontend.courses_details.lectures_text')
                                    &bull; {{ getTotalCourseHours($course->time) }}</p>
                                <div id="accordion" role="tablist">
                                    @foreach ($sections as $section)
                                        <div class="card">
                                            <div class="card-header" role="tab" id="heading{{ $section->id }}">
                                                <h5 class="h5-xs">
                                                    <a @if (!$loop->first) class="collapsed" @endif
                                                    data-bs-toggle="collapse" href="#collapse{{ $section->id }}"
                                                       role="button" aria-expanded="{{ $loop->first }}"
                                                       aria-controls="collapse{{ $section->id }}">
                                                        {{ $section->name }}
                                                    </a>
                                                </h5>
                                                <div class="hdr-data">
                                                    <p>{{ count($section->getSectionChildData) }}
                                                        lectures, {{ $section->time }} min</p>
                                                </div>
                                            </div>
                                            <div id="collapse{{ $section->id }}"
                                                 class="collapse @if ($loop->first) show @endif"
                                                 role="tabpanel" aria-labelledby="heading{{ $section->id }}"
                                                 data-bs-parent="#accordion">
                                                <div class="card-body">
                                                    @foreach ($section->getSectionChildData as $lesson)
                                                    <p class="cb-video">
                                                        @if ($lesson->curriculum_type == 'quiz')
                                                            <i class="fas fa-solid fa-question-circle"></i>
                                                        @else
                                                            <i class="fas fa-play-circle"></i>
                                                        @endif
                                                            {{ $lesson->name }}
                                                    </p>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if(count($course->relatedFaqs) > 0)
                            <div class="cs-content cd-block">
                                <h5 class="h5-xl">@lang('frontend.courses_details.faqs_title')</h5>
                                <div id="faqaccordion" role="tablist">
                                    @foreach($course->relatedFaqs as $faq)
                                        <div class="card mb-2">
                                            <div class="card-header" role="tab" id="faqheading{{ $faq->id }}">
                                                <h5 class="h5-xs">
                                                    <a class="collapsed"
                                                       data-bs-toggle="collapse" href="#faqcollapse{{ $faq->id }}"
                                                       role="button" aria-expanded=""
                                                       aria-controls="faqcollapse{{ $faq->id }}">
                                                        {{ $faq->question }}
                                                    </a>
                                                </h5>
                                            </div>
                                            <div id="faqcollapse{{ $faq->id }}"
                                                 class="collapse "
                                                 role="tabpanel" aria-labelledby="faqheading{{ $faq->id }}"
                                                 data-bs-parent="#faqaccordion">
                                                <div class="card-body">
                                                    {!! $faq->answer !!}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        @if(count($course->relatedInterviewQuestions) > 0)
                        <div class="cs-content cd-block">
                            <h5 class="h5-xl">@lang('frontend.courses_details.interview_questions_title')</h5>
                            <div id="intaccordion" role="tablist">
                                @foreach($course->relatedInterviewQuestions as $int_que)
                                    <div class="card mb-2">
                                        <div class="card-header" role="tab" id="intheading{{ $int_que->id }}">
                                            <h5 class="h5-xs">
                                                <a class="collapsed"
                                                   data-bs-toggle="collapse" href="#intcollapse{{ $int_que->id }}"
                                                   role="button" aria-expanded=""
                                                   aria-controls="intcollapse{{ $int_que->id }}">
                                                    {{ $int_que->question }}
                                                </a>
                                            </h5>
                                        </div>
                                        <div id="intcollapse{{ $int_que->id }}"
                                             class="collapse "
                                             role="tabpanel" aria-labelledby="intheading{{ $int_que->id }}"
                                             data-bs-parent="#intaccordion">
                                            <div class="card-body">
                                                {!! $int_que->answer !!}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                        {{--live sessions--}}
                        @if(count($liveLessonSlots) > 0)
                            <div class="cs-rating cd-block">
                                <h5 class="h5-xl">@lang('frontend.courses_details.live_lessons_title')</h5>
                                <div class="session-table">
                                    <div class="row px-3 pt-2 mx-0" style="background-color: #c1c1c1;opacity: .9;">
                                        <div class="col-3  text-center">
                                            <h6>@lang('frontend.courses_details.date_label')</h6>
                                        </div>
                                        <div class="col-3 text-center">
                                            <h6>@lang('frontend.courses_details.time_label')</h6>
                                        </div>
                                        <div class="col-3 text-center">
                                            <h6>@lang('frontend.courses_details.mode_label')</h6>
                                        </div>
                                        <div class="col-3 text-center">
                                            <h6>@lang('frontend.courses_details.action_label')</h6>
                                        </div>
                                    </div>
                                    @foreach($liveLessonSlots as $liveLessonSlot)
                                        <hr class="m-0">
                                        <div class="row px-3 py-2">
                                            <div class="col-3 text-center">
                                                <span>{{ formatDate($liveLessonSlot->start_at, 'd/m/Y') }}</span>
                                            </div>
                                            <div class="col-3 text-center">
                                                <span>{{ formatDate($liveLessonSlot->start_at, 'h:i A') }}</span>
                                            </div>
                                            <div class="col-3 text-center">
                                                <span>@lang('frontend.courses_details.online_text')</span>
                                            </div>
                                            <div class="col-3 text-center">
                                                @if($liveLessonSlot->remaining_seats == 0)
                                                    <a href="javascript:;"
                                                       class="btn btn-md btn-black tra-grey-hover py-1 px-4">@lang('frontend.courses_details.full_text')</a>
                                                @elseif(count($liveLessonSlot->slotUsers) > 0)
                                                    <a href="javascript:;"
                                                       class="btn btn-md btn-black tra-grey-hover py-1 px-4">@lang('frontend.courses_details.already_in_text')</a>
                                                @else
                                                    <a href="javascript:;"
                                                       class="optInLiveLesson btn btn-md btn-rose tra-black-hover-hover py-1 px-4"
                                                       data-id="{{ $liveLessonSlot->id }}" data-btn_text="Already In">@lang('frontend.courses_details.opt_in_text')</a>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        {{--live sessions--}}


                        <div class="cs-rating cd-block">
                            <h5 class="h5-xl">@lang('frontend.courses_details.course_reviews_title')</h5>
                            @lang('frontend.courses_details.course_reviews_note')

                            <div class="course-rating">
                                {!! getStarRatingHtml($course->average_rating) !!}
                                <span class="cr-rating">{{ $course->average_rating }} @lang('frontend.courses_details.based_on_text')
                                    {{ $course->total_reviews }} @lang('frontend.courses_details.reviews_text')</span>
                            </div>
                            <div class="row d-flex align-items-center">
                                <div class="col-md-9 col-xl-7">
                                    <div class="cs-rating-data">
                                        <ul>
                                            @foreach ($ratingsArray as $rating)
                                                <li class="barWrapper clearfix">
                                                    <div class="ratingtext-right">
                                                        <p class="p-sm">{{ $rating['rating'] }} @lang('frontend.courses_details.stars_text')</p>
                                                    </div>
                                                    <div class="progress-wrapper">
                                                        <div class="progress-bar" role="progressbar"
                                                             style="width: {{ $rating['percent'] }}%"
                                                             aria-valuenow="{{ $rating['percent'] }}" aria-valuemin="0"
                                                             aria-valuemax="100"></div>
                                                    </div>
                                                    <div class="ratingtext-left">
                                                        <p class="p-sm">{{ $rating['percent'] }}%</p>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @foreach ($reviews->take(15) as $review)
                            <div class="review-4">
                                <div class="review-4-txt">
                                    <p>{{ $review->comment }}</p>
                                    <div class="review-4-author d-flex align-items-center">
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
                                            {{-- <span>Software Engineer</span> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div> <!-- END COURSE DESCRIPTION -->
                <div class="col-lg-4">
                    <div class="course-data sticky-course-card">

                        <div class="play-btn play-btn-rose text-center">
                            @if(!empty($course->intro_video_url))
                                @php $intro_url = !empty($course->intro_video_provider) && ($course->intro_video_provider == 'video_file') ? getFileUrl($course->intro_video_url, 'course/video') : $course->intro_video_url; @endphp
                            <a class="video-popup3 video-play-button" href="{{ $intro_url }}">
                                <span></span>
                            </a>
                            @endif
                            <img class="img-fluid"
                                 src="{{ isset($course->intro_thumbnail_image) ? getFileUrl($course->intro_thumbnail_image, 'course/thumbnail_images') : getFileUrl($course->image, 'course/images') }}"
                                 alt="video-preview">
                        </div>
                        <div class="course-data-price text-center">
                            @if (!empty($courseUserDetail) && $courseUserDetail->paid_status == 0 && $courseUserDetail->subscription_payment == 1)
                                @lang('frontend.courses_details.subscription_active_text')
                            @elseif(!empty($courseUserDetail) && $courseUserDetail->paid_status == 1)
                                @lang('frontend.courses_details.already_paid_text')
                            @elseif($course->is_free == 1)
                                @lang('frontend.courses_details.free_course_text')
                            @elseif($course->discount_flag == 1)
                                {{ formatPrice($course->discounted_price) }}<span
                                    class="old-price">{{ formatPrice($course->price) }}</span>
                            @else
                                {{ formatPrice($course->price) }}
                            @endif
                        </div>
                        @if (count($sections) > 0)
                            <div class="course-data-links">
                                @if (!auth()->check())
                                    <a href="{{ route('login') }}"
                                       class="btn btn-md btn-rose tra-black-hover ">@lang('frontend.courses_details.start_course_now_button')</a>
                                @elseif(($course->is_free == 0) && empty($courseUserDetail))
                                    <a href="{{ route('payment.course', $course->slug) }}"
                                       class="btn btn-md btn-rose tra-black-hover ">@lang('frontend.courses_details.start_course_now_button')</a>
                                @else
                                    <form method="POST" action="{{ route('course_status') }}">
                                        @csrf
                                        <input type="hidden" name="course_id" value="{{ $course->id }}">
                                        <button class="btn btn-md btn-rose tra-black-hover ">
                                            @if (empty($courseUserDetail))
                                                @lang('frontend.courses_details.start_course_now_button')
                                            @else
                                                @lang('frontend.courses_details.continue_course_button')
                                            @endif
                                        </button>
                                    </form>
                                @endif
                                @if(empty($courseUserDetail) && $course->subscription_flag == 1)
                                    <a href="{{ route('subscription_payment.course', $course->slug) }}" class="btn btn-md btn-tra-grey rose-hover">
                                        {!! __('frontend.courses_details.subscription', ['price' => formatPrice($course->subscription_price), 'interval_count' => $course->subscription_interval_count, 'interval' => $course->subscription_interval, 'installment_count' => $course->subscription_installment_count,]) !!}</a>


                                @endif
                                <div class="">
                                    <a href="javascript:;" class="btn btn-md  btn-tra-rose rose-hover  openPreviewImageModal"><i class="fas fa-share-alt mx-2"></i>@lang('frontend.courses_details.share_this_course_button')</a></div>
                            </div>
                        @endif
                        <div class="course-data-list">
                            <span>@lang('frontend.courses_details.this_course_includes_text'):</span>
                            <p><i class="far fa-play-circle"></i> {{ getTotalCourseHours($course->time) }}
                                @lang('frontend.courses_details.on_demand_video_note')</p>
                            @lang('frontend.courses_details.this_course_includes_note')

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if (count($relatedCourses) > 0)
        <section id="courses-5" class="bg-whitesmoke courses-section division">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title mb-60">
                            <h4 class="h4-xl"> @lang('frontend.courses_details.browse_similar_courses_title')</p></h4>
                            @lang('frontend.courses_details.browse_similar_courses_note')

                            <div class="title-btn">
                                <a href="{{ route('courses') }}" class="btn btn-tra-grey rose-hover">
                                    @lang('frontend.courses_details.view_all_courses_button') </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($relatedCourses as $relatedCourse)
                        <div class="col-lg-6">
                            @include('front-end.course.horizontal_course_card', [
                                'course' => $relatedCourse,
                            ])
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    {{-- share modal body--}}
    <div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true" style=";">
        <div class="modal-dialog modal-dialog-centered">
            @php $url = route('course_detail', request('slug')); @endphp
            <div class="modal-content">
                <button type="button" class="close d-flex ms-auto close-btn px-3 py-0" data-dismiss="modal" aria-hidden="true">×</button>
                <div class="modal-body py-0 text-center">
                    <h4 class="modal-title text-center  text-dark" id="referalModalLabel">@lang('frontend.courses_details.share_with_your_friends_title')</h4>
                    <p class="fw-normal mb-0 mt-3 ps-1">@lang('frontend.courses_details.copy_this_link_and_share_text')</p>
                    <div class=" rounded-right mb-3 mt-2">
                        <div class="link-div refer-link-form d-inline-flex justify-content-between align-items-center">
                            <a href="javascript:;">{{ $url }}</a>
                            <button class="btn ps-3" type="button" onclick="copyToClipboard($(this),'{{ $url }}')" data-bs-toggle="button" autocomplete="off" aria-pressed="false">
                                <i class="fas fa-copy me-1 fa-border-left"></i><span class="fw-normal"></span>
                                <span class="copied-txt">@lang('frontend.courses_details.copied_text')</span>
                            </button>
                        </div>
                        <p class="text-center mt-3 mx-auto mb-0">@lang('frontend.courses_details.share_via_button')</p>
                        <div class="col-12 text-center  achievement-socials d-flex align-items-center justify-content-center">
                            <a class="m-2 dl-user-dashboard-social-btn" target="_blank"
                               href="https://www.facebook.com/sharer/sharer.php?kid_directed_site=0&sdk=joey&u={{ $url }}&display=popup&ref=plugin&src=share_button">
                                <i class="fab fa-facebook-f d-flex"></i>
                            </a>
                            <a class="m-2 dl-user-dashboard-social-btn" target="_blank" href="javascript:;" onclick="window.open('https://wa.me/?text={{ $url }}')">
                                <i class="fab fa-whatsapp d-flex"></i>
                            </a>
                            <a class="m-2 dl-user-dashboard-social-btn" target="_blank" href="" onclick="mailShare('{{auth()->user()->email ?? null}}','{{ config('app.name') }}', '{{ $url }}')">
                                <i class="far fa-envelope d-flex"></i>
                            </a>
                            <a class="m-2 dl-user-dashboard-social-btn" target="_blank" href="javascript:;" onclick="window.open('https://www.linkedin.com/sharing/share-offsite/?url={{ $url }}')">
                                <i class="fab fa-linkedin-in d-flex"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{--end of share modal body--}}
@endsection
@push('footer_scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            'use strict';

            $(document).on('click', '.optInLiveLesson', function () {
                var self = $(this);
                self.prop('disabled', true);
                self.removeClass('optInLiveLesson');
                self.text(self.data('btn_text')).addClass('btn-black').removeClass('btn-rose');
                var dataValue = {slot_id: self.data('id')}
                $.ajax({
                    url: $app_url + '/live-lesson-slot-attend',
                    method: 'post',
                    dataType: 'json',
                    data: dataValue,
                    success: function (data) {
                        self.prop('disabled', false);
                    }
                })
            })

            $(document).on('click', '.openPreviewImageModal', function () {
                $("#previewModal").modal('show');
            })
            $(document).on('click', '.close', function () {
                $("#previewModal").modal('hide');
            })
        })

        function copyToClipboard(self, text) {
            var textField = document.createElement('textarea');
            textField.innerText = text;
            document.body.appendChild(textField);
            textField.select();
            textField.focus();
            document.execCommand('copy');
            textField.remove();
            self.find('.copied-txt').show();
            setTimeout(function () {
                self.find('.copied-txt').hide();
            }, 500);
        }

        function mailShare(email = null, subject, body) {
            var mailToLink = "mailto:" + email + "?Subject=" + subject + "&body=" + encodeURIComponent(body);
            window.open(mailToLink);
        }
    </script>
@endpush
