@include('admin.layouts.partials.flash_messages')
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('backend.tests.label.select_course')</label>
            <span class="text-danger">*</span>
            {!! Form::select('course_id', $courses, $quiz->course_id ?? old('course_id'), [
                'id' => 'course_id',
                'class' => 'form-control select2Search',
                'data-validation' => 'required',
                'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.tests.label.select_course'))]),
                'placeholder' => __('backend.tests.label.select_course'),
            ]) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('backend.tests.label.select_lesson')</label>
            <span class="text-danger">*</span>
            {!! Form::select('section_id', $sections, $quiz->section_id ?? old('section_id'), [
                'id' => 'section_id',
                'class' => 'form-control sectionInput',
                'data-validation' => 'required',
                'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.tests.label.select_lesson'))]),
                'placeholder' => __('backend.tests.label.select_lesson'),
            ]) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('backend.tests.label.name')</label>
            <span class="text-danger">*</span>
            {!! Form::text('name',  $quiz->name ?? old('name'), [
                'class' => 'form-control',
                'id' => 'quiz_name',
                'data-validation' => 'required',
                'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.tests.label.name'))]),
            ]) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('backend.tests.label.slug')</label>
            <span class="text-danger">*</span>
            {!! Form::text('slug', $quiz->slug ?? old('slug'), [
                'class' => 'form-control slugInput',
                'id' => 'slug',
                'data-validation' => 'required',
                'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.tests.label.slug'))]),
                'disabled' => isset($quiz),
            ]) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('backend.tests.label.time')</label>
            <span class="text-danger">*</span>
            {!! Form::text('time', $quiz->time ?? "00:00:00", [
                'class' => 'form-control form_time',
                'id' => 'time',
                'data-validation' => 'required',
                'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.tests.label.time'))]),
            ]) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('backend.tests.label.retake')</label>
            <span class="text-danger">*</span>
            {!! Form::number('retake', $quiz->retake ?? old('retake'), [
                'class' => 'form-control',
                'id' => 'retake',
                'min' => '0',
                'data-validation' => 'required',
                'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.tests.label.retake'))]),
            ]) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="control-label">@lang('backend.tests.label.content')</label>
            {!! Form::textarea('content', $quiz->content ?? old('content'), [
                'class' => 'form-control html_editor',
                'id' => 'content',
            ]) !!}
        </div>
    </div>
</div>
<div class="form-actions">
    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i>
        @lang('global.button.save') </button>
</div>

@section('css')
    <link href="{{ asset('admin-assets/assets/libs/bootstrap-datepicker/dist/bootstrap-timepicker.min.css') }}"
          rel="stylesheet">
@endsection
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('admin-assets/modules/quiz_form.js') }}"></script>
    <script
        src="{{ asset('admin-assets/assets/libs/bootstrap-datepicker/dist/js/bootstrap-timepicker.min.js') }}"></script>

    <script type="text/javascript">
        var is_edit = "{{ isset($quiz) ? true : false }}";
        var getSectionByCourseURL = "{{ route(request()->user_type.'.getSectionByCourse') }}";
    </script>
@endsection
