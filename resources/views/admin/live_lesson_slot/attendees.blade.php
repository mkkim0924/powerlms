@extends('admin.layouts.master')
@section('admin_content')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-4 col-6 d-flex align-items-center">
                                    <h2 class="card-title text-capitalize">@lang('backend.live_lesson_slots.header.live_lesson_slot_attendees')</h2>
                                </div>
                                <div class="col lg 4">
                                    <span
                                        class="pull-right d-inline-block @if (session('display_type') == 'rtl') float-left @else float-right @endif">
                                        <a href="{{ route(request()->user_type . '.liveLessonSlots') }}"
                                            class="btn btn-rounded btn-warning">
                                            <i class="fa fa-arrow-left" aria-hidden="true"></i> @lang('global.button.back')
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive mt-4">
                                <table id="zero_config" class="product-overview v-middle table">
                                    <thead>
                                        <tr>
                                            <th>@lang('backend.live_lesson_slots.label.name')</th>
                                            <th>@lang('backend.live_lesson_slots.label.email')</th>
                                            <th>@lang('backend.live_lesson_slots.label.date')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($liveLessonSlot->slotUsers as $item)
                                            <tr>
                                                <td>{{ $item->userDetails->name ?? '- - -' }}</td>
                                                <td>{{ $item->userDetails->email ?? '- - -' }}</td>
                                                <td>{{ formatDate($item->created_at) }}</td>
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
@stop
