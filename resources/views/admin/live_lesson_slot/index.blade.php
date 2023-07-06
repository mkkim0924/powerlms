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
                                    <h2 class="card-title text-capitalize">@lang('backend.live_lesson_slots.header.list')</h2>
                                </div>
                                <div class="col lg 4">
                                    <span
                                        class="pull-right d-inline-block @if (session('display_type') == 'rtl') float-left @else float-right @endif">
                                        @if (!empty(config('zoom.api_key')) && !empty(config('zoom.api_secret')))
                                            <a href="{{ route(request()->user_type . '.liveLessonSlots.create') }}"
                                                class="btn btn-rounded btn-success">
                                                <i class="fa fa-plus" aria-hidden="true"></i> @lang('global.button.add_new')
                                            </a>
                                        @else
                                            <a href="{{ route('instructor.zoomSettings') }}"
                                                class="btn btn-rounded btn-success">
                                                @lang('backend.live_lesson_slots.label.add_zoom_settings')
                                            </a>
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive mt-4">
                                <table id="zero_config" class="product-overview v-middle table">
                                    <thead>
                                        <tr>
                                            <th>@lang('backend.live_lesson_slots.label.title')</th>
                                            <th>@lang('backend.live_lesson_slots.label.meeting_id')</th>
                                            <th>@lang('backend.live_lesson_slots.label.password')</th>
                                            <th>@lang('backend.live_lesson_slots.label.duretion')</th>
                                            <th>@lang('backend.live_lesson_slots.label.date')</th>
                                            <th>@lang('backend.live_lesson_slots.label.actions')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($liveLessonSlot as $item)
                                            <tr>
                                                <td>{{ $item->liveLessonDetails->title ?? '- - -' }}</td>
                                                <td>{{ $item->meeting_id }}</td>
                                                <td>{{ $item->password }}</td>
                                                <td>{{ $item->duration }}</td>
                                                <td>{{ formatDate($item->start_at) }}</td>
                                                <td>
                                                    @if (\Carbon\Carbon::now() < \Carbon\Carbon::parse($item->end_at))
                                                        <a href="{{ $item->start_url }}" class="btn btn-md btn-success"
                                                            target="_blank">
                                                            @lang('backend.live_lesson_slots.start_url_button')
                                                        </a>
                                                    @endif
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-dark dropdown-toggle"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <i class="fas fa-ellipsis-v"></i>
                                                        </button>
                                                        <div class="dropdown-menu" x-placement="bottom-start"
                                                            style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 37px, 0px);">
                                                            @if (\Carbon\Carbon::now() <= \Carbon\Carbon::parse($item->start_at)->subDay())
                                                                <a class="dropdown-item"
                                                                    href="{{ route(request()->user_type . '.liveLessonSlots.edit', $item->id) }}">@lang('global.button.edit')</a>
                                                            @endif
                                                            <a class="dropdown-item"
                                                                onclick="confirmDelete('{{ route(request()->user_type . '.liveLessonSlots.delete', $item->id) }}')"
                                                                href="javascript:;">@lang('global.button.delete')</a>
                                                            <a class="dropdown-item"
                                                                href="{{ route(request()->user_type . '.liveLessonSlots.attendees', $item->id) }}">@lang('backend.live_lesson_slots.button.attendees')</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
