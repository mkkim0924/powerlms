@extends('admin.layouts.master')
@section('admin_content')
    <div class="container-fluid">
        <div class="row my-4 admin-dashbord">
            <div class="col-md-6 col-lg-3 col-sm-12 col-12 mb-2 mb-lg-0">
                <a href="{{ route('admin.courses', ['course_status' => 1]) }}">
                    <div class="card admin-card">
                        <div class="card-body d-flex">
                            <div class="d-flex align-items-center  ">
                            <span class="icon"><i
                                    class="fa-solid fa-book-open-reader text-white bg-info mr-3"></i></span>
                                <div>
                                <span
                                    class="d-block text-dark op-7 font-medium">@lang('backend.dashboard.label.active_courses')</span>
                                    <h3 class="mb-0">{{ $data['active_courses'] }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-3 col-sm-12 col-12 mb-2 mb-lg-0">
                <a href="{{ route('admin.courses', ['course_status' => 2]) }}">
                    <div class="card admin-card">
                        <div class="card-body d-flex">
                            <div class="d-flex align-items-center  ">
                                <span class="icon"><i class="fa-solid fa-user-check text-white bg-info  mr-3"></i></span>
                                <div>
                                <span
                                    class="d-block text-dark op-7 font-medium">@lang('backend.dashboard.label.review_pending_courses')</span>
                                    <h3 class="mb-0">{{ $data['pending_review_courses'] }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-3 col-sm-12 col-12 mb-2 mb-lg-0">
                <a href="{{ route('admin.instructors') }}">
                    <div class="card admin-card">
                        <div class="card-body d-flex">
                            <div class="d-flex align-items-center  ">
                            <span class="icon"><i
                                    class="fa-solid fa-chalkboard-user text-white bg-info mr-3"></i></span>
                                <div>
                                <span
                                    class="d-block text-dark op-7 font-medium">@lang('backend.dashboard.label.active_instructors')</span>
                                    <h3 class="mb-0">{{ $data['total_instructors'] }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-3 col-sm-12 col-12 mb-2 mb-lg-0">
                <a href="{{ route('admin.students') }}">
                    <div class="card admin-card">
                        <div class="card-body d-flex">
                            <div class="d-flex align-items-center  ">
                            <span class="icon"><i
                                    class="fa-solid fa-users-rectangle text-white bg-info mr-3"></i></span>
                                <div>
                                <span
                                    class="d-block text-dark op-7 font-medium">@lang('backend.dashboard.label.total_students')</span>
                                    <h3 class="mb-0">{{ $data['total_students'] }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">@lang('backend.dashboard.chart_title.total_earnings')</h4>
                        <div class="pro-sales"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6 my-3">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">@lang('backend.dashboard.chart_title.total_students')</h4>
                        <canvas id="total_students" height="250"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-6 my-3">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">@lang('backend.dashboard.chart_title.new_enrolled_students')</h4>
                        <canvas id="new_students" height="250"></canvas>
                    </div>
                </div>
            </div>
        </div>

        @if (count($data['top_courses']) > 0)
            <div class="row my-3">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h4 class="card-title">@lang('backend.dashboard.title.top_10_best')</h4>
                                </div>
                            </div>
                            <div class="table-responsive mt-3">
                                <table class="table no-wrap v-middle">
                                    <thead>
                                    <tr>
                                        <th class="border-0 text-muted">@lang('backend.dashboard.label.course_name')</th>
                                        <th class="border-0 text-muted">@lang('backend.dashboard.label.instructor')</th>
                                        <th class="border-0 text-muted">@lang('backend.dashboard.label.total_sales')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($data['top_courses'] as $course)
                                        <tr>
                                            <td class="text-dark">{{ $course->name }}</td>
                                            <td class="text-dark">{{ $course->instructorDetail->name ?? '- -' }}</td>
                                            <td class="text-dark">{{ $course->total_enrollments }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

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

            var total_Sales = JSON.parse('{!! $chartData['total_Sales'] !!}');
            var platform_earnings = JSON.parse('{!! $chartData['platform_earnings'] !!}');
            var labels = JSON.parse('{!! $month_names !!}');
            var chart = new Chartist.Line(
                '.pro-sales', {
                    labels: labels,
                    series: [platform_earnings]
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
                        label: "@lang('backend.dashboard.chart_title.total_students')",
                        data: total_students,
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
                            gridLines: {
                                drawBorder: false
                            },
                            ticks: {
                                display: false
                            },
                        }]
                    }
                }
            });


            ///bar-chart for New Enrollment students

            var bar_ctx = document.getElementById('new_students').getContext('2d');

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
                            gridLines: {
                                drawBorder: false
                            },
                            ticks: {
                                display: false
                            },
                        }]
                    }
                }
            });
        });
    </script>
@endsection
