<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('backend.courses.label.course_name')</label>
            <span class="text-danger">*</span>
            {!! Form::text('name', $formMode == 'edit' ? $course->name : old('name'), [
                'class' => 'form-control',
                'id' => 'course_name',
                'data-validation' => 'required',
                'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.courses.label.course_name'))]),
            ]) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('backend.courses.label.slug')</label>
            <span class="text-danger">*</span>
            {!! Form::text('slug', $formMode == 'edit' ? $course->slug : old('slug'), [
                'class' => 'form-control slugInput',
                'id' => 'slug',
                'data-validation' => 'required',
                'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.courses.label.slug'))]),
                'disabled' => ($formMode == 'edit'),
            ]) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('backend.courses.label.category')</label>
            <span class="text-danger">*</span>
            {!! Form::select('category_id', $categories, $course->category_id ?? old('category_id'), [
                'class' => 'form-control select2Search',
                'id' => 'category_id',
                'data-validation' => 'required',
                'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.courses.label.category'))]),
                'placeholder' => '',
            ]) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('backend.courses.label.level')</label>
            {!! Form::select('course_level', \App\Models\Course::LEVELS, $course->course_level ?? old('course_level'), [
                'class' => 'form-control select2Search',
                'id' => 'course_level',
            ]) !!}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>@lang('backend.courses.label.related_courses')</label>
            {!! Form::select('related_courses[]', $courses, $course->related_courses ?? old('related_courses'), [
               'class' => 'form-control select2Search',
               'id' => 'related_courses',
               'multiple',
           ]) !!}
        </div>
    </div>
</div>
<div class="form-group">
    <label>@lang('backend.courses.label.tiny_description')</label>
    <small class="text-danger">@lang('backend.courses.note.tiny_description')</small>
    {!! Form::textarea(
        'tiny_description',
        $formMode == 'edit' ? $course->tiny_description : old('tiny_description'),
        ['class' => 'form-control', 'id' => 'tiny_description', 'rows' => 2, 'data-maxallowed' => 75],
    ) !!}
</div>
<div class="row row-sm">
    <div class="col-sm-6">
        <div class="form-group">
            <label>@lang('backend.courses.label.image') ({{ \App\Models\Course::IMAGE_DIMENSION['width'] }}x{{ \App\Models\Course::IMAGE_DIMENSION['height'] }})</label>
            <input type="file" accept="image/*" class="dropify" data-show-remove="false"
                data-allowed-file-extensions="png jpg jpeg svg"
                @if ($formMode == 'edit' && isset($course) && $course->image != '') data-default-file="{{ getFileUrl($course->image, 'course/images') }}" @endif name="image"
                id="image">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('backend.courses.label.expiration_days')</label>
            {!! Form::number('expiration_days', $formMode == 'edit' ? $course->expiration_days : old('expiration_days'), [
                'class' => 'form-control',
                'id' => 'course_name',
                'min' => '1',
                'placeholder' => '',
            ]) !!}
        </div>
    </div>
</div>
