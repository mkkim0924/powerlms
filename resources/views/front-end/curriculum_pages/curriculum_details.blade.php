@extends('front-end.layouts.master')
@section('content')
    <div id="breadcrumb" class="division">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a
                                    href="{{ route('home') }}">@lang('frontend.curriculum_details.breadcrumb_item.home')</a>
                            </li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('course_detail', $course->slug) }}">{{ $course->name }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                {{ ucfirst($curriculumDetails->curriculum_type) }} @lang('frontend.curriculum_details.breadcrumb_item.details')
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container" id="unit-left-section">
        <div class="row d-flex align-items-start pb-5">
            <div class="col-12 col-lg-7" id="unit-left-col">
                <section class="unit-meta unit-inner-section py-4">
                    <div class="row">
                        <div class="col-9 col-lg-12">
                            <h3>{{ $lessonDetail->name }}</h3>
                        </div>
                        <div class="col-3 ps-0 d-block d-lg-none">
                            <div class="d-flex align-items-center">
                                <div class="progress-circle blue ms-auto"
                                     data-value="{{ round($courseUserDetail->progress) }}">
                                    <span class="progress-left"><span class="progress-bar-circle"></span></span>
                                    <span class="progress-right"><span class="progress-bar-circle"></span></span>
                                    <div
                                        class="progress-value courseProgressText">{{ round($courseUserDetail->progress) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                @if ($curriculumDetails->curriculum_type == 'unit')
                    <section class="unit-desktop-s1">
                        @if ($lessonDetail->lesson_type == 'youtube')
                            <iframe id="youtubeIframe" class="video-size"
                                    src="{{ $lessonDetail->lesson_media_url }}?enablejsapi=1"
                                    title="YouTube video player"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                        @elseif($lessonDetail->lesson_type == 'vimeo')
                            <iframe id="vimeoIframe" src="{{ $lessonDetail->lesson_media_url }}?controls=1"
                                    class="video"
                                    width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen
                                    allowfullscreen></iframe>
                        @elseif(in_array($lessonDetail->lesson_type, ['video_file', 'video_url']))
                            <video id="lessonJsVideo"
                                   class="video-js video-player-styled vjs-big-play-centered vjs-16-9"
                                   controls preload="auto" responsive=true
                                   data-setup='{"fluid": true, "playbackRates": [0.5, 0.75, 1, 1.5, 1.75,2]}'
                                   poster="{{ isset($lessonDetail->lesson_thumbnail_image) ? getFileUrl($lessonDetail->lesson_thumbnail_image, 'unit/thumbnail_images') : '' }}">
                                <source
                                    src="{{ ($lessonDetail->lesson_type == 'video_file') ? getFileUrl($lessonDetail->lesson_media_url, 'unit/media') : $lessonDetail->lesson_media_url }}"
                                    type="video/mp4"/>
                                @lang('frontend.curriculum_details.update_note')

                            </video>
                        @endif
                    </section>
                    @if ($lessonDetail->lesson_type == 'document' && $lessonDetail->lesson_document_type == 'download_file')
                        <div class="row">
                            <div class="p-5 d-flex justify-content-center align-items-center"
                                 style="background-color: #b1b1b157;">
                                <a href="{{ getFileUrl($lessonDetail->lesson_media_url, 'unit/media') }}" download
                                   class=" text-center"> <span
                                        class=" btn btn-rose">@lang('frontend.curriculum_details.download_button')</span></a>
                            </div>
                        </div>
                    @elseif ($lessonDetail->lesson_type == 'document' && $lessonDetail->lesson_document_type == 'pdf')
                        <div id="pdfDiv" style="height: 841px; width: 595px; margin: auto;"></div>
                    @elseif($lessonDetail->lesson_type == 'document')
                        <iframe
                            src="https://docs.google.com/gview?url={{ getFileUrl($lessonDetail->lesson_media_url, 'unit/media') }}&embedded=true"
                            frameborder="0" style="width: 100%;height: 500px;">
                        </iframe>
                    @endif
                    <div class="row">
                        <div class="col-12 mt-4">
                            <div class="text-sm-end ms-auto pe-2 me-1 d-flex justify-content-between text-center">
                                @if (isset($pagination['prev']))
                                    <a class="btn btn-outline-rose gap-2" id="prevBtn"
                                       href="{{ route('curriculum_detail', [$pagination['prev']['course_slug'], $pagination['prev']['curriculum_slug']]) }}"><i
                                            class="fas fa-chevron-left align-self-center"></i>
                                        @lang('global.button.previous')</a>
                                @endif
                                @if (isset($pagination['next']))
                                    <a class="btn btn-outline-rose gap-2  @if(session('display_type')=='rtl') me-auto @else ms-auto @endif "
                                       id="nextBtn"
                                       href="{{ route('curriculum_detail', [$pagination['next']['course_slug'], $pagination['next']['curriculum_slug']]) }}"> @lang('global.button.next')
                                        <i
                                            class="fas fa-chevron-right align-self-center"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                @else
                    <section class="quiz-landing-section">
                        <div class="row py-3">
                            <div class="col-12 text-center">
                                <h5 class="fw-normal">@lang('frontend.curriculum_details.start_test_title')</h5>
                                <div class="quiz-meta d-flex my-2 py-4">
                                    <div
                                        class="col-6 quiz-time  px-sm-3 px-1  @if(session('display_type')=='rtl') text-start @else text-end @endif">
                                        <i class="far fa-clock"></i>
                                        <span>{{ $lessonDetail->time }} @lang('frontend.curriculum_details.mins_text')</span>
                                    </div>
                                    <div class="col-6 quiz-time border-left px-sm-3 px-1">
                                        <span>@lang('frontend.curriculum_details.total_questions_title'): {{ count($lessonDetail->relatedQuestions) }}</span>
                                    </div>
                                </div>
                                <div class="text-sm-end d-flex justify-content-center mb-5 gap-2">
                                    <div
                                        class="col-6 @if(session('display_type')=='rtl') text-start @else text-end @endif ">
                                        @if (!empty($quizUserDetails))
                                            @if($reAttemptBtnEnable)
                                                <a class="btn btn-rose"
                                                   href="{{ route('quiz_details', [$curriculumDetails->course_slug, $curriculumDetails->curriculum_slug]) }}">
                                                    @lang('frontend.curriculum_details.reattempt_now_button')</a>
                                            @endif
                                        @else
                                            <a class="btn btn-rose"
                                               href="{{ route('quiz_details', [$curriculumDetails->course_slug, $curriculumDetails->curriculum_slug]) }}">
                                                @lang('frontend.curriculum_details.start_test_button')</a>
                                        @endif
                                    </div>
                                    @if (isset($pagination['next']))
                                        <div
                                            class="col-6  @if(session('display_type')=='rtl') text-end @else text-start @endif">
                                            <a class="btn btn-outline-rose px-sm-3 px-1"
                                               href="{{ route('curriculum_detail', [$pagination['next']['course_slug'], $pagination['next']['curriculum_slug']]) }}">
                                                @lang('frontend.curriculum_details.continue_learning_button')</a>
                                        </div>
                                    @endif
                                </div>
                                @if (!empty($quizUserDetails))
                                    <hr>
                                    <div class="d-flex align-items-center">
                                        <div class="col-6 grade-meta flex-column d-flex">
                                            <h4 class=" @if(session('display_type')=='rtl') text-end @else text-start @endif">@lang('frontend.curriculum_details.your_score_title')</h4>
                                            <label
                                                class="w-25 mt-2 px-4 @if(session('display_type')=='rtl') float-end @else float-start @endif ">&nbsp;</label>
                                            <span
                                                class="fw-bold  @if(session('display_type')=='rtl') text-end @else text-start @endif ">{{ $quizUserDetails['quiz_grade'] }}%</span>
                                        </div>
                                        <div
                                            class="col-6  @if(session('display_type')=='rtl') me-auto @else ms-auto @endif">
                                            <a class="btn btn-outline-rose @if(session('display_type')=='rtl') float-start @else float-end @endif"
                                               href="{{ route('quiz_result', [$curriculumDetails->course_slug, $curriculumDetails->curriculum_slug]) }}">
                                                @lang('frontend.curriculum_details.your_result_title')</a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </section>
                @endif
                <section class="unit-desktop-s2 unit-inner-section mb-4 pt-3">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            @php $activeTab = ""; @endphp
                            <button class="nav-link d-block d-lg-none" id="course-content-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-course-content" type="button" role="tab"
                                    aria-controls="nav-course-content" aria-selected="true">
                                @lang('frontend.curriculum_details.course_button')
                            </button>
                            @if (!empty(strip_tags($lessonDetail->content)))
                                @php $activeTab = "overview"; @endphp
                                <button class="nav-link" id="overview-tab" data-bs-toggle="tab"
                                        data-bs-target="#overview" type="button" role="tab"
                                        aria-controls="nav-overview" aria-selected="true">
                                    <img class="tab-img m-view"
                                         src="{{ asset('frontend-assets/images/unit-page/Overviewgrey.png') }}"
                                         alt="">
                                    <img class="blue-img m-view"
                                         src="{{ asset('frontend-assets/images/unit-page/Overview.png') }}"
                                         alt="">
                                    @lang('frontend.curriculum_details.overview_step')
                                </button>
                            @endif
                            @if (count($lessonDetail->relatedAttachments) > 0)
                                @php $activeTab = empty($activeTab) ? "attachment" : $activeTab; @endphp
                                <button class="nav-link" id="attachment-tab" data-bs-toggle="tab"
                                        data-bs-target="#attachment" type="button" role="tab"
                                        aria-controls="nav-attachment" aria-selected="true">
                                    <i class="fas fa-paperclip m-view"></i>
                                    @lang('frontend.curriculum_details.attachments_tab')
                                </button>
                            @endif
                            @if ($curriculumDetails->curriculum_type == 'unit' && count($lessonDetail->relatedFaqs) > 0)
                                @php $activeTab = empty($activeTab) ? "faq" : $activeTab; @endphp
                                <button class="nav-link" id="faq-tab" data-bs-toggle="tab" data-bs-target="#faq"
                                        type="button" role="tab" aria-controls="nav-faq" aria-selected="false">
                                    <img class="tab-img m-view"
                                         src="{{ asset('frontend-assets/images/unit-page/FAQsgrey.png') }}"
                                         alt="">
                                    <img class="blue-img m-view"
                                         src="{{ asset('frontend-assets/images/unit-page/FAQs.png') }}" alt="">
                                    @lang('frontend.curriculum_details.FAQs_step')
                                </button>
                            @endif
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade course-content-left-accordion" id="nav-course-content" role="tabpanel"
                             aria-labelledby="course-content-tab">
                            <div class="py-3">
                                <div class="unit-course-content">
                                    <div class="accordion" id="moduleAccordion">
                                        @foreach ($curriculumList as $section)
                                            <div class="accordion-item">
                                                <h5 class="accordion-header" id="heading-{{ $section['id'] }}">
                                                    <button
                                                        class="accordion-button @if ($section['section_id'] != $lessonDetail->section_id) collapsed @endif"
                                                        data-index="{{ $section['id'] }}"
                                                        @if($section['user_access'])
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#module-{{ $section['id'] }}"
                                                        aria-expanded="{{ $section['section_id'] == $lessonDetail->section_id }}"
                                                        aria-controls="module-{{ $section['id'] }}" @endif>
                                                        @if(!$section['user_access'])<i
                                                            class="fa fa-lock"></i> @endif {{ $section['name'] }}
                                                    </button>
                                                </h5>
                                                <div id="module-{{ $section['id'] }}"
                                                     class="accordion-collapse collapse @if ($section['section_id'] == $lessonDetail->section_id) show @endif"
                                                     aria-labelledby="heading-{{ $section['id'] }}"
                                                     data-bs-parent="#moduleAccordion">
                                                    <div class="accordion-body px-2">
                                                        <ol class="ps-0">
                                                            @foreach ($section['lessons'] as $lesson)
                                                                <div class="d-flex align-items-start">
                                                                    <div
                                                                        class="mt-1 @if(session('display_type')=='rtl') ms-4 @endif me-3 ">
                                                                        @if ($lesson['curriculum_type'] == 'unit')
                                                                            <input type="checkbox"
                                                                                   class="curriculumCheckbox curriculumId{{ $lesson['id'] }}"
                                                                                   data-id="{{ $lesson['id'] }}"
                                                                                   data-module_id="{{ $lesson['curriculum_list_id'] }}"
                                                                                   data-module_type="{{ $lesson['curriculum_type'] }}"
                                                                                   @if ($lesson['is_completed'] == 1) checked @endif>
                                                                        @else
                                                                            <input type="checkbox" disabled
                                                                                   @if ($lesson['is_completed'] == 1) checked @endif>
                                                                        @endif
                                                                    </div>
                                                                    <li class="ms-2">
                                                                        <a
                                                                            href="{{ route('curriculum_detail', [$lesson['course_slug'], $lesson['curriculum_slug']]) }}">
                                                                            <h6>{{ $lesson['name'] }}</h6>
                                                                            @if (isset($lesson['time']))
                                                                                <span>
                                                                                    @if ($lesson['curriculum_type'] == 'unit')
                                                                                        <i class="fas fa-play-circle"></i>
                                                                                    @else
                                                                                        <i class="fas fa-solid fa-question-circle"></i>
                                                                                    @endif
                                                                                    {{ formatCurriculumTime($lesson['time']) }}</span>
                                                                            @endif
                                                                        </a>
                                                                    </li>
                                                                </div>
                                                            @endforeach
                                                        </ol>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (!empty(strip_tags($lessonDetail->content)))
                            <div class="tab-pane fade mt-4" id="overview" role="tabpanel"
                                 aria-labelledby="overview-tab">
                                <div class="course-overview">
                                    <h6 class="fw-bold">@lang('frontend.curriculum_details.overview_title')</h6>
                                    <div class="readMore pt-2" style="overflow-y: hidden;">
                                        <div
                                            class="text @if (strlen($lessonDetail->content) > 1200) show-more-height mask-gradient @endif">
                                            {!! $lessonDetail->content !!}
                                        </div>
                                        @if (strlen($lessonDetail->content) > 1200)
                                            <div class="show-more-line mb-2">
                                                <span
                                                    class="show-more mx-auto mt-4">@lang('frontend.curriculum_details.see_more_button')</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if (count($lessonDetail->relatedAttachments) > 0)
                            <div class="tab-pane fade mt-4" id="attachment" role="tabpanel"
                                 aria-labelledby="attachment-tab">
                                @foreach($lessonDetail->relatedAttachments as $attachmentDetail)
                                    <div class="row mb-2  bg-light p-3 rounded-3 mx-0">
                                        <div class="col-9 my-auto">
                                            <h6 class="mb-0">{{ $attachmentDetail->title }}</h6>
                                        </div>
                                        <div class="col-3 px-0 px-sm-2 text-end my-auto">
                                            <a href="{{ route('downloadAttachment', $attachmentDetail->id) }}" download
                                               class="text-brand"><i class="fas fa-download"></i>
                                                <span class="m-view"> @lang('global.button.download')</span> </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        @if ($curriculumDetails->curriculum_type == 'unit' && count($lessonDetail->relatedFaqs) > 0)
                            <div class="tab-pane fade" id="faq" role="tabpanel" aria-labelledby="faq-tab">
                                <div class="accordion unit-faq-accordion mt-3" id="faqAccordion">
                                    @foreach ($lessonDetail->relatedFaqs as $faq)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button
                                                    class="accordion-button @if (!$loop->first) collapsed @endif"
                                                    type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapse{{ $faq->id }}"
                                                    aria-expanded="{{ $loop->first }}"
                                                    aria-controls="collapse{{ $faq->id }}">
                                                    {{ $faq->question }}
                                                </button>
                                            </h2>
                                            <div id="collapse{{ $faq->id }}"
                                                 class="accordion-collapse collapse @if ($loop->first) show @endif"
                                                 aria-labelledby="heading{{ $faq->id }}"
                                                 data-bs-parent="#faqAccordion">
                                                <div class="accordion-body">
                                                    {!! $faq->answer !!}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </section>
            </div>
            <div class="col-12 col-lg-5 unit-content row sticky-course ms-auto pe-0 me-0 d-none d-lg-block px-5"
                 style="top:9rem; position: sticky;">
                <div class="col-12 ms-auto">
                    <div class="unit-left-side-section pt-0">
                        <div class="d-flex course-content rounded-top justify-content-between py-3 px-2">
                            <h6 id="headingCourseContentOne"
                                class="course-content-heading align-self-center px-2 text-white">
                                @lang('frontend.curriculum_details.course_content_title')
                            </h6>
                            <div class="progress-wrapper">
                                <div class="progress-bar" role="progressbar"
                                     style="width: {{ round($courseUserDetail->progress) }}%" aria-valuenow="100"
                                     aria-valuemin="0" aria-valuemax="100"></div>
                                <div class="d-flex justify-content-between py-1 text-white">
                                    <span
                                        class="align-self-center courseProgressText">{{ round($courseUserDetail->progress) }}%</span>
                                    <div class="dropdown">
                                        <button class="btn dropdown-toggle ms-3 progress-dropdown text-white p-0"
                                                type="button"
                                                id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                            @lang('frontend.curriculum_details.your_progress_button')
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                            <li>
                                                <div class="row d-flex align-items-center">
                                                    <div class="col">
                                                        <p class="dropdown-item d-flex justify-content-between my-auto">
                                                            @lang('frontend.curriculum_details.chapters_text')</p>
                                                    </div>
                                                    <div class="col">
                                                        <p class="my-auto">
                                                            {{ $courseStatistics['total_completed_units'] }}
                                                            @lang('frontend.curriculum_details.of_text')  {{ $courseStatistics['total_units'] }} @lang('frontend.curriculum_details.complete_text')
                                                            .</p>
                                                    </div>
                                                </div>
                                            </li>
                                            <hr>
                                            <li>
                                                <div class="row d-flex align-items-center">
                                                    <div class="col">
                                                        <p class="dropdown-item d-flex justify-content-between my-auto">
                                                            @lang('frontend.curriculum_details.test_text')</p>
                                                    </div>
                                                    <div class="col">
                                                        <p class="my-auto">
                                                            {{ $courseStatistics['total_completed_quizzes'] }}
                                                            @lang('frontend.curriculum_details.of_text') {{ $courseStatistics['total_quizzes'] }} @lang('frontend.curriculum_details.complete_text')
                                                            .</p>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="course-content-left-accordion">
                            <div class="accordion" id="moduleAccordionWeb">
                                @foreach ($curriculumList as $section)
                                    <div class="accordion-item">
                                        <h5 class="accordion-header" id="heading-{{ $section['id'] }}">
                                            <button
                                                class="accordion-button @if ($section['section_id'] != $lessonDetail->section_id) collapsed @endif"
                                                @if($section['user_access'])
                                                data-index="{{ $section['id'] }}" data-bs-toggle="collapse"
                                                data-bs-target="#module-{{ $section['id'] }}"
                                                aria-expanded="{{ $section['section_id'] == $lessonDetail->section_id }}"
                                                aria-controls="module-{{ $section['id'] }}" @endif>
                                                @if(!$section['user_access'])<i
                                                    class="fa fa-lock me-2"></i> @endif {{ $section['name'] }}
                                            </button>
                                        </h5>
                                        <div id="module-{{ $section['id'] }}"
                                             class="accordion-collapse collapse @if ($section['section_id'] == $lessonDetail->section_id) show @endif"
                                             aria-labelledby="heading-{{ $section['id'] }}"
                                             data-bs-parent="#moduleAccordionWeb">
                                            <div class="accordion-body px-2">
                                                <ol class="ps-0">
                                                    @foreach ($section['lessons'] as $lesson)
                                                        <div class="d-flex align-items-start">
                                                            <div
                                                                class="me-3  @if(session('display_type')=='rtl') ms-3 me-0 @endif mt-top">
                                                                @if ($lesson['curriculum_type'] == 'unit')
                                                                    <input type="checkbox"
                                                                           class="curriculumCheckbox curriculumId{{ $lesson['id'] }}"
                                                                           data-id="{{ $lesson['id'] }}"
                                                                           data-module_id="{{ $lesson['curriculum_list_id'] }}"
                                                                           data-module_type="{{ $lesson['curriculum_type'] }}"
                                                                           @if ($lesson['is_completed'] == 1) checked @endif>
                                                                @else
                                                                    <input type="checkbox" disabled
                                                                           @if ($lesson['is_completed'] == 1) checked @endif>
                                                                @endif
                                                            </div>
                                                            <li
                                                                class="@if(session('display_type')=='rtl') me-2 @else ms-2 @endif @if(request()->segment(2) == $lesson['curriculum_slug']) active-unit @endif">
                                                                <a
                                                                    href="{{ route('curriculum_detail', [$lesson['course_slug'], $lesson['curriculum_slug']]) }}"
                                                                    class="d-flex flex-column">
                                                                    <h6>{{ $lesson['name'] }}</h6>
                                                                    @if (isset($lesson['time']))
                                                                        <span>
                                                                            @if ($lesson['curriculum_type'] == 'unit')
                                                                                <i class="fas fa-play-circle"></i>
                                                                            @else
                                                                                <i class="fas fa-solid fa-question-circle"></i>
                                                                            @endif
                                                                            {{ formatCurriculumTime($lesson['time']) }}</span>
                                                                    @endif
                                                                </a>
                                                            </li>
                                                        </div>
                                                    @endforeach
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (count($relatedCourses) > 0)
        <section id="courses-5" class="bg-whitesmoke courses-section division">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title mb-60">
                            <h4 class="h4-xl">@lang('frontend.curriculum_details.browse_similar_courses_title')</h4>
                            @lang('frontend.curriculum_details.browse_similar_courses_note')
                            <div class="title-btn">
                                <a href="{{ route('courses') }}" class="btn btn-tra-grey rose-hover">
                                    @lang('frontend.curriculum_details.view_all_courses_button')</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row courses-grid">
                    @foreach ($relatedCourses as $relatedCourse)
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            @include('front-end.course.vertical_course_card', ['course' => $relatedCourse])
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    <input type="hidden" id="curriculum_id" value="{{ $curriculumDetails->id }}">
    <input type="hidden" id="module_id" value="{{ $curriculumDetails->curriculum_list_id }}">
    <input type="hidden" id="module_type" value="{{ $curriculumDetails->curriculum_type }}">

    @if ($preSurveyModalOpen && (isset($survey) && count($survey->surveyQuestions) > 0))
        @include('front-end.curriculum_pages.partials.survey_model')
    @endif
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend-assets/unit-page/unit.css') }}"/>
    <link rel="stylesheet" href="{{ asset('frontend-assets/plugins/touchpdf-master/jquery.touchPDF.css') }}"/>
    @if (in_array($lessonDetail->lesson_type, ['video_file', 'video_url']))
        <link rel="stylesheet" href="{{ asset('frontend-assets/plugins/videojs/video-js.css') }}"/>
        <link rel="stylesheet" href="{{ asset('frontend-assets/plugins/videojs/videojs-seek-buttons.css') }}"/>
    @endif
@endpush
@push('footer_scripts')
    <script src="{{ asset('frontend-assets/plugins/readmore/readmore.min.js') }}"></script>
    @if (in_array($lessonDetail->lesson_type, ['video_file', 'video_url']))
        <script src="{{ asset('frontend-assets/plugins/videojs/video.min.js') }}"></script>
        <script src="{{ asset('frontend-assets/plugins/videojs/videojs.hotkeys.min.js') }}"></script>
        <script src="{{ asset('frontend-assets/plugins/videojs/videojs-seek-buttons.min.js') }}"></script>
        <script type="text/javascript">
            $(function () {
                'use strict';

                var player = videojs("lessonJsVideo")
                player.ready(function () {
                    this.hotkeys({
                        volumeStep: 0.1,
                        seekStep: 5,
                        enableModifiersForNumbers: false
                    });
                    this.seekButtons({
                        forward: 10,
                        back: 10
                    });
                });
                player.on("ended", function () {
                    onVideoEndMarkComplete();
                })
            });
        </script>
    @elseif($lessonDetail->lesson_type == 'vimeo')
        <script src="{{ asset('frontend-assets/plugins/vimeo/player.js') }}"></script>
        <script type="text/javascript">
            $(function () {
                'use strict';

                var iframe = $('#vimeoIframe');
                var player = new Vimeo.Player(iframe);
                player.on('ended', function () {
                    onVideoEndMarkComplete()
                });
            });
        </script>
    @elseif($lessonDetail->lesson_type == 'youtube')
        <script src="{{ asset('frontend-assets/plugins/youtube_iframe_api.js') }}"></script>
        <script type="text/javascript">
            var player;

            function onYouTubeIframeAPIReady() {
                player = new YT.Player('youtubeIframe', {
                    events: {
                        'onStateChange': onPlayerStateChange
                    }
                });
            }

            function onPlayerStateChange(event) {
                if (event.data === 0) {
                    onVideoEndMarkComplete();
                }
            }
        </script>
    @elseif($lessonDetail->lesson_type == 'document' && $lessonDetail->lesson_document_type == 'pdf')
        <script type="text/javascript" src="{{ asset('frontend-assets/plugins/ajax.googleapis.min.js') }}"></script>
        <script type="text/javascript"
                src="{{ asset('frontend-assets/plugins/touchpdf-master/pdf.compatibility.js') }}">
        </script>
        <script type="text/javascript" src="{{ asset('frontend-assets/plugins/touchpdf-master/pdf.js') }}"></script>
        <script type="text/javascript"
                src="{{ asset('frontend-assets/plugins/touchpdf-master/jquery.touchSwipe.js') }}">
        </script>
        <script type="text/javascript" src="{{ asset('frontend-assets/plugins/touchpdf-master/jquery.touchPDF.js') }}">
        </script>
        <script type="text/javascript"
                src="{{ asset('frontend-assets/plugins/touchpdf-master/jquery.panzoom.js') }}"></script>
        <script type="text/javascript"
                src="{{ asset('frontend-assets/plugins/touchpdf-master/jquery.mousewheel.js') }}">
        </script>
        <script type="text/javascript">
            var url = '{{ getFileUrl($lessonDetail->lesson_media_url, 'unit/media') }}';
            $(document).on('ready', function () {
                'use strict';

                $("#pdfDiv").pdf({
                    source: "{{ getFileUrl($lessonDetail->lesson_media_url, 'unit/media') }}",
                    loaded: function () {
                        setTimeout(function () {
                            $("#pdfDiv").css('height', 'auto');
                        }, 500)
                    }
                });
            })
        </script>
    @endif
    <script type="text/javascript">
        var $courseId = {{ $course->id }};
        var $activeTab = '{{ $activeTab }}';

        $(document).ready(function () {
            'use strict';

            $(".show-more").click(function () {
                if ($(".text").hasClass("show-more-height")) {
                    $(this).text("See Less");
                } else {
                    $(this).text("See More");
                }
                $(".text").toggleClass("show-more-height");
                $(".text").toggleClass("mask-gradient");
            });

            $(".progress-circle").each(function () {
                var value = $(this).attr('data-value');
                var left = $(this).find('.progress-left .progress-bar-circle');
                var right = $(this).find('.progress-right .progress-bar-circle');
                if (value > 0) {
                    if (value <= 50) {
                        right.css('transform', 'rotate(' + percentageToDegrees(value) + 'deg)')
                    } else {
                        right.css('transform', 'rotate(180deg)')
                        left.css('transform', 'rotate(' + percentageToDegrees(value - 50) + 'deg)')
                    }
                }
            });

            /* Check width on page load*/
            if ($(window).width() > 1024) {
                $('#' + $activeTab + '-tab').addClass('show active');
                $('#' + $activeTab).addClass('show active');
            } else if ($activeTab != "") {
                $('#' + $activeTab + '-tab').addClass('show active');
                $('#' + $activeTab).addClass('show active');
            } else {
                $('#course-content-tab').addClass('show active');
                $('#nav-course-content').addClass('show active');
            }

            $(document).on('click', '.curriculumCheckbox', function () {
                var dataValue = {
                    curriculum_id: $(this).data('id'),
                    course_id: $courseId,
                    module_id: $(this).data('module_id'),
                    module_type: $(this).data('module_type'),
                    is_completed: ($(this).prop('checked') == true) ? 1 : 0,
                };
                markAsComplete(dataValue);
            })
        });

        function percentageToDegrees(percentage) {
            return percentage / 100 * 360
        }

        function markAsComplete(dataValue) {
            $.ajax({
                type: "POST",
                data: dataValue,
                url: $app_url + "/mark-unit-complete",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    if (data.redirect_to_complete_screen) {
                        window.location.href = data.redirect_url;
                    } else {
                        $(".courseProgressText").text(data.course_progress + "%")
                        $(".progress-bar").css('width', data.course_progress + "%")

                        var t = data.course_progress,
                            i = $(".progress-left .progress-bar-circle"),
                            o = $(".progress-right .progress-bar-circle");
                        t <= 50 ? o.css("transform", "rotate(" + percentageToDegrees(t) + "deg)") : (o.css(
                            "transform", "rotate(180deg)"), i.css("transform", "rotate(" +
                            percentageToDegrees(t - 50) + "deg)"))
                    }
                },
                error: function () {
                    alert('error');
                }
            })
        }

        function onVideoEndMarkComplete() {
            var dataValue = {
                curriculum_id: $("#curriculum_id").val(),
                course_id: $courseId,
                module_id: $("#module_id").val(),
                module_type: $("#module_type").val(),
                is_completed: 1,
            };
            if ($('.curriculumId' + dataValue.curriculum_id).prop('checked') == false) {
                markAsComplete(dataValue);
                $('.curriculumId' + dataValue.curriculum_id).prop('checked', true);
            }
            if ($("#nextBtn").length > 0) {
                window.location.href = $("#nextBtn").attr("href")
            }
        }
    </script>
@endpush
