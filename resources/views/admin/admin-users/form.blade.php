@include('admin.layouts.partials.flash_messages')
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputEmail111"> @lang('backend.admin.manage_admins.label.name')</label>
            <span class="text-danger">*</span>
            <input type="text" class="form-control" name="name" value="{{ $admin->name ?? old('name') }}"
                data-validation="required" data-validation-error-msg="{{ __('validation.required', ['attribute' => strtolower(__('backend.admin.manage_admins.label.name'))]) }}"
                id="name" placeholder="@lang('backend.admin.manage_admins.label.enter_name')">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputEmail12">@lang('backend.admin.manage_admins.label.email')</label>
            <span class="text-danger">*</span>
            <input type="email" class="form-control" id="email" value="{{ $admin->email ?? old('email') }}"
                data-validation="required" name="email" placeholder="@lang('backend.admin.manage_admins.label.enter_email')"
                data-validation-error-msg="{{ __('validation.required', ['attribute' => strtolower(__('backend.admin.manage_admins.label.email'))]) }}"
                @if (isset($admin)) disabled @endif>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="role">@lang('backend.admin.manage_admins.label.role')</label>
            <span class="text-danger">*</span>
            {!! Form::select('role_id', $roles, $admin->role_id ?? old('role_id'), [
                'id' => 'role_id',
                'class' => 'form-control custom-select',
                'placeholder' => __('backend.admin.manage_admins.label.select_role'),
                'data-validation' => 'required',
                'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.admin.manage_admins.label.role'))])
            ]) !!}
        </div>
    </div>
</div>
<div class="form-actions">
    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i>
        @lang('global.button.save') </button>
</div>
