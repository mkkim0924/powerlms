@include('admin.layouts.partials.flash_messages')
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>@lang('backend.sponsor.label.title')</label>
            <span class="text-danger">*</span>
            {{ Form::text('title', $sponsor->title ?? old('title'), [
                'class' => 'form-control',
                'data-validation' => 'required',
                'data-validation-error-msg' => __('validation.required', [
                    'attribute' => strtolower(__('backend.sponsor.label.title')),
                ]),
            ]) }}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>@lang('backend.sponsor.label.link')</label>
            {{ Form::text('link', $sponsor->link ?? old('link'), [
                'class' => 'form-control',
            ]) }}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>@lang('backend.sponsor.label.image')
                ({{ \App\Models\Sponsor::IMAGE_DIMENSION['width'] }}x{{ \App\Models\Sponsor::IMAGE_DIMENSION['height'] }})</label>
            <span class="text-danger">*</span>
            <input type="file" accept="image/*" class="dropify" data-show-remove="false"
                data-allowed-file-extensions="png jpg jpeg svg"
                @if (isset($sponsor) && $sponsor->image != '') data-default-file="{{ getFileUrl($sponsor->image, 'sponsor') }}"
                   @else data-validation="required"
                   data-validation-error-msg="{{ __('validation.required', ['attribute' => strtolower(__('backend.sponsor.label.image'))]) }}" @endif
                name="image" id="image">
        </div>
    </div>
</div>
<div class="form-actions">
    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i>
        @lang('global.button.save') </button>
</div>
