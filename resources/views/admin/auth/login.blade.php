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
                    <h5 class="font-medium m-b-20">@lang('backend.admin.header.login')</h5>
                </div>
                <!-- Form -->
                @include('admin.layouts.partials.flash_messages')
                <div class="row">
                    <div class="col-12">
                        <form class="mt-3" method="POST" action="{{ route('admin.authenticate') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text px-3" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
                                    <input name="email" type="email" class="form-control form-control-lg" placeholder="@lang('backend.admin.label.email')"
                                           aria-label="Email" aria-describedby="basic-addon1" data-validation="email" data-validation-error-msg="{{ __('validation.email', ['attribute' => strtolower(__('backend.admin.label.email'))]) }}">
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text px-3" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input name="password" type="password" class="form-control form-control-lg" placeholder="@lang('backend.admin.label.password')"
                                           aria-label="Password" aria-describedby="basic-addon1" data-validation="required" data-validation-error-msg="{{ __('validation.required', ['attribute' => strtolower(__('backend.admin.label.password'))]) }}">
                                </div>
                            </div>
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
<script>
    $(function () {
        'use strict';

        $('[data-toggle="tooltip"]').tooltip();
        $(".preloader").fadeOut();
        $.validate({
            scrollToTopOnError: false
        });
    });
</script>
</body>
</html>
