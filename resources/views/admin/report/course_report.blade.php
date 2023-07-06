@extends('admin.layouts.master')
@section('admin_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-4 col-6 d-flex align-items-center">
                                <h2 class="card-title text-capitalize">@lang('backend.course_report.header')</h2>
                            </div>
                            @if(request()->user_type == 'admin')
                                <div class="col lg 4">
                            <span
                                class="pull-right d-inline-block @if (session('display_type') == 'rtl') float-left @else float-right @endif">
                                <a href="{{ route('admin.course_report.manual_enroll') }}"
                                   class="btn btn-rounded btn-success">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                    @lang('backend.course_report.manual_course_enroll_button')
                                </a>
                            </span>
                                </div>
                            @endif
                            <div class=" @if(request()->user_type != 'admin') col lg 4 @endif">
                            <span class="pull-right d-inline-block @if (session('display_type') == 'rtl') float-left @else float-right @endif">
                                <a href="javascript:;" class="btn btn-rounded btn-success"
                                   onclick="this.href='course-report/export?course_id=' + document.getElementById('course_id').value +
                                '&search=' + document.getElementById('search').value +
                                '&enroll_date=' + document.getElementById('enroll_date').value">
                                        @lang('global.button.export')
                                </a>
                            </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! Form::open([
                        'method' => 'GET',
                        'route' => request()->user_type . '.course_report',
                        'class' => 'form-horizontal',
                        'id' => 'myForm',
                        ]) !!}
                        <div class="row d-flex align-items-center">
                            <div class="col-md-3">
                                <label>@lang('backend.course_report.label.select_course')</label>
                                {!! Form::select('course_id', $courses, request('course_id'), [
                                'id' => 'course_id',
                                'class' => 'form-control select2Search',
                                'placeholder' => '',
                                ]) !!}
                            </div>
                            <div class="col-md-3">
                                <label>@lang('backend.course_report.label.search')</label>
                                <input name="search" value="{{ request('search') }}" id="search" type="text"
                                       class="form-control" placeholder="@lang('backend.course_report.label.search')">
                            </div>
                            <div class="col-md-3">
                                <label>@lang('backend.course_report.label.enroll_date')</label>
                                <input type="text" value="{{ request('enroll_date') }}" name="enroll_date" id="enroll_date"
                                       placeholder="@lang('backend.course_report.label.select_date')" class="form-control">
                            </div>
                            <div class="col-md-3 mt-4">
                                <button type="submit" class="btn waves-effect waves-light btn-outline-success btn-sm">
                                    @lang('global.button.search')</button>
                                <a href="{{ route(request()->user_type . '.course_report') }}"
                                   class="btn waves-effect waves-light btn-outline-warning btn-sm">
                                    @lang('global.button.reset')
                                </a>
                            </div>
                        </div>
                        <hr class="mb-0">
                        {!! Form::close() !!}
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="table-responsive mt-4">
                                        <table id="datatable_without_search" class="product-overview v-middle table">
                                            <thead>
                                            <tr>
                                                <th>@lang('backend.course_report.label.name')</th>
                                                <th>@lang('backend.course_report.label.user_name')</th>
                                                <th>@lang('backend.course_report.label.course_enroll_date')</th>
                                                <th>@lang('backend.course_report.label.progress')</th>
                                                <th>@lang('backend.course_report.label.action')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($reports as $item)
                                                <tr>
                                                    <td>{{ $item->courseDetails->name }}</td>
                                                    <td>{{ $item->userDetails->name }}</td>
                                                    <td>{{ formatDate($item->created_at) }}</td>
                                                    <td>{!! $item->progress == 0.0 ? '<span>0.00%</span>' : '<span>' .
                                                        $item->progress . '%' . '</span>' !!}
                                                    </td>
                                                    <td>
                                                        <a href="{{ route(request()->user_type.'.course_report.getUserCourseProgressReport', $item->id) }}"
                                                           class="btn btn-primary btn-sm viewQuizResult">@lang('backend.course_report.button.view_progress')</a>
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
        </div>
    </div>
@endsection

@section('css')
    <link href="{{ asset('admin-assets/assets/libs/daterangepicker/daterangepicker.css') }}" rel="stylesheet">
@endsection

@section('footer_scripts')
    <script src="{{ asset('admin-assets/assets/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('admin-assets/assets/libs/daterangepicker/daterangepicker.js') }}"></script>
    <script>
        $(function () {
            'use strict';
            @if(!empty($_GET))
            $('#enroll_date').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear',
                    format: 'DD-MM-YYYY'
                },
                ranges: {
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf(
                        'month')]
                }
            });
            @else
            $('#enroll_date').daterangepicker({
                autoUpdateInput: true,
                startDate: moment().subtract(6, 'days'),
                endDate: moment(),
                locale: {
                    cancelLabel: 'Clear',
                    format: 'DD-MM-YYYY'
                },
                ranges: {
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf(
                        'month')]
                }
            });
            @endif

            $('#enroll_date').on('apply.daterangepicker', function (ev, picker) {
                $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
            });

            $('#enroll_date').on('cancel.daterangepicker', function (ev, picker) {
                $(this).val('');
            });
        });
    </script>
@endsection
