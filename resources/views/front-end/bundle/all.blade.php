@extends('front-end.layouts.master')
@section('content')
    <div id="breadcrumb" class="division">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('frontend.bundles.breadcrumb_item.home')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">@lang('frontend.bundles.breadcrumb_item.all_bundles')</li>
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
                        <h3 class="h3-xs">@lang('frontend.bundles.page_header_text')</h3>
                    </div>
                    {!! Form::open([
                        'method' => 'GET',
                        'route' => 'bundles',
                        'class' => 'form-horizontal has-validation-callback',
                        'id' => 'myForm',
                    ]) !!}
                    <div class="row d-flex align-items-center">
                        <div class="col-6 col-sm-4 flex-column">
                            <label class="mb-2">@lang('frontend.bundles.label.select_category')</label>
                            {!! Form::select('category_id', $categories, request('category_id'), [
                                'class' => 'select2 form-control w-100 select2Search',
                                'id' => 'category_id',
                                'data-validation' => 'required',
                                'placeholder' => __('frontend.bundles.label.select_category'),
                            ]) !!}
                        </div>
                        <div class="col-6 col-sm-4 flex-column">
                            <label class="mb-2">@lang('frontend.bundles.label.bundles')</label>
                            <div class="course-tab">
                                <input name="search" value="{{ request('search') }}" id="search" type="text"
                                       class="form-control py-1" placeholder="@lang('frontend.bundles.search_text')">
                            </div>
                        </div>
                        <div class="col-12 col-sm-4 btn-grup mt-4 gap-2">
                            <button type="submit"
                                    class="btn waves-effect waves-light btn-rose tra-white-hover s-btn mt-1 me-sm-3">
                                @lang('global.button.search')
                            </button>
                            <a href="{{ route('bundles') }}"
                               class="btn waves-effect waves-light rose-hover reset-btn btn-block s-btn mt-1">
                                @lang('global.button.reset')
                            </a>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>

    <section id="courses-1" class="courses-section division py-5">
        <div class="container">
            <div class="row d-flex pb-4">
                <div class="col-sm-3 col-6 m-order-one">
                    <h5 class="mb-0">{{ $bundles->total() }} @lang('frontend.bundles.results_found_text')</h5>
                </div>
            </div>
            <div class="row">
                @foreach ($bundles as $bundle)
                    <div class="col-md-6 col-lg-4 col-xl-3 col-12">
                        @include('front-end.bundle.bundle_card', ['bundle' => $bundle])
                    </div>
                @endforeach
            </div>
            @if ($bundles->total() > 8)
                <div class="page-pagination division" style="text-align:center;">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                {!! $bundles->appends($_GET)->links('pagination.html') !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    {{-- if no content to show --}}
    @if ($bundles->count() == 0)
        <div class="row mx-0">
            <div class="container">
                <div class="alert alert-danger fw-400 text-center">@lang('frontend.bundles.no_bundle_found_text')</div>
            </div>
        </div>
    @endif
    @include('front-end.home.partials.learn_something_new_everyday_section')
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend-assets/unit-page/all-courses.css') }}"/>
    <link href="{{ asset('admin-assets/assets/libs/select2/dist/css/select2.min.css') }}" rel="stylesheet">
@endpush
@push('footer_scripts')
    <script type="text/javascript"
            src="{{ asset('admin-assets/assets/libs/select2/dist/js/select2.min.js') }}"></script>
    <script>
        $(function () {
            'use strict';
            $(".select2").select2();
        });
    </script>
@endpush
