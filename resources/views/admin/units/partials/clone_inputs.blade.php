<div id="videoUrlWithThumbnailImg" style="display:none;">
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>@lang('backend.chapters.media.label.video_url')</label>
                {!! Form::text('lesson_media_url', old('lesson_media_url'), [
                    'class' => 'form-control',
                    'id' => 'lesson_media_url',
                    'data-validation' => 'required',
                    'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.chapters.media.label.video_url'))]),
                ]) !!}
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>@lang('backend.chapters.media.label.video_thumbnail_image') ({{ \App\Models\Units::THUMBNAIL_IMAGE_DIMENSION['width'] }}x{{ \App\Models\Units::THUMBNAIL_IMAGE_DIMENSION['height'] }})</label>
                <input type="file" accept="image/*" class="dropifyInput" data-show-remove="false"
                       data-allowed-file-extensions="png jpg jpeg svg"
                       data-validation="required" name="lesson_thumbnail_image"
                       data-validation-error-msg="{{ __('validation.required', ['attribute' => strtolower(__('backend.chapters.media.label.video_thumbnail_image'))]) }}"
                       id="lesson_thumbnail_image">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>@lang('backend.chapters.media.label.time')</label>
                {!! Form::text('time', "00:00:00", ['class'=>'form-control form_time', 'id' => 'time', 'data-validation' => 'required', 'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.chapters.media.label.time'))])]) !!}
            </div>
        </div>
        {{--<div class="col-sm-6">
            <div class="form-group">
                <label>@lang('backend.chapters.media.label.free_lesson')</label>
                <br>
                <input type="checkbox" name="free_lesson" id="free_lesson" value="1">
                <label for="free_lesson">@lang('backend.chapters.media.label.mark_free_lesson')</label>
            </div>
        </div>--}}
    </div>
</div>
<div id="videoUploadWithThumbnailImg" style="display:none;">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>@lang('backend.chapters.media.label.video_file')</label>
                <input type="file" accept="video/*" class="dropifyInput" data-show-remove="false"
                       data-allowed-file-extensions="mp4"
                       data-validation="required" name="lesson_media_url"
                       data-validation-error-msg="{{ __('validation.required', ['attribute' => strtolower(__('backend.chapters.media.label.video_file'))]) }}"
                       id="lesson_media_url">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>@lang('backend.chapters.media.label.video_thumbnail_image') ({{ \App\Models\Units::THUMBNAIL_IMAGE_DIMENSION['width'] }}x{{ \App\Models\Units::THUMBNAIL_IMAGE_DIMENSION['height'] }})</label>
                <input type="file" accept="image/*" class="dropifyInput" data-show-remove="false"
                       data-allowed-file-extensions="png jpg jpeg svg"
                       data-validation="required" name="lesson_thumbnail_image"
                       data-validation-error-msg="{{ __('validation.required', ['attribute' => strtolower(__('backend.chapters.media.label.video_thumbnail_image'))]) }}"
                       id="lesson_thumbnail_image">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>@lang('backend.chapters.media.label.time')</label>
                {!! Form::text('time', "00:00:00", ['class'=>'form-control form_time', 'id' => 'time', 'data-validation' => 'required', 'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.chapters.media.label.time'))])]) !!}
            </div>
        </div>
        {{-- <div class="col-sm-6">
            <div class="form-group">
                <label>@lang('backend.chapters.media.label.free_lesson')</label>
                <br>
                <input type="checkbox" name="free_lesson" id="free_lesson" value="1">
                <label for="free_lesson">@lang('backend.chapters.media.label.mark_free_lesson')</label>
            </div>
        </div> --}}
    </div>
</div>
<div id="documentTypes" style="display:none;">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>@lang('backend.chapters.media.label.document_type')</label>
                {!! Form::select('lesson_document_type', \App\Models\Units::LESSON_DOCUMENT_TYPES, old('lesson_document_type'), [
                    'class' => 'form-control',
                    'id' => 'lesson_document_type',
                    'data-validation' => 'required',
                    'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.chapters.media.label.document_type'))]),
                ]) !!}
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>@lang('backend.chapters.media.label.attachments')</label>
                <input type="file" accept=".doc,.pdf,.txt" class="dropifyInput" data-show-remove="false"
                       data-allowed-file-extensions="pdf txt doc"
                       data-validation="required" name="lesson_media_url"
                       data-validation-error-msg="{{ __('validation.required', ['attribute' => strtolower(__('backend.chapters.media.label.attachments'))]) }}"
                       id="lesson_media_url">
            </div>
        </div>
    </div>
</div>
<div class="faqCloneTemplate" style="display: none;">
    <hr>
    <div class="pd-30 pd-sm-20 bg-light">
        <div class="form-group">
            <label class="az-content-label">@lang('backend.chapters.faqs.label.question')</label>
            {!! Form::text('question[]', NULL, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            <label class="az-content-label">@lang('backend.chapters.faqs.label.answer')</label>
            {!! Form::textarea('answer[]', NULL, ['class'=>'form-control editor']) !!}
        </div>
        <button type="submit" class="btn btn-danger mg-md-t-9 btn-sm removeFaqRow"><i class="fas fa-trash"></i>
        </button>
    </div>
</div>
<div class="attachmentDiv p-2" style="display: none;">
    <div class="row row-sm">
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::text('title_attachment[]',old('name'), ['class'=>'form-control', 'id' => 'title_attachment', 'placeholder' => __('backend.chapters.attachments_tab.label.title'), 'data-validation' => 'required', 'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.chapters.attachments_tab.label.title'))])]) !!}
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <input type="file" class="attachment-dropify" id="attachment" name="attachment[]" data-show-remove="false" data-validation="required" data-validation-error-msg="{{ __('validation.required', ['attribute' => strtolower(__('backend.chapters.attachments_tab.label.attachment'))]) }}">
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                <button type="button" class="btn btn-sm btn-danger removeAttachment"><i
                        class="fa fa-trash"></i></button>
            </div>
        </div>
    </div>
</div>
