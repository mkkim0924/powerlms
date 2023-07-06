@extends('admin.layouts.master')
@section('admin_content')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-4 col-6 d-flex align-items-center">
                                    <h2 class="card-title text-capitalize">@lang('backend.manual_enroll_form.header')</h2>
                                </div>
                                <div class="col lg 4 ">
                                    <span class="pull-right d-inline-block @if(session('display_type')=='rtl') float-left @else float-right @endif">
                                         <a href="{{ route('admin.course_report') }}"
                                            class="btn btn-rounded btn-warning">
                                            <i class="fa fa-arrow-left" aria-hidden="true"></i> @lang('global.button.back')
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        {!! Form::open(['route'=>['admin.course_report.manual_enroll_store'],'method' => 'POST', 'enctype'=> "multipart/form-data", 'files' => true, 'id' => "courseForm"]) !!}
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>@lang('backend.manual_enroll_form.label.select_course')</label>
                                                {!! Form::select('course_id', $courses, request('course_id'), [
                                                    'id' => 'course_id',
                                                    'class' => 'form-control select2Search',
                                                    'placeholder' => '',
                                                    'data-validation' => 'required',
                                                    'data-validation-error-msg' => __('validation.required', ['attribute' => __('backend.manual_enroll_form.label.select_course')]),
                                                ]) !!}
                                            </div>
                                            <div class="col-md-6">
                                                <label>@lang('backend.manual_enroll_form.label.select_student')</label>
                                                {!! Form::select('student_id', $students, request('student_id'), [
                                                    'id' => 'student_id',
                                                    'class' => 'form-control select2Search',
                                                    'placeholder' => '',
                                                    'data-validation' => 'required',
                                                    'data-validation-error-msg' => __('validation.required', ['attribute' => __('backend.manual_enroll_form.label.select_student')]),
                                                ]) !!}
                                            </div>
                                        </div>
                                        <div class="form-group m-b-0 mt-3 text-left">
                                            <button type="submit" class="btn btn-success"><i class="fa fa-check"></i>
                                                @lang('global.button.save') </button>
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
    </div>
@endsection
