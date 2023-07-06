@extends('front-end.layouts.master')
@section('content')
    <div id="breadcrumb" class="division">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('frontend.courses.breadcrumb_item.home')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">@lang('frontend.courses.breadcrumb_item.all_courses')</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    {!! Form::open([
                        'method' => 'GET',
                        'route' => 'courses',
                        'class' => 'form-horizontal has-validation-callback',
                        'id' => 'courseSearchForm',
                    ]) !!}
    <section class="bg-05 page-hero-section division">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="hero-txt white-color">
                        <h3 class="h3-xs">@lang('frontend.courses.header_text')</h3>
                    </div>
                    <div class="row d-flex align-items-center">
                        <div class="col-6 col-sm-4 flex-column">
                            <label class="mb-2">@lang('frontend.courses.label.select_category')</label>
                            {!! Form::select('category_id', $categories, request('category_id'), [
                                'class' => 'select2 form-control w-100 select2Search',
                                'id' => 'category_id',
                                'data-validation' => 'required',
                                'placeholder' => __('frontend.courses.label.select_category'),
                            ]) !!}
                        </div>
                        <div class="col-6 col-sm-4 flex-column">
                            <label class="mb-2">@lang('frontend.courses.label.search_course')</label>
                            <div class="course-tab">
                                <input name="search" value="{{ request('search') }}" id="search" type="text"
                                       class="form-control py-1" placeholder="@lang('frontend.courses.label.enter_course_name')">
                            </div>
                        </div>
                        <div class="col-12 col-sm-4 btn-grup mt-4 gap-2">
                            <button type="submit"
                                    class="btn waves-effect waves-light btn-rose tra-white-hover btn-sm mt-1 s-btn me-sm-3 ">
                                    @lang('global.button.search')
                            </button>
                            <a href="{{ route('courses') }}"
                               class="btn waves-effect waves-light reset-btn rose-hover btn-block btn-sm mt-1 s-btn">
                               @lang('global.button.reset')
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="courses-3" class="wide-60 courses-section division">
        <div class="container">
            <div class="row d-flex justify-content-between pb-4">
                <div class="col-sm-6 col-6 m-order-one">
                    <h5 class="mb-0">{{ $courses->total() }} @lang('frontend.courses.results_found_text')</h5>
                </div>

                <div class="col-sm-6 col-6 d-inline-block float-inherit m-order-two">
                    <select class="form-select form-select-sm  @if(session('display_type')=='rtl') me-auto @else ms-auto @endif" id="sorting" name="order_by"
                            aria-label="form-select-sm">
                        <option value="id"
                                @if(request('order_by') == 'id' || request('order_by') == "") selected @endif>
                                @lang('frontend.courses.filter.newest')
                        </option>
                        <option value="total_enrollments"
                                @if(request('order_by') == 'total_enrollments') selected @endif>
                                @lang('frontend.courses.filter.popular')
                        </option>
                        <option value="average_rating" @if(request('order_by') == 'average_rating')selected @endif>
                            @lang('frontend.courses.filter.rating')
                        </option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                </div>
            </div>
            <div class="row courses-grid">
                @foreach ($courses as $course)
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        @include('front-end.course.vertical_course_card', ['course' => $course])
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    {!! Form::close() !!}
    @if ($courses->total() > 8)
        <div class="page-pagination division" style="text-align:center;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        {!! $courses->appends($_GET)->links('pagination.html')  !!}
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($courses->count() == 0)
        <div class="row mx-0">
            <div class="alert alert-danger fw-400 text-center">@lang('frontend.courses.no_course_found_text')</div>
        </div>
    @endif
    @include('front-end.home.partials.learn_something_new_everyday_section')
@endsection
@push('css')
    <link href="{{ asset('admin-assets/assets/libs/select2/dist/css/select2.min.css') }}" rel="stylesheet">
@endpush
@push('footer_scripts')
    <script type="text/javascript"
            src="{{ asset('admin-assets/assets/libs/select2/dist/js/select2.min.js') }}"></script>
    <script>
        $(function () {
            'use strict';

            $(".select2").select2();

            $("#sorting").change(function () {
                $("#courseSearchForm").submit();
            })
        });

    </script>
@endpush
