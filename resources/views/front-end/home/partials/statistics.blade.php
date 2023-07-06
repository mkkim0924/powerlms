@if(in_array('statistics_section', config('layout_sections')))
    <div id="statistic-1" class="bg-yellow statistic-section division">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="statistic-block">
                        <h5 class="statistic-number"><span
                                class="count-element">{{ config('statistics.online_courses') }}</span></h5>
                        <div class="statistic-block-txt">
                            <h5 class="h5-lg">@lang('frontend.statistic.online_courses_title')</h5>
                            <a href="{{ route('courses') }}">@lang('frontend.statistic.learn_more_text') &gt;</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="statistic-block">
                        <h5 class="statistic-number"><span
                                class="count-element">{{ config('statistics.total_instructors') }}</span></h5>
                        <div class="statistic-block-txt">
                            <h5 class="h5-lg">@lang('frontend.statistic.available_instructors_title')</h5>
                            <a href="{{ route('becomeAInstructor') }}">@lang('frontend.statistic.become_an_nstructor_text') &gt;</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="statistic-block">
                        <h5 class="statistic-number"><span
                                class="count-element">{{ config('statistics.students') }}</span></h5>
                        <div class="statistic-block-txt">
                            <h5 class="h5-lg">@lang('frontend.statistic.happy_students_title')</h5>
                            {!! __('frontend.statistic.with_enrolments_text',['enrollments' => config('statistics.enrollments'),]) !!}
                            
                            {{--                            <a href="javascript:;">Discover More &gt;</a>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
