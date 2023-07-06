@extends('admin.layouts.master')

@section('css')
    <style>
        .stack-content {
            background-color: #F6F6F6;
            color: #AE0E0E;
            font-family: consolas, Menlo, Courier, monospace;
            font-size: 12px;
            font-weight: 400;
            white-space: pre-line;
            max-width: 0;
            overflow-x: auto;

        }

        .level-card {
            color: #FFF;
        }

        .level-card .progress {
            background: rgba(0, 0, 0, 0.2);
            height: 2px;
            margin-top: 10px;
        }

        .level-card .progress .progress-bar {
            background: #fff;
        }

        .level-card .card-header {
            line-height: 1.5em;
            font-size: 1em;
        }

        .level-card .card-header .level-icon {
            font-size: 1.5em;
        }

        .level-card .card-body {
            font-size: 1em;
        }

        .level {
            font-size: .875em;
            line-height: 1em;
            color: #fff;
        }

        .level-none {
            background-color: none;
            color: #AAA;
        }

        .level-all,
        .level-emergency,
        .level-alert,
        .level-critical,
        .level-error,
        .level-warning,
        .level-notice,
        .level-info,
        .level-debug,
        {
            color: #FFF;
        }

        .label-env {
            font-size: .85em;
        }

        .level-all, .level.level-all {
            background-color: #8A8A8A;
        }

        .level-all .card-header {
            background-color: #8A8A8A;
        }

        .level-emergency, .level.level-emergency {
            background-color: #B71C1C;
        }

        .level-emergency .card-header {
            background-color: #B71C1C;
        }

        .level-alert, .level.level-alert {
            background-color: #D32F2F;
        }

        .level-alert .card-header {
            background-color: #D32F2F;
        }

        .level-critical, .level.level-critical {
            background-color: #F44336;
        }

        .level-critical .card-header {
            background-color: #F44336;
        }

        .level-error, .level.level-error {
            background-color: #FF5722;
        }

        .level-error .card-header {
            background-color: #FF5722;
        }

        .level-warning, .level.level-warning {
            background-color: #FF9100;
        }

        .level-warning .card-header {
            background-color: #FF9100;
        }

        .level-notice .card-header {
            background-color: #4CAF50;
        }

        .level-info, .level.level-info {
            background-color: #1976D2;
        }

        .level-info .card-header {
            background-color: #1976D2;
        }

        .level-debug, .level.level-debug {
            background-color: #90CAF9;
        }

        .level-debug .card-header {
            background-color: #90CAF9;
        }

        .level-empty, .level.level-empty {
            background-color: #D1D1D1;
        }

        .level-empty .card-header {
            background-color: #D1D1D1;
        }
        /*svg{*/
        /*    width: 20px;*/
        /*    height: 20px;*/
        /*}*/
    </style>
@endsection
@section('admin_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-4 d-flex align-items-center">
                                <h2 class="card-title">@lang('backend.log_manager.dashboard')</h2>
                            </div>
                            <div class="col lg 4">
                                <span class="pull-right d-inline-block @if(session('display_type')=='rtl') float-left @else float-right @endif">
                                    <a href="{{ route('log-viewer::logs.list') }}" target="_blank"
                                       class="btn waves-effect waves-light btn-rounded btn-outline-info">
                                       @lang('backend.log_manager.logs')
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-3">
                                <canvas id="stats-doughnut-chart" height="300" class="mb-3"></canvas>
                            </div>
                            <div class="col-md-6 col-lg-9">
                                <div class="row">
                                    @foreach($percents as $level => $item)
                                        <div class="col-md-4 col-sm-6 mb-3">
                                            <div
                                                class="card level-card level-{{ $level }} {{ $item['count'] === 0 ? 'level-empty' : '' }}">
                                                <div class="card-header">
                                        <span
                                            class="level-icon">{!! log_styler()->icon($level) !!}</span> {{ $item['name'] }}
                                                </div>
                                                <div class="card-body">
                                                    {{ $item['count'] }} entries - {!! $item['percent'] !!}%
                                                    <div class="progress">
                                                        <div class="progress-bar"
                                                             style="width: {{ $item['percent'] }}%"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment-with-locales.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.min.js"></script>
    <script>
        Chart.defaults.global.responsive = true;
        Chart.defaults.global.scaleFontFamily = "'Source Sans Pro'";
        Chart.defaults.global.animationEasing = "easeOutQuart";
    </script>
    <script>
        $(function () {
            new Chart($('canvas#stats-doughnut-chart'), {
                type: 'doughnut',
                data: {!! $chartData !!},
                options: {
                    legend: {
                        position: 'bottom'
                    }
                }
            });
        });
    </script>
@endsection
