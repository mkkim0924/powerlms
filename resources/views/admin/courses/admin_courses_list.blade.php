@extends('admin.layouts.master')
@section('admin_content')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-4 d-flex align-items-center">
                                    <h2 class="card-title text-capitalizes">@lang('backend.courses.header.list')</h2>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            {!! Form::open([
                                'method' => 'GET',
                                'route' => request()->user_type . '.courses',
                                'class' => 'form-horizontal',
                                'id' => 'myForm',
                            ]) !!}
                            <div class="row">
                                <div class="col">
                                    <label>@lang('backend.courses.label.select_category')</label>
                                    {!! Form::select('category_id', $categories, request('category_id'), [
                                        'id' => 'category_id',
                                        'class' => 'form-control select2Search',
                                        'placeholder' => '',
                                    ]) !!}
                                </div>
                                <div class="col">
                                    <label>@lang('backend.courses.label.status')</label>
                                    {!! Form::select('course_status', \App\Models\Course::STATUSES, request('course_status'), [
                                        'id' => 'course_status',
                                        'class' => 'form-control select2_no_search',
                                        'placeholder' => '',
                                    ]) !!}
                                </div>
                                <div class="col">
                                    <label>@lang('backend.courses.label.select_instructor')</label>
                                    {!! Form::select('instructor_id', $users, request('instructor_id'), [
                                        'id' => 'instructor_id',
                                        'class' => 'form-control select2Search',
                                        'placeholder' => '',
                                    ]) !!}
                                </div>
                                <div class="col">
                                    <label>@lang('backend.courses.label.price')</label>
                                    {!! Form::select('is_free', [1 => 'Free', 0 => 'Paid'], request('is_free'), [
                                        'id' => 'is_free',
                                        'class' => 'form-control select2_no_search',
                                        'placeholder' => '',
                                    ]) !!}
                                </div>
                                <div class="col mt-4">
                                    <button type="submit"
                                            class="btn waves-effect waves-light btn-outline-success btn-sm mt-1">
                                        @lang('global.button.search')</button>
                                    <a href="{{ route(request()->user_type . '.courses') }}"
                                       class="btn waves-effect waves-light btn-outline-warning btn-sm mt-1">
                                        @lang('global.button.reset')

                                    </a>
                                </div>
                            </div>
                            <hr>
                            {!! Form::close() !!}
                            <div class="table-responsive">
                                <table id="datatable_without_search" class="product-overview v-middle table">
                                    <thead>
                                    <tr>
                                        <th>@lang('backend.courses.label.course_name')</th>
                                        <th>@lang('backend.courses.label.category')</th>
                                        <th>@lang('backend.courses.label.lesson_section')</th>
                                        <th>@lang('backend.courses.label.price')</th>
                                        <th>@lang('backend.courses.label.status')</th>
                                        <th>@lang('backend.courses.label.actions')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($courses as $item)
                                        <tr>

                                            <td>{{ $item->name }}
                                                @if (isset($item->instructor_id) && request()->user_type == 'admin')
                                                    <br><span class="label label-info"><small>@lang('backend.courses.label.instructor_name'):
                                                                {{ $item->instructorDetail->name ?? '- - -' }}</small></span>
                                                @endif
                                            </td>
                                            <td>{{ $item->categoryDetail->name ?? '---' }}</td>
                                            <td>@lang('backend.courses.chapters_text'):
                                                {{ count($item->relatedCurriculumLessons) }}
                                                <br>@lang('backend.courses.lessons_text'):
                                                {{ count($item->relatedCurriculumSections) }}
                                            </td>
                                            <td>{!! $item->is_free == 1
                                                    ? '<span class="label label-success">FREE</span>'
                                                    : '<span class="label label-info">' . formatPrice($item->discount_flag == 1 ? $item->discounted_price : $item->price) . '</span>' !!}</td>
                                            <td>{!! \App\Models\Course::STATUSES[$item->course_status] !!}</td>
                                            <td>
                                                <div class="btn-group dropdown">
                                                    <button type="button" class="btn btn-dark dropdown-toggle"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-height" x-placement="bottom-start"
                                                         style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 37px, 0px);">
                                                        <a class="dropdown-item" target="_blank"
                                                           href="{{ route('admin.courses.review', $item->id) }}">@lang('backend.courses.label.view_curriculum')</a>
                                                        @if ($item->course_status == 1)
                                                            <a class="dropdown-item"
                                                               href="{{ route('admin.courses.updateStatus', [$item->id, 0]) }}">@lang('backend.courses.label.mark_as_pending')</a>
                                                        @else
                                                            <a class="dropdown-item"
                                                               href="{{ route('admin.courses.updateStatus', [$item->id, 1]) }}">@lang('backend.courses.label.mark_as_active')</a>
                                                        @endif
                                                        <a class="dropdown-item"
                                                           onclick="confirmDelete('{{ route('admin.courses.delete', $item->id) }}')"
                                                           href="javascript:;">@lang('global.button.delete')</a>
                                                    </div>
                                                </div>
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
@endsection
@section('footer_scripts')
    <script>
        $(function () {
            'use strict';

            $('.dropdown:last').on('shown.bs.dropdown', function () {
                var height = $(".dropdown-height").last().height();
                var nHeight = ((-1) * ((height) + 22));
                let this_attr = $(this).find('.dropdown-menu');

                setTimeout(function () {
                    this_attr.css('top', nHeight + "px");
                }, .000000001);
            });
        });
    </script>
@endsection
