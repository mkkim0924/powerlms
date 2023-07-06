@extends('front-end.layouts.master')

@section('content')
    @include('front-end.user.partials.navbar', ['current_tab' => 'my-webinars'])
    <section class="user-dashboard-area">
        <div class="container">
            <div class="row mx-0">
                <section id="" class="courses-section division px-3">
                    <div class="row mx-0">
                        <div class="col-md-12 px-sm-2 px-0  webinar-desktop-5">
                            <div class="d-flex justify-content-between px-sm-0 mb-3 ">
                                <h3 class="">@lang('frontend.my_webinar.enrolled_future_webinars_title')</h3>
                            </div>
                            @if (count($futureWebinars) > 0)
                                <div class="owl-carousel owl-theme reviews-holder owl-loaded owl-drag py-3">
                                    @foreach ($futureWebinars as $futureWebinarUser)
                                        <a href="{{ route('webinar_detail', $futureWebinarUser->webinarDetails->slug) }}">
                                            <div class="item text-white me-3">
                                                <div class="sbox-5 bg-051">
                                                    <div class="sbox-5-txt">
                                                        <h5 class="h5-md text-white">
                                                            {{ str_limit($futureWebinarUser->webinarDetails->name, 65) }}
                                                        </h5>
                                                        <p class="grey-color text-white me-2 py-2 text-start"><i
                                                                class="fas fa-user text-white "></i><span
                                                                class="ms-2 text-white">{{ $futureWebinarUser->webinarDetails->instructorDetail->name }}</span>
                                                        </p>
                                                        <p class=" py-2 text-start"><i
                                                                class="fas fa-calendar-alt me-2"></i>{{ formatDate($futureWebinarUser->webinarDetails->start_at, 'd/m/Y') }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            @else
                                <div class="row mx-0">
                                <div class="alert alert-danger text-center py-2">@lang('frontend.my_webinar.no_record_found_text').</div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row courses-grid mx-0 my-3">
                        <div class="col-md-12 px-sm-2 px-0 webinar-desktop-5">
                            <div class="d-flex justify-content-between px-sm-0 mb-3 ">
                                <h3 class="">@lang('frontend.my_webinar.other_past_webinars_title')</h3>
                            </div>
                           @if (count($pastWebinars) > 0)
                                <div class="owl-carousel owl-theme reviews-holder owl-loaded owl-drag">
                                    @foreach ($pastWebinars as $pastWebinarUser)
                                        <a href="{{ route('webinar_detail', $pastWebinarUser->webinarDetails->slug) }}">
                                            <div class="item text-white me-3">
                                                <div class="sbox-5 bg-05">
                                                    <div class="sbox-5-txt">
                                                        <h5 class="h5-md text-white">
                                                            {{ str_limit($pastWebinarUser->webinarDetails->name, 65) }}</h5>
                                                        <p class="grey-color text-white me-2 py-2 text-start"><i
                                                                class="fas fa-user text-white "></i><span
                                                                class="ms-2 text-white">{{ $pastWebinarUser->webinarDetails->instructorDetail->name }}</span>
                                                        </p>
                                                        <p class=" py-2 text-start"><i
                                                                class="fas fa-calendar-alt me-2"></i>{{ formatDate($pastWebinarUser->webinarDetails->start_at, 'd/m/Y') }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                           @else
                                <div class="row mx-0">
                                <div class="alert alert-danger text-center py-2">@lang('frontend.my_webinar.no_record_found_text').</div>
                                </div>
                           @endif
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend-assets/unit-page/webinar.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend-assets/unit-page/mycourses.css') }}" />
@endpush
@push('footer_scripts')
@endpush
