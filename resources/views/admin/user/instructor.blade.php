@extends('admin.layouts.master')
@section('admin_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-4 col-6 d-flex align-items-center">
                                <h2 class="card-title text-capitalize">@lang('backend.manage_instructors.header.list')</h2>
                            </div>
                            <div class="col lg 4">
                                <span
                                    class="pull-right d-inline-block @if (session('display_type') == 'rtl') float-left @else float-right @endif">
                                    <a href="{{ route('admin.instructor.create') }}" class="btn btn-rounded btn-success">
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
                                                    <th>@lang('backend.manage_instructors.label.name')</th>
                                                    <th>@lang('backend.manage_instructors.label.email')</th>
                                                    <th>@lang('backend.manage_instructors.label.numbers_of_active_courses')</th>
                                                    <th>@lang('backend.manage_instructors.label.action')</th>
                                                    <th>@lang('backend.manage_instructors.label.login')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $item)
                                                    <tr>

                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ $item->email }}</td>
                                                        <td>{{ count($item->ActivecourseCOunt) }}</td>
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
                                                                        href="{{ route('admin.instructor.edit', $item->id) }}">@lang('global.button.edit')</a>
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('admin.courses', ['instructor_id' => $item->id, 'course_status' => 1]) }}">@lang('backend.manage_instructors.label.view_courses')</a>
                                                                    <a class="dropdown-item" href="javascript:;"
                                                                        onclick="confirmDelete('{{ route('admin.instructor.delete', $item->id) }}')">@lang('global.button.delete')</a>
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('admin.instructor.details', $item->id) }}">@lang('backend.manage_instructors.label.instructors_details')</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <form target="_blank" action="{{ route('admin.instructor.auth') }}" method="post">
                                                                @csrf
                                                                <input type="hidden" name="user" value="instructor">
                                                                <input type="hidden" name="instructor_id" value="{{ $item->id }}">
                                                                <button type="submit" class="btn btn-rounded btn-success">
                                                                    @lang('backend.manage_instructors.button.login')
                                                                </button>
                                                            </form>
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
