@if(in_array('website_feature_section', config('layout_sections')))
    <section id="services-6" class="bg-03 wide-60 services-section division">
        <div class="white-color container">
            <div class="row">
                <div class=" text-center @if(session('display_type')=='rtl') col-lg-10 mx-auto @else col-lg-10 offset-lg-1  @endif">
                    <div class="services-6-txt  @if(session('display_type')=='rtl') text-center  @endif">
                        <h3 class="h3-md">@lang('frontend.website_features_section.get_quality_education_with_title') {{ config('app.name') }}</h3>
                        @lang('frontend.website_features_section.get_quality_education_with_note')

                        <a href="{{ route('courses') }}" class="btn btn-md btn-rose tra-white-hover">
                            @lang('frontend.website_features_section.start_learning_now_button')</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="row">

                        <!-- SERVICE BOX #1 -->
                        <div class="sbox-6 icon-xl">
                            <span class="flaticon-031-select"></span>
                            <h5 class="h5-xs">@lang('frontend.website_features_section.trending_courses_logo_text')</h5>
                        </div>

                        <!-- SERVICE BOX #2 -->
                        <div class="sbox-6 icon-xl">
                            <span class="flaticon-028-learning-1"></span>
                            <h5 class="h5-xs">@lang('frontend.website_features_section.certified_teachers_logo_text')</h5>
                        </div>

                        <!-- SERVICE BOX #3 -->
                        <div class="sbox-6 icon-xl">
                            <span class="flaticon-006-diploma"></span>
                            <h5 class="h5-xs">@lang('frontend.website_features_section.graduation_certificate_logo_text')</h5>
                        </div>

                        <!-- SERVICE BOX #4 -->
                        <div class="sbox-6 icon-xl">
                            <span class="flaticon-013-elearning-5"></span>
                            <h5 class="h5-xs">@lang('frontend.website_features_section.online_course_facilities_logo_text')</h5>
                        </div>

                        <!-- SERVICE BOX #5 -->
                        <div class="sbox-6 icon-xl">
                            <span class="flaticon-001-book"></span>
                            <h5 class="h5-xs">@lang('frontend.website_features_section.free_books_library_logo_text')</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
