<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <input type="hidden" name="survey_id" value="{{ $survey_id ?? '' }}">
            <label>@lang('backend.course_survey_questions.label.question_title')</label>
            <span class="text-danger">*</span>
            {!! Form::textarea('title', $data->title ?? old('title'), [
            'id' => 'title',
            'class' => 'form-control',
            'rows' => '2',
            ]) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('backend.course_survey_questions.label.question_type')</label>
            <span class="text-danger">*</span>
            {!! Form::select(
            'type', App\Models\CourseSurveyQuestion::control_type,
            $data->type ?? old('type'),
            [
            'class' => 'form-control select2_no_search',
            'id' => 'type',
            'data-validation' => 'required',
            'data-validation-error-msg' => __('validation.required', ['attribute' =>
            strtolower(__('backend.course_survey_questions.label.question_type'))]),
            ],
            ) !!}
        </div>
    </div>
    <div class="col-md-6" id="no_of_option" 
        @if (isset($data->type) && ($data->type != 'multiple_choice' && $data->type != 'single_choice')) style="display: none" @endif>
        <div class="form-group">
            <label>@lang('backend.course_survey_questions.label.no_of_option')</label>
            <span class="text-danger">*</span>
            {!! Form::number('option_count', isset($option_data) ? count($option_data) :
            old('option_count'), [
            'id' => 'option_count',
            'class' => 'form-control',
            'data-validation' => 'required',
            'data-validation-error-msg' => __('validation.required', ['attribute' =>
            strtolower(__('backend.course_survey_questions.label.no_of_option'))]),
            'min' => '0',
            ]) !!}
        </div>
    </div>
</div>
    <div class="row" id="options">
        @if ((isset($option_data) && isset($data->type)) && ($data->type == 'multiple_choice' || $data->type == 'single_choice'))
            @foreach($option_data as $key => $value)
                <div class="col-lg-6" id="multipleChoiceHtml">
                    <div class="form-group">
                        <label class="labelTitle">@lang('backend.course_survey_questions.label.options') {{ $value->option_id ?? '' }}</label>
                        <div class="input-group">
                            <input type="text" class="form-control inputVal" data-validation="required"
                                name="options_data[{{ $value->option_id ?? "" }}]" value="{{ $value->content ?? "" }}">
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
<div class="col-lg-6" id="multipleChoiceHtml" style="display: none">
    <div class="form-group">
        <label class="labelTitle">@lang('backend.course_survey_questions.label.options')</label>
        <div class="input-group">
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
        $(document).on('keyup', '#option_count', function() {
            $("#options").html("");
            var numberOfOptions = $(this).val();
            var type = $("#type").val();
            var cloneHtml = "";
            for (var i = 1; i <= numberOfOptions; i++) {
                if (type == "multiple_choice" || type == "single_choice") {
                    cloneHtml = $("#multipleChoiceHtml").last().clone();
                    cloneHtml.find('.labelTitle').text("@lang('backend.course_survey_questions.label.options') " + i);
                    cloneHtml.find('.inputVal').attr('name', 'options_data[' + i + ']');
                }
                $("#options").append(cloneHtml.show());
            }
        })
        $(document).on('change', '#type', function() {
            var input_type = $(this).val()
            if (input_type != 'multiple_choice' && input_type != 'single_choice') {
                $("#options").html("").hide();
                $("#no_of_option").hide();
            }else{
                $("#options").html("").show();
                $("#option_count").val("").show();
                $("#no_of_option").show();
            }
        })

        $(document).on('click', '#submitBtn', function() {
            var isValid = $("#survayForm").isValid();

            if (isValid) {
                $("#survayForm").submit();
            }
        }) 
    });
</script>
@endsection