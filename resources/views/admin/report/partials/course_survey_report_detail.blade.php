@extends('admin.layouts.master')
@section('admin_content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-4 col-6 d-flex align-items-center">
                            <h2 class="card-title text-capitalize">Course Survey Report</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="table-responsive mt-4">
                                    @foreach ($survey_data->surveyQuestions as $question)
                                    <table class="product-overview v-middle table mb-5">
                                        <h4>{!! $question->title !!}</h4>
                                        <thead>
                                            <tr>
                                                <th>Response</th>
                                                @if (isset($question->type) && ($question->type != 'textarea' && $question->type != 'text'))
                                                <th>Average</th>
                                                <th>Total</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $total_response = 0;
                                                $total_response = count($question->userCourseSurveyHistory);
                                            @endphp
                                            @if (isset($question->type))
                                                @if ($question->type == 'single_choice' || $question->type == 'multiple_choice')
                                                    @foreach ($question->surveyQuestionsOption as $option)
                                                        @php
                                                            $total_option_response = 0;
                                                            foreach ($question->userCourseSurveyHistory as $value) {
                                                                if ($value->answers == $option->content) {
                                                                    $total_option_response += 1;
                                                                }
                                                            }
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $option->content ?? ""}}</td>
                                                            <td>
                                                                    <div class="progress report-progress" style="width: 80%" >
                                                                        <div class="progress-bar bg-primary" role="progressbar"
                                                                             style="width: {{ $total_response != 0 ? number_format(($total_option_response/$total_response)*100, 2, '.', '') . '%' : 0 }}"
                                                                             aria-valuenow="50" aria-valuemin="0"
                                                                             aria-valuemax="100">
                                                                        </div>
                                                                        <p class="progress-percent px-2">{{ $total_response != 0 ? number_format(($total_option_response/$total_response)*100, 2, '.', '') . '%' : 0 }}</p>
                                                                    </div>
                                                            </td>
                                                            <td>{{ $total_option_response }}</td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                                @if ($question->type == 'yes_no' || $question->type == 'true_false')
                                                        @php
                                                            $total_yes_response = $total_no_response = 0;
                                                            foreach ($question->userCourseSurveyHistory as $value) {
                                                                if ($value->answers == 'Yes' || $value->answers == 'True') {
                                                                    $total_yes_response += 1;
                                                                }else {
                                                                    $total_no_response += 1;
                                                                }
                                                            }
                                                        @endphp
                                                    <tr>
                                                        <td>{{ $question->type == 'yes_no' ? 'Yes' : 'True' }}</td>
                                                        <td>
                                                            <div class="progress report-progress" style="width: 80%">
                                                                <div class="progress-bar bg-primary" role="progressbar"
                                                                    style="width: {{ $total_response != 0 ? number_format(($total_yes_response/$total_response)*100, 2, '.', '') . '%' : 0 }}"
                                                                    aria-valuenow="50" aria-valuemin="0"
                                                                    aria-valuemax="100"></div>
                                                                <p class="progress-percent px-2">{{ $total_response != 0 ? number_format(($total_yes_response/$total_response)*100, 2, '.', '') . '%' : 0 }}</p>

                                                            </div>
                                                        </td>
                                                        <td>{{ $total_yes_response }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{ $question->type == 'yes_no' ? 'No' : 'False' }}</td>
                                                        <td>
                                                            <div class="progress report-progress" style="width: 80%">
                                                                <div class="progress-bar bg-primary" role="progressbar"
                                                                    style="width: {{ $total_response != 0 ? number_format(($total_no_response/$total_response)*100, 2, '.', '') . '%' : 0 }}"
                                                                    aria-valuenow="50" aria-valuemin="0"
                                                                    aria-valuemax="100"></div>
                                                                <p class="progress-percent px-2">{{ $total_response != 0 ? number_format(($total_no_response/$total_response)*100, 2, '.', '') . '%' : 0 }}</p>

                                                            </div>
                                                        </td>
                                                        <td>{{ $total_no_response }}</td>
                                                    </tr>
                                                @endif
                                                @if ($question->type == 'text')
                                                    @foreach ($question->userCourseSurveyHistory as $text_ans)
                                                        <tr>
                                                            <td>{{ $text_ans->answers ?? ""}}</td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                                @if ($question->type == 'textarea')
                                                    @foreach ($question->userCourseSurveyHistory as $textarea_ans)
                                                        <tr>
                                                            <td>{{ $textarea_ans->answers ?? ""}}</td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                                @if ($question->type == 'ratings')
                                                        @php
                                                            $star_1 = $star_2 = $star_3 = $star_4 = $star_5 = 0;
                                                            foreach ($question->userCourseSurveyHistory as $value) {
                                                                switch ($value->answers) {
                                                                    case 1:
                                                                        $star_1 += 1;
                                                                        break;
                                                                    case 2:
                                                                        $star_2 += 1;
                                                                        break;
                                                                    case 3:
                                                                        $star_3 += 1;
                                                                        break;
                                                                    case 4:
                                                                        $star_4 += 1;
                                                                        break;
                                                                    case 5:
                                                                        $star_5 += 1;
                                                                        break;
                                                                }
                                                            }
                                                            $ratings_data = [ '1' => $star_1 ?? 0,'2' => $star_2 ?? 0,
                                                                    '3' => $star_3 ?? 0,'4' => $star_4 ?? 0,'5' => $star_5 ?? 0,]
                                                        @endphp
                                                        @foreach ($ratings_data as $rating_key => $rating_value)
                                                        <tr>
                                                            <td>{{ $rating_key }} Star</td>
                                                            <td>
                                                                <div class="progress report-progress" style="width: 80%">
                                                                    <div class="progress-bar bg-primary" role="progressbar"
                                                                        style="width: {{ $total_response != 0 ? number_format(($rating_value/$total_response)*100, 2, '.', '') . '%' : 0 }}"
                                                                        aria-valuenow="50" aria-valuemin="0"
                                                                        aria-valuemax="100"></div>
                                                                    <p class="progress-percent px-2">{{ $total_response != 0 ? number_format(($rating_value/$total_response)*100, 2, '.', '') . '%' : 0 }}</p>

                                                                </div>
                                                            </td>
                                                            <td>{{ $rating_value }}</td>
                                                        </tr>
                                                        @endforeach
                                                @endif
                                            @endif
                                        </tbody>
                                    </table>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
