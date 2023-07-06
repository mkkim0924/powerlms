@extends('admin.layouts.master')
@section('admin_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-4 col-12 d-flex align-items-center">
                                <h2 class="card-title text-capitalize">@lang('backend.offline_payment_requests.header')</h2>
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
                                                <th data-sorting="false">@lang('backend.offline_payment_requests.label.user')</th>
                                                <th data-sorting="false">@lang('backend.offline_payment_requests.label.course')</th>
                                                <th data-sorting="false">@lang('backend.offline_payment_requests.label.amount')</th>
                                                <th data-sorting="false">@lang('backend.offline_payment_requests.label.actions')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($offline_requests as $item)
                                                <tr>
                                                    <td>{{ $item->userDetails->name ?? "- - -" }}</td>
                                                    <td>
                                                        <span class="label label-info"><small>{{ ucfirst($item->module_type) }}</small></span><br>
                                                        {{ ($item->module_type == 'course') ? ($item->courseDetails->name ?? '- - -') : ($item->bundleDetails->name ?? '- - -') }}
                                                    </td>
                                                    <td>{{ ($item->module_type == 'course') ?
                                                                    formatPrice(($item->courseDetails->discount_flag == 1) ? $item->courseDetails->discounted_price : $item->courseDetails->price) :
                                                                    formatPrice($item->bundleDetails->price) }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.offline_payment_requests.status', [$item->id, 'approve']) }}"
                                                           class="btn waves-effect waves-light btn-rounded btn-sm btn-success">@lang('global.button.approve')</a>
                                                        <a href="javascript:;" onclick="confirmDelete('{{ route('admin.offline_payment_requests.status', [$item->id, 'delete']) }}')"
                                                           class="btn waves-effect waves-light btn-rounded btn-sm btn-danger">@lang('global.button.delete')</a>
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
