@extends('admin.layouts.master')
@section('admin_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-4 col-6 d-flex align-items-center">
                                <h2 class="card-title text-capitalize">@lang('backend.lessons.header.create')</h2>
                            </div>
                            <div class="col lg 4">
                                <span class="pull-right d-inline-block @if(session('display_type')=='rtl') float-left @else float-right @endif">
                                    <a href="{{ route(request()->user_type . '.sections') }}"
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
                                <form class="form-horizontal" role="form" method="post"
                                      action="{{ route(request()->user_type . '.sections.store') }}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @include('admin.section.form')
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="newRowTemplate" style="display: none;">
                        <div class="row">
                            <div class="col-sm-6">
                                <hr>
                                <div class="form-group">
                                    <label>@lang('backend.lessons.label.lesson_name')</label>
                                    <span class="text-danger">*</span>
                                    {!! Form::text('name[]', null, [
                                        'class' => 'form-control',
                                        'data-validation' => 'required',
                                        'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.lessons.label.lesson_name'))]),
                                    ]) !!}
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group m-b-0">
                                    <button type="submit" class="btn btn-info waves-effect waves-light removeRow"><i
                                            class="fas fa-trash"></i></button>
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
        var $document = $(document);
        $document.ready(function () {
            $document.on('click', "#addNewRow", function () {
                var newRowCloned = $('.newRowTemplate').last().clone();
                newRowCloned.show();
                newRowCloned.find('.editor').summernote({
                    tabsize: 4,
                    height: 250
                });
                $("#courseFaqs").append(newRowCloned);
            });

            $document.on('click', ".removeRow", function () {
                var self = $(this);
                self.parents(".newRowTemplate").remove();
            });
        });
    </script>
@endsection
