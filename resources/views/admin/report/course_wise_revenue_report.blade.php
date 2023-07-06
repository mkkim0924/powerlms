@extends('admin.layouts.master')
@section('admin_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-4 col-6 d-flex align-items-center">
                                <h2 class="card-title text-capitalize">@lang('backend.course_wise_revenue_report.title')</h2>
                            </div>
                            <div class="col lg 4">
                                <span class="pull-right d-inline-block @if (session('display_type') == 'rtl') float-left @else float-right @endif">
                                    <a href="javascript:;" class="btn btn-rounded btn-success"
                                       onclick="this.href='course-wise-revenue-report/export?course_id=' + document.getElementById('course_id').value +
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
                            'route' => request()->user_type . '.course_wise_revenue_report',
                            'class' => 'form-horizontal',
                            'id' => 'myForm',
                        ]) !!}
                        <div class="row d-flex align-items-center">
                            <div class="col-md-3">
                                <label>@lang('backend.course_wise_revenue_report.label.select_course')</label>
                                {!! Form::select('course_id', $courses, request('course_id'), [
                                    'id' => 'course_id',
                                    'class' => 'form-control select2Search',
                                    'placeholder' => '',
                                ]) !!}
                            </div>
                            <div class="col-md-3">
                                <label>@lang('backend.course_wise_revenue_report.label.enroll_date')</label>
                                <input type="text" value="{{ request('enroll_date') }}" name="enroll_date"
                                       id="enroll_date" placeholder="@lang('backend.course_wise_revenue_report.label.select_date')" class="form-control">
                            </div>
                            <div class="col-md-3 mt-4">
                                <button type="submit" class="btn waves-effect waves-light btn-outline-success btn-sm">
                                    @lang('global.button.search')</button>
                                <a href="{{ route(request()->user_type . '.course_wise_revenue_report') }}"
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
                                        <table id="datatable_list" class="product-overview v-middle table">
                                            <thead>
                                            <tr>
                                                <th>@lang('backend.course_wise_revenue_report.label.course_name')</th>
                                                <th>@lang('backend.course_wise_revenue_report.label.instructor_name')</th>
                                                <th>@lang('backend.course_wise_revenue_report.label.system_revenue')</th>
                                                <th>@lang('backend.course_wise_revenue_report.label.instructor_revenue')</th>
                                                <th>@lang('backend.course_wise_revenue_report.label.total_enrollments')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($course_wise_revenue_report as $course_details)
                                                <tr>
                                                    <td width="25%">{{ $course_details['name'] }}</td>
                                                    <td width="20%">{{ $course_details['instructor_detail']['name'] }}</td>
                                                    <td width="20%">{{ formatPrice($course_details['payment_transaction_detail'][0]['admin_revenue'] ?? 0) }}</td>
                                                    <td width="20%">{{ formatPrice($course_details['payment_transaction_detail'][0]['instructor_revenue'] ?? 0) }}</td>
                                                    <td width="15%">{{ $course_details['course_user_detail'][0]['total_enrollments'] ?? 0 }}</td>
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
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            });
            @else
            $('#enroll_date').daterangepicker({
                autoUpdateInput: true,
                startDate: moment().subtract(1, 'years'),
                endDate: moment(),
                locale: {
                    cancelLabel: 'Clear',
                    format: 'DD-MM-YYYY'
                },
                ranges: {
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            });
            @endif

            $('#datatable_list').DataTable({
                searching: false,
                order: [[4, 'desc']],
                "language": {
                    url: $datatable_language_url
                },
                "drawCallback": function () {
                    let elems = Array.prototype.slice.call($('.js-switch'));
                    elems.forEach(function (html) {
                        if (typeof $(html).data('switchery') == "undefined") {
                            new Switchery(html, {
                                size: 'small'
                            });
                        }
                    });
                },
            });

            $('#enroll_date').on('apply.daterangepicker', function (ev, picker) {
                $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
            });

            $('#enroll_date').on('cancel.daterangepicker', function (ev, picker) {
                $(this).val('');
            });
        });
    </script>
@endsection
