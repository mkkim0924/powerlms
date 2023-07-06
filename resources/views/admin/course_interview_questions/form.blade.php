@include('admin.layouts.partials.flash_messages')
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>@lang('backend.course_interview_question.label.select_course')</label>
            <span class="text-danger">*</span>
            {!! Form::select('course_id', $courses, $data->course_id ?? old('course_id'), [
            'class' => 'form-control select2Search',
            'id' => 'course_id',
            'data-validation' => 'required',
            'data-validation-error-msg' => __('validation.required', ['attribute' =>
            strtolower(__('backend.course_faqs.label.course_name'))]),
            'placeholder' => '',
            ]) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <label>@lang('backend.course_interview_question.label.questions')</label>
            <span class="text-danger">*</span>
            {!! Form::text('question', $data->question ?? old('question'), [
            'class' => 'form-control',
            'data-validation' => 'required',
            'data-validation-error-msg' => __('validation.required', ['attribute' =>
            strtolower(__('backend.course_faqs.label.question'))])
            ]) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <label>@lang('backend.course_interview_question.label.answer')</label>
            <span class="text-danger">*</span>
            {!! Form::textarea('answer', $data->answer ?? old('answer'), [
            'class' => 'form-control html_editor',
            'data-validation' => 'required',
            'data-validation-error-msg' => __('validation.required', ['attribute' =>
            strtolower(__('backend.course_faqs.label.answer'))])
            ]) !!}
        </div>
    </div>
</div>

<div class="form-actions">
    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i>
        @lang('global.button.save') </button>
</div>
