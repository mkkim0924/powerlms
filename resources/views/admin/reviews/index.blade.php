@extends('admin.layouts.master')
@section('admin_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-4 col-6 d-flex align-items-center">
                                <h2 class="card-title text-capitalize">@lang('backend.reviews.header')</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! Form::open([
                        'method' => 'GET',
                        'route' => request()->user_type . '.reviews',
                        'class' => 'form-horizontal',
                        'id' => 'myForm',
                        ]) !!}
                        <div class="row d-flex align-items-center">
                            <div class="col-md-3">
                                <label>@lang('backend.reviews.label.select_course')</label>
                                {!! Form::select('course_id', $courses, request('course_id'), [
                                'id' => 'course_id',
                                'class' => 'form-control select2Search',
                                'placeholder' => '',
                                ]) !!}
                            </div>
                            <div class="col-md-3">
                                <label>@lang('backend.reviews.label.select_rating')</label>
                                {!! Form::select('rating', ['1' => '1 Star','2' => '2 Stars','3' => '3 Stars','4' => '4 Stars','5' => '5 Stars',], request('rating'), [
                                'id' => 'rating',
                                'class' => 'form-control select2Search',
                                'placeholder' => '',
                                ]) !!}
                            </div>
                            <div class="col-md-3">
                                <label>@lang('backend.reviews.label.review_date')</label>
                                <input type="text" value="{{ request('review_date') }}" name="review_date" id="review_date"
                                       placeholder="@lang('backend.reviews.label.select_date')" class="form-control">
                            </div>
                            <div class="col-md-3 mt-4">
                                <button type="submit" class="btn waves-effect waves-light btn-outline-success btn-sm">
                                    @lang('global.button.search')</button>
                                <a href="{{ route(request()->user_type . '.reviews') }}"
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
                                        <table id="zero_config" class="product-overview v-middle table">
                                            <thead>
                                            <tr>
                                                <th>@lang('backend.reviews.label.course_name')</th>
                                                <th>@lang('backend.reviews.label.student')</th>
                                                <th>@lang('backend.reviews.label.rating')</th>
                                                <th>@lang('backend.reviews.label.review')</th>
                                                <th>@lang('backend.reviews.label.date')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($review_data as $item)
                                                <tr>
                                                    <td>{{ $item->courseDetail->name }}</td>
                                                    <td>{{ $item->userDetail->name }}</td>
                                                    <td>{{ $item->rating }}</td>
                                                    <td>{{ $item->comment }}</td>
                                                    <td>{{ formatDate($item->created_at) ?? '---' }}</td>
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
            $('#review_date').daterangepicker({
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
            $('#review_date').daterangepicker({
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
            $('#review_date').on('apply.daterangepicker', function (ev, picker) {
                $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
            });

            $('#review_date').on('cancel.daterangepicker', function (ev, picker) {
                $(this).val('');
            });
        });
    </script>
@endsection
