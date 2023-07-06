@include('admin.layouts.partials.flash_messages')
<div class="form-group">
    <label>@lang('backend.blog_categories.label.title')</label>
    <span class="text-danger">*</span>
    {{ Form::text('name', $category->name ?? old('name'), ['class' => 'form-control', 'id' => 'name', 'data-validation' => 'required', 'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.blog_categories.label.title'))])]) }}
</div>
<div class="form-group">
    <label>@lang('backend.blog_categories.label.slug')</label>
    <span class="text-danger">*</span>
    {{ Form::text('slug', $category->slug ?? old('slug'), ['class' => 'form-control', 'id' => 'slug', 'data-validation' => 'required', 'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.blog_categories.label.slug'))])]) }}
</div>
<div class="form-actions">
    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i>
        @lang('global.button.save') </button>
</div>
@section('footer_scripts')
    <script type="text/javascript">
        $(function () {
            'use strict';
            var is_edit = "{{ isset($category) ? true : false }}";
            if (!is_edit) {
                $("#name").focusout(function (i, d) {
                    var title = $.trim($("#name").val());
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

            $("#slug").keypress(function (e) {
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
