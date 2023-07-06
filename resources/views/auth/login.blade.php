@extends('front-end.layouts.master')
@section('content')
    <div class="main-wrapper">
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center">
            <div class="auth-box my-5">
                <div id="loginform">
                    <div class="logo">
                        <h5 class="font-medium m-b-20">@lang('frontend.signin.header')</h5>
                    </div>
                    <div class=" mx-auto text-center ">
                        <h4 class="py-2 mx-auto text-center login-title">@lang('frontend.signin.note.sign_in_and_start_learning')</h4>
                        @if(config('services.google.active') == 1 || config('services.facebook.active') == 1)
                            @if(config('services.google.active') == 1)
                                <a href="{{ route('auth.social', 'google') }}"
                                   class="btn btn-google w-100 mb-3 py-2 px-4">
                                    <span> <i class="fab fa-google float-start "></i></span>
                                    @lang('frontend.signin.label.signin_with_google')</a>
                            @endif
                            @if(config('services.facebook.active') == 1)
                                <a href="{{ route('auth.social', 'facebook') }}"
                                   class="btn btn-facebook w-100 mb-2 py-2 px-4">
                                    <span><i class="fab fa-facebook-f float-start"></i></span>
                                    @lang('frontend.signin.label.signin_with_facebook')</a>
                            @endif
                            <div class="show-more-line my-2 d-flex">
                                <span class="show-more mx-auto">@lang('frontend.signin.or_text')</span>
                            </div>
                        @endif
                    </div>
                    <!-- Form -->
                    @include('front-end.layouts.partials.flash_messages')
                    <div class="row">
                        <div class="col-12">
                            <form class="" id="loginform" method="POST"
                                  action="{{ route('user.authenticate') }}">
                                @csrf
                                <div class="form-group mb-3">
                                    <div class="input-group mb-0">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                class="far fa-user"></i></span>
                                        <input name="email" type="email" class="form-control form-control-lg"
                                               placeholder="@lang('frontend.signin.label.email')"
                                               aria-label="Email" aria-describedby="basic-addon1"
                                               data-validation="email"
                                               data-validation-error-msg="{{ __('validation.email', ['attribute' => strtolower(__('frontend.signin.label.email'))]) }}">
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="input-group mb-0 position-relative">
                                        <span class="input-group-text" id="basic-addon2"><i
                                                class="fas fa-pencil-alt"></i></span>
                                        <input name="password" type="password"
                                               class="form-control form-control-lg show-password" id="password"
                                               placeholder="@lang('frontend.signin.label.password')"
                                               aria-label="Password" aria-describedby="basic-addon1"
                                               data-validation="required"
                                               data-validation-error-msg="{{ __('validation.required', ['attribute' => strtolower(__('frontend.signin.label.password'))]) }}">
                                        <i class="fas fa-eye-slash togglePassword" id="loginPasswordShow"></i>
                                    </div>
                                </div>
                                @if(config('services.no-captcha.active'))
                                    <div class="form-group row">
                                        <div class="col">
                                            {{ no_captcha()->input('g-recaptcha-response') }}
                                        </div><!--col-->
                                    </div><!--row-->
                                @endif
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="custom-control custom-checkbox float-end mb-2">
                                            <a href="javascript:void(0)" id="to-recover"
                                               class="text-dark float-right"><i
                                                    class="fa fa-lock m-r-5 mx-2"></i>@lang('frontend.signin.label.forgot_password')
                                            </a>
                                        </div>
                                    </div>
                                </div>
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
                                        @lang('frontend.signup.note.do_not_have_an_account')<a
                                            href="{{ route('register') }}"
                                            class="text-info m-l-5 pl-5"><b>@lang('frontend.signup.header')</b></a>
                                    </div>
                                </div>
                            </form>
                            <hr class="w-100 mx-auto">
                            {!! __('frontend.signin.note.privacy_policy',['terms_url' => route('details', 'terms-and-conditions'), 'privacy_url' => route('details', 'privacy-policy')]) !!}
                        </div>
                    </div>
                </div>
                <div id="recoverform" style="display: none;">
                    <div class="logo">
                        <h5 class="font-medium mb-3">@lang('frontend.signin.label.recover_password')</h5>
                        <span class="forgot-pass-text grey-text ">@lang('frontend.signin.note.recover_password')</span>
                    </div>
                    <div class="row my-3">
                        <!-- Form -->
                        <form class="col-12" method="POST" action="{{ route('reset-password.send-link') }}">
                        @csrf
                        <!-- email -->
                            <div class="form-group ">
                                <input name="email" class="form-control form-control-lg mb-0" type="email"
                                       data-validation="email"
                                       placeholder="@lang('frontend.signin.label.email')"
                                       data-validation-error-msg="{{ __('validation.email', ['attribute' => strtolower(__('frontend.signin.label.email'))]) }}">
                            </div>
                            <!-- pwd -->
                            <div class="row mt-3">
                                <div class="col-12">
                                    <button class="btn btn-block btn-lg bg-gradient-primary text-white w-100 py-2"
                                            type="submit"
                                            name="action">@lang('global.button.reset')
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
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
            // ==============================================================
            // Login and Recover Password
            // ==============================================================
            $('#to-recover').on("click", function () {
                $("#loginform").slideUp();
                $("#recoverform").fadeIn();
            });

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
                grecaptcha.execute(site_key, {action: 'login'}).then(function (token) {
                    document.getElementById("g-recaptcha-response").value = token;
                });
                // refresh token every minute to prevent expiration
                setInterval(function () {
                    grecaptcha.execute(site_key, {action: 'login'}).then(function (token) {
                        document.getElementById("g-recaptcha-response").value = token;
                    });
                }, 60000);
            });
        </script>
    @endif
@endpush
