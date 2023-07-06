@extends('front-end.layouts.master')
@section('content')
    <div id="breadcrumb" class="division">
        <div class="container">
            <div class="row">
                <!-- BREADCRUMB NAV -->
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('frontend.category_details.breadcrumb_item.home')</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('categories') }}">@lang('frontend.category_details.breadcrumb_item.all_categories')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <section class="bg-05 page-hero-section division">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="hero-txt white-color">

                        <!-- Title -->
                        <h3 class="h3-xs">{{ $category->name }} @lang('frontend.category_details.courses_header_text')</h3>

                        <!-- Share Icons -->
                        <div class="share-list">
                            <ul class="share-social-icons text-center clearfix">
                                <li>
                                    {!! __('frontend.category_details.found_text', ['courses' => config('statistics.online_courses'), ]) !!}
                                </li>
                            </ul>
                        </div>
                        <p>{!! __('frontend.category_details.learning_online_text', ['students' => config('statistics.students'), ]) !!}{{ config('app.name') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="courses-3" class="wide-60 courses-section division">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title mb-40">
                        <h4 class="h4-xl">@lang('frontend.category_details.all_courses_title')</h4>
                        @lang('frontend.category_details.all_courses_note')

                    </div>
                </div>
            </div>
            <div class="row courses-grid">
                @foreach($courses as $course)
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        @include('front-end.course.vertical_course_card', ['course' => $course])
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @if($courses->total() > 8)
        <div class="page-pagination division">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        {!! $courses->links("pagination.html") !!}
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if(count($bundles) > 0)
        <section id="courses-1" class="wide-100 courses-section division">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title mb-40">
                            <!-- Title 	-->
                            <h4 class="h4-xl">@lang('frontend.category_details.bundles_title')</h4>
                            @lang('frontend.category_details.bundles_note')
                        </div>
                    </div>
                </div>
                <!-- COURSE BOXES CAROUSEL -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="owl-carousel owl-theme owl-loaded courses-carousel">
                            @foreach($bundles as $bundle)
                                @include('front-end.bundle.bundle_card', ['bundle' => $bundle])
                            @endforeach
                        </div>
                    </div>
                </div> <!-- END COURSES BOXES CAROUSEL -->
            </div> <!-- End container -->
        </section>
    @endif
    @include('front-end.home.partials.learn_something_new_everyday_section')
@endsection
