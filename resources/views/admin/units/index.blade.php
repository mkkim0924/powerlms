@extends('admin.layouts.master')
@section('admin_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-4 col-6 d-flex align-items-center">
                                <h2 class="card-title text-capitalize">@lang('backend.chapters.header.list')</h2>
                            </div>
                            <div class="col lg 4 ">
                                <span
                                    class="pull-right d-inline-block @if (session('display_type') == 'rtl') float-left @else float-right @endif">
                                    <a href="{{ route(request()->user_type . '.units.create') }}"
                                       class="btn btn-rounded btn-success">
                                        <i class="fa fa-plus" aria-hidden="true"></i> @lang('global.button.add_new')
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! Form::open([
                            'method' => 'GET',
                            'class' => 'form-horizontal',
                            'route' => request()->user_type . '.units',
                            'id' => 'unitForm',
                        ]) !!}
                        <div class="row d-flex align-items-center">
                            <div class="col">
                                <label>@lang('backend.chapters.label.select_course'):</label>
                                {!! Form::select('course_id', $courses, request('course_id'), [
                                    'id' => 'course_id',
                                    'class' => 'form-control select2Search',
                                    'placeholder' => '',
                                ]) !!}
                            </div>
                            <div class="col">
                                <label>@lang('backend.chapters.label.lesson_name'):</label>
                                {!! Form::select('section_id', $sections, request('section_id'), [
                                    'id' => 'section_id',
                                    'class' => 'form-control sectionInput',
                                    'placeholder' => '',
                                ]) !!}
                            </div>
                            <div class="col align-self-end">
                                <button type="submit" class="btn waves-effect waves-light btn-outline-success btn-sm">
                                    @lang('global.button.search')</button>
                                <a href="{{ route(request()->user_type . '.units') }}"
                                   class="btn waves-effect waves-light btn-outline-warning btn-sm">
                                    @lang('global.button.reset')
                                </a>
                            </div>
                        </div>
                        <hr>
                        {!! Form::close() !!}
                        <div class="table-responsive mt-4">
                            <table id="datatable_without_search" class="product-overview v-middle table">
                                <thead>
                                <tr>

                                    <th>@lang('backend.chapters.label.course_name')</th>
                                    <th>@lang('backend.chapters.general.label.chapter_name')</th>
                                    <th>@lang('backend.chapters.label.status')</th>
                                    <th>@lang('backend.chapters.label.action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($units as $item)
                                    <tr>

                                        <td>{{ $item->courseDetail->name ?? '- - -' }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td><input type="checkbox" data-id="{{ $item->id }}" name="is_active"
                                                   class="js-switch" {{ $item->is_active == 1 ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <a href="{{ route(request()->user_type . '.units.edit', $item->id) }}"
                                               data-toggle="tooltip" data-original-title="@lang('global.button.edit')">
                                                <i class="fas fa-pencil-alt text-inverse m-r-10"></i>
                                            </a>
                                            <a href="javascript:;"
                                               onclick="confirmDelete('{{ route(request()->user_type . '.units.delete', $item->id) }}')"
                                               data-toggle="tooltip" data-original-title="@lang('global.button.delete')">
                                                <i class="fas fa-times text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer_scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            'use strict';
            var getSectionByCourseURL = "{{ route(request()->user_type . '.getSectionByCourse') }}";
            $(".sectionInput").select2({
                placeholder: $plugin_translations.select2_placeholder,
                ajax: {
                    url: getSectionByCourseURL,
                    type: "get",
                    dataType: 'json',
                    data: function (params) {
                        var searchTerm = params.term;
                        return {
                            searchTerm: searchTerm,
                            courseId: $("#course_id").val()
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                }
            });

            $(document).on('change', '.js-switch', function () {
                let is_active = $(this).prop('checked') === true ? 1 : 0;
                let userId = $(this).data('id');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route(request()->user_type . '.units.update.status') }}',
                    data: {
                        'is_active': is_active,
                        'id': userId
                    },
                    success: function (data) {
                        toastr.success(data.message, $plugin_translations.toastr_success_text, {
                            timeOut: 2000
                        });
                    }
                });
            });
        });
    </script>
@endsection
