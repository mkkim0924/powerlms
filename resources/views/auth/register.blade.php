@extends('front-end.layouts.master')
@section('content')
    <div class="main-wrapper">
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center">
            <div class="auth-box my-5">
                <div id="loginform">
                    <div class="logo">
                        <h5 class="font-medium m-b-20">@lang('frontend.signup.header')</h5>
                    </div>
                    <div class=" mx-auto text-center ">
                        <h4 class="py-2 mx-auto text-center login-title">@lang('frontend.signup.note.sign_up_and_start_learning')</h4>
                        @if(config('services.google.active') == 1 || config('services.facebook.active') == 1)
                            @if(config('services.google.active') == 1)
                                <a href="{{ route('auth.social', 'google') }}" class="btn btn-google w-100 mb-3 py-2 px-4">
                                    <span> <i class="fab fa-google float-start pt-1"></i></span>
                                    @lang('frontend.signup.label.sign_up_with_gmail')</a>
                            @endif
                            @if(config('services.facebook.active') == 1)
                                <a href="{{ route('auth.social', 'facebook') }}" class="btn btn-facebook w-100 mb-2 py-2 px-4">
                                    <span><i class="fab fa-facebook-f float-start pt-1"></i></span>
                                    @lang('frontend.signup.label.sign_up_with_facebook')</a>
                            @endif
                            <div class="show-more-line my-2 d-flex">
                                <span class="show-more mx-auto">@lang('frontend.signup.or_text')</span>
                            </div>
                        @endif
                    </div>
                    <!-- Form -->
                    @include('front-end.layouts.partials.flash_messages')
                    <div class="row">
                        <div class="col-12">
                            <form class="mt-3" id="loginform" method="POST"
                                  action="{{ route('register') }}">
                                @csrf
                                <div class="form-group mb-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                class="far fa-user"></i></span>
                                        </div>
                                        <input name="name" type="text" class="form-control form-control-lg"
                                               style="font-size: 1rem;"
                                               placeholder="@lang('frontend.signup.label.name')"
                                               aria-label="Name" aria-describedby="basic-addon1" data-validation="required"
                                               data-validation-error-msg="{{ __('validation.required', ['attribute' => strtolower(__('frontend.signup.label.name'))]) }}">
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                class="far fa-user"></i></span>
                                        </div>
                                        <input name="email" type="email" class="form-control form-control-lg"
                                               placeholder="@lang('frontend.signup.label.email')"
                                               aria-label="Email" aria-describedby="basic-addon1" data-validation="email"
                                               data-validation-error-msg="{{ __('validation.email', ['attribute' => strtolower(__('frontend.signup.label.email'))]) }}">
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="input-group position-relative">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon2"><i
                                                class="fas fa-pencil-alt"></i></span>
                                        </div>
                                        <input name="password" type="password"
                                               class="form-control form-control-lg show-password" id="password"
                                               placeholder="@lang('frontend.signup.label.password')"
                                               aria-label="Password" aria-describedby="basic-addon1" data-validation="required"
                                               data-validation-error-msg="{{ __('validation.required', ['attribute' => strtolower(__('frontend.signup.label.password'))]) }}">
                                        <i class="fas fa-eye-slash togglePassword" id="loginPasswordShow"></i>
                                    </div>
                                </div>
                                @if(config('disable_instructor_registration') != 1)
                                <div class="form-group mb-2">
                                    <div class="custom-control custom-checkbox mr-sm-2 ps-0">
                                        <input name="is_instructor" type="checkbox" class="custom-control-input"
                                               id="checkboxInstructor" value="check">
                                        <label class="custom-control-label grey-text" for="checkboxInstructor">@lang('frontend.signup.label.register_as_instructor')</label>
                                    </div>
                                </div>
                                @endif
                                @if(config('services.no-captcha.active'))
                                    <div class="form-group row">
                                        <div class="col">
                                            {{ no_captcha()->input('g-recaptcha-response') }}
                                        </div><!--col-->
                                    </div><!--row-->
                                @endif
                                <div class="form-group text-center flex flex-column">
                                    <div class="col-xs-12 col-12 mb-3">
                                        <button class="btn btn-block btn-lg bg-gradient-primary text-white w-100 py-2"
                                                type="submit">
                                            @lang('global.button.submit')
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group m-b-0 m-t-10">
                                    <div class="col-sm-12 text-center grey-text ">
                                        @lang('frontend.signup.note.have_an_account') <a href="{{ route('login') }}"
                                                                    class="text-info m-l-5 pl-5">  <b> @lang('frontend.signin.header') </b></a>
                                    </div>
                                </div>
                            </form>
                            <hr class="w-25 mx-auto">
                            {!! __('frontend.signup.note.privacy_policy',['terms_url' => route('details', 'terms-and-conditions'), 'privacy_url' => route('details', 'privacy-policy')]) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <link href="{{ asset('frontend-assets/files/css/flaticon.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend-assets/unit-page/login.css') }}"/>
@endpush
@push('footer_scripts')
    <script src="{{ asset('admin-assets/assets/extra-libs/jquery-form-validator/jquery.form-validator.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            "use strict";

            $.validate({
                scrollToTopOnError: false
            });
            $('[data-toggle="tooltip"]').tooltip();
            $(".preloader").fadeOut();

            $('#loginPasswordShow').on('click', function (e) {
                // toggle the type attribute
                var type = $('#password').attr('type') === 'password' ? 'text' : 'password';
                $('#password').attr('type', type);
                // toggle the eye slash icon
                this.classList.toggle('fa-eye-slash');
                this.classList.toggle('fa-eye');
            });
        });
    </script>
    @if(config('services.no-captcha.active'))
        {{ no_captcha()->script() }}
        <script>
            var site_key = "{{ config('no-captcha.sitekey') }}";
            grecaptcha.ready(function () {
                grecaptcha.execute(site_key, {action: 'register'}).then(function (token) {
                    document.getElementById("g-recaptcha-response").value = token;
                });
                // refresh token every minute to prevent expiration
                setInterval(function () {
                    grecaptcha.execute(site_key, {action: 'register'}).then(function (token) {
                        document.getElementById("g-recaptcha-response").value = token;
                    });
                }, 60000);
            });
        </script>
    @endif
@endpush
