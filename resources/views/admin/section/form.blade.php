@include('admin.layouts.partials.flash_messages')
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>@lang('backend.lessons.label.select_course')</label>
            <span class="text-danger">*</span>
            {!! Form::select('course_id', $courses, $section->course_id ?? old('course_id'), [
                'class' => 'form-control select2Search',
                'data-validation' => 'required',
                'data-validation-error-msg' => __('validation.required', [
                    'attribute' => strtolower(__('backend.lessons.label.select_course')),
                ]),
                'placeholder' => __('backend.lessons.label.select_course'),
                'id' => 'courseId',
            ]) !!}
        </div>
    </div>
    @if (!isset($section))
        <div class="col-sm-6">
            <div class="float-right pt-4">
                <button type="button" class="btn btn-sm btn-primary" id="addNewRow">@lang('backend.lessons.button.add_button')
                </button>
            </div>
        </div>
    @endif
</div>
<div id="FaqDetails"></div>
@if (isset($section))
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>@lang('backend.lessons.label.lesson_name')</label>
                <span class="text-danger">*</span>
                {!! Form::text('name', $section->name ?? old('name'), [
                    'class' => 'form-control',
                    'data-validation' => 'required',
                    'data-validation-error-msg' => __('validation.required', [
                        'attribute' => strtolower(__('backend.lessons.label.lesson_name')),
                    ]),
                ]) !!}
            </div>
        </div>
    </div>
@else
    <div id="courseFaqs">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>@lang('backend.lessons.label.lesson_name')</label>
                    <span class="text-danger">*</span>
                    {!! Form::text('name[]', $section->name ?? old('name'), [
                        'class' => 'form-control',
                        'data-validation' => 'required',
                        'data-validation-error-msg' => __('validation.required', [
                            'attribute' => strtolower(__('backend.lessons.label.lesson_name')),
                        ]),
                    ]) !!}
                </div>
            </div>
        </div>
    </div>
@endif
<div class="row">
    <div class="col">
        <div class="form-group m-b-0 text-left">
            <button type="submit" class="btn btn-success"><i class="fa fa-check"></i>
                @lang('global.button.save')
            </button>
        </div>
    </div>
</div>