@extends('front-end.layouts.master')
@section('content')
<div class="inner-page-wrapper">
    <div id="breadcrumb" class="division">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('frontend.instructor_details.breadcrumb_item.home')</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('instructor.list') }}">@lang('frontend.instructor_details.breadcrumb_item.all_instructor')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $instructor->name }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <section id="team-3" class="pt-100 team-section division">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="team-3-photo text-center">
                        <div class="t-3-photo mb-25">
                            <img class="img-fluid" alt="image"
                                src="{{ getFileUrl($instructor->image ?? 'default-placeholder.jpg', 'users') }}" />
                        </div>
                        <div class="tm-3-social clearfix">
                            <ul class="text-center clearfix">
                                @if (isset($links->facebook)) <li><a href="{{ $links->facebook}}"  target="_blank" class="ico-facebook"><i class="fab fa-facebook-f"></i></a></li> @endif
                                @if (isset($links->twitter)) <li><a href="{{ $links->twitter}}"  target="_blank" class="ico-twitter"><i class="fab fa-twitter"></i></a></li> @endif
                                @if (isset($links->linkedin)) <li><a href="{{ $links->linkedin}}"  target="_blank" class="ico-linkedin"><i class="fab fa-linkedin-in"></i></a></li> @endif
                            </ul>
                        </div>
                        <div class="t-3-links">
                            @if (isset($links->website)) <a href="{{ $links->website }}"  target="_blank" class="btn btn-md btn-tra-grey rose-hover">@lang('frontend.instructor_details.website_button')</a> @endif
                            <a href="mailto:{{ $instructor->email }}" class="btn btn-md btn-tra-grey rose-hover">{{ $instructor->email }}</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="team-3-txt pc-45">
                        <h3 class="h3-xs">{{ $instructor->name }}</h3>
                        <p class="teacher-data">{{ $total_students[0]['total_students'] ?? '--' }} {!! __('frontend.instructor_details.total_students_text',['courses' => count($instructor_course)],) !!}</p>
                        @if ($instructor->bio != null) <h5 class="h5-xl mt-40">@lang('frontend.instructor_details.about_me_title')</h5>
                        <p>{{ $instructor->bio }}</p> @endif
                        @if ($instructor->experience != null) <h5 class="h5-xl mt-40">@lang('frontend.instructor_details.experience_title')</h5>
                        <p>{{ $instructor->experience }}</p> @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="courses-3" class="pt-80 pb-60 courses-section division">
        @if (count($instructor_course) > 0)
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title mb-40">
                        <h5 class="h5-xl">@lang('frontend.instructor_details.my_courses_title')</h5>
                    </div>
                </div>
            </div>
            <div class="row courses-grid">
                @foreach ($instructor_course as $course)
                <div class="col-md-6 col-lg-4 col-xl-3">
                    @include('front-end.course.vertical_course_card', ['course' => $course])
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </section>
    @if($instructor_course->total() > 8)
    <div class="page-pagination division">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    {!! $instructor_course->links("pagination.html") !!}
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

@endsection
