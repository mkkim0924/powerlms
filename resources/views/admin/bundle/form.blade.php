@include('admin.layouts.partials.flash_messages')
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('backend.bundles.label.select_category')</label>
            <span class="text-danger">*</span>
            {!! Form::select('category_id', $categories, $bundle->category_id ?? old('category_id'), [
                'class' => 'form-control select2Search',
                'id' => 'category_id',
                'data-validation' => 'required',
                'data-validation-error-msg' => __('validation.required', [
                    'attribute' => strtolower(__('backend.bundles.label.select_category')),
                ]),
                'placeholder' => '',
            ]) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('backend.bundles.label.name')</label>
            <span class="text-danger">*</span>
            {{ Form::text('name', $bundle->name ?? old('name'), [
                'class' => 'form-control',
                'id' => 'bundle_name',
                'data-validation' => 'required',
                'data-validation-error-msg' => __('validation.required', [
                    'attribute' => strtolower(__('backend.bundles.label.name')),
                ]),
            ]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('backend.bundles.label.slug')</label>
            <span class="text-danger">*</span>
            {!! Form::text('slug', $bundle->slug ?? old('slug'), [
                'class' => 'form-control slugInput',
                'id' => 'slug',
                'data-validation' => 'required',
                'data-validation-error-msg' => __('validation.required', [
                    'attribute' => strtolower(__('backend.bundles.label.slug')),
                ]),
                'disabled' => isset($bundle),
            ]) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('backend.bundles.label.price')</label>
            <span class="text-danger">*</span>
            {!! Form::number('price', $formMode == 'edit' ? $bundle->price : old('price'), [
                'id' => 'price',
                'class' => 'form-control',
                'min' => '0',
                'data-validation' => 'required',
                'data-validation-error-msg' => __('validation.required', [
                    'attribute' => strtolower(__('backend.bundles.label.price')),
                ]),
            ]) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('backend.bundles.label.start_date')</label>
            {!! Form::date('start_date', $bundle->start_date ?? old('start_date'), [
                'class' => 'form-control',
            ]) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('backend.bundles.label.end_date')</label>
            {!! Form::date('end_date', $bundle->end_date ?? old('end_date'), [
                'class' => 'form-control',
            ]) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('backend.bundles.label.image')
                ({{ \App\Models\Bundle::IMAGE_DIMENSION['width'] }}x{{ \App\Models\Bundle::IMAGE_DIMENSION['height'] }})</label>
            <span class="text-danger">*</span>
            <input type="file" accept="image/*" class="dropify" data-show-remove="false"
                   data-allowed-file-extensions="png jpg jpeg svg"
                   @if ($formMode == 'edit' && isset($bundle) && $bundle->image != '') data-default-file="{{ getFileUrl($bundle->image, 'bundle') }}"
                   @else data-validation="required" data-validation-error-msg="{{ __('validation.required', ['attribute' => strtolower(__('backend.bundles.label.image'))]) }}" @endif
                   name="image" id="image">
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>@lang('backend.bundles.label.related_course')</label>
            <span class="text-danger">*</span>
            @if ($formMode == 'edit')
                {!! Form::select('related_courses[]', $courses, $bundleCourse, [
                    'class' => 'form-control select2Search',
                    'id' => 'related_courses',
                    'multiple',
                    'data-validation' => 'required',
                    'data-validation-error-msg' => __('validation.required', [
                        'attribute' => __('backend.bundles.label.related_course'),
                    ]),
                ]) !!}
            @else
                {!! Form::select('related_courses[]', $courses, $bundle->related_courses ?? old('related_courses'), [
                    'class' => 'form-control select2Search',
                    'id' => 'related_courses',
                    'multiple',
                    'data-validation' => 'required',
                    'data-validation-error-msg' => __('validation.required', [
                        'attribute' => __('backend.bundles.label.related_course'),
                    ]),
                ]) !!}
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>@lang('backend.bundles.label.description')</label>
            <span class="text-danger">*</span>
            {!! Form::textarea('description', $bundle->description ?? old('description'), [
                'class' => 'form-control html_editor',
                'id' => 'description',
                'data-validation' => 'required',
                'data-validation-error-msg' => __('validation.required', ['attribute' => __('backend.bundles.label.description')]),
                'rows' => 4,
            ]) !!}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>@lang('backend.bundles.label.meta_title')</label>
            <small class="text-danger">@lang('backend.bundles.note.meta_title')</small>
            {!! Form::text('meta_title', $bundle->meta_title ?? old('meta_title'), [
                'class' => 'form-control',
                'id' => 'meta_title',
            ]) !!}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>@lang('backend.bundles.label.meta_description')</label>
            <small class="text-danger">@lang('backend.bundles.note.meta_description')</small>
            {!! Form::text('meta_description', $bundle->meta_description ?? old('meta_description'), [
                'class' => 'form-control',
                'id' => 'meta_description',
            ]) !!}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>@lang('backend.bundles.label.meta_keywords')</label>
            <small class="text-danger">@lang('backend.bundles.note.meta_keywords')</small>
            {!! Form::text('meta_keywords', $bundle->meta_keywords ?? old('meta_keywords'), [
                'class' => 'form-control',
                'id' => 'meta_keywords',
            ]) !!}
        </div>
    </div>
</div>
<div class="form-group m-b-0 text-left">
    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i>
        @lang('global.button.save') </button>
</div>

@section('footer_scripts')
    <script>
        $(function () {
            'use strict';

            var is_edit = "{{ isset($bundle) ? true : false }}";

            if (!is_edit) {
                $("#bundle_name").focusout(function (i, d) {
                    var title = $.trim($("#bundle_name").val());
                    if (title.length > 0) {
                        title = title.toLowerCase();
                        title = title.replace(/[^a-z0-9\s]/gi, "").replace(/ +/g, " ").replace(/[_\s]/g, "-");
                    }
                    $("#slug").val(title);
                });
            }
            $("#slug").focusout(function (e) {
                var slug = $.trim($(this).val().toLowerCase());
                $(this).val(slug);
            });

            $(".slugInput").keypress(function (e) {
                var regex = new RegExp("^[A-Za-z0-9-]+$");
                var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
                if (regex.test(str)) {
                    return true;
                }
                e.preventDefault();
                return false;
            });
        });
    </script>
@endsection
