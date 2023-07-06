@extends('admin.layouts.master')
@section('admin_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-4 col-6 d-flex align-items-center">
                                <h2 class="card-title text-capitalize">@lang('backend.updates.header.update')</h2>
                            </div>
                            <div class="col lg 4 ">
                                <span class="pull-right d-inline-block @if(session('display_type')=='rtl') float-left @else float-right @endif">
                                    @lang('backend.update.current_version') {{ config('app.version') }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('admin.update_theme.update') }}" enctype="multipart/form-data">
                            @csrf
                            <h2>@lang('backend.update.note_before_upload_title')</h2>
                            @lang('backend.update.note_before_upload')
                            <h5 class="text-danger">@lang('backend.update.warning')</h5>
                            <div class="row">
                                <div class="form-group col-12 col-md-6">
                                    <label class="font-weight-bold">@lang('backend.update.label.upload_new_version')</label>
                                    <span class="text-danger">*</span>
                                    <input type="file" id="file" data-allowed-file-extensions=".zip" accept="application/zip" class="form-control dropify" name="file" data-validation="required" data-validation-error-msg="{{ __('validation.required', ['attribute' => '']) }}">
                                </div>
                                <div class="form-group col-12">
                                    <button class="btn btn-primary mt-auto" type="submit">@lang('global.button.update')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
