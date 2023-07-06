@extends('admin.layouts.master')
@section('admin_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-4 col-6 d-flex align-items-center">
                                <h2 class="card-title text-capitalize">@lang('backend.course_faqs.header.list')</h2>
                            </div>
                            <div class="col lg 4">
                                <span
                                    class="pull-right d-inline-block @if (session('display_type') == 'rtl') float-left @else float-right @endif">
                                    <a href="{{ route(request()->user_type . '.faqs.create') }}"
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
                                {!! Form::open([
                                    'method' => 'GET',
                                    'class' => 'form-horizontal',
                                    'route' => request()->user_type . '.faqs',
                                    'id' => 'myForm',
                                ]) !!}
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>@lang('backend.course_faqs.label.select_course'):</label>
                                        {!! Form::select('course_id', $courses, request('course_id'), [
                                            'id' => 'course_id',
                                            'class' => 'form-control select2Search',
                                            'placeholder' => '',
                                        ]) !!}
                                    </div>
                                    <div class="col-md-6 align-self-end">
                                        <button type="submit"
                                            class="btn waves-effect waves-light btn-outline-success btn-sm">
                                            @lang('global.button.search')</button>

                                        <a href="{{ route(request()->user_type . '.faqs') }}"
                                            class="btn waves-effect waves-light btn-outline-warning btn-sm">
                                            @lang('global.button.reset')

                                        </a>
                                    </div>
                                </div>
                                <hr>
                                {!! Form::close() !!}
                                <div class="table-responsive">
                                    <table id="datatable_without_search" class="product-overview v-middle table">
                                        <thead>
                                            <tr>
                                                <th>@lang('backend.course_faqs.label.question')</th>
                                                <th>@lang('backend.course_faqs.label.course_name')</th>
                                                <th>@lang('backend.course_faqs.label.actions')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($faqs as $item)
                                                <tr>
                                                    <td>{{ $item->question }}</td>
                                                    <td>{{ $item->courseDetail->name ?? '- - -' }}</td>
                                                    <td>
                                                        <a href="{{ route(request()->user_type . '.faqs.edit', $item->id) }}"
                                                            data-toggle="tooltip" data-original-title="@lang('global.button.edit')">
                                                            <i class="fas fa-pencil-alt text-inverse m-r-10"></i>
                                                        </a>
                                                        <a href="javascript:;"
                                                            onclick="confirmDelete('{{ route(request()->user_type . '.faqs.delete', $item->id) }}')"
                                                            data-toggle="tooltip" data-original-title="@lang('global.button.delete')">
                                                            <i class="text-inverse fas fa-times text-danger"></i>
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
    </div>
@endsection
