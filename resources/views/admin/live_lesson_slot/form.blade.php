@include('admin.layouts.partials.flash_messages')
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>@lang('backend.live_lesson_slots.label.live_lesson')</label>
            <span class="text-danger">*</span>
            {!! Form::select('live_lesson_id', $liveLesson, $liveLessonSlot->live_lesson_id ?? old('live_lesson_id'), [
            'class' => 'form-control select2Search',
            'data-validation' => 'required',
            'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.live_lesson_slots.label.live_lesson'))]),
            'placeholder' => '',
            ]) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>@lang('backend.live_lesson_slots.label.slot_title')</label>
            <span class="text-danger">*</span>
            <input type="text" name="title" value="{{ $liveLessonSlot->title ?? old('title') }}"
                   class="form-control" data-validation="required" data-validation-error-msg="{{ __('validation.required', ['attribute' => strtolower(__('backend.live_lesson_slots.label.slot_title'))]) }}">
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>@lang('backend.live_lesson_slots.label.start_at')</label>
            <span class="text-danger">*</span>
            <input type="datetime-local" name="start_at" data-validation="required" data-validation-error-msg="{{ __('validation.required', ['attribute' => strtolower(__('backend.live_lesson_slots.label.start_at'))]) }}" value="{{ isset($liveLessonSlot) ? $liveLessonSlot->start_at->format('Y-m-d\TH:i') : "" }}" class="form-control" min="{{ \Carbon\Carbon::now()->format('Y-m-d\TH:i') }}">
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>@lang('backend.live_lesson_slots.label.duretion_in_minutes')</label>
            <span class="text-danger">*</span>
            {!! Form::number('duration', $liveLessonSlot->duration ?? old('duration'), [
            'class' => 'form-control ',
            'id' => 'time',
            'data-validation' => 'required',
            'data-validation-error-msg' => __('validation.required', ['attribute' => __('backend.live_lesson_slots.label.duretion_in_minutes')])
            ]) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>@lang('backend.live_lesson_slots.label.password')</label>
            <span class="text-danger">*</span>
            <input type="text" name="password" @if ($formMode=='edit' && isset($liveLessonSlot) &&
                $liveLessonSlot->password != '')
            value="{{ $liveLessonSlot->password }}" @endif data-validation="required"
                   data-validation-error-msg="{{ __('validation.required', ['attribute' => __('backend.live_lesson_slots.label.password')]) }}"
                   class="form-control">
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>@lang('backend.live_lesson_slots.label.description')</label>
            <span class="text-danger">*</span>
            <textarea name="description" class="form-control" data-validation="required" data-validation-error-msg="{{ __('validation.required', ['attribute' => __('backend.live_lesson_slots.label.description')]) }}" id="" cols="65" rows="5">{{ $liveLessonSlot->description ?? old('description') }}</textarea>
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
@section('css')
    <link href="{{ asset('admin-assets/assets/libs/bootstrap-datepicker/dist/bootstrap-timepicker.min.css') }}"
          rel="stylesheet">
@endsection
@section('footer_scripts')
    <script>
        $(document).ready(function () {
            'use strict';
            $('.form_time').timepicker({
                format: 'hh:mm:ss',
                showSeconds: true,
                showMeridian: false,
                minuteStep: 15,
                secondStep: 30
            });
        });
    </script>
    <script src="{{ asset('admin-assets/assets/libs/bootstrap-datepicker/dist/js/bootstrap-timepicker.min.js') }}">
    </script>
@endsection
