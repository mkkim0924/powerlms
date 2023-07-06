@include('admin.layouts.partials.flash_messages')
<div class="form-group">
    <label>@lang('backend.banners.label.backend_title')</label>
    <span class="text-danger">*</span>
    {{ Form::text('name', isset($banner) ? $banner->name : old('name'), [
        'class' => 'form-control',
        'data-validation' => 'required',
        'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.banners.label.backend_title'))]),

        ]) }}
</div>
<div class="form-group">
    <label>@lang('backend.banners.label.hero_text')</label>
    <span class="text-danger">*</span>
    {{ Form::text('hero_text', isset($banner) ? $banner->hero_text : old('hero_text'), [
        'class' => 'form-control',
        'id' => 'hero_text',
        'data-validation' => 'required',
        'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.banners.label.hero_text'))]),
        'rows' => 3,
    ]) }}
</div>
<div class="form-group">
    <label>@lang('backend.banners.label.sub_text')</label>
    <span class="text-danger">*</span>
    {{ Form::textarea('sub_text', isset($banner) ? $banner->sub_text : old('sub_text'), [
        'class' => 'form-control',
        'id' => 'sub_text',
        'data-validation' => 'required',
        'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.banners.label.sub_text'))]),

        'rows' => 3,
    ]) }}
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>@lang('backend.banners.label.text_color')</label>
            <span class="text-danger">*</span>
            {{ Form::select('text_color', ['white' => 'White', 'black' => 'Black'], $banner->text_color ?? old('text_color'), [
            'class' => 'form-control selectSearch',
            'id' => 'text_color',
            'data-validation' => 'required',
            'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.banners.label.text_color'))]),
        ]) }}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>@lang('backend.banners.label.action_type')</label>
            {{ Form::select('action_type', ['button' => 'Button', 'search' => 'Search'], $banner->action_type ?? old('action_type'), [
            'class' => 'form-control select2Search action_type',
            'id' => 'action_type',
            'placeholder' => '',
        ]) }}
        </div>
    </div>
</div>
<div class="row" id="buttonDetails">
    <div class="col-sm-6">
        <div class="form-group">
            <label>@lang('backend.banners.label.button_text')</label>
            <span class="text-danger">*</span>
            {{ Form::text('button_text', isset($banner) ? $banner->button_text : old('button_text'), [
                'class' => 'form-control',
                'data-validation' => 'required',
                'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.banners.label.button_text'))]),

            ]) }}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>@lang('backend.banners.label.button_url')</label>
            <span class="text-danger">*</span>
            {{ Form::text('button_url', isset($banner) ? $banner->button_url : old('button_url'), [
                'class' => 'form-control',
                'data-validation' => 'required',
                'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.banners.label.button_url'))]),
            ]) }}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>@lang('backend.banners.label.image') ({{ \App\Models\Banner::IMAGE_DIMENSION['width'] }}x{{ \App\Models\Banner::IMAGE_DIMENSION['height'] }})</label>
            <span class="text-danger">*</span>
            <input type="file" accept="image/*" class="dropify" data-show-remove="false"
                   data-allowed-file-extensions="png jpg jpeg svg"
                   @if (isset($banner) && $banner->image != '') data-default-file="{{ getFileUrl($banner->image, 'banner') }}"
                   @else data-validation="required"
                   data-validation-error-msg="{{ __('validation.required', ['attribute' => strtolower(__('backend.banners.label.image'))]) }}"@endif
                   name="image" id="image">
        </div>
    </div>
</div>

<div class="form-actions">
    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i>
        @lang('global.button.save') </button>
</div>
@section('footer_scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            'use strict';

            $("#buttonDetails").toggle($(this).val() == "button")
            $(document).on('change', '.action_type', function () {
                $("#buttonDetails").toggle($(this).val() == "button")
            });
        });
    </script>
@endsection
