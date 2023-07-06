<div id="menu-details" class="menu-details">
    <div id="search-megaMenu">
        @php
            $width = 100;
            if (count($courses) > 0 && count($webinars) > 0 && count($bundles) > 0){
                $width = 33.33;
            }elseif((count($courses) > 0 && count($webinars) > 0) || (count($courses) > 0 && count($bundles) > 0) || (count($webinars) > 0 && count($bundles) > 0)){
                $width = 50;
            }
        @endphp
        @if(count($courses) > 0 || count($webinars) > 0 || count($bundles) > 0)
            <div class="menu-innerItem show">
                <div class="align-items-start">
                    <div class="nav nav-pills" id="search-megamenu-tab" role="tablist">
                        <a class="nav-link text-center border-btm @if(count($courses) > 0) active @endif"
                           style="width: {{ $width }}%"
                           id="search-megamenu-course-tab" data-bs-toggle="pill" href="#search-megamenu-course" role="tab"
                           aria-controls="course" aria-selected="true"> @lang('frontend.search.courses_tab_text')</a>
                        @if(count($webinars) > 0)
                            <a class="nav-link text-center border-btm @if(count($courses) == 0 && count($webinars) > 0) active @endif"
                               style="width: {{ $width }}%"
                               id="search-megamenu-webinar-tab" data-bs-toggle="pill" href="#search-megamenu-webinar" role="tab"
                               aria-controls="webinar" aria-selected="false">@lang('frontend.search.webinars_tab_text')</a>
                        @endif
                        @if(count($bundles) > 0)
                            <a class="nav-link text-center border-btm @if(count($courses) == 0 && count($webinars) == 0 && count($bundles) > 0) active @endif"
                               style="width: {{ $width }}%"
                               id="search-megamenu-bundle-tab" data-bs-toggle="pill" href="#search-megamenu-bundle" role="tab"
                               aria-controls="bundle" aria-selected="false">@lang('frontend.search.bundles_tab_text')</a>
                        @endif
                    </div>
                    <div class="tab-content tab-content-megamenu" id="v-pills-tabContent">
                        @if(count($courses) > 0)
                            <div class="tab-pane fade @if(count($courses) > 0) active show @endif" id="search-megamenu-course"
                                 role="tabpanel" aria-labelledby="search-megamenu-course-tab">
                                <div class="tabcontent-main tab-scroll">
                                    <div class="row mx-auto">
                                        @foreach($courses as $course)
                                            <div class="col-12 col-md-6 py-2">
                                                <a href="{{ route('course_detail', $course->slug) }}">
                                                    <div class="search-course-inner gap-3 d-flex p-1">
                                                        <div class="col-3 icon-bg">
                                                            <img
                                                                src="{{ getFileUrl($course->image, 'course/images') }}"
                                                                alt="{{ $course->name }}" width="50px"
                                                                height="50px">
                                                        </div>
                                                        <div class="col-9">
                                                            <p class="mb-0 search-item-title">{{ str_limit($course->name, 40) }}</p>
                                                            <div
                                                                class="d-flex search-course-badge pb-1 align-items-center">
                                                                <span class="course-price">
                                                                    @if($course->is_free == 1)
                                                                        @lang('frontend.vertical_course_card.free_course_text')
                                                                    @elseif($course->discount_flag == 1)
                                                                        <span
                                                                            class="old-price">{{ formatPrice($course->price) }}</span>
                                                                        {{ formatPrice($course->discounted_price) }}
                                                                    @else
                                                                        {{ formatPrice($course->price) }}
                                                                    @endif
                                                                    {{ $course->course_id }}
                                                                </span>
                                                            </div>
                                                            <div class="d-flex mb-1 search-ratings">
                                                                <div class="course-rating clearfix">
                                                                    {!! getStarRatingHtml($course->average_rating) !!}
                                                                </div>
                                                                <span
                                                                    class="mx-1 ps-1">{{ $course->average_rating }}</span>
                                                                <span
                                                                    class="mx-1"> ({{ $course->total_reviews }})</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if(count($webinars) > 0)
                            <div
                                class="tab-pane fade @if(count($courses) == 0 && count($webinars) > 0) active show @endif"
                                id="search-megamenu-webinar" role="tabpanel" aria-labelledby="search-megamenu-webinar-tab">
                                <div class="tabcontent-main tab-scroll">
                                    <div class="row mx-auto">
                                        @foreach($webinars as $webinar)
                                            <div class="col-12 col-md-6 py-2">
                                                <a href="{{ route('webinar_detail', $webinar->slug) }}">
                                                    <div class="search-course-inner gap-3 d-flex p-1">
                                                        <div class="col-3 icon-bg">
                                                            <img src="{{ getFileUrl($webinar->image, 'webinar') }}"
                                                                 alt="{{ $webinar->name }}"
                                                                 width="50px"
                                                                 height="50px">
                                                        </div>
                                                        <div class="col-9">
                                                            <p class="mb-0 search-item-title">{{ str_limit($webinar->name, 40) }}</p>
                                                            @if(new DateTime() > new DateTime($webinar->start_at) && new DateTime() < new DateTime($webinar->end_at))
                                                                <p class="head-txt-blue">@lang('frontend.search.live_label')</p>
                                                            @elseif(new DateTime() > new DateTime($webinar->end_at))
                                                                <p class="head-txt-blue">@lang('frontend.search.recorded_label')</p>
                                                            @else
                                                                <p class="head-txt-blue">@lang('frontend.search.upcoming_label')</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if(count($bundles) > 0)
                            <div
                                class="tab-pane fade @if(count($courses) == 0 && count($webinars) == 0 && count($bundles) > 0) active show @endif"
                                id="search-megamenu-bundle" role="tabpanel" aria-labelledby="search-megamenu-bundle-tab">
                                <div class="tabcontent-main tab-scroll">
                                    <div class="row mx-auto">
                                        @foreach($bundles as $bundle)
                                            <div class="col-12 col-md-6 py-2">
                                                <a href="{{ route('bundle_detail', $bundle->slug) }}">
                                                    <div class="search-course-inner gap-3 d-flex p-1">
                                                        <div class="col-3 icon-bg">
                                                            <img
                                                                src="{{ getFileUrl($bundle->image, 'bundle') }}"
                                                                alt="{{ $bundle->name }}" width="50px"
                                                                height="50px">
                                                        </div>
                                                        <div class="col-9">
                                                            <p class="mb-0 search-item-title">{{ str_limit($bundle->name, 40) }}</p>
                                                            <div
                                                                class="d-flex search-course-badge pb-1 align-items-center">
                                                                <span
                                                                    class="course-price">{{ formatPrice($bundle->price) }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @else
            <div class="row mx-1">
                <div class="alert alert-danger fw-400 text-center">@lang('frontend.search.no_record_found_text')</div>
            </div>
        @endif
    </div>
</div>
