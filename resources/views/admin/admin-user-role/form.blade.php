@include('admin.layouts.partials.flash_messages')
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <label for="exampleInputEmail111">@lang('backend.admin.manage_roles.label.role_title')</label>
            <span class="text-danger">*</span>
            {!! Form::text('name', $adminRole->name ?? old('role_title'), [
                'class' => 'form-control',
                'id' => 'name',
                'data-validation' => 'required',
                'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.admin.manage_roles.label.role_title'))])
            ]) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <div class="custom-control custom-radio">
                <input type="radio" id="customRadio11" name="user_type" class="custom-control-input" value="super_admin"
                       @if (!isset($adminRole) || $adminRole->user_type == 'super_admin') checked="checked" @endif>
                <label class="custom-control-label"
                       for="customRadio11">@lang('backend.admin.manage_roles.label.super_admin')</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" id="customRadio22" name="user_type" class="custom-control-input" value="lms"
                       @if (isset($adminRole) && $adminRole->user_type == 'lms') checked="checked" @endif>
                <label class="custom-control-label"
                       for="customRadio22">@lang('backend.admin.manage_roles.label.lms_user')</label>
            </div>
        </div>
    </div>
    <div class="col-sm-6" id="lmsModulesSection"
         @if ((isset($adminRole) && $adminRole->user_type == 'super_admin') || !isset($adminRole)) style="display:  none;" @endif>
        <div class="card">
            <div class="card-body category-tree p-2">
                <ul class="tree_structure">
                    @foreach ($lms_modules as $module)
                        <li>
                            @if($module->module_key == 'dashboard_menu')
                                <input type="hidden" name="lms_modules[]" value="{{ $module->module_key }}">
                            @else
                                {!! Form::checkbox(
                                    'lms_modules[]',
                                    $module->module_key,
                                    isset($module->module_key) &&
                                        !empty($current_selected_modules) &&
                                        in_array($module->module_key, $current_selected_modules),
                                    ['class' => 'parent_module'],
                                ) !!}
                                @lang("backend.navbar.$module->module_key")
                            @endif
                            @if (count($module->child) > 0)
                                <ul>
                                    @foreach ($module->child as $child)
                                        <li>
                                            {!! Form::checkbox(
                                                'lms_modules[]',
                                                $child->module_key,
                                                isset($child->module_key) &&
                                                    !empty($current_selected_modules) &&
                                                    in_array($child->module_key, $current_selected_modules),
                                                ['class' => 'child_module'],
                                            ) !!}
                                            @lang("backend.navbar.$child->module_key")
                                            @if (count($child->child) > 0)
                                                <ul>
                                                    @foreach ($child->child as $subChild)
                                                        <li>
                                                            {!! Form::checkbox(
                                                                'lms_modules[]',
                                                                $subChild->module_key,
                                                                isset($subChild->module_key) &&
                                                                    !empty($current_selected_modules) &&
                                                                    in_array($subChild->module_key, $current_selected_modules),
                                                                ['class' => 'child_module'],
                                                            ) !!}
                                                            @lang("backend.navbar.$subChild->module_key")
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="form-actions">
    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i>
        @lang('global.button.save') </button>
</div>
@section('css')
    <link href="{{ asset('admin-assets/tree/tree.css') }}" rel="stylesheet">
@endsection
@section('footer_scripts')
    <script src="{{ asset('admin-assets/tree/tree.js') }}"></script>
    <script>
        $(document).ready(function () {
            'use strict';

            $('input[type=checkbox]').click(function () {
                var self = $(this);
                if (this.checked) {
                    self.parents('li').children('input[type=checkbox]').prop('checked', true);
                }
                self.parent().find('input[type=checkbox]').prop('checked', this.checked);
            });

            $(document).on("change", "input[name='user_type']", function () {
                if ($(this).val() == "lms") {
                    $("#lmsModulesSection").show();
                } else if ($(this).val() == "super_admin") {
                    $("#lmsModulesSection").hide();
                }
            });
        })
    </script>
@endsection
