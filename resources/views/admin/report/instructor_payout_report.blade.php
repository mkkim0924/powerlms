@extends('admin.layouts.master')
@section('admin_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <span class="d-block text-dark op-7 font-medium">@lang('backend.instructor_payout_report.label.pending_amount')</span>
                                <h3 class="mb-0">{{ formatPrice($instructor->instructor_pending_amount) }}</h3>
                            </div>
                            <div class="round round-purple ml-auto">{{ config('currency_symbol') }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <span class="d-block text-dark op-7 font-medium">@lang('backend.instructor_payout_report.label.total_paout_amount')</span>
                                <h3 class="mb-0">{{ formatPrice($instructor->instructor_payout_amount) }}</h3>
                            </div>
                            <div class="round round-primary ml-auto">{{ config('currency_symbol') }}</div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <span class="d-block text-dark op-7 font-medium">@lang('backend.instructor_payout_report.label.requested_withdrawal_amount')</span>
                                <h3 class="mb-0">{{ formatPrice($pendingRequest->price ?? 0) }}</h3>
                            </div>
                            <div class="round round-info ml-auto">{{ config('currency_symbol') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row my-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-4 d-flex align-items-center">
                                <h2 class="card-title">@lang('backend.instructor_payout_report.header.payout_report')</h2>
                            </div>
                            <div class="col lg 4">
                                <span
                                    class="pull-right d-inline-block @if (session('display_type') == 'rtl') float-left @else float-right @endif">
                                    <a href="javascript:;"
                                       class="btn waves-effect waves-light btn-rounded btn-outline-success"
                                       data-toggle="modal" data-target="#myModal">
                                        <i class="fa fa-plus" aria-hidden="true"></i> @lang('backend.instructor_payout_report.label.request_a_new_withdrawal') </a>
                                </span>
                            </div>
                            <div>
                                <span class="pull-right d-inline-block @if (session('display_type') == 'rtl') float-left @else float-right @endif">
                                    <a href="{{ route('instructor.payout_report.export') }}" class="btn btn-rounded btn-success">
                                        @lang('global.button.export')
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-md-4">
                            <label>@lang('backend.instructor_payout_report.label.select_status')</label>
                            {!! Form::select('status', ['approved' =>'Approved','pending' => 'Pending'], null, [
                                'class' => 'form-control select2Search rounded-0',
                                'placeholder' => '',
                            ]) !!}
                        </div>
                        <hr class="mb-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="table-responsive mt-4">
                                        <table id="zero_config" class="product-overview v-middle table">
                                            <thead>
                                            <tr>
                                                <th data-sorting="false">@lang('backend.instructor_payout_report.label.payout_amount')</th>
                                                <th data-sorting="false">@lang('backend.instructor_payout_report.label.request_status')</th>
                                                <th data-sorting="false">@lang('backend.instructor_payout_report.label.request_created_date')</th>
                                                <th data-sorting="false">@lang('backend.instructor_payout_report.label.request_approved_date')</th>
                                                <th data-sorting="false">@lang('backend.instructor_payout_report.label.actions')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($payoutRequests as $item)
                                                    <tr>
                                                        <td>{{ formatPrice($item->price) }}</td>
                                                        @if ($item->payout_request_status == 1)
                                                            <td>@lang('backend.instructor_payout_report.label.approved')</td>
                                                        @else
                                                            <td>@lang('backend.instructor_payout_report.label.pending')</td>
                                                        @endif
                                                        <td>{{ formatDate($item->created_at) }}</td>
                                                        <td>@if ($item->payout_request_status == 1) {{formatDate($item->updated_at)}} @else -- @endif</td>
                                                        <td>@if ($item->payout_request_status == 1) -- @else
                                                                <a href="javascript:;"
                                                                    onclick="confirmDelete('{{ route('instructor.payout_request.delete', $item->id) }}')"
                                                                    class="btn btn-pinterest waves-effect waves-light"
                                                                    type="button"><i class="fa fa-trash-alt"></i>
                                                                </a>
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
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">@lang('backend.instructor_payout_report.label.request_a_new_withdrawal')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                @if (isset($pendingRequest))
                    <div class="modal-body">
                        <div class="alert alert-danger" role="alert">
                            <h4 class="alert-heading">@lang('backend.instructor_payout_report.label.oops')</h4>
                            @lang('backend.instructor_payout_report.note.withdrawal')
                            {{-- <p><strong>You already requested a withdrawal</strong></p>
                            <p>If you want to make another, You have to delete the requested one first</p> --}}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info waves-effect"
                                data-dismiss="modal">@lang('global.button.cancel')</button>
                    </div>
                @else
                    <form action="{{ route('instructor.payout_request.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <lable>@lang('backend.instructor_payout_report.label.amount')</lable>
                                <span class="text-danger">*</span>
                                {!! Form::number('request_amount', old('request_amount'), [
                                    'class' => 'form-control',
                                    'data-validation' => 'required',
                                    'data-validation-error-msg' => __('validation.required', [
                                        'attribute' => strtolower(__('backend.instructor_payout_report.label.amount')),
                                    ]),
                                ]) !!}
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-info waves-effect">@lang('backend.instructor_payout_report.button.request')</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('footer_scripts')
    <script>
        $(document).ready(function () {
            'use strict';
            $(document).on('change', '.select2Search', function () {
                filterColumn(1, $(this).val());
            });
        });

        function filterColumn(i, val) {
            $('#zero_config').DataTable().column(i).search(val, false, true).draw();
        }
    </script>
@endsection
