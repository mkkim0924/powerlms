<div class="form-group">
    <label class="az-content-label tx-11 tx-medium tx-gray-600">@lang('backend.courses.label.meta_title'):</label>
    <small class="text-danger">@lang('backend.courses.note.meta_title')</small>
    {!! Form::text('meta_title', $course->meta_title ?? old('meta_title'), [
        'class' => 'form-control',
        'id' => 'meta_title',
    ]) !!}
</div>
<div class="form-group">
    <label class="az-content-label tx-11 tx-medium tx-gray-600">@lang('backend.courses.label.meta_description'):</label>
    <small class="text-danger">@lang('backend.courses.note.meta_description')</small>
    {!! Form::text('meta_description', $course->meta_description ?? old('meta_description'), [
        'class' => 'form-control',
        'id' => 'meta_description',
    ]) !!}
</div>
<div class="form-group">
    <label class="az-content-label tx-11 tx-medium tx-gray-600">@lang('backend.courses.label.meta_keywords'):</label>
    <small class="text-danger">@lang('backend.courses.note.meta_keywords')</small>
    {!! Form::text('meta_keywords', $course->meta_keywords ?? old('meta_keywords'), [
        'class' => 'form-control',
        'id' => 'meta_keywords',
    ]) !!}
</div>
<div class="form-group">
    <label class="az-content-label tx-11 tx-medium tx-gray-600">@lang('backend.courses.label.schema_script'):</label>
    <small class="text-danger">@lang('backend.courses.note.schema_script')</small>
    {!! Form::textarea('schema_script', $course->schema_script ?? old('schema_script'), [
        'class' => 'form-control',
        'id' => 'schema_script',
        'rows' => 4
    ]) !!}
</div>
