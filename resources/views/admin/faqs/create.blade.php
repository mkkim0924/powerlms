@extends('admin.layouts.master')
@section('admin_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-4 col-6 d-flex align-items-center">
                                <h2 class="card-title text-capitalize">@lang('backend.course_faqs.header.create')</h2>
                            </div>
                            <div class="col lg 4">
                                <span
                                    class="pull-right d-inline-block @if (session('display_type') == 'rtl') float-left @else float-right @endif">
                                    <a href="{{ route(request()->user_type . '.faqs') }}"
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
                                {!! Form::open([
                                    'route' => request()->user_type . '.faqs.store',
                                    'method' => 'POST',
                                    'enctype' => 'multipart/form-data',
                                    'files' => true,
                                    'id' => 'courseForm',
                                ]) !!}
                                @include('admin.faqs.form')
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                    <div class="newRowTemplate" style="display: none;">
                        <div class="row my-2">
                            <div class="col">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group text-right">
                                                    <button type="submit" class="btn btn-warning removeRow"><i
                                                            class="fas fa-trash"></i> @lang('backend.course_faqs.delete_this_question_button')
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-9">
                                                <div class="form-group">
                                                    <label for="">@lang('backend.course_faqs.label.question')</label>
                                                    <span class="text-danger">*</span>
                                                    {!! Form::text('question[]', null, [
                                                        'class' => 'form-control',
                                                        'data-validation' => 'required',
                                                        'data-validation-error-msg' => __('validation.required', [
                                                            'attribute' => strtolower(__('backend.course_faqs.label.question')),
                                                        ]),
                                                    ]) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-9">
                                                <div class="form-group">
                                                    <label for="question">@lang('backend.course_faqs.label.answer')</label>
                                                    <span class="text-danger">*</span>
                                                    {!! Form::textarea('answer[]', old('question'), [
                                                        'class' => 'form-control editor',
                                                        'data-validation' => 'required',
                                                        'data-validation-error-msg' => __('validation.required', [
                                                            'attribute' => strtolower(__('backend.course_faqs.label.answer')),
                                                        ]),
                                                    ]) !!}
                                                </div>
                                            </div>
                                        </div>
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

@section('footer_scripts')
    <script type="text/javascript">
        var course_id = "{{ request('course_id') }}";
        var $document = $(document);
        $document.ready(function() {
            'use strict';
            $document.on('click', "#addNewRow", function() {
                var newRowCloned = $('.newRowTemplate').last().clone();
                newRowCloned.show();
                newRowCloned.find('.editor').summernote({
                    tabsize: 4,
                    height: 250
                });
                $("#courseFaqs").prepend(newRowCloned);
            });
            $document.on('click', ".removeRow", function() {
                var self = $(this);
                self.parents(".newRowTemplate").remove();
            });
        });
    </script>
@endsection
