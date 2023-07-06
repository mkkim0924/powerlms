@if(in_array('become_a_teacher_section', config('layout_sections')))
    <section id="banner-5" class="bg-whitesmoke wide-60 pb-100 banner-section division">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="banner-5-txt h-100 ">
                        <img src="{{ asset('frontend-assets/files/images/image-04.png') }}" alt="banner-icon"/>
                        <div class="b5-txt d-flex flex-column h-100">
                            <h4 class="h4-xs mt-3 mt-sm-1">@lang('frontend.beacome_teacher_section.become_a_teacher_title') </h4>
                            @lang('frontend.beacome_teacher_section.become_a_teacher_note')

                                <a href="{{ route('becomeAInstructor') }}" class="btn btn-rose tra-black-hover mt-auto mt-md-0 mt-lg-auto align-self-start">@lang('frontend.beacome_teacher_section.find_out_more_button')</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="banner-5-txt h-100 ">
                        <img src="{{ asset('frontend-assets/files/images/image-05.png') }}" alt="banner-icon"/>
                        <div class="b5-txt flex-column d-flex h-100">
                            <h4 class="h4-xs mt-3 mt-sm-1">{{ config('app.name') }} @lang('frontend.beacome_teacher_section.for_business_text')</h4>
                            @lang('frontend.beacome_teacher_section.for_business_note')

                            <a href="{{ route('courses') }}" class="btn btn-rose tra-black-hover mt-auto mt-md-0 mt-lg-auto align-self-start">@lang('frontend.beacome_teacher_section.find_out_more_button')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
