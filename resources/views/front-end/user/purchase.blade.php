@extends('front-end.layouts.master')

@section('content')
    @include('front-end.user.partials.navbar', ['current_tab' => 'purchase'])
    <section class="user-dashboard-area">
        <div class="container">
            <section id="courses-3" class="purchase-section division">
                <div class="row mx-0">
                    <div class="d-flex justify-content-between px-2 px-sm-3 mb-3">
                        <h3 class="">Purchase History</h3>
                    </div>
                    @if (count($purchase) > 0)
                        <section class="purchase-history-list-area">
                            <ul class="purchase-history-list">
                                <li class="purchase-history-list-header">
                                    <div class="row mx-0">
                                        <div class="col-5">
                                            <h6> @lang('frontend.purchases.item_label')</h6>
                                        </div>
                                        <div class="col-7 hidden-xxs hidden-xs">
                                            <div class="row mx-0">
                                                <div class="col-3">
                                                    <h6>@lang('frontend.purchases.date_label')</h6>
                                                </div>
                                                <div class="col-2">
                                                    <h6>@lang('frontend.purchases.price_label')</h6>
                                                </div>
                                                <div class="col-4">
                                                    <h6>@lang('frontend.purchases.payment_type_label')</h6>
                                                </div>
                                                <div class="col-3">
                                                    <h6>
                                                        @lang('frontend.purchases.actions_label')
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @foreach ($purchase as $item)
                                    <li class="purchase-history-items radius-10 box-shadow-3 mt-3">
                                        <div class="row mx-0">
                                            <div class="col-5">
                                                @if ($item->module_type == 'course')
                                                    <div class="purchase-history-course-img">
                                                        <img src="{{ getFileUrl($item->courseDetails->image, 'course/images') }}"
                                                             class="img-fluid">
                                                    </div>
                                                    <a class="purchase-history-course-title"
                                                       href="{{ route('course_detail', $item->courseDetails->slug) }}">
                                                        {{ $item->courseDetails->name }} </a>
                                                @else
                                                    <div class="purchase-history-course-img">
                                                        <img src="{{ getFileUrl($item->bundleDetails->image, 'bundle') }}"
                                                             class="img-fluid">
                                                    </div>
                                                    <a class="purchase-history-course-title"
                                                       href="{{ route('bundle_detail', $item->bundleDetails->slug) }}">
                                                        {{ $item->bundleDetails->name }} </a>
                                                @endif
                                            </div>
                                            <div class="col-7 purchase-history-detail">
                                                <div class="row">
                                                    <div class="col-3 date">
                                                        {{ formatdate($item->created_at) }}
                                                    </div>
                                                    <div class="col-2 price"><b>
                                                            {{ formatPrice($item->price) }}
                                                        </b></div>
                                                    <div class="col-4 payment-type">
                                                        {{ __('backend.payment_method.' . $item->payment_type) }}
                                                    </div>
                                                    <div class="col-3">
                                                        <a href="{{ route('purchase.invoice', $item->id) }}" target="_blank"
                                                           class="ms-2 btn btn-receipt">@lang('frontend.purchases.invoice_text')</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </section>
                    @else
                        <div class="row mx-0 px-0">
                            <div class="alert alert-danger fw-400 text-center py-2">@lang('frontend.purchases.no_record_found_text')</div>
                        </div>

                @endif
            </section>
        </div>
    </section>
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend-assets/unit-page/purchase.css') }}"/>
@endpush
