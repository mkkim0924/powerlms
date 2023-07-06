@include('admin.layouts.partials.flash_messages')
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>@lang('backend.course_faqs.label.course_name')</label>
            <span class="text-danger">*</span>
            {!! Form::select('course_id', $courses, $faqs->course_id ?? old('course_id'), [
                'class' => 'form-control select2Search',
                'id' => 'course_id',
                'data-validation' => 'required',
                'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.course_faqs.label.course_name'))]),
                'placeholder' => '',
            ]) !!}
        </div>
    </div>
    @if (!isset($faqs))
        <div class="col-sm-4">
            <div class="float-right pt-4">
                <button type="button" class="btn btn-sm btn-primary"
                        id="addNewRow">@lang('backend.course_faqs.button.add_new_faq')
                </button>
            </div>
        </div>
    @endif
</div>

<div id="FaqDetails"></div>
@if (isset($faqs))
    <div class="form-group">
        <label>@lang('backend.course_faqs.label.question')</label>
        <span class="text-danger">*</span>
        {!! Form::text('question', $faqs->question ?? old('question'), [
            'class' => 'form-control',
            'data-validation' => 'required',
            'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.course_faqs.label.question'))])
        ]) !!}
    </div>
    <div class="form-group">
        <label>@lang('backend.course_faqs.label.answer')</label>
        <span class="text-danger">*</span>
        {!! Form::textarea('answer', $faqs->answer ?? old('answer'), [
            'class' => 'form-control html_editor',
            'data-validation' => 'required',
            'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.course_faqs.label.answer'))])
        ]) !!}
    </div>
@else
    <div id="courseFaqs">
        <div class="card">
            <div class="card-body px-0">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="form-group">
                            <label for="">@lang('backend.course_faqs.label.question')</label>
                            <span class="text-danger">*</span>
                            {!! Form::text('question[]', null, [
                                'class' => 'form-control',
                                'data-validation' => 'required',
                                'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.course_faqs.label.question'))])
                                ]) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-9">
                        <div class="form-group">
                            <label for="question">@lang('backend.course_faqs.label.answer')</label>
                            <span class="text-danger">*</span>
                            {!! Form::textarea('answer[]', old('question'), [
                                'class' => 'form-control html_editor',
                                'data-validation' => 'required',
                                'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.course_faqs.label.answer'))])
                            ]) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

<div class="form-actions">
    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i>
        @lang('global.button.save') </button>
</div>
