@if(isset($widgets['video_promotion_section_widget']) && in_array('video_promotion_section_widget', config('layout_sections')))
    @php $sectionData = $widgets['video_promotion_section_widget'][0]; @endphp
    <section id="video-1" class="bg-lightgrey bg-map video-ection division">
        <div class="container">
            <div class="video-1-holder">
                <div class="row d-flex align-items-center">
                    <div class="col-md-6">
                        <div class="video-link text-center">
                            <div class="play-btn play-btn-rose text-center">
                                @if(!empty($sectionData['video_url']))
                                    <a class="video-popup3 video-play-button"
                                       href="{{ $sectionData['video_url'] }}">
                                        <span></span>
                                    </a>
                                @endif
                                <img class="img-fluid" src="{{ getFileUrl($sectionData['image'], 'widgets') }}"
                                     alt="video-preview">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="video-txt">
                            <h4 class="h4-xl">{{ $sectionData['title'][config('app.locale')] ?? ($sectionData['title'][$default_language_code] ?? "") }}</h4>
                            {!! $sectionData['description'][config('app.locale')] ?? ($sectionData['description'][$default_language_code] ?? "") !!}
                            <a href="{{ route('courses') }}" class="btn btn-tra-rose rose-hover">@lang('frontend.video_section.find_out_more_button')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
