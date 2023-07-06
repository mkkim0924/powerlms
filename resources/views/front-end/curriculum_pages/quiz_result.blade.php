@extends('front-end.layouts.master')
@section('content')
    <div class="container" id="unit-left-section">
        <section class="unit-meta unit-inner-section py-4">
            <div class="col-12">
                <div class="unit-breadcrumbs division" id="breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('frontend.quiz_result.breadcrumb_item.home')</a></li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('course_detail', $curriculumDetails->course_slug) }}">{{ $curriculumDetails->courseDetail->name }}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">@lang('frontend.quiz_result.breadcrumb_item.test_result')</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h2 class="unit-section-heading pt-2">{{ $curriculumDetails->name }}</h2>
                </div>
            </div>
        </section>
        <section class="result-section">
            <div class="row py-3 px-3 mt-4 d-none d-sm-flex" id="quiz-result">
                <div class="col-sm-8 col-12 col-md-7 ">
                    <h3 class="">@lang('frontend.quiz_result.your_result_title')</h3>
                    <p class="total-question mt-sm-4 mt-2">@lang('frontend.quiz_result.total_questions_text') :
                        <span>{{ $resultData['total_questions'] }}</span></p>
                    <div class="row">
                        <div class="col-sm-3 col-md-4 col-4 px-md-0 right-border d-flex py-2">
                            <p class="quiz-ans  my-auto ">@lang('frontend.quiz_result.correct_answers_text') :
                                <span>{{ $resultData['correct_answers'] }}</span></p>

                        </div>
                        <div class="col-sm-3 col-4  col-md-4  px-md-0 right-border d-flex py-2">
                            <p class="quiz-ans m-auto">@lang('frontend.quiz_result.incorrect_answers_text') :
                                <span>{{ $resultData['incorrect_answers'] }}</span></p>
                        </div>
                        <div class="col-sm-3 col-4  col-md-4 px-md-0 d-flex py-2">
                            <p class="quiz-ans m-auto">@lang('frontend.quiz_result.unanswered_text') :
                                <span>{{ $resultData['unanswered_questions'] }}</span></p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-12 col-md-5 flex-column d-flex  text-end ">
                    @if($reAttemptBtnEnable)
                    <a class="btn btn-rose-outline re-attempt-btn  mb-2 ms-auto"
                       href="{{ route('quiz_details', [$curriculumDetails->course_slug, $curriculumDetails->curriculum_slug]) }}">@lang('frontend.quiz_result.reattempt_now_text')</a>
                    @endif
                    @if(request('course_complete'))
                        <a href="{{ route('course_complete', $curriculumDetails->course_slug) }}"
                           class="btn btn-rose continue-btn  ms-auto mb-3">
                           @lang('frontend.quiz_result.continue_learning_text')
                        </a>
                    @elseif(isset($pagination['next']))
                        <a href="{{ route('curriculum_detail', [$pagination['next']['course_slug'], $pagination['next']['curriculum_slug']]) }}"
                           class="btn btn-rose continue-btn  ms-auto mb-3">
                           @lang('frontend.quiz_result.continue_learning_text')
                        </a>
                    @else
                        <form method="POST" action="{{ route('course_status') }}">
                            @csrf
                            <input type="hidden" name="course_id" value="{{ $curriculumDetails->course_id }}">
                            <button class="btn btn-rose continue-btn  ms-auto mb-3">@lang('frontend.quiz_result.continue_course_button')</button>
                        </form>
                    @endif
                    <h5 class="submission">@lang('frontend.quiz_result.latest_submission_grade_text'): <span>{{ $resultData['quiz_grade'] }}%</span></h5>
                </div>
            </div>
            {{--for mobile--}}
            <div class="row py-3 px-3 d-block d-sm-none quiz-result-mobile" id="quiz-result-mobile ">
                <div class="col-12 ">
                    <h3 class="text-center">@lang('frontend.quiz_result.your_result_title')</h3>
                    <p class="total-question mt-sm-4 mt-2 text-center">@lang('frontend.quiz_result.total_questions_text') :
                        <span>{{ $resultData['total_questions'] }}</span></p>
                    <div class="row">
                        <div class="col-4 right-border p-1 text-center">
                            <p class="quiz-ans mb-0">@lang('frontend.quiz_result.correct_answers_text')</p>
                            <span>{{ $resultData['correct_answers'] }}</span>
                        </div>
                        <div class="col-4 right-border text-center p-1">
                            <p class="quiz-ans mb-0">@lang('frontend.quiz_result.incorrect_answers_text')</p>
                            <span>{{ $resultData['incorrect_answers'] }}</span>
                        </div>
                        <div class="col-4 p-1 text-center">
                            <p class="quiz-ans mb-0">@lang('frontend.quiz_result.unanswered_text')</p>
                            <span>{{ $resultData['unanswered_questions'] }}</span>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <h5 class="submission">@lang('frontend.quiz_result.latest_submission_grade_text'): <span>{{ $resultData['quiz_grade'] }}%</span></h5>
                </div>
                <div class="d-flex justify-content-evenly text-center mb-2 mt-4">
                    @if($reAttemptBtnEnable)
                        <a class="btn btn-rose-outline"
                           href="{{ route('quiz_details', [$curriculumDetails->course_slug, $curriculumDetails->curriculum_slug]) }}">@lang('frontend.quiz_result.reattempt_now_text')
                            </a>
                    @endif
                    @if(request('course_complete'))
                        <a href="{{ route('course_complete', $curriculumDetails->course_slug) }}" class="btn btn-rose ">
                            @lang('frontend.quiz_result.continue_learning_text')
                        </a>
                    @else
                        <form method="POST" action="{{ route('course_status') }}">
                            @csrf
                            <input type="hidden" name="course_id" value="{{ $curriculumDetails->course_id }}">
                            <button class="btn btn-rose ms-2">@lang('frontend.quiz_result.continue_course_text')</button>
                        </form>
                    @endif
                </div>
            </div>
            {{-- end for mobile--}}
        </section>
        <section class="quiz-questions  py-3">
            <ol class="p-0">
                @foreach($resultData['questions'] as $questionData)
                    <div class="d-flex flex-row mb-3">
                        @if($questionData['is_correct_answer'] == 1)
                            <i class="fas fa-check-circle px-3 me-3 mt-1 green"></i>
                        @else
                            <i class="fas fa-times-circle px-3  mt-1 red @if(session('display_type')=='rtl') ms-3 @endif me-3"></i>
                        @endif
                        <li>
                            <h5 class="quiz-qus">{!! $questionData['title'] !!}</h5>

                            @if(!empty(strip_tags($questionData['que_description'])))
                                <div class="questn-detail p-2 my-3">
                                {!! $questionData['que_description'] !!}
                                </div>
                            @endif

                            <p class="mb-0">@lang('frontend.quiz_result.marked_answers_text') :
                                <span>{{ $questionData['user_question_answers'] ?? "--" }}</span></p>
                            <p class="correct-ans">@lang('frontend.quiz_result.correct_answers_text') : <span>{{ $questionData['correct_answers'] }}</span>
                            </p>
                        </li>
                    </div>
                @endforeach
            </ol>
        </section>
    </div>
    <hr style="opacity:.1;" class="mt-4">
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend-assets/unit-page/quiz_result.css') }}"/>
@endpush















