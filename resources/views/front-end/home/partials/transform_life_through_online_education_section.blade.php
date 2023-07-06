@if(isset($widgets['promotional_section_one_widget']) && in_array('promotional_section_one_widget', config('layout_sections')))
    @php $sectionData = $widgets['promotional_section_one_widget'][0]; @endphp
    <section id="about-2" class="wide-60 about-section division">
        <div class="container">
            <div class="row d-flex align-items-center">
                <!-- ABOUT IMAGE -->
                <div class="col-md-5 col-lg-6">
                    <div class="img-block pc-25 mb-40">
                        <img class="img-fluid" src="{{ getFileUrl($sectionData['image'], 'widgets') }}"
                             alt="about-image">
                    </div>
                </div>
                <div class="col-md-7 col-lg-6">
                    <div class="txt-block pc-25 mb-40">
                        <h3 class="h3-sm">{{ $sectionData['title'][config('app.locale')] ?? ($sectionData['title'][$default_language_code] ?? "") }}</h3>
                        {!! $sectionData['description'][config('app.locale')] ?? ($sectionData['description'][$default_language_code] ?? "") !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
