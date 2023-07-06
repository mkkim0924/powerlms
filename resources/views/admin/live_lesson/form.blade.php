@include('admin.layouts.partials.flash_messages')
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>@lang('backend.live_lessons.label.select_course')</label>
            <span class="text-danger">*</span>
            {!! Form::select('course_id', $courses, $live_lesson->course_id ?? old('course_id'), [
                'class' => 'form-control select2Search',
                'data-validation' => 'required',
                'data-validation-error-msg' => __('validation.required', [
                    'attribute' => __('backend.live_lessons.label.select_course'),
                ]),
                'placeholder' => __('backend.live_lessons.label.select_course'),
                'id' => 'courseId',
            ]) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <label>@lang('backend.live_lessons.label.title')</label>
            <span class="text-danger">*</span>
            {!! Form::text('title', $live_lesson->title ?? old('name'), [
                'class' => 'form-control',
                'data-validation' => 'required',
                'data-validation-error-msg' => __('validation.required', ['attribute' => __('backend.live_lessons.label.title')]),
                'placeholder' => __('backend.live_lessons.label.enter_lesson_name_text'),
            ]) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <label>@lang('backend.live_lessons.label.description')</label>
            <span class="text-danger">*</span>
            {!! Form::textarea('description', $live_lesson->description ?? old('description'), [
                'class' => 'form-control',
                'data-validation' => 'required',
                'data-validation-error-msg' => __('validation.required', [
                    'attribute' => __('backend.live_lessons.label.description'),
                ]),
                'placeholder' => __('backend.live_lessons.label.enter_lesson_details_text'),
            ]) !!}
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
