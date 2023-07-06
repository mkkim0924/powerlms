@include('admin.layouts.partials.flash_messages')
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('backend.manage_instructors.label.image')
                ({{ \App\Models\User::IMAGE_DIMENSION['width'] }}x{{ \App\Models\User::IMAGE_DIMENSION['height'] }})</label>
            <span class="text-danger">*</span>
            <input type="file" accept="image/*" class="dropify" data-show-remove="false"
                data-allowed-file-extensions="png jpg jpeg svg"
                @if ($formMode == 'edit' && isset($instructor) && $instructor->image != '') data-default-file="{{ getFileUrl($instructor->image, 'users/') }}"
                   @else data-validation="required" data-validation-error-msg="{{ __('validation.required', ['attribute' => strtolower(__('backend.manage_instructors.label.image'))]) }}" @endif
                name="image" id="image">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputEmail111"> @lang('backend.manage_instructors.label.name')</label>
            <span class="text-danger">*</span>
            <input type="text" class="form-control" name="name" value="{{ $instructor->name ?? old('name') }}"
                data-validation="required"
                data-validation-error-msg="{{ __('validation.required', ['attribute' => strtolower(__('backend.manage_instructors.label.name'))]) }}"
                id="name" placeholder="@lang('backend.manage_instructors.label.enter_name')">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputEmail12">@lang('backend.manage_instructors.label.email')</label>
            <span class="text-danger">*</span>
            <input type="email" class="form-control" id="email" value="{{ $instructor->email ?? old('email') }}"
                data-validation="required"
                data-validation-error-msg="{{ __('validation.required', ['attribute' => strtolower(__('backend.manage_instructors.label.email'))]) }}"
                name="email" placeholder="@lang('backend.manage_instructors.label.enter_email')" @if (isset($instructor)) disabled @endif>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputEmail111"> @lang('backend.manage_instructors.label.mobile_number')</label>
            <span class="text-danger">*</span>
            <input type="text" class="form-control" name="mobile_number"
                value="{{ $instructor->mobile_number ?? old('mobile_number') }}" data-validation="required"
                data-validation-error-msg="{{ __('validation.required', ['attribute' => strtolower(__('backend.manage_instructors.label.mobile_number'))]) }}"
                id="mobile_number" placeholder="@lang('backend.manage_instructors.label.mobile_number')">
        </div>
    </div>
    @if ($formMode == 'create')
        <div class="col-md-6">
            <div class="form-group">
                <label>@lang('backend.manage_instructors.label.password')</label>
                <span class="text-danger">*</span>
                <input type="password" data-validation="required"
                    data-validation-error-msg="{{ __('validation.required', ['attribute' => strtolower(__('backend.manage_instructors.label.password'))]) }}"
                    class="form-control" name="password">
            </div>
        </div>
    @endif
    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputEmail111"> @lang('backend.manage_instructors.label.experience')</label>
            <span class="text-danger">*</span>
            {!! Form::textarea('experience', $instructor->experience ?? old('experience'), [
                'class' => 'form-control',
                'id' => 'experience',
                'data-validation' => 'required',
                'data-validation-error-msg' => __('validation.required', [
                    'attribute' => strtolower(__('backend.manage_instructors.label.experience')),
                ]),
                'rows' => 4,
            ]) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputEmail111"> @lang('backend.manage_instructors.label.address')</label>
            <span class="text-danger">*</span>
            {!! Form::textarea('address', $instructor->address ?? old('address'), [
                'class' => 'form-control',
                'id' => 'address',
                'data-validation' => 'required',
                'data-validation-error-msg' => __('validation.required', [
                    'attribute' => strtolower(__('backend.manage_instructors.label.address')),
                ]),
                'rows' => 4,
            ]) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <input type="checkbox" class="js-input-switch" name="enable_course_review" id="enable_course_review"
                @if (!isset($instructor) || $instructor->enable_course_review == 1) checked @endif>
            <label for="enable_course_review">@lang('backend.manage_instructors.label.enable_course_review')</label>
        </div>
        <div class="form-group">
            <input type="checkbox" class="js-input-switch" name="custom_payout_setting_enable"
                id="custom_payout_setting_enable" @if ($formMode == 'edit' && $instructor->custom_payout_setting_enable == 1) checked @endif>
            <label for="custom_payout_setting_enable">@lang('backend.manage_instructors.label.change_default_system_revenue')</label>
        </div>
    </div>
    <div class="col-md-6" id="customPayoutDiv" @if ($formMode == 'create' || ($formMode == 'edit' && $instructor->custom_payout_setting_enable == 0)) style="display: none;" @endif>
        <div class="form-group">
            <label>@lang('backend.manage_instructors.label.system_revenue')</label>
            <span class="text-danger">*</span>
            <input type="number" data-validation="required"
                data-validation-error-msg="{{ __('validation.required', ['attribute' => strtolower(__('backend.manage_instructors.label.system_revenue'))]) }}"
                class="form-control" name="system_revenue_percentage"
                value="{{ $instructor->system_revenue_percentage ?? (old('system_revenue_percentage') ?? config('system_revenue_percentage')) }}">
        </div>
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-success"><i class="fa fa-check"></i>
            @lang('global.button.save') </button>
    </div>
</div>
@section('footer_scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            'use strict';
            $('#custom_payout_setting_enable').change(function() {
                $("#customPayoutDiv").toggle($(this).prop('checked') === true);
            });
        });
    </script>
@endsection
