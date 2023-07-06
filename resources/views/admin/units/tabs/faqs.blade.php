<button type="button" class="btn btn-sm btn-primary" id="addNewFaqRow">@lang('backend.chapters.faqs.button.add_new_faq')</button>
@if(isset($unit) && (count($unit->relatedFaqs) > 0))
    <div id="unitFaqs">
        @foreach($unit->relatedFaqs as $relatedFaqs)
            <div class="faqCloneTemplate">
                <hr>
                <div class="pd-30 pd-sm-20 bg-light p-2 ">
                    <div class="form-group">
                        <label>@lang('backend.chapters.faqs.label.question')</label>
                        {!! Form::text('question[]', $relatedFaqs->question, ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <label>@lang('backend.chapters.faqs.label.answer')</label>
                        {!! Form::textarea('answer[]',$relatedFaqs->answer, ['class'=>'form-control html_editor']) !!}
                    </div>
                    <a href="javascript:;"
                       class="btn btn-danger btn-sm removeFaqRow" data-id="{{ $relatedFaqs->id }}">
                        <i class="fas fa-trash"></i>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div id="unitFaqs">
        <div class="unitFaqs">
            <hr>
            <div class="pd-30 pd-sm-20 bg-light">
                <div class="form-group">
                    <label class="az-content-label">@lang('backend.chapters.faqs.label.question')</label>
                    {!! Form::text('question[]', NULL, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    <label class="az-content-label">@lang('backend.chapters.faqs.label.answer')</label>
                    {!! Form::textarea('answer[]',NULL, ['class'=>'form-control html_editor']) !!}
                </div>
            </div>
        </div>
    </div>
@endif
