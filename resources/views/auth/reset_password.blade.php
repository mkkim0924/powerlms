<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ config('meta_description') }}">
    <!-- Favicon icon -->
    <!-- FAVICON AND TOUCH ICONS  -->
    <link rel="shortcut icon" href="{{ getFileUrl(config('favicon_icon'), 'logos') }}" type="image/x-icon">
    <link rel="icon" href="{{ getFileUrl(config('favicon_icon'), 'logos') }}" type="image/x-icon">
    <title>{{ config('meta_title') }}</title>
    <!-- Custom CSS -->
    <link href="{{ asset('admin-assets/dist/css/style.min.css') }}" rel="stylesheet">
    <link defer href="{{ asset('admin-assets/assets/extra-libs/jquery-form-validator/jquery.form-validator.min.css') }}"
          rel="stylesheet"/>
</head>

<body>
<div class="main-wrapper">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Login box.scss -->
    <!-- ============================================================== -->
    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url(/admin-assets/assets/images/big/auth-bg.jpg) no-repeat center center;">
        <div class="auth-box">
            <div id="loginform">
                <div class="logo">
                    <span class="db"><img src="{{ getFileUrl(config('logo'), 'logos') }}" alt="logo" width="152"
                                          height="35"/></span>
                    <h5 class="font-medium m-b-20">@lang('frontend.reset_password.header_text')</h5>
                </div>
                <!-- Form -->
                @include('front-end.layouts.partials.flash_messages')
                <div class="row">
                    <div class="col-12">
                        <form class="form-horizontal mt-3" method="POST" action="{{ route('reset-password.store') }}">
                            @csrf
                            <div class="form-group">
                                <label>@lang('frontend.reset_password.email_label')</label>
                                <input type="text" name="email" class="form-control" placeholder="@lang('frontend.reset_password.email_placeholder')"
                                       value="{{ $recordExist->email }}"
                                       data-validation="email" readonly>
                            </div>
                            <div class="form-group">
                                <label>@lang('frontend.reset_password.password_label')</label>
                                {!! Form::password('password_confirmation', ['class'=>'form-control', 'placeholder'=>__('frontend.reset_password.password_placeholder'), 'data-validation'=>'required',
                                        'data-validation-error-msg-required' => __('frontend.reset_password.password_validation')]) !!}
                            </div>
                            <div class="form-group">
                                <label>@lang('frontend.reset_password.confirm_password_label')</label>
                                {!! Form::password('password',['class'=>'form-control', 'data-validation' => 'confirmation', 'placeholder'=>__('frontend.reset_password.confirm_password_placeholder'),
                                        'data-validation-error-msg' => __('frontend.reset_password.confirm_password_validation')]) !!}
                            </div>
                            <input type="hidden" name="activation_token" value="{{ $token }}">
                            <div class="form-group text-center">
                                <div class="col-xs-12 p-b-20">
                                    <button class="btn btn-block btn-lg bg-gradient-primary text-white" type="submit">@lang('global.button.submit')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script src="{{ asset('admin-assets/assets/libs/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{ asset('admin-assets/assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
<script src="{{ asset('admin-assets/assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin-assets/assets/extra-libs/jquery-form-validator/jquery.form-validator.min.js') }}"></script>
<script src="{{ asset('admin-assets/assets/extra-libs/jquery-form-validator/security.js') }}"></script>
<script>
    $(function () {
        'use strict';
        $('[data-toggle="tooltip"]').tooltip();
        $(".preloader").fadeOut();
        $.validate({
            modules: 'security',
            scrollToTopOnError: false
        });
    });
</script>
</body>
</html>
