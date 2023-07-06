@extends('admin.layouts.master')
@section('admin_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-4 col-6">
                                <h4 class="card-title text-capitalize">@lang('backend.user_course_progress_report.header')</h4>
                            </div>
                            <div class="col-lg-8">
                                <span class="pull-right d-inline-block float-right">
                                    <a href="{{ route(request()->user_type.'.course_report') }}" class="btn btn-rounded btn-warning">
                                        <i class="fa fa-arrow-left" aria-hidden="true"></i> @lang('global.button.back')
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td width="390">@lang('backend.user_course_progress_report.label.course')</td>
                                    <td> {{ $course->name }} </td>
                                </tr>
                                <tr>
                                    <td width="390">@lang('backend.user_course_progress_report.label.student')</td>
                                    <td> {{ $student->name }} </td>
                                </tr>
                                <tr>
                                    <td width="390">@lang('backend.user_course_progress_report.label.enroll_date')</td>
                                    <td> {{ formatDate($courseUser->created_at) }} </td>
                                </tr>
                                <tr>
                                    <td width="390">@lang('backend.user_course_progress_report.label.course_progress')</td>
                                    <td> {{ $courseUser->progress }} %</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        @if(count($curriculumUsers) > 0)
                            <hr>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-light">
                                    <tr>
                                        <th scope="col">@lang('backend.user_course_progress_report.label.title')</th>
                                        <th scope="col">@lang('backend.user_course_progress_report.label.type')</th>
                                        <th scope="col">@lang('backend.user_course_progress_report.label.completed_date')</th>
                                        <th scope="col">@lang('backend.user_course_progress_report.label.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($curriculumUsers as $item)
                                        <tr>
                                            <th scope="row">{{ $item->curriculumDetail->name }}</th>
                                            <td>{{ ($item->module_type == 'unit') ? __('backend.user_course_progress_report.label.chapter_type') : __('backend.user_course_progress_report.label.quiz_type') }}</td>
                                            <td>{{ formatDate($item->updated_at) }}</td>
                                            <td>
                                                @if($item->module_type == 'unit') - - -
                                                @else
                                                    <a href="javascript:;" data-title="{{ $item->curriculumDetail->name }}" data-user_id="{{ $courseUser->user_id }}" data-quiz_id="{{ $item->module_id }}"
                                                       class="btn btn-primary btn-sm viewQuizResult">@lang('backend.user_course_progress_report.button.view_result')</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="quizResultModal" tabindex="-1" role="dialog" aria-labelledby="quizResultModalLabel"
         aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalTitle"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body" id="modalContent">
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
@endsection
@section('footer_scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            'use strict';
            $(document).on('click', '.viewQuizResult', function () {
                var self = $(this);
                $("#modalTitle").text(self.data('title'));
                $.ajax({
                    type: "post",
                    dataType: "json",
                    url: '{{ route(request()->user_type.'.course_report.quizResult') }}',
                    data: {quiz_id: self.data('quiz_id'), student_id: self.data('user_id')},
                    success: function (data) {
                        $("#modalContent").html(data.html);
                        $("#quizResultModal").modal('show')
                    },
                })
            })
        })
    </script>
@endsection
