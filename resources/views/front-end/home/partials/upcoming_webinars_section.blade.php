@if(count($upcomingWebinars) > 0 && in_array('upcoming_webinar_section', config('layout_sections')))
    <section class="wide-60 courses-section webinar-desktop-5 division ">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title mb-5">
                        <h3 class="h3-sm">@lang('frontend.upcoming_webinars_section.upcoming_webinars_title')</h3>
                        @lang('frontend.upcoming_webinars_section.upcoming_webinars_note')

                    </div>
                </div>
                <div class="owl-carousel owl-theme  webinar-carousel owl-loaded  py-3">
                    @foreach($upcomingWebinars as $webinar)
                        <a href="{{ route('webinar_detail', $webinar->slug) }}">
                            <div class="item text-white me-3">
                                <div class="sbox-5 bg-05">
                                    <div class="sbox-5-txt">
                                        <h5 class="h5-md text-white">{{ str_limit($webinar->name, 65) }}</h5>
                                        <p class="grey-color text-white  py-2 text-start "><i
                                                class="fas fa-user text-white "></i><span
                                                class="mx-2 text-white">{{ $webinar->instructorDetail->name ?? "" }}</span>
                                        </p>
                                        <p class=" py-2 text-start"><i
                                                class="fas fa-calendar-alt"></i><span class="mx-2">{{ formatDate($webinar->start_at, 'd/m/Y') }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif
