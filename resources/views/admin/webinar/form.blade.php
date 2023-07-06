@include('admin.layouts.partials.flash_messages')
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label>@lang('backend.webinars.label.select_category')</label>
            <span class="text-danger">*</span>
            {!! Form::select('category_id', $categories, $webinar->category_id ?? old('category_id'), [
            'class' => 'form-control select2Search',
            'id' => 'category_id',
            'data-validation' => 'required',
            'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.webinars.label.select_category'))]),
            'placeholder' => '',
            ]) !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('backend.webinars.label.name')</label>
            <span class="text-danger">*</span>
            {{ Form::text('name', $webinar->name ?? old('name'), ['class' => 'form-control', 'id' => 'webinar_name',
            'data-validation' => 'required',
            'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.webinars.label.name'))]),
            ]) }}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('backend.webinars.label.slug')</label>
            <span class="text-danger">*</span>
            {!! Form::text('slug', $webinar->slug ?? old('slug'), [
            'class' => 'form-control slugInput',
            'id' => 'slug',
            'data-validation' => 'required',
            'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.webinars.label.slug'))]),
            'disabled' => isset($webinar),
            ]) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>@lang('backend.webinars.label.start_at')</label>
            <span class="text-danger">*</span>
            <input type="datetime-local" name="start_at" value="{{ isset($webinar) ? $webinar->start_at: "" }}" class="form-control" min="{{ \Carbon\Carbon::now()->format('Y-m-d\TH:i') }}"
            data-validation = 'required' data-validation-error-msg="{{ __('validation.required', ['attribute' => strtolower(__('backend.webinars.label.start_at'))]) }}">
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>@lang('backend.webinars.label.duration_in_minutes')</label>
            <span class="text-danger">*</span>
            {!! Form::number('duration', $webinar->duration ?? old('duration'), [
            'class' => 'form-control ',
            'id' => 'time',
            'data-validation' => 'required',
            'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.webinars.label.duration_in_minutes'))]),
            ]) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="form-group">
                <label>@lang('backend.webinars.label.live_srteaming_url')</label>
                {!! Form::text("live_streaming_url", $webinar->live_streaming_url ?? old("live_streaming_url"), ['class' => 'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="form-group">
                <label>@lang('backend.webinars.label.intro_video_url')</label>
                <span class="text-danger">*</span>
                {!! Form::text("intro_video_url", $webinar->intro_video_url ?? old("intro_video_url"), [
                    'class' => 'form-control',
                    'data-validation' => 'required',
                    'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.webinars.label.intro_video_url'))]),
                    ]) !!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('backend.webinars.label.image') ({{ \App\Models\Webinar::IMAGE_DIMENSION['width'] }}x{{ \App\Models\Webinar::IMAGE_DIMENSION['height'] }})</label>
            <span class="text-danger">*</span>
            <input type="file" accept="image/*" class="dropify" data-show-remove="false"
                   data-allowed-file-extensions="png jpg jpeg svg" @if ($formMode=='edit' && isset($webinar) &&
                $webinar->image != '') data-default-file="{{ getFileUrl($webinar->image, 'webinar') }}"
                   @else data-validation="required" data-validation-error-msg="{{ __('validation.required', ['attribute' => strtolower(__('backend.webinars.label.image'))]) }}"@endif
                   name="image" id="image">
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>@lang('backend.webinars.label.related_courses')</label>
            {!! Form::select('related_courses[]', $courses, $webinar->related_courses ?? old('related_courses'), [
               'class' => 'form-control select2Search',
               'id' => 'related_courses',
               'multiple',
           ]) !!}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>@lang('backend.webinars.label.short_description')</label>
            <span class="text-danger">*</span>
            {!! Form::textarea('short_description', $webinar->short_description ?? old('short_description'), [
            'class' => 'form-control',
            'id' => 'short_description',
            'data-validation' => 'required',
            'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.webinars.label.short_description'))]),
            'rows' => 4,
            ]) !!}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>@lang('backend.webinars.label.description')</label>
            <span class="text-danger">*</span>
            {!! Form::textarea('description', $webinar->description ?? old('description'), [
            'class' => 'form-control html_editor',
            'id' => 'description',
            'data-validation' => 'required',
            'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.webinars.label.description'))]),
            'rows' => 4,
            ]) !!}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>@lang('backend.webinars.label.meta_title')</label>
            <small class="text-danger">@lang('backend.webinars.note.meta_title')</small>
            {!! Form::text('meta_title', $webinar->meta_title ?? old('meta_title'), [
            'class' => 'form-control',
            'id' => 'meta_title',
            ]) !!}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>@lang('backend.webinars.label.meta_description')</label>
            <small class="text-danger">@lang('backend.webinars.note.meta_description')</small>
            {!! Form::textarea('meta_description', $webinar->meta_description ?? old('meta_description'), [
            'class' => 'form-control',
            'id' => 'meta_description',
            'rows' => 4,
            ]) !!}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>@lang('backend.webinars.label.meta_keyword')</label>
            <small class="text-danger">@lang('backend.webinars.note.meta_keyword')</small>
            {!! Form::textarea('meta_keywords', $webinar->meta_keywords ?? old('meta_keywords'), [
            'class' => 'form-control',
            'id' => 'meta_keywords',
            'rows' => 4,
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
        var is_edit = "{{ isset($webinar) ? true : false }}";

        if (!is_edit) {
            $("#webinar_name").focusout(function (i, d) {
                var title = $.trim($("#webinar_name").val());
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
    </script>
@endsection
