<div class="row text-center">
    <div class="col-md-6 col-lg-3 col-sm-12">@lang('frontend.quiz_result.total_questions_text') : {{ $resultData['total_questions'] }}</div>
    <div class="col-md-6 col-lg-3 col-sm-12">@lang('frontend.quiz_result.correct_answers_text') : {{ $resultData['correct_answers'] }}</div>
    <div class="col-md-6 col-lg-3 col-sm-12">@lang('frontend.quiz_result.incorrect_answers_text') : {{ $resultData['incorrect_answers'] }}</div>
    <div class="col-md-6 col-lg-3 col-sm-12">@lang('frontend.quiz_result.unanswered_text') : {{ $resultData['unanswered_questions'] }}</div>
</div>
<hr>
<ol>
    @foreach($resultData['questions'] as $questionData)
        <div class="d-flex flex-row mb-3">
            <li>
                <h5 class="quiz-qus">{!! $questionData['title'] !!}</h5>

                @if(!empty(strip_tags($questionData['que_description'])))
                    <div class="questn-detail p-2 my-3">
                        {!! $questionData['que_description'] !!}
                    </div>
                @endif

                <p class="mb-0"><strong>@lang('frontend.quiz_result.marked_answers_text') :</strong>
                    <span>{{ $questionData['user_question_answers'] ?? "--" }}</span></p>
                <p class="correct-ans"><strong>@lang('frontend.quiz_result.correct_answers_text') :</strong> <span>{{ $questionData['correct_answers'] }}</span>
                </p>
            </li>
        </div>
    @endforeach
</ol>

