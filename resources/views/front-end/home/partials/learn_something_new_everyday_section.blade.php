@php $sectionData = $widgets['promotional_section_three_widget'][0] ?? null; @endphp
@if (!empty($sectionData))
    <section id="banner-3" class="bg-lightdark bg-map banner-section division">
        <div class="container">
            <div class="banner-3-holder bg-lightgrey">
                <div class="row d-flex align-items-center">
                    <div class="col-lg-8">
                        <div class="banner-3-img">
                            <img class="img-fluid" src="{{ getFileUrl($sectionData['image'], 'widgets') }}"
                                alt="banner-image" />
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="banner-3-txt">
                            {!! $sectionData['description'][config('app.locale')] ?? ($sectionData['description'][$default_language_code] ?? '') !!}
                            <a href="{{ route('courses') }}" class="btn btn-rose tra-black-hover">@lang('frontend.learn_something_new_everyday_section.find_out_more_button')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
