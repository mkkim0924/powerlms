@extends('admin.layouts.master')
@section('admin_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-4 col-6 d-flex align-items-center">
                                <h2 class="card-title text-capitalize">@lang('backend.webinars.header.list')</h2>
                            </div>
                            <div class="col lg 4">
                                <span class="pull-right d-inline-block float-right">
                                    <a href="{{ route('instructor.webinar.create') }}" class="btn btn-rounded btn-success">
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
                                    <div class="table-responsive">
                                        <table id="zero_config" class="product-overview v-middle table">
                                            <thead>
                                                <tr>
                                                    <th>@lang('backend.webinars.label.name')</th>
                                                    <th>@lang('backend.webinars.label.category_name')</th>
                                                    <th>@lang('backend.webinars.label.actions')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($webinar as $item)
                                                    <tr>
                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ $item->categoryDetails->name ?? '---' }}</td>
                                                        <td>
                                                            <a href="{{ route(request()->user_type . '.webinar.edit', $item->id) }}"
                                                                data-toggle="tooltip"
                                                                data-original-title="@lang('global.button.edit')">
                                                                <i class="fas fa-pencil-alt text-inverse m-r-10"></i>
                                                            </a>
                                                            <a href="javascript:;"
                                                                onclick="confirmDelete('{{ route(request()->user_type . '.webinar.delete', $item->id) }}')"
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
        </div>
    </div>
@endsection
