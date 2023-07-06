<div class="form-group">
    <label>@lang('backend.courses.label.intro_video_provider')</label>
    {!! Form::select('intro_video_provider', \App\Models\Course::VIDEO_PROVIDER, $course->intro_video_provider ?? old('intro_video_provider'), [
        'class' => 'form-control select2Search',
        'id' => 'intro_video_provider',
    ]) !!}
</div>
<div class="form-group" id="intro_video_url_div" @if(isset($course) && ($course->intro_video_provider == 'video_file')) style="display: none" @endif>
    <label>@lang('backend.courses.label.intro_video_url')</label>
    {!! Form::text('intro_video_url', (!empty($course->intro_video_provider) && $course->intro_video_provider != 'video_file') && !empty($course->intro_video_url) ?  $course->intro_video_url : old('intro_video_url'), [
        'class' => 'form-control',
        'id' => 'intro_video_url',
    ]) !!}
    @lang('backend.courses.label.intro_video_url_help_text')
</div>

<div class="row">
    <div class="col-sm-6" id="video_file_div" @if(!isset($course) || (!empty($course->intro_video_provider) && $course->intro_video_provider != 'video_file')) style="display: none" @endif>
        <div class="form-group">
            <label>@lang('backend.chapters.media.label.video_file')</label>
            <input type="file" accept="video/*" class="dropify" data-show-remove="false"
                   data-allowed-file-extensions="mp4"
                   name="intro_video_url"
                   @if ((!empty($course->intro_video_provider) && $course->intro_video_provider == 'video_file') && !empty($course->intro_video_url)) data-default-file="{{ getFileUrl($course->intro_video_url, 'course/video') }}"@endif
                   id="video_file">
            @lang('backend.courses.label.upload_video_help_text')
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>@lang('backend.courses.label.intro_thumbnail_image')
                ({{ \App\Models\Course::THUMBNAIL_IMAGE_DIMENSION['width'] }}
                x{{ \App\Models\Course::THUMBNAIL_IMAGE_DIMENSION['height'] }})</label>
            <input type="file" accept="image/*" class="dropify" data-show-remove="false"
                   data-allowed-file-extensions="png jpg jpeg svg"
                   @if (!empty($course->intro_thumbnail_image)) data-default-file="{{ getFileUrl($course->intro_thumbnail_image, 'course/thumbnail_images') }}"
                   @endif name="intro_thumbnail_image"
                   id="intro_thumbnail_image">
        </div>
    </div>
</div>
