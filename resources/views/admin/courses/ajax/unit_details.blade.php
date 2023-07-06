<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-lg-4 col-6 d-flex align-items-center">
                <h2 class="card-title">@lang('backend.courses.header.chapter_details')</h2>
            </div>
            @if($unit->courseDetail->course_status == 2)
                <div class="col lg 4">
                <span class="pull-right d-inline-block @if(session('display_type')=='rtl') float-left @else float-right @endif">
                     <a href="javascript:;"
                        class="btn waves-effect waves-light btn-rounded btn-outline-success curriculumReview"
                        data-id="{{ $curriculum->id }}">
                        <i class="fa fa-plus" aria-hidden="true"></i>@lang('backend.courses.button.add_review')
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
                <td>{{ $unit->name ?? "- - -" }}</td>
            </tr>
            <tr>
                <td width="150"><b>@lang('backend.courses.label.slug')</b></td>
                <td>{{ $unit->slug ?? "- - -" }}</td>
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
                <td width="150"><b>@lang('backend.courses.label.lesson_type')</b></td>
                <td>{{ isset($unit->lesson_type) ? \App\Models\Units::LESSON_TYPES[$unit->lesson_type] : "- - -" }}</td>
            </tr>
            <tr>
                <td width="150"><b>@lang('backend.courses.label.lesson_media_url')</b></td>
                <td>{{ $unit->lesson_media_url ?? "- - -" }}</td>
            </tr>
            <tr>
                <td width="150"><b>@lang('backend.courses.label.lesson_thumbnail_image')</b></td>
                @if(isset($unit->lesson_thumbnail_image))
                    <td><input type="file" class="dropify" disabled="disabled" data-default-file="{{ getFileUrl($unit->lesson_thumbnail_image, 'unit/thumbnail_images') }}"></td>
                @else
                    <td>- - -</td>
                @endif
            </tr>
            <tr>
                <td width="150"><b>@lang('backend.courses.label.time')</b></td>
                <td>{{ $unit->time ?? "- - -" }}</td>
            </tr>
            <tr>
                <td width="150"><b>@lang('backend.courses.label.is_free_unit')</b></td>
                <td>{{ ($unit->free_lesson == 1) ? 'Yes' : 'No' }}</td>
            </tr>
            <tr>
                <td width="150"><b>@lang('backend.courses.label.short_content')</b></td>
                <td>{{ $unit->short_content ?? "- - -" }}</td>
            </tr>
            <tr>
                <td width="150"><b>@lang('backend.courses.label.content')</b></td>
                <td>{!! $unit->content ?? "- - -" !!}</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
