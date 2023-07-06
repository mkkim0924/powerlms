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
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('frontend.live_webinars.breadcrumb_item.home')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">@lang('frontend.live_webinars.breadcrumb_item.webinar_details')</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="webinar-video-container d-flex mx-auto justify-content-center">
        <iframe width="853" height="480" src="{{ $webinarDetails->live_streaming_url }}" title="{{ $webinarDetails->name }}"
                frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
    <div class="container">
        <div class="row d-flex align-items-start">
            <div class="col-12">
                <section class="ncp-desktop-s1  my-4" id="Overview">
                    <div class="m-order d-none d-lg-block">
                        <p class="webinar-text mb-1">@lang('frontend.live_webinars.webinar_topic_title')</p>
                        <h3 class="section-heading  h3-sm">{{ $webinarDetails->name }}</h3>
                    </div>
                    @if(isset($webinarDetails->short_description))
                        <p>{{ $webinarDetails->short_description }}</p>
                    @endif
                    <div class="row webinar-info pt-5 pb-4">
                        <div class="col-6 pe-0 trainer-one">
                            <h5 class="heading-blue">@lang('frontend.live_webinars.teacher_label')</h5>
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
                            <h5 class="heading-blue">@lang('frontend.live_webinars.date_time_label')</h5>
                            <p class="semi-bold my-2"><i
                                    class="far fa-calendar"></i> {{ formatDate($webinarDetails->start_at, 'd M, Y') }}
                            </p>
                            <p class="my-2 fw-9"><i
                                    class="fas fa-clock"></i> {{ formatDate($webinarDetails->start_at, 'h:i A') }}
                                @lang('frontend.live_webinars.onwards_text')</p>
                        </div>
                    </div>
                </section>
                @if(!empty($webinarDetails->description))
                    <section class="ncp-desktop-s2 my-2 my-sm-5" id="course-overview">
                        <div class="course-overview">
                            <h4 class="heading-blue">@lang('frontend.live_webinars.about_the_webinar_title')</h4>
                            {!! $webinarDetails->description !!}
                        </div>
                    </section>
                @endif
            </div>
        </div>
        @if(count($pastWebinars) > 0)
            <section class="webinar-desktop-5 my-2 my-sm-5">
                <h4 class="py-2 heading-black fw-bold">@lang('frontend.live_webinars.other_past_webinars_title')</h4>
                <div class="owl-carousel owl-theme reviews-holder owl-loaded owl-drag py-3" id="pastWebinars">
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
