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
                                    <h2 class="card-title text-capitalize">@lang('backend.lessons.header.list')</h2>
                                </div>
                                <div class="col lg 4">
                                    <span class="pull-right d-inline-block @if(session('display_type')=='rtl') float-left @else float-right @endif">
                                        <a href="{{ route(request()->user_type . '.sections.create') }}"
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
                                'route' => request()->user_type . '.sections',
                                'id' => 'myForm',
                            ]) !!}
                            <div class="row">
                                <div class="col-md-6">
                                    <label>@lang('backend.lessons.label.select_course')</label>
                                    {!! Form::select('course_id', $courses, request('course_id'), [
                                        'id' => 'course_id',
                                        'class' => 'form-control select2Search',
                                        'placeholder' => '',
                                    ]) !!}
                                </div>
                                <div class="col-md-6 mt-4">
                                    <button type="submit"
                                            class="btn waves-effect waves-light btn-outline-success">  @lang('global.button.search')</button>

                                    <a href="{{ route(request()->user_type . '.sections') }}"
                                       class="btn waves-effect waves-light btn-outline-warning">
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

                                        <th>@lang('backend.lessons.label.lesson_name')</th>
                                        <th>@lang('backend.lessons.label.course_name')</th>
                                        <th>@lang('backend.lessons.label.status')</th>
                                        <th>@lang('backend.lessons.label.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($sections as $item)
                                        <tr>

                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->courseDetail->name ?? '- - -' }}</td>
                                            <td>
                                                <input type="checkbox" data-id="{{ $item->id }}" name="is_active"
                                                       class="js-switch" {{ $item->is_active == 1 ? 'checked' : '' }}>
                                            </td>
                                            <td>
                                                <a href="{{ route(request()->user_type . '.sections.edit', $item->id) }}"
                                                   data-toggle="tooltip"
                                                   data-original-title="@lang('global.button.edit')">
                                                    <i class="fas fa-pencil-alt text-inverse m-r-10"></i>
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
    </div>
@stop
@section('footer_scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            'use strict';
            $(document).on('change', '.js-switch', function () {
                let is_active = $(this).prop('checked') === true ? 1 : 0;
                let userId = $(this).data('id');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route(request()->user_type . '.sections.update.status') }}',
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
