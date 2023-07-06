@extends('admin.layouts.master')
@section('admin_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @if ($instructor->instructor_application_status == 0)
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mb-3">@lang('frontend.instructor_application_form.header_text')</h4>
                            <div class="alert alert-info" role="alert">
                                <h4 class="alert-heading">@lang('frontend.instructor_application_form.heads_up_text')</h4>
                                @lang('frontend.instructor_application_form.heads_up_note')
                            </div>
                            <form class="required-form" files="true" action="{{ route('application.store') }}"
                                method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label>@lang('frontend.instructor_application_form.profile_image_label')</label>
                                    <span class="text-danger">*</span>
                                    <input type="file" class="form-control" data-validation="required"
                                        data-validation-error-msg="{{ __('validation.required', ['attribute' => strtolower(__('frontend.instructor_application_form.profile_image_label'))]) }}"
                                        name="image" id="image">
                                </div>
                                <div class="form-group">
                                    <label for="name">@lang('frontend.instructor_application_form.name_label')</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        aria-describedby="name-help" placeholder="" value="{{ $instructor->name }}"
                                        readonly="" required="">
                                </div>
                                <div class="form-group">
                                    <label for="email">@lang('frontend.instructor_application_form.email_address_label')</label>
                                    <input type="email" class="form-control" name="email" id="email"
                                        aria-describedby="email-help" placeholder="" value="{{ $instructor->email }}"
                                        readonly="" required="">
                                </div>
                                <div class="form-group">
                                    <label for="phone">@lang('frontend.instructor_application_form.phone_number_label')</label>
                                    <span class="text-danger">*</span>
                                    <input type="number" class="form-control" name="mobile_number" id="phone"
                                        aria-describedby="phone-help" placeholder="" data-validation="required"
                                        data-validation-error-msg="{{ __('validation.required', ['attribute' => strtolower(__('frontend.instructor_application_form.phone_number_label'))]) }}">
                                </div>
                                <div class="form-group">
                                    <label for="address">@lang('frontend.instructor_application_form.address_label')</label>
                                    <span class="text-danger">*</span>
                                    <textarea name="address" id="address" class="form-control" data-validation="required"
                                        data-validation-error-msg="{{ __('validation.required', ['attribute' => strtolower(__('frontend.instructor_application_form.address_label'))]) }}"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="experience"> @lang('frontend.instructor_application_form.experience_label')</label>
                                    <span class="text-danger">*</span>
                                    <textarea name="experience" id="experience" class="form-control" data-validation="required"
                                        data-validation-error-msg="{{ __('validation.required', ['attribute' => strtolower(__('frontend.instructor_application_form.experience_label'))]) }}"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="bio">@lang('frontend.instructor_application_form.about_label')</label>
                                    <span class="text-danger">*</span>
                                    <textarea name="bio" id="bio" class="form-control" data-validation="required"
                                        data-validation-error-msg="{{ __('validation.required', ['attribute' => strtolower(__('frontend.instructor_application_form.about_label'))]) }}"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="message">@lang('frontend.instructor_application_form.any_message_label')</label>
                                    <textarea name="instructor_application_message" id="message" class="form-control"></textarea>
                                    <small id="message-help" class="form-text text-muted">@lang('frontend.instructor_application_form.any_message_note')</small>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="text-center">
                                            <div class="mb-3 mt-3">
                                                <button type="submit"
                                                    class="btn btn-primary text-center">@lang('global.button.apply')</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @elseif($instructor->instructor_application_status == 2)
                    <div class="card">
                        <div class="card-header font-20 text-white">
                            @lang('frontend.instructor_application_form.instructor_application_header')
                        </div>
                        <center>
                            <div class="card-body">
                                <h3 class="card-title">@lang('frontend.instructor_application_form.application_status_title')</h3>
                                <div class="alert alert-warning font-18 py-2" style="font-weight: 500;">
                                    @lang('frontend.instructor_application_form.application_status_2_note')
                                </div>
                                <a href="javascript:void(0)" data-toggle="modal" data-target=".bs-example-modal-lg"
                                    class="model_img btn btn-secondary">@lang('frontend.instructor_application_form.view_application_details_button')</a>
                            </div>
                        </center>
                    </div>
                @elseif($instructor->instructor_block_status == 1)
                    <div class="card">
                        <div class="card-header font-20 text-white">
                            @lang('frontend.instructor_application_form.instructor_application_header')
                        </div>
                        <center>
                            <div class="card-body">
                                <h3 class="card-title">@lang('frontend.instructor_application_form.application_status_title')</h3>
                                <div class="alert alert-warning font-18 py-2" style="font-weight: 500;">
                                    @lang('frontend.instructor_application_form.application_status_1_note')

                                </div>
                                <a href="javascript:void(0)" data-toggle="modal" data-target=".bs-example-modal-lg"
                                    class="model_img btn btn-secondary">@lang('frontend.instructor_application_form.view_application_details_button')</a>
                            </div>
                        </center>
                    </div>
                @elseif($instructor->instructor_application_status == 3)
                    <div class="card">
                        <div class="card-header font-20 text-white">
                            @lang('frontend.instructor_application_form.instructor_application_header')
                        </div>
                        <center>
                            <div class="card-body pb-2">
                                <h3 class="card-title">@lang('frontend.instructor_application_form.application_status_title')</h3>
                                <div class="alert alert-danger font-18 py-2" style="font-weight: 500;">
                                    {!! __('frontend.instructor_application_form.application_status_3_note', [
                                        'reject_reason' => $instructor->application_reject_reason,
                                    ]) !!}

                                </div>
                                @lang('frontend.instructor_application_form.help_note')

                                <div class="row">
                                    <div class="col-lg-12 d-flex justify-content-center gap-2">
                                        <p class="mx-3"><i class="fas fa-phone me-3"
                                                style="transform: rotateY(180deg);"></i><a
                                                href="tel:{{ config('contact_no') }}">{{ config('contact_no') }}</a></p>
                                        <p class="last-li">
                                            <i class="far fa-envelope me-3"></i> <a
                                                href="mailto:{{ config('contact_email') }}">{{ config('contact_email') }}</a>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <a href="javascript:void(0)" data-toggle="modal" data-target=".bs-example-modal-lg"
                                class="model_img btn btn-secondary mb-3">@lang('frontend.instructor_application_form.view_application_details_button')</a>
                        </center>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

{{-- Model --}}
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h3 class="box-title m-t-40">@lang('frontend.instructor_application_form.general_info_title')</h3>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>@lang('frontend.instructor_application_form.profile_image_label')</td>
                                    <td><img src="{{ getFileUrl($instructor->image, 'users/') }}"
                                            alt="{{ $instructor->name }}" width="80">
                                    </td>
                                </tr>
                                <tr>
                                    <td width="390">@lang('frontend.instructor_application_form.name_label')</td>
                                    <td> {{ $instructor->name }} </td>
                                </tr>
                                <tr>
                                    <td>@lang('frontend.instructor_application_form.email_address_label')</td>
                                    <td> {{ $instructor->email }} </td>
                                </tr>
                                <tr>
                                    <td>@lang('frontend.instructor_application_form.address_label')</td>
                                    <td> {{ $instructor->address }} </td>
                                </tr>
                                <tr>
                                    <td>@lang('frontend.instructor_application_form.phone_number_label')</td>
                                    <td> {{ $instructor->mobile_number }} </td>
                                </tr>
                                <tr>
                                    <td>@lang('frontend.instructor_application_form.about_label')</td>
                                    <td> {{ $instructor->bio }} </td>
                                </tr>
                                <tr>
                                    <td>@lang('frontend.instructor_application_form.any_message_label')</td>
                                    <td> {{ $instructor->instructor_application_message ?? 'No message' }}
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect text-left"
                    data-dismiss="modal">@lang('global.button.close')</button>
            </div>
        </div>
    </div>
</div>
