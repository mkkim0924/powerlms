@extends('front-end.layouts.master')

@section('content')
    <div id="breadcrumb" class="division">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('frontend.contact.breadcrumb_item.home')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">@lang('frontend.contact.breadcrumb_item.contact_us')</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <section id="contacts-2" class="wide-100 contacts-section division">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title title-centered mb-60">
                        <h3 class="h3-sm">@lang('frontend.contact.header_text')</h3>
                        @lang('frontend.contact.sub_header_text')
                    </div>
                </div>
            </div>

            <div class="contacts-2-holder">
                <div class="row d-flex align-items-stretch">
                    <div class="col-lg-4">
                        <div class="contact-box b-right ">
                            <img class="img-75" src="{{ asset('frontend-assets/files/images/icons/OurLocation.svg') }}"
                                 alt="contacts-icon"/>
                            <h5 class="h5-md">@lang('frontend.contact.our_location_title')</h5>
                            <p>{{ config('app.address') }}</p>
                            @if(!empty(config('google_map_link')))
                                <a href="{{ config('google_map_link') }}" target="_blank" class="btn btn-tra-grey rose-hover">
                                    @lang('frontend.contact.find_location_on_map_button')</a>
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="contact-box b-right h-100">
                            <img class="img-75" src="{{ asset('frontend-assets/files/images/icons/PartnershiRequest.svg') }}"
                                 alt="contacts-icon"/>
                            <h5 class="h5-md">@lang('frontend.contact.partnership_request_title')</h5>
                            @lang('frontend.contact.partnership_request_text')
                            <a href="mailto:{{ config('contact_email') }}"
                               class="btn btn-tra-grey rose-hover">{{ config('contact_email') }}</a>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="contact-box">
                            <img class="img-75" src="{{ asset('frontend-assets/files/images/icons/NeedHelp.svg') }}"
                                 alt="contacts-icon"/>
                            <h5 class="h5-md">@lang('frontend.contact.need_help_title')</h5>
                            @lang('frontend.contact.need_help_text')
                            <a href="mailto:{{ config('contact_email') }}"
                               class="btn btn-tra-grey rose-hover">{{ config('contact_email') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if(config('location_iframe'))
        <div id="gmap" class="map-section division">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="google-map">
                            <!-- Embedded Google Map using an iframe - to select your location find it on Google maps and paste the link as the iframe src. If you want to use the Google Maps API instead then have at it! -->
                            {!! config('location_iframe') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
