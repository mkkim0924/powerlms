@extends('admin.layouts.master')
@section('admin_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-4 d-flex align-items-center">
                                <h2 class="card-title text-capitalize">@lang('backend.admin.manage_admins.header.list')</h2>
                            </div>
                            <div class="col lg 4">
                                <span
                                    class="pull-right d-inline-block @if (session('display_type') == 'rtl') float-left @else float-right @endif">
                                    <a href="{{ route('admin.admin_users.create') }}" class="btn btn-rounded btn-success">
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
                                                    <th>@lang('backend.admin.manage_admins.label.name')</th>
                                                    <th>@lang('backend.admin.manage_admins.label.email')</th>
                                                    <th>@lang('backend.admin.manage_admins.label.join_date')</th>
                                                    <th>@lang('backend.admin.manage_admins.label.status')</th>
                                                    <th>@lang('backend.admin.manage_admins.label.role')</th>
                                                    <th>@lang('backend.admin.manage_admins.label.action')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($admins as $item)
                                                    <tr>

                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ $item->email }}</td>
                                                        <td>
                                                            {{ formatDate($item->created_at, 'M d, Y') }}
                                                        </td>
                                                        <td> <input type="checkbox" data-id="{{ $item->id }}"
                                                                name="is_active" class="js-switch"
                                                                {{ $item->is_active == 1 ? 'checked' : '' }}>
                                                        </td>
                                                        </td>
                                                        <td>{{ isset($item->relatedRole) ? $item->relatedRole->name : '--' }}
                                                        </td>
                                                        <td><a href="{{ route('admin.admin_users.edit', $item->id) }}"
                                                                class="text-inverse p-r-10 ab" data-toggle="tooltip"
                                                                title="" data-original-title="@lang('global.button.edit')"><i
                                                                    class="fas fa-pencil-alt text-inverse mr-2"></i></a>
                                                            <a href="javascript:;"
                                                                onclick="confirmDelete('{{ route('admin.admin_users.delete', $item->id) }}')"
                                                                class="text-inverse" title="" data-toggle="tooltip"
                                                                data-original-title="@lang('global.button.delete')"><i
                                                                    class="ti-trash text-danger"></i></a>
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
            'use strict';

            $(document).on('change', '.js-switch', function() {
                let is_active = $(this).prop('checked') === true ? 1 : 0;
                let userId = $(this).data('id');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route('admin.admin-user.status') }}',
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
        });
    </script>
@endsection
