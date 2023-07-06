@extends('admin.layouts.master')
@section('admin_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-4 col-6 d-flex align-items-center">
                                <h2 class="card-title text-capitalize"> @lang('backend.profile.header')</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card card-body">
                        <form class="form-horizontal mt-4" method="POST" enctype="multipart/form-data"
                            action="{{ route('admin.profile.update') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('backend.profile.label.name')</label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ $admin->name }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('backend.profile.label.email')</label>
                                        <input type="email" class="form-control" id="email"
                                            value="{{ $admin->email }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('backend.profile.label.image') ({{ \App\Models\User::IMAGE_DIMENSION['width'] }}x{{ \App\Models\User::IMAGE_DIMENSION['height'] }})</label>
                                        <input type="file" accept="image/*" class="dropify" data-show-remove="false"
                                            data-allowed-file-extensions="png jpg jpeg svg"
                                            @if (isset($admin) && $admin->image != '') data-default-file="{{ getFileUrl($admin->image, 'users/') }}"
                                            @else data-validation="required" data-validation-error-msg="{{ __('validation.required', ['attribute' => strtolower(__('backend.profile.label.image'))]) }}" @endif
                                            name="image" id="image">
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
