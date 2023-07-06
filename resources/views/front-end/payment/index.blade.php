@extends('front-end.layouts.master')
@section('content')
    <div id="breadcrumb" class="division">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a
                                    href="{{ route('home') }}">@lang('frontend.payments.breadcrumb_item.home')</a></li>
                            <li class="breadcrumb-item"><a
                                    href="{{ ($type == 'course') ? route('course_detail', $course->slug) : route('bundle_detail', $course->slug) }}">{{ str_limit($course->name, 20) }}</a>
                            </li>
                            <li class="breadcrumb-item active"
                                aria-current="page">@lang('frontend.payments.breadcrumb_item.payment')</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <section class="bg-05 page-hero-section division">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="hero-txt white-color">
                        <h3 class="h3-xs">@lang('frontend.payments.page_header_text')</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="course-details" class="wide-40 course-section division">
        <div class="container">
            <div class="row mx-auto">
                <div class="col-lg-12">
                    <div class="course-txt course-page-section">
                        <div class="cs-content cd-block">
                            <h5 class="h5-xl">@lang('frontend.payments.order_courses_title')</h5>
                            {{--                            <div class="course-list-view ">--}}
                            <div class="list-head">
                                <div class="row">
                                    <!-- COURSES LIST -->
                                    <div class="col-12 mx-auto">
                                        <!-- COURSE #1 -->
                                        <div class="cbox-5 b-bottom course-detail-card">
                                            <div class="row">
                                                <!-- Course Description -->
                                                <div class="col-sm-3  col-3">
                                                    <img src="{{ ($type == 'course') ? getFileUrl($course->image, 'course/images') : getFileUrl($course->image, 'bundle') }}" alt="{{ $course->name }}"
                                                         class="img-fluid course-card-img">
                                                </div>
                                                <div class="col-sm-5 cbox-5-txt col-9 ">
                                                    <h5 class="h5-xs">{{ $course->name }}
                                                    </h5>
                                                    <p class=" justify-self-start">
                                                        <span class="btn-rose p-2 rounded-1 ">{{ ($type == 'course') ? 'Course' : 'Bundle' }}</span>
                                                    </p>
                                                    <div class="cbox-5-txt  instructor-detail d-block d-sm-none" >
                                                        <h6 class="h5-xs text-gray"><i class="fas fa-user  @if(session('display_type')=='rtl') ms-2 @else me-2  @endif"></i>{{ $course->instructorDetail->name }}
                                                        </h6>
                                                    </div>
                                                    <!-- Course Price -->
                                                    <div class=" cbox-5-price text-start clearfix d-block d-sm-none ">
                                                        @if(($type == 'course') && $course->discount_flag == 1)
                                                            <span class="course-price">{{ formatPrice($course->discounted_price) }}</span>
                                                            <span class="old-price">{{ formatPrice($course->price) }}</span>
                                                        @else
                                                            <span class="course-price">{{ formatPrice($course->price) }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-sm-2 cbox-5-txt  instructor-detail d-none d-sm-block p-0" >
                                                    <h6 class="h5-xs text-gray"><i class="fas fa-user me-2"></i>{{ $course->instructorDetail->name }}
                                                    </h6>
                                                </div>
                                                <!-- Course Price -->
                                                <div class="col-sm-2 cbox-5-price text-right clearfix  d-none d-sm-block">
                                                    @if(($type == 'course') && $course->discount_flag == 1)
                                                        <span class="course-price">{{ formatPrice($course->discounted_price) }}</span>
                                                        <span class="old-price">{{ formatPrice($course->price) }}</span>
                                                    @else
                                                        <span class="course-price">{{ formatPrice($course->price) }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END COURSE #1 -->
                                    </div>
                                    <!-- END COURSES LIST -->
                                </div>
                            </div>
                            {{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>

            @include('front-end.layouts.partials.flash_messages')
            <div class="row mx-auto">
                <div class="col-lg-12">
                    <div class="course-txt">
                        <div class="cs-content cd-block">
                            <h5 class="h5-xl">@lang('frontend.payments.select_payment_method_text')</h5>
                            @if((config('services.stripe.active') == 1) || (config('services.razorpay.active') == 1) || (config('services.paypal.active') == 1) || (config('services.payu.active') == 1) || (config('offline_payment.active') == 1))
                                <div id="accordion" role="tablist">
                                    @if(config('services.stripe.active') == 1)
                                        <div class="card">
                                            <div class="card-header" role="tab" id="headingOne">
                                                <h5 class="h5-xs">
                                                    <a data-bs-toggle="collapse" href="#collapseStripe" role="button"
                                                       aria-expanded="false" aria-controls="collapseStripe"
                                                       class="collapsed">
                                                        @lang('frontend.payments.credit_or_debit_card_text')
                                                    </a>
                                                </h5>
                                                <div class="hdr-data">
                                                    <img src="{{asset('frontend-assets/images/payment/stripe.png')}}"
                                                         alt="Stripe Image">
                                                </div>
                                            </div>
                                            <div id="collapseStripe" class="collapse" role="tabpanel"
                                                 aria-labelledby="headingStripe" data-bs-parent="#accordion" style="">
                                                <form action="{{ route('payment.stripe.create') }}" method="post"
                                                      id="stripe-payment-form">
                                                    @csrf
                                                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                                                    <input type="hidden" name="type" value="{{ $type }}">
                                                    <div class="card-body">
                                                        <div id="card-element">
                                                            <!-- A Stripe Element will be inserted here. -->
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <button type="submit"
                                                                class="btn btn-sm btn-rose tra-black-hover submit">@lang('global.button.pay')
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                    @if(config('services.razorpay.active') == 1)
                                        <div class="card">
                                            <div class="card-header" role="tab" id="headingRzp">
                                                <h5 class="h5-xs">
                                                    <a class="collapsed" data-bs-toggle="collapse" href="#collapseRzp"
                                                       role="button"
                                                       aria-expanded="@if(session()->get('razorpay')) true @else false @endif"
                                                       aria-controls="collapseRzp">
                                                        @lang('frontend.payments.razorpay_title')
                                                    </a>
                                                </h5>
                                                <div class="razorpay hdr-data">
                                                    <img src="{{asset('frontend-assets/images/payment/razorpay.png')}}"
                                                         alt="Paypal Image" class="bg-white" style="width:60%;">
                                                </div>
                                            </div>
                                            <div id="collapseRzp"
                                                 class="collapse @if(session()->get('razorpay')) show @endif"
                                                 role="tabpanel"
                                                 aria-labelledby="headingRzp"
                                                 data-bs-parent="#accordion" style="">
                                                <form class="w3-container w3-display-middle w3-card-4 "
                                                      method="POST"
                                                      action="{{ route('payment.razorpay') }}">
                                                    @csrf
                                                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                                                    <input type="hidden" name="type" value="{{ $type }}">
                                                    <div class="card-body">
                                                        <p> @lang('frontend.payments.pay_securely_with_razorpay_text')</p>
                                                    </div>
                                                    <div class="card-footer">
                                                        <button type="submit"
                                                                class="btn btn-sm btn-rose tra-black-hover submit">@lang('global.button.pay')
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                    @if(config('services.paypal.active') == 1)
                                        <div class="card">
                                            <div class="card-header" role="tab" id="headingPaypal">
                                                <h5 class="h5-xs">
                                                    <a class="collapsed" data-bs-toggle="collapse"
                                                       href="#collapsePaypal"
                                                       role="button" aria-expanded="false"
                                                       aria-controls="collapsePaypal">
                                                        @lang('frontend.payments.paypal_title')
                                                    </a>
                                                </h5>
                                                <div class="hdr-data">
                                                    <img src="{{asset('frontend-assets/images/payment/paypal.png')}}"
                                                         alt="Paypal Image">
                                                </div>
                                            </div>
                                            <div id="collapsePaypal" class="collapse" role="tabpanel"
                                                 aria-labelledby="headingPaypal"
                                                 data-bs-parent="#accordion" style="">
                                                <form class="w3-container w3-display-middle w3-card-4 "
                                                      method="POST"
                                                      action="{{ route('payment.paypal.redirection') }}">
                                                    @csrf
                                                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                                                    <input type="hidden" name="type" value="{{ $type }}">
                                                    <div class="card-body">
                                                        <p> @lang('frontend.payments.pay_securely_with_paypal_text')</p>
                                                    </div>
                                                    <div class="card-footer">
                                                        <button type="submit"
                                                                class="btn btn-sm btn-rose tra-black-hover submit">@lang('global.button.pay')
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                    @if(config('services.payu.active') == 1)
                                        <div class="card">
                                            <div class="card-header" role="tab" id="headingPayu">
                                                <h5 class="h5-xs">
                                                    <a class="collapsed" data-bs-toggle="collapse" href="#collapsePayu"
                                                       role="button" aria-expanded="false" aria-controls="collapsePayu">
                                                        @lang('frontend.payments.payu_title')
                                                    </a>
                                                </h5>
                                                <div class="hdr-data payu-img">
                                                    <img src="{{asset('frontend-assets/images/payment/payumoney.png')}}"
                                                         alt="PayU Image">
                                                </div>
                                            </div>
                                            <div id="collapsePayu" class="collapse" role="tabpanel"
                                                 aria-labelledby="headingPayu"
                                                 data-bs-parent="#accordion" style="">
                                                <div class="card-body">
                                                    <p>@lang('frontend.payments.pay_securely_with_payu_text') </p>
                                                    <div id="register-form">
                                                        <form action="{{route('payment.payu_redirection')}}"
                                                              method="POST" class="row register-form">
                                                            @csrf
                                                            <div id="input-name" class="col-md-12">
                                                                <p>@lang('frontend.payments.your_name_label')*</p>
                                                                <input type="text" name="user_name" autocomplete="off"
                                                                       class="form-control name"
                                                                       value="{{ auth()->user()->name }}"
                                                                       placeholder="@lang('frontend.payments.enter_your_name_placeholder')*" required>
                                                            </div>
                                                            <div id="input-email" class="col-md-12">
                                                                <p>@lang('frontend.payments.your_email_label')*</p>
                                                                <input type="email" name="user_email" autocomplete="off"
                                                                       class="form-control email"
                                                                       value="{{ auth()->user()->email }}"
                                                                       placeholder="@lang('frontend.payments.enter_your_email_placeholder')*" required>
                                                                <input type="hidden" name="course_id"
                                                                       value="{{ $course->id }}">
                                                                <input type="hidden" name="type" value="{{ $type }}">
                                                            </div>
                                                            <div id="input-phone" class="col-md-12">
                                                                <p>@lang('frontend.payments.your_mobile_number_label')
                                                                    *</p>
                                                                <input type="number" name="user_phone"
                                                                       autocomplete="off" class="form-control phone"
                                                                       value="{{ auth()->user()->mobile_number }}"
                                                                       placeholder="@lang('frontend.payments.enter_mobile_number_placeholder')*" required>
                                                            </div>
                                                            <div class="col-md-12 form-btn">
                                                                <button type="submit"
                                                                        class="btn btn-sm btn-rose tra-black-hover submit">
                                                                    @lang('global.button.pay')
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if(config('offline_payment.active') == 1)
                                        <div class="card">
                                            <div class="card-header" role="tab" id="headingOfflinePayment">
                                                <h5 class="h5-xs">
                                                    <a class="collapsed" data-bs-toggle="collapse"
                                                       href="#collapseOfflinePayment"
                                                       role="button" aria-expanded="false"
                                                       aria-controls="collapseOfflinePayment">
                                                        @lang('frontend.payments.offline_payment_title')
                                                    </a>
                                                </h5>
                                            </div>
                                            <div id="collapseOfflinePayment" class="collapse" role="tabpanel"
                                                 aria-labelledby="headingOfflinePayment"
                                                 data-bs-parent="#accordion" style="">
                                                <form class="w3-container w3-display-middle w3-card-4 "
                                                      method="POST"
                                                      action="{{ route('offline_payment.store') }}">
                                                    @csrf
                                                    <input type="hidden" name="module_id"
                                                           value="{{ $course->id }}">
                                                    <input type="hidden" name="module_type" value="{{ $type }}">
                                                    <input type="hidden" name="course_slug"
                                                           value="{{ request()->slug }}">
                                                    <div class="card-body">
                                                        <p>{{ config('offline_payment.instruction') }}</p>
                                                    </div>
                                                    <div class="card-footer">
                                                        <button type="submit"
                                                                class="btn btn-sm btn-rose tra-black-hover submit">
                                                            @lang('frontend.payments.request_assistance_button')
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @else
                                <div
                                    class="alert alert-danger text-center p-2">@lang('frontend.payments.no_payment_record_found_text') </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if(session()->get('razorpay'))
        <button id="razor-pay-btn" class="d-none">@lang('global.button.pay')</button>
        <form id="razorpay-callback-form" method="post" action="{{ route('payment.razorpay.create') }}">
            @csrf
            <input type="hidden" name="type" value="{{ $type }}">
            <input type="hidden" name="course_id" value="{{ $course->id }}">
            <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
            <input type="hidden" name="razorpay_order_id" id="razorpay_order_id">
            <input type="hidden" name="razorpay_signature" id="razorpay_signature">
        </form>
    @endif
@endsection
@push('footer_scripts')

    @if(session()->get('razorpay'))
        @php
            $rzpData = session()->get('razorpay');
        @endphp
        <script src="{{ asset('frontend-assets/plugins/payment/razorpay.checkout.js') }}"></script>
        <script type="text/javascript">
            $(function () {
                'use strict';
                var options = {
                    "key": "{{ config('services.razorpay.key') }}", // Enter the Key ID generated from the Dashboard
                    "amount": "{{ $rzpData['amount'] }}", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                    "currency": "{{ $rzpData['currency'] }}",
                    "name": "{{ $course->name }}",
                    "description": "{{ $rzpData['description'] }}",
                    "image": "{{ getFileUrl(config('logo'), 'logos') }}",
                    "order_id": "{{ $rzpData['order_id'] }}", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                    "handler": function (response) {
                        $('#razorpay_payment_id').val(response.razorpay_payment_id);
                        $('#razorpay_order_id').val(response.razorpay_order_id);
                        $('#razorpay_signature').val(response.razorpay_signature)
                        $("#razorpay-callback-form").submit();
                    },
                    "prefill": {
                        "name": "{{ $rzpData['name'] }}",
                        "email": "{{ $rzpData['email'] }}",
                    }
                };
                var rzp1 = new Razorpay(options);
                rzp1.open();
            });
        </script>
    @elseif(config('services.stripe.active') == 1)
        <script src="https://js.stripe.com/v3/"></script>
        <script>
            $(function () {
                'use strict';
                // Create a Stripe client.
                var stripe = Stripe('{{ config('services.stripe.key') }}');

                // Create an instance of Elements.
                var elements = stripe.elements();

                // Custom styling can be passed to options when creating an Element.
                // (Note that this demo uses a wider set of styles than the guide below.)
                var style = {
                    base: {
                        color: '#32325d',
                        lineHeight: '18px',
                        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                        fontSmoothing: 'antialiased',
                        fontSize: '16px',
                        '::placeholder': {
                            color: '#aab7c4'
                        }
                    },
                    invalid: {
                        color: '#fa755a',
                        iconColor: '#fa755a'
                    }
                };

                // Create an instance of the card Element.
                var card = elements.create('card', {style: style});

                // Add an instance of the card Element into the `card-element` <div>.
                card.mount('#card-element');

                // Handle real-time validation errors from the card Element.
                card.addEventListener('change', function (event) {
                    var displayError = document.getElementById('card-errors');
                    if (event.error) {
                        displayError.textContent = event.error.message;
                    } else {
                        displayError.textContent = '';
                    }
                });

                // Handle form submission.
                var form = document.getElementById('stripe-payment-form');
                form.addEventListener('submit', function (event) {
                    event.preventDefault();

                    stripe.createToken(card).then(function (result) {
                        if (result.error) {
                            // Inform the user if there was an error.
                            var errorElement = document.getElementById('card-errors');
                            errorElement.textContent = result.error.message;
                        } else {
                            // Send the token to your server.
                            stripeTokenHandler(result.token);
                        }
                    });
                });

                // Submit the form with the token ID.
                function stripeTokenHandler(token) {
                    // Insert the token ID into the form so it gets submitted to the server
                    var form = document.getElementById('stripe-payment-form');
                    var hiddenInput = document.createElement('input');
                    hiddenInput.setAttribute('type', 'hidden');
                    hiddenInput.setAttribute('name', 'stripeToken');
                    hiddenInput.setAttribute('value', token.id);
                    form.appendChild(hiddenInput);

                    // Submit the form
                    form.submit();
                }
            });
        </script>
    @endif
@endpush
