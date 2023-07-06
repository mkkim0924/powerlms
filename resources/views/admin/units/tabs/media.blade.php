<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('backend.chapters.media.label.lesson_type')</label>
            <span class="text-danger">*</span>
            {!! Form::select('lesson_type', \App\Models\Units::LESSON_TYPES, $unit->lesson_type ?? old('lesson_type'), [
                'class' => 'form-control select2_no_search',
                'id' => 'lesson_type',
                'placeholder' => '',
                'data-validation' => 'required',
                'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.chapters.media.label.lesson_type'))])
            ]) !!}
        </div>
    </div>
    <div class="col-md-12">
        @lang('backend.chapters.lesson_type_help_text')
    </div>
</div>

<div id="lessonTypeContentDiv">
    @if(isset($unit) && in_array($unit->lesson_type, ['youtube', 'vimeo', 'video_url', 'video_file']))
        <div class="row">
            @if($unit->lesson_type != 'video_file')
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>@lang('backend.chapters.media.label.video_url')</label>
                        <span class="text-danger">*</span>
                        {!! Form::text('lesson_media_url', $unit->lesson_media_url ?? old('lesson_media_url'), [
                            'class' => 'form-control',
                            'id' => 'lesson_media_url',
                            'data-validation' => 'required',
                            'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.chapters.media.label.video_url'))]),
                        ]) !!}
                    </div>
                </div>
            @else
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>@lang('backend.chapters.media.label.video_file')</label>
                        <span class="text-danger">*</span>
                        <input type="file" accept="video/*" class="dropify" data-show-remove="false"
                               data-allowed-file-extensions="mp4"
                               @if(isset($unit->lesson_media_url)) data-default-file="{{ getFileUrl($unit->lesson_media_url, 'unit/media') }}"
                               @else data-validation="required" data-validation-error-msg="{{ __('validation.required', ['attribute' => strtolower(__('backend.chapters.media.label.video_file'))]) }}"@endif name="lesson_media_url"
                               id="lesson_media_url">
                    </div>
                </div>
            @endif
            <div class="col-sm-6">
                <div class="form-group">
                    <label>@lang('backend.chapters.media.label.video_thumbnail_image') ({{ \App\Models\Units::THUMBNAIL_IMAGE_DIMENSION['width'] }}x{{ \App\Models\Units::THUMBNAIL_IMAGE_DIMENSION['height'] }})</label>
                    <span class="text-danger">*</span>
                    <input type="file" accept="image/*" class="dropify" data-show-remove="false"
                           data-allowed-file-extensions="png jpg jpeg svg"
                           @if(isset($unit->lesson_thumbnail_image)) data-default-file="{{ getFileUrl($unit->lesson_thumbnail_image, 'unit/thumbnail_images') }}"
                           @else data-validation="required" data-validation-error-msg="{{ __('validation.required', ['attribute' => strtolower(__('backend.chapters.media.label.video_thumbnail_image'))]) }}"@endif name="lesson_thumbnail_image"
                           id="lesson_thumbnail_image">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>@lang('backend.chapters.media.label.time')</label>
                    <span class="text-danger">*</span>
                    {!! Form::text('time', $unit->time ?? "00:00:00", [
                        'class'=>'form-control edit_form_time',
                         'id' => 'time',
                         'data-validation' => 'required',
                         'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.chapters.media.label.time'))])
                         ]) !!}
                </div>
            </div>
            {{-- <div class="col-sm-6">
                <div class="form-group">
                    <label>@lang('backend.chapters.media.label.free_lesson')</label>
                    <br>
                    <input type="checkbox" name="free_lesson" id="free_lesson" value="1"
                           @if($unit->free_lesson == 1) checked @endif>
                    <label for="free_lesson">@lang('backend.chapters.media.label.mark_free_lesson')</label>
                </div>
            </div> --}}
        </div>
    @elseif(isset($unit) && $unit->lesson_type == 'document')
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>@lang('backend.chapters.media.label.document_type')</label>
                    <span class="text-danger">*</span>
                    {!! Form::select('lesson_document_type', \App\Models\Units::LESSON_DOCUMENT_TYPES, $unit->lesson_document_type ?? old('lesson_document_type'), [
                        'class' => 'form-control select2-no-search',
                        'id' => 'lesson_document_type',
                        'data-validation' => 'required',
                        'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.chapters.media.label.document_type'))])
                    ]) !!}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>@lang('backend.chapters.media.label.attachments')</label>
                    <span class="text-danger">*</span>
                    <input type="file" accept=".doc,.pdf,.txt" class="dropify" data-show-remove="false"
                           data-allowed-file-extensions="pdf txt doc"
                           @if(isset($unit->lesson_media_url)) data-default-file="{{ getFileUrl($unit->lesson_media_url, 'unit/media') }}"
                           @else data-validation="required" data-validation-error-msg="{{ __('validation.required', ['attribute' => strtolower(__('backend.chapters.media.label.attachments'))]) }}" @endif name="lesson_media_url"
                           id="lesson_media_url">
                </div>
            </div>
        </div>
    @endif
</div>
