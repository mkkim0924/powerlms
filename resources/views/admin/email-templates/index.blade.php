@extends('admin.layouts.master')
@section('admin_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-4 col-6 d-flex align-items-center">
                                <h2 class="card-title text-capitalize">@lang('backend.emails.header.list')</h2>
                            </div>
                            <div class="col lg 4">
                                <span
                                    class="pull-right d-inline-block @if (session('display_type') == 'rtl') float-left @else float-right @endif">
                                    <a href="{{ route('admin.email-templates.create') }}"
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
                                    <div class="table-responsive mt-4">
                                        <table id="zero_config" class="product-overview v-middle table">
                                            <thead>
                                                <tr>

                                                    <th>@lang('backend.emails.label.title')</th>
                                                    <th>@lang('backend.emails.label.identifier')</th>
                                                    <th>@lang('backend.emails.label.actions')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($email_templates as $item)
                                                    <tr>

                                                        <td>{{ $item->title }}</td>
                                                        <td>{{ __('backend.email_action.' . $item->identifier) }}</td>
                                                        <td>
                                                            <a href="{{ route('admin.email-templates.edit', $item->id) }}"
                                                                data-toggle="tooltip"
                                                                data-original-title="@lang('global.button.edit')">
                                                                <i class="fas fa-pencil-alt text-inverse m-r-10"></i>
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
