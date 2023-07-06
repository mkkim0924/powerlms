@csrf
@include('admin.layouts.partials.flash_messages')
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>@lang('backend.pages.label.name')</label>
            <span class="text-danger">*</span>
            {{ Form::text('name', isset($page) ? $page->name : old('name'), [
                'class' => 'form-control',
                'data-validation' => 'required',
                'data-validation-error-msg' => __('validation.required', [
                    'attribute' => strtolower(__('backend.pages.label.name')),
                ]),
                'id' => 'page_name',
            ]) }}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>@lang('backend.pages.label.slug')</label>
            <span class="text-danger">*</span>
            {!! Form::text('slug', $page->slug ?? old('slug'), [
                'class' => 'form-control slugInput',
                'id' => 'slug',
                'data-validation' => 'required',
                'data-validation-error-msg' => __('validation.required', [
                    'attribute' => strtolower(__('backend.pages.label.slug')),
                ]),
            ]) !!}
            @if ($errors->has('slug'))
                <span class="text-danger">{{ $errors->first('slug') }}</span>
            @endif
        </div>
    </div>
</div>

<div class="form-group">
    <label>@lang('backend.pages.label.content')</label>
    <span class="text-danger">*</span>
    {{ Form::textarea('content', isset($page) ? $page->content : old('content'), [
        'class' => 'form-control html_editor',
        'id' => 'content',
        'data-validation' => 'required',
        'data-validation-error-msg' => __('validation.required', [
            'attribute' => strtolower(__('backend.pages.label.content')),
        ]),
    ]) }}
</div>

<div class="form-group">
    <label>@lang('backend.pages.label.meta_title')</label>
    <small class="text-danger">@lang('backend.pages.note.meta_keywords')</small>
    {{ Form::text('meta_title', isset($page) ? $page->meta_title : old('meta_title'), ['class' => 'form-control', 'rows' => 3]) }}
</div>


<div class="form-group">
    <label>@lang('backend.pages.label.meta_description')</label>
    <small class="text-danger">@lang('backend.pages.note.meta_keywords')</small>
    {{ Form::textarea('meta_description', isset($page) ? $page->meta_description : old('meta_description'), ['class' => 'form-control', 'id' => 'meta_description', 'rows' => 3]) }}
</div>

<div class="form-group">
    <label>@lang('backend.pages.label.meta_keywords')</label>
    <small class="text-danger">@lang('backend.pages.note.meta_keywords')</small>
    {{ Form::textarea('meta_keywords', isset($page) ? $page->meta_keywords : old('meta_keywords'), ['class' => 'form-control', 'id' => 'meta_keywords', 'rows' => 3]) }}
</div>

<div class="card-body p-0">
    <div class="form-group m-b-0 text-left">
        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i>
            @lang('global.button.save') </button>
    </div>
</div>

@section('footer_scripts')
    <script type="text/javascript">
        var is_edit = "{{ isset($page) && $formMode == 'edit' ? true : false }}";
    </script>
    <script type="text/javascript" src="{{ asset('admin-assets/modules/pages_form.js') }}"></script>
@endsection
