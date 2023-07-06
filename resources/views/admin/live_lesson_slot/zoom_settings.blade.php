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
                                    <h2 class="card-title text-capitalize">@lang('backend.live_lesson_slots.header.zoom_setting')</h2>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" role="form" method="post"
                                  action="{{ route('instructor.updateZoomSettings') }}"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>@lang('backend.live_lesson_slots.label.api_key')</label>
                                            <span class="text-danger">*</span>
                                            {!! Form::text('instructor_zoom_details[api_key]', $instructor->instructor_zoom_details['api_key'] ?? old('instructor_zoom_details[api_key]'), [
                                            'class' => 'form-control',
                                            'data-validation' => 'required',
                                            'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.live_lesson_slots.label.api_key'))])
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>@lang('backend.live_lesson_slots.label.secret_key')</label>
                                            <span class="text-danger">*</span>
                                            {!! Form::text('instructor_zoom_details[api_secret]', $instructor->instructor_zoom_details['api_secret'] ?? old('instructor_zoom_details[api_secret]'), [
                                            'class' => 'form-control',
                                            'data-validation' => 'required',
                                            'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.live_lesson_slots.label.secret_key'))])
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>@lang('backend.live_lesson_slots.label.meeting_join_approval')</label>
                                            <span class="text-danger">*</span>
                                            {!! Form::select('instructor_zoom_details[approval_type]', $select_configuration_values['approval_type'],
                                            $instructor->instructor_zoom_details['approval_type'] ?? old('instructor_zoom_details[approval_type]'), [
                                            'class' => 'form-control select2_no_search',
                                            'data-validation' => 'required',
                                            'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.live_lesson_slots.label.meeting_join_approval'))])
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>@lang('backend.live_lesson_slots.label.audio_option')</label>
                                            <span class="text-danger">*</span>
                                            {!! Form::select('instructor_zoom_details[audio]', $select_configuration_values['audio'],
                                            $instructor->instructor_zoom_details['audio'] ?? old('instructor_zoom_details[audio]'), [
                                            'class' => 'form-control select2_no_search',
                                            'data-validation' => 'required',
                                            'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.live_lesson_slots.label.audio_option'))])
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>@lang('backend.live_lesson_slots.label.auto_recording')</label>
                                            <span class="text-danger">*</span>
                                            {!! Form::select('instructor_zoom_details[auto_recording]', $select_configuration_values['auto_recording'],
                                            $instructor->instructor_zoom_details['auto_recording'] ?? old('instructor_zoom_details[auto_recording]'), [
                                            'class' => 'form-control select2_no_search',
                                            'data-validation' => 'required',
                                            'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.live_lesson_slots.label.auto_recording'))])
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>@lang('backend.live_lesson_slots.label.timezone')</label>
                                            <span class="text-danger">*</span>
                                            {!! Form::select('instructor_zoom_details[timezone]', $select_configuration_values['timezone'],
                                            $instructor->instructor_zoom_details['timezone'] ?? 'UTC', [
                                            'class' => 'form-control select2SearchWithoutClear',
                                            'data-validation' => 'required',
                                            'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.live_lesson_slots.label.timezone'))])
                                            ]) !!}
                                        </div>
                                    </div>
                                    {{--                                    {{ dd($instructor->instructor_zoom_details) }}--}}
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input type="checkbox" class="js-input-switch parentSwitchInput"
                                                   id="join_before_host"
                                                   @if(!empty($instructor->instructor_zoom_details) && $instructor->instructor_zoom_details['join_before_host'] == 1) checked
                                                   @endif
                                                   name="instructor_zoom_details[join_before_host]">
                                            <label for="join_before_host">@lang('backend.live_lesson_slots.label.join_before_host')</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input type="checkbox" class="js-input-switch" id="host_video"
                                                   @if(!empty($instructor->instructor_zoom_details) && $instructor->instructor_zoom_details['host_video'] == 1) checked
                                                   @endif
                                                   name="instructor_zoom_details[host_video]">
                                            <label for="host_video">@lang('backend.live_lesson_slots.label.host_video')</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input type="checkbox" class="js-input-switch"
                                                   id="participant_video"
                                                   @if(!empty($instructor->instructor_zoom_details) && $instructor->instructor_zoom_details['participant_video'] == 1) checked
                                                   @endif
                                                   name="instructor_zoom_details[participant_video]">
                                            <label for="participant_video">@lang('backend.live_lesson_slots.label.participant_video')</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input type="checkbox" class="js-input-switch"
                                                   id="mute_upon_entry"
                                                   @if(!empty($instructor->instructor_zoom_details) && $instructor->instructor_zoom_details['mute_upon_entry'] == 1) checked
                                                   @endif
                                                   name="instructor_zoom_details[mute_upon_entry]">
                                            <label for="mute_upon_entry">@lang('backend.live_lesson_slots.label.participant_mic_mute')</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input type="checkbox" class="js-input-switch" id="waiting_room"
                                                   @if(!empty($instructor->instructor_zoom_details) && $instructor->instructor_zoom_details['waiting_room'] == 1) checked
                                                   @endif
                                                   name="instructor_zoom_details[waiting_room]">
                                            <label for="waiting_room">@lang('backend.live_lesson_slots.label.waiting_room')</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group m-b-0 text-left">
                                            <button type="submit" class="btn btn-success"><i class="fa fa-check"></i>
                                                @lang('global.button.save')
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
