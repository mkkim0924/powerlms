<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('backend.chapters.general.label.course')</label>
            <span class="text-danger">*</span>
            {!! Form::select('course_id', $courses, $unit->course_id ?? old('course_id'), [
                'class' => 'form-control select2Search',
                'id' => 'course_id',
                'data-validation' => 'required',
                'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.chapters.general.label.course'))]),
                'placeholder' => '',
            ]) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('backend.chapters.general.label.lesson')</label>
            <span class="text-danger">*</span>
            {!! Form::select('section_id', $sections, $unit->section_id ?? old('section_id'), [
                'class' => 'form-control sectionInput',
                'id' => 'section_id',
                'data-validation' => 'required',
                'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.chapters.general.label.lesson'))]),
                'placeholder' => '',
            ]) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('backend.chapters.general.label.chapter_name')</label>
            <span class="text-danger">*</span>
            {!! Form::text('name', $unit->name ?? old('name'), [
                'class' => 'form-control',
                'id' => 'unit_name',
                'data-validation' => 'required',
                'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.chapters.general.label.chapter_name'))]),
            ]) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('backend.chapters.general.label.slug')</label>
            <span class="text-danger">*</span>
            {!! Form::text('slug', $unit->slug ?? old('slug'), [
                'class' => 'form-control slugInput',
                'id' => 'slug',
                'data-validation' => 'required',
                'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.chapters.general.label.slug'))]),
                'disabled' => ($formMode == 'edit'),
            ]) !!}
        </div>
    </div>
</div>
<div class="form-group">
    <label>@lang('backend.chapters.general.label.short_content')</label>
    {!! Form::textarea(
        'short_content',
        $unit->short_content ?? old('short_content'),
        ['class' => 'form-control', 'id' => 'short_content', 'rows' => 2],
    ) !!}
</div>
<div class="form-group">
    <label>@lang('backend.chapters.general.label.content')</label>
    {!! Form::textarea(
        'content',
        $unit->content ?? old('content'),
        ['class' => 'form-control html_editor', 'id' => 'short_content', 'rows' => 2],
    ) !!}
</div>
