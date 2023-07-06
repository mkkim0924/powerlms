@extends('front-end.layouts.master')

@section('content')
    @php $current_tab = Session::get('current_tab') ?? 'profile' @endphp
    @include('front-end.user.partials.navbar', ['current_tab' => 'profile'])
    <section class="user-dashboard-area">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-lg-3 col-12">
                    <div class="user-dashboard-sidebar box-shadow-5">
                        <div class="user-box" id="left-section">
                            @php $image = getFileUrl($user->image ?? 'default-placeholder.jpg', 'users') @endphp
                            <div class="avatar-upload container-img">
                                <div class="avatar-edit">
                                    <input type="file" id="imageUpload" class="image" accept=".png, .jpg, .jpeg">
                                    <label for="imageUpload"></label>
                                </div>
                                <div class="avatar-preview">
                                    <div id="imagePreview"
                                         style="background: url('{{ $image }}') no-repeat center;background-size: cover;">
                                    </div>
                                    <div class="overlay">
                                        <a class="cam" href=""><img
                                                src="{{ url('frontend-assets/images/unit-page/camera1.svg') }}"
                                                alt="" class="pb-1"></a>
                                    </div>
                                </div>
                            </div>
                            <h5 class="profile-pic mt-3 p-2 text-center">@lang('frontend.profiles.change_profile_picture_text')</h5>
                        </div>
                        <div class="user-dashboard-menu">

                            <div class="d-flex align-items-start">
                                <div class="nav flex-column nav-pills me-3 w-100" id="v-pills-tab" role="tablist"
                                     aria-orientation="vertical">
                                    <button
                                        class="@if ($current_tab == 'profile') nav-link active @else nav-link @endif text-start mb-3"
                                        id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home"
                                        type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">
                                        <i class="fas fa-user-circle"></i> @lang('frontend.profiles.profile_tab')
                                    </button>
                                    <button
                                        class="@if ($current_tab == 'password') nav-link active @else nav-link @endif text-start mb-3"
                                        id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile"
                                        type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                                        <i class="fas fa-lock"></i>
                                        @lang('frontend.profiles.account_tab')
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 col-lg-9 mt-md-0 col-12 radius-10 box-shadow-5 mt-4">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="@if ($current_tab == 'profile') tab-pane fade show active @else tab-pane fade @endif"
                             id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                            @if (session('successes'))
                                <div class="alert alert-success">
                                    {{ session('successes') }}
                                </div>
                            @endif
                            <form class="w-100 bg-white p-4" action="{{ route('profile.update') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-12 border-bottom mb-3 pb-3">
                                        <h4>@lang('frontend.profiles.edit_profile_header_text')</h4>
                                        @lang('frontend.profiles.edit_profile_sub_header_text')

                                    </div>

                                    <div class="col-12 mb-3">
                                        <label class="text-dark fw-600" for="FristName">@lang('frontend.profiles.full_name_label')</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            <input type="text" class="form-control" name="name" id="changes"
                                                   placeholder="@lang('frontend.profiles.full_name_label')" value="{{ $user->name }}">
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="text-dark fw-600" for="email">@lang('frontend.profiles.email_label')</label>
                                        <div class="input-group">
                                            <input type="email" class="form-control" name="email" id="email"
                                                   placeholder="@lang('frontend.profiles.email_label')" value="{{ $user->email }}" disabled="">
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="text-dark fw-600" for="mobile_number">@lang('frontend.profiles.mobile_number_label')</label>
                                        <div class="input-group">
                                            <input type="number" value="{{ $user->mobile_number }}" id="number"
                                                   class="form-control" name="mobile_number" placeholder="@lang('frontend.profiles.mobile_number_label')">
                                        </div>
                                    </div>
                                    <div class="col-12 pt-4">
                                        <button type="submit" id="submit-button" disabled="disabled"
                                                class="btn btn-rose px-5 py-2">@lang('global.button.save')
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="@if ($current_tab == 'password') tab-pane fade show active @else tab-pane fade @endif"
                             id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if ($errors)
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                            <form class="w-100 bg-white p-4" action="{{ route('password.update') }}" method="post">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-12 border-bottom mb-3 pb-3">
                                        <h4>@lang('frontend.profiles.account_information_header_text')</h4>
                                        @lang('frontend.profiles.account_information_sub_header_text')

                                    </div>
                                    <div
                                        class="form-group mb-3 col-12 {{ $errors->has('current-password') ? ' has-error' : '' }}">
                                        <label class="text-dark fw-600" for="new-password">@lang('frontend.profiles.current_password_label')</label>
                                        <div class="input-group position-relative">
                                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                                            <input id="old_password" type="password" class="form-control"
                                                   name="current-password" placeholder="@lang('frontend.profiles.enter_your_current_password_label')"
                                                   data-validation="required">
                                            <i class="fas fa-eye-slash togglePassword" id="currentPassword"></i>
                                        </div>
                                    </div>
                                    <div
                                        class="form-group col-12 mb-3 {{ $errors->has('new-password') ? ' has-error' : '' }}">
                                        <label class="text-dark fw-600" for="new-password"> @lang('frontend.profiles.new_password_label')</label>
                                        <div class="input-group position-relative">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                            {!! Form::password('password_confirmation', [
                                                'class' => 'form-control',
                                                'id' => 'new_password',
                                                'placeholder' => __('frontend.profiles.enter_your_new_password_label'),
                                                'data-validation' => 'required',
                                                'data-validation-error-msg-required' => __('validation.required', [
                                                    'attribute' => strtolower(__('frontend.profiles.new_password_label')),
                                                ]),
                                            ]) !!}
                                            <i class="fas fa-eye-slash togglePassword" id="newpassword"></i>
                                        </div>
                                    </div>

                                    <div class="form-group col-12 mb-3">
                                        <label class="text-dark fw-600" for="new-password-confirm">
                                            @lang('frontend.profiles.confirm_password_label')</label>
                                        <div class="input-group position-relative">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                            {!! Form::password('password', [
                                                'class' => 'form-control',
                                                'id' => 'confirm_password',
                                                'data-validation' => 'confirmation',
                                                'placeholder' => __('frontend.profiles.enter_new_password_again_label'),
                                                'data-validation-error-msg' => __('validation.confirmed', [
                                                    'attribute' => strtolower(__('frontend.profiles.new_password_label')),
                                                ]),
                                            ]) !!}
                                            <i class="fas fa-eye-slash togglePassword" id="confirmpassword"></i>
                                        </div>
                                    </div>

                                    <div class="col-12 pt-4">
                                        <button type="submit" id="submitbutton" disabled="disabled"
                                                class="btn btn-rose px-5 py-2">@lang('global.button.save')
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <hr style="opacity:.1;">
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend-assets/unit-page/purchase.css') }}"/>
@endpush
@push('footer_scripts')
    <script src="{{ asset('admin-assets/assets/extra-libs/jquery-form-validator/jquery.form-validator.min.js') }}"></script>
    <script src="{{ asset('admin-assets/assets/extra-libs/jquery-form-validator/security.js') }}"></script>
    <script>
        $(document).ready(function () {
            'use strict';

            $.validate({
                modules: 'security',
                scrollToTopOnError: false
            });

            $('#currentPassword').on('click', function (e) {
                var type = $('#old_password').attr('type') === 'password' ? 'text' : 'password';
                $('#old_password').attr('type', type);
                // toggle the eye slash icon
                this.classList.toggle('fa-eye-slash');
                this.classList.toggle('fa-eye');
            });

            $('#newpassword').on('click', function (e) {
                var type = $('#new_password').attr('type') === 'password' ? 'text' : 'password';
                $('#new_password').attr('type', type);
                // toggle the eye slash icon
                this.classList.toggle('fa-eye-slash');
                this.classList.toggle('fa-eye');
            });

            $('#confirmpassword').on('click', function (e) {
                var type = $('#confirm_password').attr('type') === 'password' ? 'text' : 'password';
                $('#confirm_password').attr('type', type);
                // toggle the eye slash icon
                this.classList.toggle('fa-eye-slash');
                this.classList.toggle('fa-eye');
            });

            $("#imageUpload").change(function () {
                var input = this;
                var image = input.files[0];
                if (image != undefined) {
                    var extension = image.name.split('.').pop().toLowerCase();
                    if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                        alert("Invalid Image File");
                        $(this).val();
                        return false;
                    }
                }
                var form_data = new FormData();
                form_data.append("image", image);
                $.ajax({
                    url: $app_url + '/profile/update-image',
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function (data) {
                    },
                    success: function (data) {
                        if (data.status) {
                            $("#profileImage").attr('src', data.image)
                            readURL(input);
                            $("#imageOverlay").hide();
                        } else {
                            alert(data.message);
                        }
                    }
                });
            });

            setTimeout(function () {
                $("div.alert").remove();
            }, 5000); // 5 secs

            $('#changes, #number').on('input change', function () {
                if ($(this).val() != '') {
                    $('#submit-button').prop('disabled', false);
                } else {
                    $('#submit-button').prop('disabled', true);
                }
            });

            $('#old_password, #new_password, #confirm_password').on('input change', function () {
                if ($(this).val() != '') {
                    $('#submitbutton').prop('disabled', false);
                } else {
                    $('#submitbutton').prop('disabled', true);
                }
            });

        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $("#imagePreview").css(
                        "background-image",
                        "url(" + e.target.result + ")"
                    );
                    console.log(e.target.result);
                    $("#imagePreview").hide();
                    $("#imagePreview").fadeIn(650);
                };
                $("#removeImgDiv").show();
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush
