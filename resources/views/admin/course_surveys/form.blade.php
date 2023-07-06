<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <input type="text" name="id" value="{{ $data->id ?? '' }}" style="display:none" >
            <label>@lang('backend.course_survey.label.select_course')</label>
            <span class="text-danger">*</span>
            @if ($formMode == 'edit')<input type="hidden" name="course_id" value="{{ $data->course_id ?? '' }}">@endif
            {!! Form::select('course_id', $courses, $data->course_id ?? old('course_id'), [
                'id' => 'course_id',
                'class' => 'form-control select2Search',
                'data-validation' => 'required',
                'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.course_survey.label.select_course'))]),
                'placeholder' => '',
            ]) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('backend.course_survey.label.select_survey_type')</label>
            <span class="text-danger">*</span>
            {!! Form::select('survey_type',['pre' => 'Pre Survey', 'post' => 'Post Survey'], $data->survey_type ?? old('section_id'), [
                'id' => 'survey_type',
                'class' => 'form-control select2Search',
                'data-validation' => 'required',
                'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.course_survey.label.select_survey_type'))]),
                'placeholder' => '',
            ]) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('backend.course_survey.label.name')</label>
            <span class="text-danger">*</span>
            {!! Form::text('name',  $data->name ?? old('name'), [
                'class' => 'form-control',
                'id' => 'survey_name',
                'data-validation' => 'required',
                'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.course_survey.label.name'))]),
            ]) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('backend.course_survey.label.frontend_view')</label>
            <span class="text-danger">*</span>
            {!! Form::select('view_type',['list' => 'List View', 'tab' => 'Tab View'], $data->view_type ?? old('view_type'), [
                'id' => 'view_type',
                'class' => 'form-control select2Search',
                'data-validation' => 'required',
                'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.course_survey.label.frontend_view'))]),
                'placeholder' => '',
            ]) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('backend.course_survey.label.description')</label>
            {!! Form::textarea('description',  $data->description ?? old('description'), [
                'class' => 'form-control',
                'id' => 'description',
            ]) !!}
        </div>
    </div>
    <div class="col-md-6 mt-4">
        <div class="form-group">
            <input type="checkbox" id="skippable" name="is_skippable" class="js-switch" {{ isset($data->is_skippable) && $data->is_skippable == 0 ? '' : 'checked' }}>
            <label for="skippable" >@lang('backend.course_survey.label.survey_is_skippable')</label>
        </div>
    </div>
</div>
<hr>
<div class="form-actions">
    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i>
        @lang('global.button.save') </button>
</div>
@section('footer_scripts')
@if ($formMode == 'edit')
    <script>
        $('#course_id').attr('disabled', true);
    </script>
@endif
@endsection
