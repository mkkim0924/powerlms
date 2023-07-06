@extends('admin.layouts.master')
@section('admin_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-4 col-6 d-flex align-items-center">
                                <h2 class="card-title text-capitalize">@lang('backend.instructor_payouts.header.list_of_payout')</h2>
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
                                                <th data-sorting="false">@lang('backend.instructor_payouts.label.instructor')</th>
                                                <th data-sorting="false">@lang('backend.instructor_payouts.label.payout_amount')</th>
                                                <th data-sorting="false">@lang('backend.instructor_payouts.label.payout_date')</th>
                                                <th data-sorting="false">@lang('backend.instructor_payouts.label.status')</th>
                                                <th data-sorting="false">@lang('backend.instructor_payouts.label.action')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($payoutRequests as $item)
                                                <tr>
                                                    <td>{{ $item->userDetails->name ?? '---' }}</td>
                                                    <td>{{ formatPrice($item->price) }}</td>
                                                    <td>{{ formatDate($item->created_at) }}</td>
                                                    <td>@if($item->payout_request_status == 1) Processed @else Pending @endif</td>
                                                    <td>
                                                        @if($item->payout_request_status == 0)
                                                            <a href="{{ route('admin.instructor_payout.process', $item->id) }}" class="btn btn-success btn-sm waves-effect waves-light" type="button" data-toggle="tooltip" data-original-title="Approve">@lang('global.button.approve')
                                                            </a>
                                                        @else
                                                            ---
                                                        @endif
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
