@extends('admin.layouts.master')
@section('admin_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-4 col-6 d-flex align-items-center">
                                <h2 class="card-title text-capitalize">@lang('backend.course_survey.header.list')</h2>
                            </div>
                            <div class="col lg 4">
                                <span
                                    class="pull-right d-inline-block @if (session('display_type') == 'rtl') float-left @else float-right @endif">
                                    <a href="{{ route(request()->user_type . '.survey.create') }}"
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
                                        'route' => request()->user_type . '.surveys',
                                        'id' => 'course_surveys',
                                    ]) !!}
                                    <div class="row">
                                        <div class="col">
                                            <label>@lang('backend.course_survey.label.select_course')</label>
                                            {!! Form::select('course_id', $courses, request('course_id'), [
                                                'id' => 'course_id',
                                                'class' => 'form-control select2Search',
                                                'placeholder' => '',
                                            ]) !!}
                                        </div>
                                        <div class="col">
                                            <label>@lang('backend.course_survey.label.course_survey_type')</label>
                                            {!! Form::select('type', ['pre' => 'Pre', 'post' => 'Post'], request('type'), [
                                                'id' => 'type',
                                                'class' => 'form-control select2Search',
                                                'placeholder' => '',
                                            ]) !!}
                                        </div>
                                        <div class="col">
                                            <label>@lang('backend.course_survey.label.status')</label>
                                            {!! Form::select('status', ['1' => 'Active', '0' => 'Inactive'], request('status'), [
                                                'id' => 'status',
                                                'class' => 'form-control select2Search',
                                                'placeholder' => '',
                                            ]) !!}
                                        </div>
                                        <div class="col align-self-end">
                                            <button type="submit"
                                                class="btn waves-effect waves-light btn-outline-success btn-sm">
                                                @lang('global.button.search')</button>
                                            <a href="{{ route(request()->user_type . '.surveys') }}"
                                                class="btn waves-effect waves-light btn-outline-warning btn-sm">
                                                @lang('global.button.reset')
                                            </a>
                                        </div>
                                    </div>
                                    <hr>
                                    {!! Form::close() !!}
                                    <div class="table-responsive mt-4">
                                        <table id="zero_config" class="product-overview v-middle table">
                                            <thead>
                                                <tr>
                                                    <th width="27%">@lang('backend.course_survey.label.name')</th>
                                                    <th width="27%">@lang('backend.course_survey.label.course_name')</th>
                                                    <th width="13%">@lang('backend.course_survey.label.created_date')</th>
                                                    <th width="11%">@lang('backend.course_survey.label.course_survey_type')</th>
                                                    <th width="10%">@lang('backend.course_survey.label.status')</th>
                                                    <th width="10%">@lang('backend.course_survey.label.action')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($course_survey_data as $item)
                                                    <tr>

                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ $item->courseDetails->name ?? '- - -' }}</td>
                                                        <td>{{ formatDate($item->created_at) }}</td>
                                                        <td>{{ $item->survey_type == 'pre' ? 'Pre' : 'Post' }} Survey</td>
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
                                                                        href="{{ route(request()->user_type . '.survey.edit', $item->id) }}">@lang('global.button.edit')</a>
                                                                    <a class="dropdown-item" href="javascript:;"
                                                                        onclick="confirmDelete('{{ route(request()->user_type . '.survey.delete', $item->id) }}')">@lang('global.button.delete')</a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item"
                                                                        href="{{ route(request()->user_type . '.survey.questions', $item->id) }}">@lang('backend.course_survey.label.manage_questions')</a>
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
                let dataId = $(this).data('id');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route(request()->user_type . '.survey.update.status') }}',
                    data: {
                        'is_active': is_active,
                        'id': dataId
                    },
                    success: function(data) {
                        toastr.success(data.message, $plugin_translations.toastr_success_text, {
                            timeOut: 2000
                        });
                    }
                });
            });
        });
    </script>
@endsection
