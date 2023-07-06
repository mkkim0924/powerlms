<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-lg-4 col-6 d-flex align-items-center">
                <h2 class="card-title">@lang('backend.courses.header.test_details')</h2>
            </div>
            @if($quiz->courseDetail->course_status == 2)
                <div class="col lg 4">
                <span class="">
                     <a href="javascript:;"
                        class="btn waves-effect waves-light btn-rounded btn-outline-success curriculumReview float-right"
                        data-id="{{ $curriculum->id }}">
                        <i class="fa fa-plus" aria-hidden="true"></i>@lang('backend.courses.button.add_review')
                     </a>
                </span>
                </div>
            @endif
        </div>
    </div>
    <div class="card-body">
        <div id="chatSection">

        </div>
        <div class="table-responsive">
            <table class="table">
                <tbody>
                <tr>
                    <td width="150"><b>@lang('backend.courses.label.name')</b></td>
                    <td>{{ $quiz->name ?? "- - -" }}</td>
                </tr>
                <tr>
                    <td width="150"><b>@lang('backend.courses.label.slug')</b></td>
                    <td>{{ $quiz->slug ?? "- - -" }}</td>
                </tr>
                <tr>
                    <td width="150"><b>@lang('backend.courses.label.course_name')</b></td>
                    <td>{{ $curriculum->courseDetail->name ?? "- - -" }}</td>
                </tr>
                <tr>
                    <td width="150"><b>@lang('backend.courses.label.lesson_name')</b></td>
                    <td>{{ $curriculum->sectionDetail->name ?? "- - -" }}</td>
                </tr>
                <tr>
                    <td width="150"><b>@lang('backend.courses.label.time')</b></td>
                    <td>{{ $quiz->time ?? "- - -" }}</td>
                </tr>
                <tr>
                    <td width="150"><b>@lang('backend.courses.label.test_retake')</b></td>
                    <td>{{ $quiz->retake ?? "- - -" }}</td>
                </tr>
                <tr>
                    <td width="150"><b>@lang('backend.courses.label.content')</b></td>
                    <td>{!! $quiz->content ?? "- - -" !!}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <hr>
        @if(count($quiz->relatedQuestions) > 0)
            <h4 class="card-title">@lang('backend.courses.label.questions')</h4>
            <div id="questionAccordian">
                @foreach($quiz->relatedQuestions as $que_id => $question)
                    <div class="card">
                        <a class="card-header" id="heading{{ $que_id }}">
                            <button class="btn btn-link @if(!$loop->first) collapsed @endif" data-toggle="collapse"
                                    data-target="#collapse{{ $que_id }}" aria-expanded="{{ $loop->first }}"
                                    aria-controls="collapse{{ $que_id }}">
                                <h5 class="mb-0">{{ $que_id + 1 }}. {!! $question->title !!}</h5>
                            </button>
                        </a>
                        <div id="collapse{{ $que_id }}" class="collapse @if($loop->first) show @endif" aria-labelledby="heading{{ $que_id }}"
                             data-parent="#questionAccordian" style="">
                            <div class="card-body">
                                @foreach($question->relatedOptions as $option)
                                    <div class="form-group">
                                        @if($question->type == 'single_choice')
                                            <div class="custom-control custom-radio mr-sm-2">
                                                <input type="radio" class="custom-control-input" id="checkbox1" disabled
                                                       value="check" @if($option->is_correct_answer) checked @endif>
                                                <label class="custom-control-label"
                                                       for="checkbox1">{{ $option->content }}</label>
                                            </div>
                                        @else
                                            <div class="custom-control custom-checkbox mr-sm-2">
                                                <input type="checkbox" class="custom-control-input" id="checkbox1" disabled
                                                       value="check" @if($option->is_correct_answer) checked @endif>
                                                <label class="custom-control-label"
                                                       for="checkbox1">{{ $option->content }}</label>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            @lang('backend.courses.note.no_questions_found')
        @endif
    </div>
</div>
