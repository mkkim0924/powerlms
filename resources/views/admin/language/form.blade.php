@csrf
@include('admin.layouts.partials.flash_messages')
<div class="form-group">
    <div class="row">
        <div class="col-md-6 form-group">
            <label>@lang('backend.languages.label.language_name')</label>
            <span class="text-danger">*</span>
            {{ Form::select('short_name', config('languages'), $locale->short_name ?? old('short_name'), [
                'class' => 'form-control select2Search',
                'placeholder' => '',
                'data-validation' => 'required',
                'data-validation-error-msg' => __('validation.required', [
                    'attribute' => strtolower(__('backend.languages.label.language_name')),
                ]),
            ]) }}
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-6">
            <label for="">@lang('backend.languages.label.text_direction')</label><br>
            <div class="row">
                <div class="col-md-6 d-inline-block">
                    <label>
                        {!! Form::radio('display_type', 'ltr', (isset($locale) && $locale->display_type == 'ltr') || !isset($locale)) !!}
                        @lang('backend.languages.label.left_to_right')</label>
                </div>
                <div class="col-md-6 d-inline-block">
                    <label>
                        {!! Form::radio('display_type', 'rtl', isset($locale) && $locale->display_type == 'rtl') !!}
                        @lang('backend.languages.label.right_to_left') </label>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group m-b-0 text-left">
    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i>
        @lang('global.button.save') </button>
</div>
