<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-lg-4 col-6 d-flex align-items-center">
                <h2 class="card-title">@lang('backend.courses.header.course_details')</h2>
            </div>
            @if($course->course_status == 2)
                <div class="col lg 4">
                <span class="">
                     <a href="javascript:;"
                        class="btn waves-effect waves-light btn-rounded btn-outline-success curriculumReview float-right"
                        data-id="">
                        <i class="fa fa-plus" aria-hidden="true"></i> @lang('backend.courses.button.add_review')
                    </a>
                </span>
                </div>
            @endif
        </div>
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
                <td>{{ $course->name ?? "- - -" }}</td>
            </tr>
            <tr>
                <td width="150"><b>@lang('backend.courses.label.slug')</b></td>
                <td>{{ $course->slug ?? "- - -" }}</td>
            </tr>
            <tr>
                <td width="150"><b>@lang('backend.courses.label.category_name')</b></td>
                <td>{{ $course->categoryDetail->name ?? "- - -" }}</td>
            </tr>
            <tr>
                <td width="150"><b>@lang('backend.courses.label.tiny_description')</b></td>
                <td>{{ $course->tiny_description ?? "- - -" }}</td>
            </tr>
            <tr>
                <td width="150"><b>@lang('backend.courses.label.is_free')</b></td>
                <td>{{ ($course->is_free == 1) ? 'Yes' : 'No' }}</td>
            </tr>
            <tr>
                <td width="150"><b>@lang('backend.courses.label.price')</b></td>
                <td>{{ formatPrice($course->price) }}</td>
            </tr>
            <tr>
                <td width="150"><b>@lang('backend.courses.label.discounted_price')</b></td>
                <td>{{ formatPrice($course->discounted_price) }}</td>
            </tr>
            <tr>
                <td width="150"><b>@lang('backend.courses.label.course_level')</b></td>
                <td>{{ $course->course_level }}</td>
            </tr>
            <tr>
                <td width="150"><b>@lang('backend.courses.label.course_time')</b></td>
                <td>{{ $course->time }}</td>
            </tr>
            <tr>
                <td width="150"><b>@lang('backend.courses.label.course_status')</b></td>
                <td>{{ \App\Models\Course::STATUSES[$course->course_status] ?? "In Draft" }}</td>
            </tr>
            <tr>
                <td width="150"><b>@lang('backend.courses.label.video_provider')</b></td>
                <td>{{ \App\Models\Course::VIDEO_PROVIDER[$course->intro_video_provider] ?? "- - -" }}</td>
            </tr>
            <tr>
                <td width="150"><b>@lang('backend.courses.label.video_url')</b></td>
                <td>
                    @if (!empty($course->intro_video_url))
                        {{ !empty($course->intro_video_provider) && $course->intro_video_provider == 'video_file' ? getFileUrl($course->intro_video_url, 'course/video') : $course->intro_video_url }}
                    @else
                        "- - -"
                    @endif
                </td>
            </tr>
            <tr>
                <td width="150"><b>@lang('backend.courses.label.course_image')</b></td>
                @if(isset($course->image))
                    <td><input type="file" class="dropify" disabled="disabled" data-default-file="{{ getFileUrl($course->image, 'course/images') }}"></td>
                @else
                    <td>- - -</td>
                @endif
            </tr>
            <tr>
                <td width="150"><b>@lang('backend.courses.label.thumbnail_image')</b></td>
                @if(isset($course->intro_thumbnail_image))
                    <td><input type="file" class="dropify" disabled="disabled" data-default-file="{{ getFileUrl($course->intro_thumbnail_image, 'course/thumbnail_images') }}"></td>
                @else
                    <td>- - -</td>
                @endif
            </tr>
            <tr>
                <td width="150"><b>@lang('backend.courses.label.what_you_will_learn')</b></td>
                @if(!empty($course->what_you_will_learn_points))
                    <td>
                        <ul>
                            @foreach($course->what_you_will_learn_points as $point)
                                <li>{{ $point }}</li>
                            @endforeach
                        </ul>
                    </td>
                @else
                    <td>- - -</td>
                @endif
            </tr>
            <tr>
                <td width="150"><b>@lang('backend.courses.label.who_this_course_is_for')</b></td>
                @if(!empty($course->who_this_course_is_for_points))
                    <td>
                        <ul>
                            @foreach($course->who_this_course_is_for_points as $point)
                                <li>{{ $point }}</li>
                            @endforeach
                        </ul>
                    </td>
                @else
                    <td>- - -</td>
                @endif
            </tr>
            <tr>
                <td width="150"><b>@lang('backend.courses.label.content')</b></td>
                <td>{!! $course->content ?? '- - -' !!}</td>
            </tr>
            <tr>
                <td width="150"><b>@lang('backend.courses.label.requirements')</b></td>
                <td>{!! $course->requirements ?? '- - -' !!}</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
