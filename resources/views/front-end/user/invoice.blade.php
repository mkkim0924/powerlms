@extends('front-end.layouts.master')

@section('content')
    <div class="inner-wrapper">
        <div class="container">
            <section class="invoice">
                <div class="row mx-auto p-3" id="invoice-step">
                    <div class="col-12 my-3 d-flex">
                        <img src="{{ getFileUrl(config('logo'), 'logos') }}" alt="" class="img-fluid" width="200">
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <h4 class="fw-500">{{ config('app.name') }}</h4>
                        <p class="mb-0">{{ config('contact_email') }}</p>
                        <p class="mb-0">{{ config('app.address') }}</p>
                        <p class="mb-0">
                            <span>@lang('frontend.invoices.phone_text'):</span> {{ config('contact_no') }}
                        </p>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12 text-start text-sm-end pt-sm-0 pt-3 ">
                        <h4 class="fw-500 text-uppercase">@lang('frontend.invoices.header_text')</h4>
                        @foreach ($invoice as $item)
                            <p class="mb-0">@lang('frontend.invoices.payment_method_text'): <span>{{ __('backend.payment_method.'.$item->payment_type) }}</span></p>
                            <p class="mb-0">
                                @lang('frontend.invoices.purchase_date_text'): <span> {{ formatdate($item->created_at) }}
                                </span>
                            </p>
                        @endforeach
                    </div>
                </div>
                <hr class="bg-secondary">
                <div class="row mx-auto">
                    <div class="col-12 mx-3">
                        @foreach ($invoice as $item)
                            <p class="mb-0"><span class="fw-500">@lang('frontend.invoices.bill_to_text'):</span>
                                <span class="text-capitalize">{{ $item->userDetails->name }}</span>
                            </p>
                            <p class="mb-0"><span class="fw-500">@lang('frontend.invoices.email_text'):</span>
                                <span>{{ $item->userDetails->email }}</span>
                            </p>
                        @endforeach
                    </div>
                </div>
                <hr class="bg-secondary">
                <div class="row">
                    <div style="overflow-x: auto;">
                    <table class="padding small border-bottom w-100 text-left">
                        <thead>
                        <tr class="gry-color" style="background: #eceff4;">
                            <th width="50%"><span class="mx-4">@lang('frontend.invoices.course_name_label')</span></th>
                            <th width="15%" style="padding-left : 10px;">@lang('frontend.invoices.category_label')</th>
                            <th width="15%">@lang('frontend.invoices.instructor_label')</th>
                            <th width="20%" class="text-end pe-4">@lang('frontend.invoices.total_label')</th>
                        </tr>
                        </thead>
                        <tbody class="strong">
                        @foreach ($invoice as $item)
                            <tr class="">
                                <td class="ps-4"> {{ $item->courseDetails->name }}</td>
                                <td class="gry-color" style="padding-left : 10px;">
                                    {{ $item->courseDetails->categoryDetail->name }}</td>
                                <td class="gry-color">{{ $item->courseDetails->instructorDetail->name }}</td>
                                <td class="text-end pe-4">{{ formatPrice($item->price) }}</td>
                            </tr>
                            <tr class="">
                                <td></td>
                                <td class="gry-color"></td>
                                <td class="gry-color strong"><strong>@lang('frontend.invoices.grand_total_text')</strong>:</td>
                                <td class="text-end pe-4"><strong>{{ formatPrice($item->price) }}</strong></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                    <div class="d-print-none mb-2 px-0">
                        <button onclick="window.print()" class="btn btn-secondary float-end mt-2"><i
                                class="fas fa-print"></i> @lang('global.button.print')
                        </button>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <hr style="opacity:.1;">
@endsection
@push('css')
    <link href="{{ asset('frontend-assets/files/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend-assets/files/css/flaticon.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend-assets/unit-page/invoice.css') }}"/>
@endpush
