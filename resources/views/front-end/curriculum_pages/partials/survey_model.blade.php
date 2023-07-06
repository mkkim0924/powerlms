<div class="modal fade survey-modal" id="surveyModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content modal-dialog-scrollable">
            <form action="{{ route('course_survey.results.store') }}" method="post" id="surveyForm">
                @csrf
                <input type="hidden" value="{{ $survey->id ?? "" }}" name="survey_id">
                <div class="modal-body">
                    <div class="text-center">
                        <img src="{{ asset('frontend-assets/images/icons/checklist.png') }}" alt=""
                            class="img-fluid w-7">
                        <h5 class="modal-title my-2 text-dark-blue" id="staticBackdropLabel">{{ $survey->name ?? "" }}
                        </h5>
                        <p>{{ $survey->description ?? "" }}</p>
                    </div>
                    @if(isset($survey->view_type) && $survey->view_type == 'tab')
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                aria-labelledby="pills-home-tab">
                                <div class="border border-primary rounded-2 p-4">
                                    @foreach ($survey->surveyQuestions as $que_key => $question)
                                    @if (isset($question->type))
                                        <div class="question-box form-check py-2  survey-questions"@if (!$loop->first) style="display: none;"
                                            @endif id="que{{ $que_key }}">
                                            <h6 class="text-dark-blue d-flex"><span class="me-1">{{ $que_key+1 }}. </span> {!! $question->title ?? "" !!}</h6>
                                                @if ($question->type == 'text')
                                                    <div class="d-flex py-2">
                                                        <input name="question[{{ $question->id }}]" type="text" class="form-control question-input" placeholder="Write here...">
                                                    </div>
                                                @elseif($question->type == 'textarea')
                                                    <div class="d-flex py-2">
                                                        <textarea class="form-control" name="question[{{ $question->id }}]" cols="30" rows="2"
                                                            placeholder="Write here..."></textarea>
                                                    </div>
                                                @elseif($question->type == 'yes_no' || $question->type == 'true_false')
                                                    <div class="d-flex py-2">
                                                        <div class="form-check  me-4">
                                                            <input class="form-check-input ms-1 me-2" type="radio" name="question[{{ $question->id ?? "" }}]"
                                                                    id="id_1_{{ $question->id ?? "" }}" value="{{ $question->type == 'yes_no' ? 'Yes' : 'True' }}">
                                                            <label class="form-check-label" for="id_1_{{ $question->id ?? "" }}">
                                                                {{ $question->type == 'yes_no' ? 'Yes' : 'True' }}
                                                            </label>
                                                        </div>
                                                        <div class="form-check  me-4">
                                                            <input class="form-check-input ms-1 me-2" type="radio"name="question[{{ $question->id ?? "" }}]"
                                                            id="id_0_{{ $question->id ?? "" }}" value="{{ $question->type == 'yes_no' ? 'No' : 'False' }}">
                                                            <label class="form-check-label" for="id_0_{{ $question->id ?? "" }}">
                                                                {{ $question->type == 'yes_no' ? 'No' : 'False' }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @elseif($question->type == 'multiple_choice')
                                                    @foreach ($question->surveyQuestionsOption as $item)
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="form-check  d-inline-block me-4 px-2">
                                                                    <input class="form-check-input ms-1 me-2 input{{ $question->id }}" type="checkbox"
                                                                            name="question[{{ $question->id }}][{{ $item->option_id }}]"
                                                                            value="{{ $item->content }}" id="id_{{ $item->option_id }}">
                                                                    <label class="form-check-label" for="id_{{ $item->option_id }}">
                                                                        {{ $item->content }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @elseif ($question->type == 'single_choice')
                                                    @foreach ($question->surveyQuestionsOption as $item)
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="form-check  d-inline-block me-4 px-2 mb-2">
                                                                    <input class="form-check-input ms-1 me-2" type="radio" name="question[{{ $question->id }}]"
                                                                        value="{{ $item->content }}"id="id_{{ $question->id }}_{{ $item->option_id }}">
                                                                    <label class="form-check-label" for="id_{{ $question->id }}_{{ $item->option_id }}">
                                                                        {{ $item->content }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @elseif ($question->type == 'ratings')
                                                    <div class="d-flex py-2">
                                                        <div class="star_ratings d-flex justify-content-start"></div>
                                                        <input type="hidden" class="ratingInputField" name="question[{{ $question->id }}]">
                                                    </div>
                                                @endif
                                                <div class="col-12 validationDiv" style="display: none;">
                                                    The field is required.
                                                </div>
                                                <ul class="nav nav-pills  d-flex justify-content-between mt-3" id="pills-tab"
                                                    role="tablist">
                                                    @if(!$loop->first)
                                                        <li class="nav-item btnLi" role="presentation">
                                                            <button class="btn-light-rose btn my-1 px-5 nextPreQuestion"
                                                                data-currentQueNo="{{ $que_key }}" data-queNo="{{ $que_key - 1 }}" type="button"
                                                                role="tab">
                                                                Previous
                                                            </button>
                                                        </li>
                                                    @endif
                                                    @if ($loop->first)
                                                    <li class="nav-item btnLi" role="presentation">
                                                        <button class="btn-light-rose btn my-1 px-5 nextPreQuestion"
                                                            data-currentQueNo="{{ $que_key }}" data-queNo="{{ $que_key - 1 }}" type="button"
                                                            role="tab" disabled>
                                                            Previous
                                                        </button>
                                                    </li>
                                                    @endif
                                                    @if (!$loop->last)
                                                        <li class="nav-item btnLi" role="presentation">
                                                            <button class=" btn-rose btn my-1 px-5 nextPreQuestion"
                                                                data-currentQueNo="{{ $que_key }}" data-queId="{{ $question->id }}"
                                                                data-queType="{{ $question->type }}" data-queNo="{{ $que_key + 1 }}"
                                                                type="button" role="tab">
                                                                Next
                                                            </button>
                                                        </li>
                                                    @else
                                                        <button type="button" class="submitStepFormButton btn-rose btn py-2 px-5 my-1"
                                                            data-queId="{{ $question->id }}"
                                                            data-queType="{{ $question->type }}">@lang('global.button.submit')</button>
                                                    @endif
                                                </ul>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @elseif(isset($survey->view_type) && $survey->view_type == 'list')
                        <div class="border border-primary rounded-2 p-4 scroll-body">
                            @foreach ($survey->surveyQuestions as $queNoKey => $question)
                            <div class="question-box form-check py-2 ">
                                <h6 class="text-dark-blue d-flex"><span class="me-1">{{ $queNoKey+1 }}. </span> {!! $question->title ?? "" !!}</h6>
                                @if (isset($question->type))
                                @if ($question->type == 'text')
                                <div class="d-flex py-2">
                                    <input type="text" class="form-control input{{ $queNoKey }}" placeholder="Write here..."
                                        name="question[{{ $question->id }}]" data-type="{{ $question->type }}">
                                </div>
                                @elseif($question->type == 'textarea')
                                <div class="d-flex py-2">
                                    <textarea class="form-control input{{ $queNoKey }}" name="question[{{ $question->id }}]"
                                        cols="30" rows="2" placeholder="Write here..."
                                        data-type="{{ $question->type }}"></textarea>
                                </div>
                                @elseif($question->type == 'yes_no' || $question->type == 'true_false')
                                <div class="d-flex py-2">
                                    <div class="form-check  me-4">
                                        <input class="form-check-input ms-1 me-2 input{{ $queNoKey }}" type="radio"
                                            name="question[{{ $question->id }}]" data-type="{{ $question->type }}"
                                            id="id_1_{{ $question->id }}"
                                            value="{{ $question->type == 'yes_no' ? 'Yes' : 'True' }}">
                                        <label class="form-check-label" for="id_1_{{ $question->id }}">
                                            {{ $question->type == 'yes_no' ? 'Yes' : 'True' }}
                                        </label>
                                    </div>
                                    <div class="form-check  me-4">
                                        <input class="form-check-input ms-1 me-2 input{{ $queNoKey }}" type="radio"
                                            name="question[{{ $question->id }}]" data-type="{{ $question->type }}"
                                            id="id_0_{{ $question->id }}"
                                            value="{{ $question->type == 'yes_no' ? 'No' : 'False' }}">
                                        <label class="form-check-label" for="id_0_{{ $question->id }}">
                                            {{ $question->type == 'yes_no' ? 'No' : 'False' }}
                                        </label>
                                    </div>
                                </div>
                                @elseif($question->type == 'multiple_choice')
                                @foreach ($question->surveyQuestionsOption as $item)
                                <div class=" row ">
                                    <div class="col-12">
                                        <div class="form-check  d-inline-block me-4 px-2 ">
                                            <input class="form-check-input ms-1 me-2 input{{ $queNoKey }}" type="checkbox"
                                                data-type="{{ $question->type }}"
                                                name="question[{{ $question->id }}][{{ $item->option_id }}]"
                                                value="{{ $item->content }}" id="id_{{ $item->option_id }}">
                                            <label class="form-check-label" for="id_{{ $item->option_id }}">
                                                {{ $item->content }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @elseif ($question->type == 'single_choice')
                                @foreach ($question->surveyQuestionsOption as $item)
                                <div class="row ">
                                    <div class="col-12">
                                        <div class="form-check  d-inline-block me-4 px-2">
                                            <input class="form-check-input ms-1 me-2 input{{ $queNoKey }}" type="radio"
                                                data-type="{{ $question->type }}" name="question[{{ $question->id }}]"
                                                value="{{ $item->content }}" id="id_{{ $question->id }}_{{ $item->option_id }}">
                                            <label class="form-check-label" for="id_{{ $question->id }}_{{ $item->option_id }}">
                                                {{ $item->content }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @elseif ($question->type == 'ratings')
                                <div class="col-md-12 form-group">
                                    <div class="star_ratings d-flex justify-content-start"></div>
                                    <input type="hidden" class="ratingInputField" name="question[{{ $question->id }}]"
                                        value="5">
                                </div>
                                @endif
                                <div class="col-12 validationDiv" style="display: none;">
                                    The field is required.
                                </div>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    @if ($survey->is_skippable == 1 && $survey->view_type == 'list')
                        <a href="{{ route('course_survey.skipped',$survey->id) }}"
                            class="text-decoration-underline float-start me-auto text-dark skip-btn">
                            Skip Survey
                        </a>
                    @elseif($survey->is_skippable == 1 && $survey->view_type == 'tab')
                        <a href="{{ route('course_survey.skipped',$survey->id) }}"
                            class="text-decoration-underline text-center mx-auto pt-2 pb-4 text-dark skip-btn">
                            Skip Survey
                        </a>
                    @endif
                    @if(isset($survey->view_type) && $survey->view_type == 'list')
                        <button type="submit"
                            class="btn btn-rose rounded-4 float-end ms-auto py-2 px-4 submitButton">@lang('global.button.submit')</button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
@push('css')
    <link rel="stylesheet" href="{{ asset('admin-assets/assets/extra-libs/rateyo/jquery.rateyo.min.css') }}">
@endpush
@push('footer_scripts')
    <script src="{{ asset('admin-assets/assets/extra-libs/rateyo/jquery.rateyo.min.js') }}"></script>
    <script>
        var totalQuestions = '{{ count($survey->surveyQuestions) }}';
        $(document).ready(function () {
            $("#surveyModal").modal("show");

            $(".star_ratings").rateYo({
                rating: 5,
                fullStar: !0,
                ratedFill: "#FFC000",
                onSet: function (a) {
                    $(".ratingInputField").val(a)
                }
            });

            $(document).on('click', '.submitButton', function () {
                $('.validationDiv').hide();
                for (var i = 0; i < totalQuestions; i++)//see that I removed the $ preceeding the `for` keyword, it should not have been there
                {
                    var isValid = true;
                    var input = $('.input' + i);
                    var queType = input.data('type');
                    if ((queType === 'text' || queType === 'textarea') && ($.trim($(".input" + i).val()) === '')) {
                        isValid = false;
                    } else if (((queType === 'single_choice') || (queType === 'yes_no') || (queType === 'true_false') || queType === 'multiple_choice')) {
                        isValid = ($('.input' + i + ':checked').length > 0);
                    }
                    input.parents('.row').find('.validationDiv').toggle(!isValid);
                }
                if (isValid) {
                    $("#surveyForm").submit();
                }
            });

            $(document).on('click', '.nextPreQuestion', function () {
                $('.validationDiv').hide();
                var currentQueNo = $(this).attr('data-currentQueNo');
                var nextPreQueNo = $(this).attr('data-queNo');
                var queType = $(this).attr('data-queType');
                var queId = $(this).attr('data-queId');
                var isValid = true;
                if (nextPreQueNo > currentQueNo) {
                    if ((queType === 'text' || queType === 'textarea') && ($.trim($("[name='question[" + queId + "]']").val()) === '')) {
                        isValid = false;
                    } else if ((queType === 'single_choice') || (queType === 'yes_no') || (queType === 'true_false')) {
                        isValid = ($('input[name="question[' + queId + ']"]:checked').length === 1);
                    } else if (queType === 'multiple_choice') {
                        isValid = ($('.input' + queId + ':checked').length > 0);
                    }
                }
                if (isValid) {
                    $('.survey-questions').hide();
                    $("#que" + nextPreQueNo).show();
                } else {
                    $('.validationDiv').show();
                }
            });

            $(document).on('click', '.submitStepFormButton', function () {
                $('.validationDiv').hide();
                var queType = $(this).attr('data-queType');
                var queId = $(this).attr('data-queId');
                var isValid = true;
                if ((queType === 'text' || queType === 'textarea') && ($.trim($("[name='question[" + queId + "]']").val()) === '')) {
                    isValid = false;
                } else if ((queType === 'single_choice') || (queType === 'yes_no') || (queType === 'true_false')) {
                    isValid = ($('input[name="question[' + queId + ']"]:checked').length === 1);
                } else if (queType === 'multiple_choice') {
                    isValid = ($('.input' + queId + ':checked').length > 0);
                }
                if (isValid) {
                    $("#surveyForm").submit();
                } else {
                    $('.validationDiv').show();
                }
            });
        });
    </script>
@endpush
