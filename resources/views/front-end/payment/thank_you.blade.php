@extends('front-end.layouts.master')
@section('content')
    <div class="main-wrapper">
        <div class="inner-wrapper">
            <div class="container">
                <div class="row align-items-stretch py-4">
                    <div class="col-md-6 mx-auto text-center">
                        <img src="{{ url('frontend-assets/images/unit-page/PaymentRecevied.png') }}" alt="">
                        <h3 class="my-3 mx-auto text-center fw-bold" style=" font-family: var(--bs-font-sans-serif);">
                            @lang('frontend.payment_success.page_header_text')</h3>
                        <h2 class="my-3 mx-auto text-center fw-bold" style=" font-family: var(--bs-font-sans-serif);">
                            @lang('frontend.payment_success.sub_header_text')</h2>
                        <hr>
                        <div class="py-2">
                            <p class="mb-2 fw-normal">{!! __('frontend.payment_success.payment_received_text', ['price' => formatPrice($course->price), 'course' => $course->name]) !!}</span>
                            </p>
                            @if(request()->type == 'course')
                                <a href="{{ route('course_detail', $course->slug) }}" class="btn btn-rose ms-auto mt-2">
                                    @lang('frontend.payment_success.go_to_course_button')</a>
                            @elseif(request()->type == 'bundle')
                                <a href="{{ route('bundle_detail', $course->slug) }}" class="btn btn-rose ms-auto mt-2">
                                    @lang('frontend.payment_success.go_to_course_button')</a>
                            @endif
                        </div>
                        <hr>
                        <img src="{{ url('frontend-assets/images/unit-page/support.png') }}" alt="">
                        <p class="my-3"> @lang('frontend.payment_success.page_help_text')</p>
                        <a class="btn-link-blue fw-bold ms-auto text-white p-2 border-1 rounded-1"
                           style="background-color: #3AB54A;"><span> {{ config('contact_no') }}</span></a>
                    </div>
                </div>
            </div>
        </div>
        <hr style="opacity:.1;">
    </div>
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend-assets/unit-page/login.css') }}"/>
@endpush
