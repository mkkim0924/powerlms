<button type="button" class="btn btn-sm btn-primary" id="addNewAttachment">{{ __('backend.chapters.attachments_tab.button.add_new_attachment') }}</button>
<hr>
<div id="attachmentRows">
    @if(isset($unit))
        @foreach($unit->relatedAttachments as $existKey => $relatedAttachment)
            <div class="attachmentDiv p-2">
                <div class="row row-sm">
                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::text('exist_attachment_details['.$existKey.'][title]',$relatedAttachment->title, ['class'=>'form-control', 'id' => 'title_attachment', 'placeholder' => __('backend.chapters.attachments_tab.label.title'), 'data-validation' => 'required', 'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.chapters.attachments_tab.label.title'))])]) !!}
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <input type="hidden" name="exist_attachment_details[{{ $existKey }}][id]" value="{{ $relatedAttachment->id }}">
                            <input type="file" class="attachmentInput" name="exist_attachment_details[{{ $existKey }}][attachment]" data-show-remove="false" data-default-file="{{ getFileUrl($relatedAttachment->attachment, 'unit/attachments') }}">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <button type="button" class="btn btn-sm btn-danger deleteExistAttachment" data-id="{{ $relatedAttachment->id }}"><i
                                    class="fa fa-trash"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>

