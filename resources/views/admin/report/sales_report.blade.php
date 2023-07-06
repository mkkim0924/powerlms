@extends('admin.layouts.master')
@section('admin_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-4 col-6 d-flex align-items-center">
                                <h2 class="card-title text-capitalize">@lang('backend.sales_report.header')</h2>
                            </div>
                            <div class="col lg 4">
                                <span class="pull-right d-inline-block @if (session('display_type') == 'rtl') float-left @else float-right @endif">
                                    <a href="javascript:;" class="btn btn-rounded btn-success"
                                       onclick="this.href='sales-report/export?course_id=' + document.getElementById('course_id').value +
                                    '&search=' + document.getElementById('search').value +
                                    '&purchase_date=' + document.getElementById('purchase_date').value">
                                            @lang('global.button.export')
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! Form::open([
                            'method' => 'GET',
                            'route' => request()->user_type . '.sales_report',
                            'class' => 'form-horizontal',
                            'id' => 'myForm',
                        ]) !!}
                        <div class="row d-flex align-items-center">
                            <div class="col-md-3">
                                <label>@lang('backend.sales_report.label.search')</label>
                                <input name="search" value="{{ request('search') }}" id="search" type="text"
                                       class="form-control" placeholder="@lang('backend.sales_report.label.search')">
                            </div>
                            <div class="col-md-4">
                                <label>@lang('backend.sales_report.label.select_course')</label>
                                {!! Form::select('course_id', $courses, request('course_id'), [
                                    'id' => 'course_id',
                                    'class' => 'form-control select2Search rounded-0',
                                    'placeholder' => '',
                                ]) !!}
                            </div>

                            <div class="col-md-3">
                                <label>@lang('backend.sales_report.label.purchase_date')</label>
                                <input type="text" value="{{ request('purchase_date') }}" name="purchase_date"
                                       id="purchase_date" placeholder="@lang('backend.sales_report.label.select_date')" class="form-control">
                            </div>
                            <div class="col-md-2 mt-4 p-0">
                                <button type="submit" class="btn waves-effect waves-light btn-outline-success">
                                    @lang('global.button.search')</button>
                                <a href="{{ route(request()->user_type . '.sales_report') }}"
                                   class="btn waves-effect waves-light btn-outline-warning">
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
                                                <th>@lang('backend.sales_report.label.user')</th>
                                                <th>@lang('backend.sales_report.label.course_name')</th>
                                                <th>@lang('backend.sales_report.label.price')</th>
                                                <th>@lang('backend.sales_report.label.instructor_revenue')</th>
                                                <th>@lang('backend.sales_report.label.payment_date')</th>
                                                <th>@lang('backend.sales_report.label.payment_method')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($payments as $item)
                                                <tr>

                                                    <td>{{ $item->userDetails->name }}</td>
                                                    <td>
                                                        <span class="label label-info"><small>{{ ucfirst($item->module_type) }}</small></span><br>
                                                        {{ ($item->module_type == 'course') ? ($item->courseDetails->name ?? '- - -') : ($item->bundleDetails->name ?? '- - -') }}
                                                    </td>
                                                    <td>{{ formatPrice($item->price) }}</td>
                                                    <td>{{ formatPrice($item->instructor_revenue) }}</td>
                                                    <td>{{ formatDate($item->created_at) }}</td>
                                                    <td>{{ __('backend.payment_method.'.$item->payment_type) }}</td>
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
            $('#purchase_date').daterangepicker({
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
            $('#purchase_date').daterangepicker({
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
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            });
            @endif
            $('#purchase_date').on('apply.daterangepicker', function (ev, picker) {
                $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
            });

            $('#purchase_date').on('cancel.daterangepicker', function (ev, picker) {
                $(this).val('');
            });
        });
    </script>
@endsection
