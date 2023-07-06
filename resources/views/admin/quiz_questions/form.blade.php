@include('admin.layouts.partials.flash_messages')
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <input type="hidden" name="quiz_id" value="{{ $quiz_id }}">
            <label>@lang('backend.quiz_questions.label.question_title')</label>
            {!! Form::textarea('title', $question->title ?? old('title'), [
                'id' => 'title',
                'class' => 'form-control html_editor',
            ]) !!}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>@lang('backend.quiz_questions.label.question_description')</label>
            {!! Form::textarea('que_description', $question->que_description ?? old('que_description'), [
                'id' => 'que_description',
                'class' => 'form-control html_editor',
            ]) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('backend.quiz_questions.label.quiz_type')</label>
            <span class="text-danger">*</span>
            {!! Form::select(
                'type',
                [
                    'multiple_choice' => __('backend.quiz_questions.quiz_type_option.multiple_choice'),
                    'single_choice' => __('backend.quiz_questions.quiz_type_option.single_choice'),
                ],
                $question->type ?? old('type'),
                [
                    'class' => 'form-control select2_no_search',
                    'id' => 'type',
                    'data-validation' => 'required',
                ],
            ) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('backend.quiz_questions.label.no_of_option')</label>
            <span class="text-danger">*</span>
            {!! Form::number('option_count', isset($question) ? count($question->relatedOptions) : old('option_count'), [
                'id' => 'option_count',
                'class' => 'form-control',
                'data-validation' => 'required',
                'min' => '0',
            ]) !!}
        </div>
    </div>
</div>
<div class="row" id="options">
    @if (isset($question))
        @foreach ($question->relatedOptions as $optionDetail)
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="labelTitle">@lang('backend.quiz_questions.label.options') {{ $optionDetail->option_id }}</label>
                    @if ($question->type == 'multiple_choice')
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input"
                                               id="option{{ $optionDetail->option_id }}"
                                               name="options_data[{{ $optionDetail->option_id }}][right_answer]"
                                               @if ($optionDetail->is_correct_answer == 1) checked @endif>
                                        <label class="custom-control-label"
                                               for="option{{ $optionDetail->option_id }}"></label>
                                    </div>
                                </div>
                            </div>
                            <input type="text" class="form-control" data-validation="required"
                                   name="options_data[{{ $optionDetail->option_id }}][title]"
                                   value="{{ $optionDetail->content }}">
                        </div>
                    @else
                        <div class="input-group">
                            <a href="javascript:;" data-toggle="tooltip" data-placement="top" title="@lang('backend.quiz_questions.tooltip.mark_as_answer')">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input"
                                                   id="option{{ $optionDetail->option_id }}" name="right_answer"
                                                   value="{{ $optionDetail->option_id }}"
                                                   @if ($optionDetail->is_correct_answer == 1) checked @endif>
                                            <label class="custom-control-label"
                                                   for="option{{ $optionDetail->option_id }}"></label>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <input type="text" class="form-control" data-validation="required"
                                   name="options[{{ $optionDetail->option_id }}]" value="{{ $optionDetail->content }}">
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    @endif
</div>
<div class="col-lg-6" id="multipleChoiceHtml" style="display: none">
    <div class="form-group">
        <label class="labelTitle">@lang('backend.quiz_questions.label.options')</label>
        <div class="input-group">
            <a href="javascript:;" data-toggle="tooltip" data-placement="top" title="@lang('backend.quiz_questions.tooltip.mark_as_answer')">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input">
                            <label class="custom-control-label"></label>
                        </div>
                    </div>
                </div>
            </a>
            <input type="text" class="form-control inputVal" data-validation="required">
        </div>
    </div>
</div>
<div class="col-lg-6" id="singleChoiceHtml" style="display: none">
    <div class="form-group">
        <label class="labelTitle">@lang('backend.quiz_questions.label.options')</label>
        <div class="input-group">
            <a href="javascript:;" data-toggle="tooltip" data-placement="top" title="@lang('backend.quiz_questions.tooltip.mark_as_answer')">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input">
                            <label class="custom-control-label"></label>
                        </div>
                    </div>
                </div>
            </a>
            <input type="text" class="form-control inputVal" data-validation="required">
        </div>
    </div>
</div>

<div class="form-actions">
    <button type="button" id="submitBtn" class="btn btn-success"><i class="fa fa-check"></i>
        @lang('global.button.save') </button>
</div>

@section('footer_scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            'use strict';
            $(document).on('keyup', '#option_count', function () {
                $("#options").html("");
                var type = $("#type").val();
                var numberOfOptions = $(this).val();
                var cloneHtml = "";
                for (var i = 1; i <= numberOfOptions; i++) {
                    if (type == "multiple_choice") {
                        cloneHtml = $("#multipleChoiceHtml").last().clone();
                        cloneHtml.find('.labelTitle').text("@lang('backend.quiz_questions.label.options') " + i);
                        cloneHtml.find('.custom-control-input').attr('id', "option" + i).attr('name', 'options_data[' +
                            i + '][right_answer]');
                        cloneHtml.find('.custom-control-label').attr('for', "option" + i);
                        cloneHtml.find('.inputVal').attr('name', 'options_data[' + i + '][title]');
                    } else {
                        cloneHtml = $("#singleChoiceHtml").last().clone();
                        cloneHtml.find('.labelTitle').text("@lang('backend.quiz_questions.label.options') " + i);
                        cloneHtml.find('.custom-control-input').attr('id', "option" + i).attr('name', 'right_answer')
                            .val(i);
                        cloneHtml.find('.custom-control-label').attr('for', "option" + i);
                        cloneHtml.find('.inputVal').attr('name', 'options[' + i + ']');
                    }
                    $("#options").append(cloneHtml.show());
                }
            })

            $(document).on('change', '#type', function () {
                $("#options").html("");
                $("#option_count").val("");
            })

            $(document).on('click', '#submitBtn', function () {
                var isValid = $("#quizQueForm").isValid();
                if (isValid) {
                    var $selected_answer = false;
                    $("#options").find('.custom-control-input').each(function () {
                        if (!$selected_answer && $(this).is(':checked')) {
                            $selected_answer = true;
                        }
                    });
                    if ($selected_answer) {
                        $("#quizQueForm").submit();
                    } else {
                        toastr.error("@lang('backend.quiz_questions.message.select_answer_error')",
                            $plugin_translations.toastr_error_text, {
                                timeOut: 2000
                            });
                    }
                }
            })

            // For showing tooltip
            $("body").tooltip({
                selector: '[data-toggle=tooltip]'
            });
        });
    </script>
@endsection
