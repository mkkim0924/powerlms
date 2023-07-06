@include('admin.layouts.partials.flash_messages')
<div class="form-body">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">@lang('backend.blogs.label.category')</label>
                    <span class="text-danger">*</span>
                    {!! Form::select('category_id', $categories, $blog->category_id ?? old('category_id'), [
                        'class' => 'form-control select2Search',
                        'id' => 'category_id',
                        'data-validation' => 'required',
                        'data-validation-error-msg' => __('validation.required', [
                            'attribute' => strtolower(__('backend.blogs.label.category')),
                        ]),
                        'placeholder' => '',
                    ]) !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">@lang('backend.blogs.label.blog_title')</label>
                    <span class="text-danger">*</span>
                    {!! Form::text('title', $blog->title ?? old('title'), [
                        'class' => 'form-control',
                        'data-validation' => 'required',
                        'data-validation-error-msg' => __('validation.required', [
                            'attribute' => strtolower(__('backend.blogs.label.blog_title')),
                        ]),
                        'id' => 'blog_name',
                    ]) !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>@lang('backend.blogs.label.slug')</label>
                    <span class="text-danger">*</span>
                    {!! Form::text('slug', $blog->slug ?? old('slug'), [
                        'class' => 'form-control slugInput',
                        'id' => 'slug',
                        'data-validation' => 'required',
                        'data-validation-error-msg' => __('validation.required', [
                            'attribute' => strtolower(__('backend.blogs.label.slug')),
                        ]),
                    ]) !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">@lang('backend.blogs.label.image')
                        ({{ \App\Models\Blog::IMAGE_DIMENSION['width'] }}x{{ \App\Models\Blog::IMAGE_DIMENSION['height'] }})</label>
                    <span class="text-danger">*</span>
                    <input type="file" accept="image/*" class="dropify" data-show-remove="false"
                        data-allowed-file-extensions="png jpg jpeg svg"
                        @if ($formMode == 'edit' && isset($blog) && $blog->image != '') data-default-file="{{ getFileUrl($blog->image, 'blog') }}" @else
                           data-validation="required"
                           data-validation-error-msg = "{{ __('validation.required', ['attribute' => strtolower(__('backend.blogs.label.image'))]) }}" @endif
                        name="image" id="image">
                </div>
            </div>
        </div>
        <div class="row pt-3">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label">@lang('backend.blogs.label.content')</label>
                    <span class="text-danger">*</span>
                    {!! Form::textarea('content', $blog->content ?? old('content'), [
                        'class' => 'form-control html_editor',
                        'data-validation' => 'required',
                        'data-validation-error-msg' => __('validation.required', [
                            'attribute' => strtolower(__('backend.blogs.label.content')),
                        ]),
                        'id' => 'content',
                    ]) !!}
                </div>
            </div>
        </div>

        <div class="row pt-3">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="az-content-label tx-11 tx-medium tx-gray-600">@lang('backend.blogs.label.meta_title')</label>
                    <small class="text-danger">@lang('backend.blogs.note.meta_title')</small>
                    {!! Form::text('meta_title', $blog->meta_title ?? old('meta_title'), [
                        'class' => 'form-control',
                        'id' => 'meta_title',
                    ]) !!}
                </div>
            </div>
        </div>
        <div class="row pt-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">@lang('backend.blogs.label.meta_description')</label>
                    <small class="text-danger">@lang('backend.blogs.note.meta_description')</small>
                    {!! Form::textarea('meta_description', $blog->meta_description ?? old('meta_description'), [
                        'class' => 'form-control',
                        'id' => 'meta_description',
                        'rows' => 4,
                    ]) !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="az-content-label tx-11 tx-medium tx-gray-600">@lang('backend.blogs.label.meta_keywords')</label>
                    <small class="text-danger">@lang('backend.blogs.note.meta_keywords')</small>
                    {!! Form::textarea('meta_keywords', $blog->meta_keywords ?? old('meta_keywords'), [
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
    </div>
</div>

@section('footer_scripts')
    <script>
        var is_edit = "{{ isset($blog) && $formMode == 'edit' ? true : false }}";
    </script>
    <script type="text/javascript" src="{{ asset('admin-assets/modules/blog_form.js') }}"></script>
@endsection
