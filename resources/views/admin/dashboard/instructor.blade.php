@extends('admin.layouts.master')
@section('admin_content')
    <div class="container-fluid">
        <div class="row my-4">
            <div class="col-md-6 col-lg-4 col-sm-12 col-12 mb-2 mb-lg-0">
                <div class="card instructor-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <span class="icon"><i class="fas fa-users bg-info text-white mr-3"></i></span>
                            <div class="mr-2">
                            <span
                                class="d-block text-dark op-7 font-medium">@lang('backend.instructor.dashboard.label.total_courses')</span>
                                <h3 class="mb-0">{{ $data['total_courses'] ?? 0 }}</h3>
                            </div>
                        </div>
                        <p class="mb-0"><strong>{!! __('backend.instructor.dashboard.text.total_free_courses', ['statistics' => $data['free_courses'] ?? 0, ]) !!} </strong></p>
                        <p class="mb-0"><strong>{!! __('backend.instructor.dashboard.text.total_paid_courses', ['statistics' => $data['paid_courses'] ?? 0, ]) !!} </strong></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 col-sm-12 col-12 mb-2 mb-lg-0">
                <div class="card instructor-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <span class="icon"><i class="fa-solid fa-user-plus bg-info text-white mr-3"></i></span>
                            <div class="mr-2">
                            <span
                                class="d-block text-dark op-7 font-medium">@lang('backend.instructor.dashboard.label.total_students')</span>
                                <h3 class="mb-0">{{ $data['total_students'] ?? 0 }}</h3>
                            </div>
                        </div>
                        <p class="mb-0"><strong>{!! __('backend.instructor.dashboard.text.total_free_enrollment', ['statistics' => $data['free_students'] ?? 0, ]) !!}</strong></p>
                        <p class="mb-0"><strong>{!! __('backend.instructor.dashboard.text.total_paid_enrollment', ['statistics' => $data['paid_students'] ?? 0, ]) !!}</strong></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 col-sm-12 col-12 mb-2 mb-lg-0">
                <div class="card instructor-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <span class="icon"><i class="fa-solid fa-users-rays text-white bg-info  mr-3"></i></span>
                            <div class="mr-2">
                            <span
                                class="d-block text-dark op-7 font-medium">@lang('backend.instructor.dashboard.label.new_students')</span>
                                <h3 class="mb-0">{{ $data['new_students'] ?? 0 }}</h3>
                            </div>
                        </div>
                        <p class="mb-0"><strong>{!! __('backend.instructor.dashboard.text.new_free_enrollment', ['statistics' => $data['free_new_students'] ?? 0, ]) !!}</strong></p> 
                        <p class="mb-0"><strong>{!! __('backend.instructor.dashboard.text.new_paid_enrollment', ['statistics' => $data['paid_new_students'] ?? 0, ]) !!}</strong></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4>@lang('backend.instructor.dashboard.chart_title.total_earnings')</h4>
                        <div class="pro-sales"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6 my-3">
                <div class="card">
                    <div class="card-body">
                        <h4>@lang('backend.instructor.dashboard.chart_title.total_students')</h4>
                        <canvas id="total_students" height="250"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-6 my-3">
                <div class="card">
                    <div class="card-body">
                        <h4>@lang('backend.instructor.dashboard.chart_title.new_enrolled_students')</h4>
                        <canvas id="new_students" height="250"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row my-3">
            @if(count($data['top_courses']) > 0)
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h4 class="card-title">@lang('backend.instructor.dashboard.title.top_10_best')</h4>
                                </div>
                            </div>
                            <div class="table-responsive mt-3">
                                <table class="table no-wrap v-middle">
                                    <thead>
                                    <tr>
                                        <th class="border-0 text-muted">
                                            @lang('backend.instructor.dashboard.label.course_name')</th>
                                        <th class="border-0 text-muted">
                                            @lang('backend.instructor.dashboard.label.total_sales')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data['top_courses'] as $course)
                                        <tr>
                                            <td class="text-dark">{{ $course->name }}</td>
                                            <td class="text-dark">{{ $course->total_enrollments }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @include('admin.dashboard.partials.pending_chat')
        </div>
    </div>
@endsection
@section('css')
    <link href="{{ asset('admin-assets/assets/libs/chartist/dist/chartist.min.css') }}" rel="stylesheet">
@endsection
@section('footer_scripts')

    <script src="{{ asset('admin-assets/assets/libs/chartist/dist/chartist.min.js') }}"></script>
    <script src="{{ asset('admin-assets/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') }}">
    </script>
    <script src="{{ asset('admin-assets/assets/libs/chart.js/dist/Chart.min.js') }}"></script>

    <script>
        $(function () {
            'use strict';
            var totalSales = JSON.parse('{!! $chartData['totalSales'] !!}');
            var labels = JSON.parse('{!! $month_names !!}');
            var chart = new Chartist.Line(
                '.pro-sales', {
                    labels: labels,
                    series: [totalSales]
                }, {
                    low: 0,
                    showArea: true,
                    fullWidth: true,
                    plugins: [Chartist.plugins.tooltip({
                        currency: '{{ config('currency_symbol') }} ',
                        appendToBody: true
                    })],
                }
            );

            ///bar-chart for active students

            var bar_ctx = document.getElementById('total_students').getContext('2d');

            var primary_gradient = bar_ctx.createLinearGradient(0, 0, 0, 200);
            primary_gradient.addColorStop(0.5, '#f158d0');
            primary_gradient.addColorStop(1, '#c581fc');

            var total_students = JSON.parse('{!! $chartData['total_students'] !!}');
            var bar_chart = new Chart(bar_ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: "@lang('backend.instructor.dashboard.chart_title.total_students')",
                        data: total_students,
                        backgroundColor: primary_gradient,
                        hoverBackgroundColor: primary_gradient,
                        hoverBorderWidth: 2,
                        hoverBorderColor: '#c581fc',
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    scales: {
                        xAxes: [{
                            gridLines: {
                                display: false
                            },
                            barPercentage: 0.7,
                            categoryPercentage: 0.6
                        }],
                        yAxes: [{
                            gridLines: {
                                drawBorder: false
                            },
                            ticks: {
                                min: 0,
                                display: false
                            },
                        }]
                    }
                }
            });


            ///bar-chart for New Enrollment students

            var bar_ctx = document.getElementById('new_students').getContext('2d');
            var days = [];
            var primary_gradient = bar_ctx.createLinearGradient(0, 0, 0, 200);
            primary_gradient.addColorStop(0.5, '#f158d0');
            primary_gradient.addColorStop(1, '#c581fc');

            var new_students = JSON.parse('{!! $chartData['new_students'] !!}');
            var days = [];
            for (let index = 1; index <= new_students.length; index++) {
                days.push(index);
            }
            var bar_chart = new Chart(bar_ctx, {
                type: 'bar',
                data: {
                    labels: days,
                    datasets: [{
                        label: "@lang('backend.dashboard.text.new_enrollment')",
                        data: new_students,
                        backgroundColor: primary_gradient,
                        hoverBackgroundColor: primary_gradient,
                        hoverBorderWidth: 2,
                        hoverBorderColor: '#c581fc'
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    scales: {
                        xAxes: [{
                            gridLines: {
                                display: false
                            },
                            barPercentage: 0.7,
                            categoryPercentage: 0.6
                        }],
                        yAxes: [{
                            ticks: {
                                min: 0,
                                scaleMinSpace: 1,
                                display: false
                            },
                        }]
                    },
                }
            });
        });
    </script>

@endsection
