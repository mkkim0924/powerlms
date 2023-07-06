@include('admin.layouts.partials.flash_messages')
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('backend.categories.label.category_name')</label>
            <span class="text-danger">*</span>
            {{ Form::text('name', $category->name ?? old('name'), ['class' => 'form-control', 'id' => 'category_name', 'data-validation' => 'required', 'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.categories.label.category_name'))])]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('backend.categories.label.slug')</label>
            <span class="text-danger">*</span>
            {!! Form::text('slug', $category->slug ?? old('slug'), [
                'class' => 'form-control slugInput',
                'id' => 'slug',
                'data-validation' => 'required',
                'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.categories.label.slug'))]),
                'disabled' => isset($category),
            ]) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('backend.categories.label.icon') ({{ \App\Models\Categories::IMAGE_DIMENSION['width'] }}x{{ \App\Models\Categories::IMAGE_DIMENSION['height'] }})</label>
            <span class="text-danger">*</span>
            <input type="file" accept="image/*" class="dropify" data-show-remove="false"
                   data-allowed-file-extensions="png jpg jpeg svg"
                   @if ($formMode == 'edit' && isset($category) && $category->icon != '') data-default-file="{{ getFileUrl($category->icon, 'category') }}"
                   @else data-validation="required" data-validation-error-msg="{{ __('validation.required', ['attribute' => strtolower(__('backend.categories.label.icon'))]) }}" @endif
                   name="icon" id="icon">
        </div>
    </div>
</div>
<div class="form-group m-b-0 text-left">
    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i>
        @lang('global.button.save') </button>
</div>
@section('footer_scripts')
    <script
        src="{{ asset('admin-assets/assets/libs/bootstrap-datepicker/dist/js/bootstrap-timepicker.min.js') }}"></script>

    <script type="text/javascript">
        $(function () {
            'use strict';
            var is_edit = "{{ isset($category) ? true : false }}";

            if (!is_edit) {
                $("#category_name").focusout(function (i, d) {
                    var title = $.trim($("#category_name").val());
                    if (title.length > 0) {
                        title = title.toLowerCase();
                        title = title.replace(/[^a-z0-9\s]/gi, "").replace(/  +/g, " ").replace(/[_\s]/g, "-");
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
