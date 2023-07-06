@if(in_array('our_goal_or_vision_section_widget', config('layout_sections')))
    <section id="about-4" class="wide-70 about-section division">
        <div class="container">
            @if(isset($widgets['our_goal_or_vision_section_widget']))
                @php $sectionData = $widgets['our_goal_or_vision_section_widget'][0]; @endphp
                <div class="row">
                    <div class="  @if(session('display_type')=='rtl') col-xl-10 mx-auto @else col-xl-10  offset-xl-1 @endif">
                        <div class="a4-txt @if(session('display_type')=='rtl') text-center  @endif">
                            <h5 class="h5-xl text-center">{{ $sectionData['title'][config('app.locale')] ?? ($sectionData['title'][$default_language_code] ?? "") }}</h5>
                            {!! $sectionData['description'][config('app.locale')] ?? ($sectionData['description'][$default_language_code] ?? "") !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="img-block">
                            <img class="img-fluid" src="{{ getFileUrl($sectionData['image'], 'widgets') }}"
                                 alt="about-image">
                        </div>
                    </div>
                </div>
            @endif
            <div class="a4-boxes">
                <div class="row d-flex align-items-center">
                    <div class="col-md-4">
                        <div class="abox-4 icon-sm">
                            <span class="flaticon-004-computer"></span>
                            <div class="abox-4-txt">
                                <h5 class="h5-lg">@lang('frontend.our_goal_section.trusted_content_title')</h5>
                                @lang('frontend.our_goal_section.trusted_content_note')

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="abox-4 icon-sm">
                            <span class="flaticon-028-learning-1"></span>
                            <div class="abox-4-txt">
                                <h5 class="h5-lg">@lang('frontend.our_goal_section.certified_teachers_title')</h5>
                                @lang('frontend.our_goal_section.certified_teachers_note')

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="abox-4 icon-sm">
                            <span class="flaticon-032-tablet"></span>
                            <div class="abox-4-txt">
                                <h5 class="h5-lg">@lang('frontend.our_goal_section.lifetime_access_title')</h5>
                                @lang('frontend.our_goal_section.lifetime_access_note')

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
