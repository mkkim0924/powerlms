@extends('admin.layouts.master')
@section('admin_content')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-4 col-6 d-flex align-items-center">
                                    <h2 class="card-title text-capitalize">@lang('backend.live_lessons.header.list')</h2>
                                </div>
                                <div class="col lg 4">
                                    <span
                                        class="pull-right d-inline-block @if (session('display_type') == 'rtl') float-left @else float-right @endif">
                                        <a href="{{ route(request()->user_type . '.live_lessons.create') }}"
                                            class="btn btn-rounded btn-success">
                                            <i class="fa fa-plus" aria-hidden="true"></i> @lang('global.button.add_new')
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            {!! Form::open([
                                'method' => 'GET',
                                'class' => 'form-horizontal',
                                'route' => request()->user_type . '.live_lessons',
                                'id' => 'myForm',
                            ]) !!}
                            <div class="row">
                                <div class="col-md-6">
                                    <label>@lang('backend.live_lessons.label.select_course')</label>
                                    {!! Form::select('course_id', $courses, request('course_id'), [
                                        'id' => 'course_id',
                                        'class' => 'form-control select2Search',
                                        'placeholder' => '',
                                    ]) !!}
                                </div>
                                <div class="col-md-6 mt-4">
                                    <button type="submit" class="btn waves-effect waves-light btn-outline-success">
                                        @lang('global.button.search')</button>

                                    <a href="{{ route(request()->user_type . '.live_lessons') }}"
                                        class="btn waves-effect waves-light btn-outline-warning">
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
                                            <th>@lang('backend.live_lessons.label.title')</th>
                                            <th>@lang('backend.live_lessons.label.course')</th>
                                            <th>@lang('backend.live_lessons.label.actions')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($live_lessons as $item)
                                            <tr>
                                                <td>{{ $item->title }}</td>
                                                <td>{{ $item->courseDetail->name ?? '' }}</td>
                                                <td>
                                                    <a href="{{ route(request()->user_type . '.live_lessons.edit', $item->id) }}"
                                                        data-toggle="tooltip" data-original-title="@lang('global.button.edit')">
                                                        <i class="fas fa-pencil-alt text-inverse m-r-10"></i>
                                                    </a>
                                                    <a href="javascript:;"
                                                        onclick="confirmDelete('{{ route(request()->user_type . '.live_lessons.delete', $item->id) }}')"
                                                        data-toggle="tooltip"data-original-title="@lang('global.button.delete')">
                                                        <i class="fas fa-times text-danger"></i>
                                                    </a>
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
@stop
