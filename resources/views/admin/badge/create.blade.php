@extends('admin.layouts.master')
@section('admin_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-4 col-6 d-flex align-items-center">
                                <h2 class="card-title text-capitalize">@lang('backend.badges.header.create')</h2>
                            </div>
                            <div class="col lg 4 ">
                                <span class="pull-right d-inline-block @if(session('display_type')=='rtl') float-left @else float-right @endif">
                                    <a href="{{ route('admin.badge') }}"
                                        class="btn waves-effect waves-light btn-rounded btn-outline-warning">
                                        <i class="fa fa-arrow-left" aria-hidden="true"></i> @lang('global.button.back')
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    @include('admin.layouts.partials.flash_messages')
                                    {!! Form::open([
                                        'route' => 'admin.badge.store',
                                        'method' => 'POST',
                                        'enctype' => 'multipart/form-data',
                                        'files' => true,
                                    ]) !!}
                                    @csrf
                                    <div class="form-group">
                                        <label><span class="help">@lang('backend.badges.label.name')</span></label>
                                        <span class="text-danger">*</span>
                                        {{ Form::text('name', old('name'), ['class' => 'form-control', 'data-validation' => 'required', 'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.badges.label.name'))])]) }}
                                    </div>
                                    <div class="form-group">
                                        <label><span class="help">@lang('backend.badges.label.courses')</span></label>
                                        {{ Form::select('courses[]', $courses, null, ['class' => 'form-control select2Search', 'multiple']) }}
                                    </div>
                                    <hr>
                                    <div class="card-body">
                                        <div class="form-group m-b-0 text-left">
                                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i>
                                                @lang('global.button.save') </button>
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
