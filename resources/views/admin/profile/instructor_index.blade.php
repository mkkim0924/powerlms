@extends('admin.layouts.master')
@section('admin_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-4 col-6 d-flex align-items-center">
                                <h2 class="card-title text-capitalize">@lang('backend.profile.header')</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card card-body">
                        <form class="form-horizontal mt-4" method="POST" enctype="multipart/form-data"
                            action="{{ route('instructor.profile.update') }}">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('backend.profile.label.name')</label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ $instructor->name }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('backend.profile.label.email')</label>
                                        <input type="email" class="form-control" id="email"
                                            value="{{ $instructor->email }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('backend.profile.label.image') ({{ \App\Models\User::IMAGE_DIMENSION['width'] }}x{{ \App\Models\User::IMAGE_DIMENSION['height'] }})</label>
                                        <input type="file" accept="image/*" class="dropify" data-show-remove="false"
                                            data-allowed-file-extensions="png jpg jpeg svg"
                                            @if (isset($instructor) && $instructor->image != '') data-default-file="{{ getFileUrl($instructor->image, 'users/') }}"
                                            @else data-validation="required" data-validation-error-msg="{{ __('validation.required', ['attribute' => strtolower(__('backend.profile.label.image'))]) }}" @endif
                                            name="image" id="image">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label> @lang('backend.profile.label.experience')</label>
                                        {!! Form::textarea('experience', $instructor->experience ?? old('experience'), [
                                            'class' => 'form-control',
                                            'id' => 'experience',
                                            'rows' => 4,
                                        ]) !!}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label> @lang('backend.profile.label.address')</label>
                                        {!! Form::textarea('address', $instructor->address ?? old('address'), [
                                            'class' => 'form-control',
                                            'id' => 'address',
                                            'rows' => 4,
                                        ]) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="card-header">
                                <div class="row">
                                    <div class="col-lg-4 d-flex align-items-center">
                                        <h2 class="card-title">@lang('backend.profile.label.bank_credentials')</h2>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label> @lang('backend.profile.label.bank_name')</label>
                                        <input type="text" name="bank_name" class="form-control"
                                            value="{{ $instructor->bank_name }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label> @lang('backend.profile.label.account_number')</label>
                                        <input type="text" name="account_number" class="form-control"
                                            value="{{ $instructor->account_number }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label> @lang('backend.profile.label.ifsc/routing_number')</label>
                                        <input type="text" name="ifsc_routing_number" class="form-control"
                                            value="{{ $instructor->ifsc_routing_number }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group has-success">
                                        <label class="control-label">@lang('backend.profile.label.select_country')</label>
                                        {!! Form::select('country', $countries, $instructor->country ?? old('country'), [
                                            'class' => 'form-control select2Search',
                                            'placeholder' => '',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label> @lang('backend.profile.label.zip_code')</label>
                                        <input type="text" name="zip_code" class="form-control"
                                            value="{{ $instructor->zip_code }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label> @lang('backend.profile.label.bank_address')</label>
                                        {!! Form::textarea('bank_address', $instructor->bank_address ?? old('bank_address'), [
                                            'class' => 'form-control',
                                            'id' => 'bank_address',
                                            'rows' => 4,
                                        ]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-lg-4 d-flex align-items-center">
                                        <h2 class="card-title">@lang('backend.profile.label.social_links')</h2>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="facebook">@lang('backend.profile.label.facebook')</label>
                                        <input type="text" class="form-control" name="facebook_link" id="facebook" value="{{ $links->facebook ?? ''}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="linkedin">@lang('backend.profile.label.linkedin')</label>
                                        <input type="text" class="form-control" name="linkedin_link" id="linkedin" value="{{ $links->linkedin ?? ''}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="twitter">@lang('backend.profile.label.twitter')</label>
                                        <input type="text" class="form-control" name="twitter_link" id="twitter" value="{{ $links->twitter ?? ''}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="website">@lang('backend.profile.label.website')</label>
                                        <input type="text" class="form-control" name="website_link" id="website" value="{{ $links->website ?? ''}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group m-b-0 text-left">
                                <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i>
                                    @lang('global.button.save') </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
