@extends('front-end.layouts.master')
@section('content')
    <div id="breadcrumb" class="division">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('frontend.become_a_teacher.breadcrumb_item.home')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">@lang('frontend.become_a_teacher.breadcrumb_item.become_a_teacher')</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <section id="services-4" class="wide-60 services-section division">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title title-centered mb-70  @if(session('display_type')=='rtl') text-center @endif">
                        <h3 class="h3-sm">@lang('frontend.become_a_teacher.header_text')</h3>
                        @lang('frontend.become_a_teacher.sub_header_text')
                    </div>
                </div>
            </div>
            @include('front-end.layouts.partials.flash_messages')
            <div class="row">
                <div class="col-md-4">
                    <div class="sbox-4 text-center">
                        <img class="img-95" src="{{ asset('frontend-assets/images/icons/creative.png') }}"
                             alt="service-icon"/>
                        <div class="sbox-4-txt">
                            <h5 class="h5-lg">@lang('frontend.become_a_teacher.plan_your_course_title')</h5>
                            @lang('frontend.become_a_teacher.plan_your_course_note')
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="sbox-4 text-center">
                        <img class="img-95" src="{{ asset('frontend-assets/images/icons/film.png') }}"
                             alt="service-icon"/>
                        <div class="sbox-4-txt">
                            <h5 class="h5-lg">@lang('frontend.become_a_teacher.record_your_video_title')</h5>
                            @lang('frontend.become_a_teacher.record_your_video_note')
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="sbox-4 text-center">
                        <img class="img-95" src="{{ asset('frontend-assets/images/icons/classroom.png') }}"
                             alt="service-icon"/>
                        <div class="sbox-4-txt">
                            <h5 class="h5-lg">@lang('frontend.become_a_teacher.build_your_community_title')</h5>
                            @lang('frontend.become_a_teacher.build_your_community_note')

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="about-4" class="bg-lightgrey wide-70 about-section division">
        <div class="container">
            @if(isset($widgets['our_goal_or_vision_section_widget']))
                @php $sectionData = $widgets['our_goal_or_vision_section_widget'][0]; @endphp
                <div class="row">
                    <div class="  @if(session('display_type')=='rtl') col-xl-10 mx-auto @else col-xl-10  offset-xl-1 @endif">
                        <div class="a4-txt">
                            <h5 class="h5-xl text-center">{{ $sectionData['title'][config('app.locale')] ?? ($sectionData['title'][$default_language_code] ?? "") }}</h5>
                            {!! $sectionData['description'][config('app.locale')] ?? ($sectionData['description'][$default_language_code] ?? "") !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="img-block">
                            <img class="img-fluid" src="{{ getFileUrl($sectionData['image'], 'widgets') }}"
                                 alt="about-image">
                        </div>
                    </div>
                </div>
            @endif
            <div class="a4-boxes">
                <div class="row d-flex align-items-center">
                    <div class="col-md-4">
                        <div class="abox-4 icon-sm">
                            <span class="flaticon-004-computer"></span>
                            <div class="abox-4-txt">
                                <h5 class="h5-lg">@lang('frontend.our_goal_section.trusted_content_title')</h5>
                                @lang('frontend.our_goal_section.trusted_content_note')

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="abox-4 icon-sm">
                            <span class="flaticon-028-learning-1"></span>
                            <div class="abox-4-txt">
                                <h5 class="h5-lg">@lang('frontend.our_goal_section.certified_teachers_title')</h5>
                                @lang('frontend.our_goal_section.certified_teachers_note')

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="abox-4 icon-sm">
                            <span class="flaticon-032-tablet"></span>
                            <div class="abox-4-txt">
                                <h5 class="h5-lg">@lang('frontend.our_goal_section.lifetime_access_title')</h5>
                                @lang('frontend.our_goal_section.lifetime_access_note')

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="about-3" class="pt-100 about-section division">
        <div class="container">
            @php $sectionData = $widgets['promotional_section_two_widget'][0]; @endphp
            <div class="row d-flex align-items-center">
                <div class="col-md-7 col-lg-6">
                    <div class="txt-block pc-25">
                        <h3 class="h3-sm">{{ $sectionData['title'][config('app.locale')] ?? ($sectionData['title'][$default_language_code] ?? "") }}</h3>
                        {!! $sectionData['description'][config('app.locale')] ?? ($sectionData['description'][$default_language_code] ?? "") !!}
                        @if(config('disable_instructor_registration') == 0)
                            @if(auth()->check())
                                <a href="{{ route('instructor.become') }}" class="btn btn-md btn-rose tra-black-hover">
                                    @lang('frontend.become_a_teacher.become_a_teacher_button')</a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-md btn-rose tra-black-hover">
                                    @lang('frontend.become_a_teacher.become_a_teacher_button')</a>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="col-md-5 col-lg-6">
                    <div class="img-block">
                        <img class="img-fluid" src="{{ getFileUrl($sectionData['image'], 'widgets') }}"
                             alt="about-image">
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('front-end.home.partials.statistics')

    <section id="banner-5" class="bg-whitesmoke wide-60 banner-section division">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="banner-5-txt">
                        <img src="{{ asset('frontend-assets/files/images/image-04.png') }}" alt="banner-icon"/>
                        <div class="b5-txt">
                            <h4 class="h4-xs mt-3 mt-sm-1">@lang('frontend.beacome_teacher_section.become_a_teacher_title')</h4>
                            @lang('frontend.beacome_teacher_section.become_a_teacher_note')
                            @if(config('disable_instructor_registration') == 0)
                                <a href="{{ route('instructor.become') }}" class="btn btn-rose tra-black-hover">@lang('frontend.become_a_teacher.become_a_teacher_button')</a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="banner-5-txt">
                        <img src="{{ asset('frontend-assets/files/images/image-05.png') }}" alt="banner-icon"/>
                        <div class="b5-txt">
                            <h4 class="h4-xs mt-3 mt-sm-1">{{ config('app.name') }} @lang('frontend.beacome_teacher_section.for_business_text')</h4>
                            @lang('frontend.beacome_teacher_section.for_business_note')
                            <a href="{{ route('courses') }}" class="btn btn-rose tra-black-hover">@lang('frontend.beacome_teacher_section.find_out_more_button')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    @if(count($blogs) > 0)
        @include('front-end.home.partials.our_stories_and_news_section')
    @endif

    <section id="contacts-1" class="contacts-section division">
        <div class="container">
            <div class="bg-03 bg-fixed contacts-1-holder">
                <div class="row d-flex align-items-center">

                    <div class="  @if(session('display_type')=='rtl') col-lg-8 mx-auto @else col-lg-8 offset-lg-2 @endif">
                        <div class="contacts-txt text-center white-color">
                            <h3 class="h3-sm">@lang('frontend.become_a_teacher.help_text')</h3>
                            @lang('frontend.become_a_teacher.help_note')
                            @if(session('display_type')=='rtl') <br> @endif
                            <a class="btn btn-md btn-rose tra-white-hover  @if(session('display_type')=='rtl') mt-3 @endif"
                               href="mailto:{{ config('contact_email') }}">{{ config('contact_email') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

