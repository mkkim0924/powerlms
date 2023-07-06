@extends('admin.layouts.master')
@section('admin_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-4 col-6 d-flex align-items-center">
                                <h2 class="card-title text-capitalize">@lang('backend.tests.header.list')</h2>
                            </div>
                            <div class="col lg 4">
                                <span
                                    class="pull-right d-inline-block @if (session('display_type') == 'rtl') float-left @else float-right @endif">
                                    <a href="{{ route(request()->user_type . '.quiz.create') }}"
                                        class="btn btn-rounded btn-success">
                                        <i class="fa fa-plus" aria-hidden="true"></i> @lang('global.button.add_new')
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    {!! Form::open([
                                        'method' => 'GET',
                                        'class' => 'form-horizontal',
                                        'route' => request()->user_type . '.quiz',
                                        'id' => 'quizForm',
                                    ]) !!}
                                    <div class="row">
                                        <div class="col">
                                            <label>@lang('backend.tests.label.select_course'):</label>
                                            {!! Form::select('course_id', $courses, request('course_id'), [
                                                'id' => 'course_id',
                                                'class' => 'form-control select2Search',
                                                'placeholder' => '',
                                            ]) !!}
                                        </div>
                                        <div class="col">
                                            <label>@lang('backend.tests.label.select_lesson'):</label>
                                            {!! Form::select('section_id', $sections, request('section_id'), [
                                                'id' => 'section_id',
                                                'class' => 'form-control sectionInput',
                                                'placeholder' => '',
                                            ]) !!}
                                        </div>
                                        <div class="col align-self-end">
                                            <button type="submit"
                                                class="btn waves-effect waves-light btn-outline-success btn-sm">
                                                @lang('global.button.search')</button>
                                            <a href="{{ route(request()->user_type . '.quiz') }}"
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

                                                    <th>@lang('backend.tests.label.name')</th>
                                                    <th>@lang('backend.tests.label.course_name')</th>
                                                    <th>@lang('backend.tests.label.lesson_name')</th>
                                                    <th>@lang('backend.tests.label.status')</th>
                                                    <th>@lang('backend.tests.label.actions')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($quizList as $item)
                                                    <tr>

                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ $item->courseDetail->name ?? '- - -' }}</td>
                                                        <td>{{ $item->sectionDetail->name }}</td>
                                                        <td><input type="checkbox" data-id="{{ $item->id }}"
                                                                name="is_active" class="js-switch"
                                                                {{ $item->is_active == 1 ? 'checked' : '' }}>
                                                        </td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn-dark dropdown-toggle"
                                                                    data-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                    <i class="fas fa-ellipsis-v"></i>
                                                                </button>
                                                                <div class="dropdown-menu" x-placement="bottom-start"
                                                                    style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 37px, 0px);">

                                                                    <a class="dropdown-item"
                                                                        href="{{ route(request()->user_type . '.quiz.edit', $item->id) }}">@lang('global.button.edit')</a>
                                                                    <a class="dropdown-item" href="javascript:;"
                                                                        onclick="confirmDelete('{{ route(request()->user_type . '.quiz.delete', $item->id) }}')">@lang('global.button.delete')</a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item"
                                                                        href="{{ route(request()->user_type . '.quiz.questions', $item->id) }}">@lang('backend.tests.label.manage_questions')</a>
                                                                </div>
                                                            </div>
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
@section('footer_scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('change', '.js-switch', function() {
                let is_active = $(this).prop('checked') === true ? 1 : 0;
                let userId = $(this).data('id');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route(request()->user_type . '.quiz.update.status') }}',
                    data: {
                        'is_active': is_active,
                        'id': userId
                    },
                    success: function(data) {
                        toastr.success(data.message, $plugin_translations.toastr_success_text, {
                            timeOut: 2000
                        });
                    }
                });
            });

            var getSectionByCourseURL = "{{ route(request()->user_type . '.getSectionByCourse') }}";
            $(".sectionInput").select2({
                placeholder: $plugin_translations.select2_placeholder,
                ajax: {
                    url: getSectionByCourseURL,
                    type: "get",
                    dataType: 'json',
                    data: function(params) {
                        var searchTerm = params.term;
                        return {
                            searchTerm: searchTerm,
                            courseId: $("#course_id").val()
                        };
                    },
                    processResults: function(response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                }
            });
        });
    </script>
@endsection
