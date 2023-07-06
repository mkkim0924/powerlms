@extends('admin.layouts.master')
@section('admin_content')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-9 mt-1">
                                    <h2 class="card-title text-capitalize @if(session('display_type')=='rtl')  float-right @endif">@lang('backend.courses.header.curriculum') - {{ $course->name }}</h2>
                                </div>
                                <div class="col lg 3">
                                    <span class="pull-right d-inline-block @if(session('display_type')=='rtl') float-left @else float-right @endif">
                                         <a href="{{ route(request()->user_type.'.courses') }}"
                                            class="btn btn-rounded btn-warning">
                                            <i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;@lang('global.button.back')
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    @if(count($sections) > 0)
                                        <div class="card card-body p-1 mb-0">
                                            <div class="alert alert-warning" role="alert">
                                                <i class="fa fa-info-circle"></i> @lang('backend.courses.sort_curriculum_info_text')
                                            </div>
                                            <div class="sortable">
                                                @foreach($sections as $section)
                                                    <div class="group-caption bg-light" id="section_{{ $section->id }}"
                                                         data-id="{{ $section->id }}">
                                                        <div class="d-flex justify-content-between">
                                                            <h4>{{ $section->name }}</h4>
                                                            <div class="move">+</div>
                                                        </div>
                                                        <div class="group-items">
                                                            @foreach($section->getSectionChildData as $data)
                                                                @php
                                                                    $text_color = ($data->type == "unit") ? "green" : ($data->type == "assignment" ? "peru" : ($data->type == "quiz" ? "brown" : "black"))
                                                                @endphp
                                                                <div class="group-item" data-id="{{ $data->id }}"
                                                                     style="color: {{ $text_color }} !important;">
                                                                    <div
                                                                        class="d-flex justify-content-between align-items-center">
                                                                        {{ $data->name }}
                                                                        <div class="text-right">
                                                                            @if($data->type == "unit")
                                                                                <input type="checkbox" class="is_free_checkbox" @if($data->is_free == 1) checked @endif data-id="{{ $data->id }}"><span>@lang('backend.courses.note.available_for_free_preview')</span>
                                                                            @endif
                                                                            <div class="move">+</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <button type="button" id="submitCurriculum" class="btn btn-success btn-border"><i class="fa fa-check"></i>
                                            @lang('global.button.save')
                                        </button>
                                    @else
                                        <div class="az-content-label text-center"><h3>@lang('backend.courses.note.no_record_found')</h3></div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <style>
        .sortable {

        }

        .group-caption {
            width: 100%;
            display: block;
            padding: 20px;
            margin: 0 0 15px 0;
        }

        .group-item {
            background: #ffffff;
            width: 80%;
            height: auto;
            display: block;
            padding: 3px;
            margin: 5px;
            color: #000;
        }

        .move {
            background: #17a2b8;
            width: 30px;
            height: 30px;
            /*float: right;*/
            color: #fff;
            text-align: center;
            text-transform: uppercase;
            line-height: 30px;
            font-family: Arial;
            cursor: move;
            display: inline-block;
        }

        .delete-btn {
            display: inline-block;
            background: #ff0000;
            width: 30px;
            height: 30px;
            color: #fff !important;
            text-align: center;
            text-transform: uppercase;
            line-height: 30px;
            font-family: Arial;
            cursor: pointer;
        }

        .movable-placeholder {
            background: #ccc;
            width: 100%;
            height: 100px;
            display: block;
            padding: 20px;
            margin: 0 0 15px 0;
            border-style: dashed;
            border-width: 2px;
            border-color: #000;
        }

        .btn-border.btn-success.focus, .btn-border.btn-success:focus, .btn-border.btn-success:not(:disabled):not(.disabled).btn-borderctive:focus,
        .btn-border.btn-success:not(:disabled):not(.disabled):active:focus, .show > .btn-border.btn-success.dropdown-toggle:focus {
            box-shadow: none !important;
            border: 2px solid lightgreen !important;
        }
    </style>
@endsection
@section('footer_scripts')
    <script type="text/javascript" src="{{asset('admin-assets/assets/libs/block-ui/jquery.blockUI.js')}}"></script>
    <script src="{{ asset('admin-assets/assets/extra-libs/taskboard/js/jquery-ui.min.js') }}"></script>
    <script type="text/javascript">
        var $courseId = {{ $course->id }}
        $(document).ready(function () {
            'use strict';

            $(".sortable").sortable({
                containment: "parent",
                items: "> div",
                handle: ".move",
                tolerance: "pointer",
                cursor: "move",
                opacity: 0.7,
                revert: 300,
                delay: 150,
                dropOnEmpty: true,
                placeholder: "movable-placeholder",
                start: function (e, ui) {
                    ui.placeholder.height(ui.helper.outerHeight());
                }
            });

            // Sort the children
            $(".group-items").sortable({
                items: "> div",
                tolerance: "pointer",
                containment: "parent"
            });

            $(document).on('click', "#submitCurriculum", function () {
                var sortArray = {};
                var selectedCheckboxArray = [];
                var sortSectionData = $('.sortable').sortable('toArray', {attribute: 'data-id'});
                $.each(sortSectionData, function (key, value) {
                    var sortData = $('#section_' + value).children('.group-items').sortable('toArray', {attribute: 'data-id'});
                    sortArray[value] = sortData;
                });
                $('.is_free_checkbox').each(function () {
                    if ($(this).prop('checked') == true) {
                        selectedCheckboxArray.push($(this).data('id'));
                    }
                });
                $.ajax({
                    url: $app_url + "/{{ request()->user_type }}/course/curriculum/update",
                    method: 'POST',
                    data: {courseId: $courseId, sortSectionArray: sortSectionData, sortUnitsArray: sortArray, selectedCheckboxArray: selectedCheckboxArray},
                    beforeSend: function () {
                        $.blockUI({
                            message: '<i class="fas fa-spin fa-sync text-white"></i>',
                            overlayCSS: {
                                backgroundColor: '#000',
                                opacity: 0.5,
                                cursor: 'wait'
                            },
                            css: {
                                border: 0,
                                padding: 0,
                                backgroundColor: 'transparent'
                            }
                        });
                    },
                    success: function (data) {
                        if (data.status) {
                            toastr.success(data.message, $plugin_translations.toastr_success_text, {timeOut: 2000});
                        } else {
                            toastr.error(data.message, $plugin_translations.toastr_error_text, {timeOut: 2000});
                        }
                        $.unblockUI();
                    }
                });
            })
        });
    </script>
@endsection
