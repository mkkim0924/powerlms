@extends('admin.layouts.master')
@section('admin_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-4 col-6 d-flex align-items-center">
                                <h2 class="card-title text-capitalize">@lang('backend.students.header.list')</h2>
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
                                                    <th>@lang('backend.students.label.image')</th>
                                                    <th>@lang('backend.students.label.name')</th>
                                                    <th>@lang('backend.students.label.email')</th>
                                                    <th>@lang('backend.students.label.actions')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($students as $item)
                                                    <tr>
                                                        <td><img src="{{ getFileUrl($item->image ?? 'default-placeholder.jpg', 'users') }}"
                                                                alt="iMac" width="80"></td>
                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ $item->email }}</td>
                                                        <td>
                                                            <a href="{{ route('admin.student_details.index', $item->id) }}"
                                                                class="text-inverse p-r-10" data-toggle="tooltip"
                                                                title="@lang('backend.students.label.action.view_student')"
                                                                data-original-title="@lang('global.button.edit')"><i
                                                                    class="fas fa-eye"></i></a>
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
