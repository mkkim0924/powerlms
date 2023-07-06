<div class="form-group">
    <label>@lang('backend.courses.label.content')</label>
    <small class="text-danger">@lang('backend.courses.note.content')</small>
    {!! Form::textarea('content', $course->content ?? old('content'), [
        'class' => 'form-control html_editor',
        'id' => 'content',
    ]) !!}
</div>
<div class="form-group">
    <label>@lang('backend.courses.label.requirements')</label>
    <small class="text-danger">@lang('backend.courses.note.requirements')</small>
    {!! Form::textarea('requirements', $course->requirements ?? old('requirements'), [
        'class' => 'form-control html_editor',
        'id' => 'requirements',
    ]) !!}
</div>
<div class="form-group" id="whatYouLearn">
    <label>@lang('backend.courses.label.what_you_will_learn')</label>
    @if(isset($course) && !empty($course->what_you_will_learn_points))
        @foreach($course->what_you_will_learn_points as $what_you_will_learn_point)
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="what_you_will_learn_points[]"
                       value="{{ $what_you_will_learn_point }}">
                <div class="input-group-append">
                    @if($loop->first)
                        <a href="javascript:;" class="btn btn-success addNewPoint py-0 d-flex align-items-center" type="button"
                           data-name="what_you_will_learn_points" data-div="whatYouLearn">@lang('backend.courses.button.add_new_point')</a>
                    @else
                        <a href="javascript:;" class="btn btn-danger removePoint py-0 d-flex align-items-center" type="button">@lang('backend.courses.label.remove')</a>
                    @endif
                </div>
            </div>
        @endforeach
    @else
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="what_you_will_learn_points[]">
            <div class="input-group-append">
                <a href="javascript:;" class="btn btn-success addNewPoint py-0 d-flex align-items-center" type="button"
                   data-name="what_you_will_learn_points" data-div="whatYouLearn">@lang('backend.courses.button.add_new_point')</a>
            </div>
        </div>
    @endif
</div>
<div class="form-group pb-3" id="whoThisCourseFor">
    <label>@lang('backend.courses.button.who_this_course_is_for')</label>
    @if(isset($course) && !empty($course->who_this_course_is_for_points))
        @foreach($course->who_this_course_is_for_points as $who_this_course_is_for_point)
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="who_this_course_is_for_points[]"
                       value="{{ $who_this_course_is_for_point }}">
                <div class="input-group-append">
                    @if($loop->first)
                        <a href="javascript:;" class="btn btn-success addNewPoint py-0 d-flex align-items-center" type="button"
                           data-name="who_this_course_is_for_points" data-div="whoThisCourseFor">@lang('backend.courses.button.add_new_point')</a>
                    @else
                        <a href="javascript:;" class="btn btn-danger removePoint py-0 d-flex align-items-center" type="button">@lang('backend.courses.label.remove')</a>
                    @endif
                </div>
            </div>
        @endforeach
    @else
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="who_this_course_is_for_points[]">
            <div class="input-group-append">
                <a href="javascript:;" class="btn btn-success addNewPoint py-0 d-flex align-items-center" type="button"
                   data-name="who_this_course_is_for_points" data-div="whoThisCourseFor">@lang('backend.courses.button.add_new_point')</a>
            </div>
        </div>
    @endif
</div>
