@include('admin.layouts.partials.flash_messages')
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>@lang('backend.emails.label.email_action')</label>
            <span class="text-danger">*</span>
            {{ Form::select('identifier', $identifiers , isset($email_template) ? $email_template->identifier : old('identifier') ,['class' => 'form-control select2Search','id'=>'identifier', 'placeholder' => '',
                    'data-validation' => 'required', 'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.emails.label.email_action'))])] ) }}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group" id="emailVariables">
            <table class="table table-responsive d">
                <thead>
                <tr>
                    <th>@lang('backend.emails.label.variables')</th>
                    <th>@lang('backend.emails.label.details')</th>
                </tr>
                </thead>
                @if(!empty(config('emailvariables')))
                    @foreach(config('emailvariables') as $action => $details)
                        <tbody id="{{ $action }}" class="actionDiv">
                        @foreach($details as $key => $translation_key)
                            <tr>
                                <td>{{ $key }}</td>
                                <td>{{ __('backend.email_variables.'.$translation_key) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    @endforeach
                @endif
            </table>
        </div>
    </div>
</div>
<div class="form-group">
    <label>@lang('backend.emails.label.title')</label>
    <span class="text-danger">*</span>
    {{ Form::text('title', isset($email_template) ? $email_template->title : old('title') ,['class' => 'form-control','id'=>'title',
            'data-validation' => 'required', 'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.emails.label.title'))])] ) }}
</div>
<div class="form-group">
    <label>@lang('backend.emails.label.subject')</label>
    <span class="text-danger">*</span>
    {{ Form::text('subject', isset($email_template) ? $email_template->subject : old('subject') ,['class' => 'form-control','id'=>'subject',
            'data-validation' => 'required', 'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.emails.label.subject'))])] ) }}
</div>
<div class="form-group">
    <label>@lang('backend.emails.label.content')</label>
    <span class="text-danger">*</span>
    {{ Form::textarea('content', isset($email_template) ? $email_template->content : old('content') ,['class' => 'form-control html_editor','id'=>'content',
            'data-validation' => 'required', 'data-validation-error-msg' => __('validation.required', ['attribute' => strtolower(__('backend.emails.label.content'))])] ) }}
</div>
<div class="row" style="width: 100%;">
    <div class="col-sm-4">
        <div class="form-group">
            <label class="az-content-label tx-11 tx-medium tx-gray-600">@lang('backend.emails.label.attachments')</label>
            <input type="file" class="file-upload dropify"
                   @if(isset($email_template) && isset($email_template->attachment)) data-default-file="{{ getFileUrl($email_template->attachment, 'email-attachments') }}"
                   @endif  id="attachment" name="attachment">
            <input type="hidden" name="remove_attachment" id="removeAttachment" value="false">
        </div>
    </div>
</div>
<div class="form-actions">
    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i>
        @lang('global.button.save')
    </button>
</div>
@section('footer_scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            'use strict';
            getAction($('#identifier').val());

            $(document).on('change', "#identifier", function () {
                getAction($('#identifier').val());
            });

            $(document).on('click', '.dropify-clear', function () {
                $("#removeAttachment").val("true");
            })
        });
        function getAction(selected_action) {
            $("#emailVariables").toggle(selected_action != "");
            $(".actionDiv").hide();
            if (selected_action != "") {
                $('#' + selected_action).show();
            }
        }
    </script>
@endsection

