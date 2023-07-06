@if(isset($widgets['promotional_section_two_widget']) && in_array('promotional_section_two_widget', config('layout_sections')))
    @php $sectionData = $widgets['promotional_section_two_widget'][0]; @endphp
    <section id="about-3" class="pt-80 about-section division">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-md-7 col-lg-6">
                    <div class="txt-block pc-25">
                        <h3 class="h3-sm">{{ $sectionData['title'][config('app.locale')] ?? ($sectionData['title'][$default_language_code] ?? "") }}</h3>
                        {!! $sectionData['description'][config('app.locale')] ?? ($sectionData['description'][$default_language_code] ?? "") !!}
                    </div>
                </div>
                <div class="col-md-5 col-lg-6">
                    <div class="img-block">
                        <img class="img-fluid" src="{{ getFileUrl($sectionData['image'], 'widgets') }}"
                             alt="about-image">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
