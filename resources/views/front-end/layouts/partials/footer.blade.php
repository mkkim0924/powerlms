<footer id="footer-2" class="footer division noPrint">
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-lg-5 col-xl-4">
                <div class="footer-info mb-40">
                    <img src="{{ getFileUrl(config('logo'), 'logos') }}" width="172" height="40" alt="footer-logo">
                    @lang('frontend.footers.page_note')

                </div>
            </div>
            <div class="col-md-3 col-lg-3 col-xl-2">
                <div class="footer-links mb-40">
                    <h5 class="h5-md">@lang('frontend.footers.quick_links_title')</h5>
                    <ul class="foo-links clearfix">
                        <li><a href="{{ route('about') }}">@lang('frontend.footers.about_link') {{ config('app.name') }}</a></li>
                        <li><a href="{{ route('categories') }}">@lang('frontend.footers.courses_catalog_link')</a></li>
                        {{-- <li><a href="javascript:;">Our Testimonials</a></li> --}}
                        <li><a href="{{ route('blogs') }}">@lang('frontend.footers.from_the_blog_link')</a></li>
                        @foreach ($pages as $page)
                            <li><a href="{{ route('details', $page->slug) }}">{{ $page->name }}</a></li>
                        @endforeach
                        @if(auth()->check() && auth()->user()->type == 0)

                            <li class="nl-simple" aria-haspopup="true"><a href="{{ route('becomeAInstructor') }}">
                                @lang('frontend.footers.become_a_instructor_text')</a></li>
                        @endif
                    </ul>
                </div>
            </div>
            @if(count($categories) > 0)
                <div class="col-md-4 col-lg-4 col-xl-3">
                    <div class="footer-links mb-40">
                        <h5 class="h5-md">@lang('frontend.footers.popular_categories_title')</h5>
                        <ul class="clearfix">
                            @foreach ($categories->take(5) as $category)
                                <li><a href="{{ route('category_detail', $category->slug) }}">{{ $category->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            <div class="col-md-7 col-xl-3">
                <div class="mb-20">

                    <!-- Title -->
                    <h5 class="h5-md"> @lang('frontend.footers.need_help_get_in_touch_title')</h5>
                    @lang('frontend.footers.need_help_get_in_touch_note')

                    <a href="mailto:{{ config('contact_email') }}"
                       class="btn btn-rose tra-rose-hover">{{ config('contact_email') }}</a>
                </div>
            </div>
        </div>

        <div class="bottom-footer">
            <div class="row">
                <div class="col-lg-8">
                    <ul class="bottom-footer-list">
                        <li>
                            <p>&copy; @lang('frontend.footers.copyright_text') {{ config('name') }} {{ date('Y') }}</p>
                        </li>
                        <li>
                            <p><a href="tel:{{ config('contact_no') }}">{{ config('contact_no') }}</a></p>
                        </li>
                        <li>
                            <p class="last-li">
                                <a href="mailto:{{ config('contact_email') }}">{{ config('contact_email') }}</a>
                            </p>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-4 text-right">
                    <ul class="foo-socials clearfix text-center">
                        @if (config('facebook_link'))
                            <li><a href="{{ config('facebook_link') }}" target="_blank" class="ico-facebook">
                                    <i class="fab fa-facebook-f"></i></a>
                            </li>
                        @endif
                        @if (config('youtube_link'))
                            <li><a href="{{ config('youtube_link') }}" target="_blank" class="ico-youtube">
                                    <i class="fab fa-youtube"></i></a></li>
                        @endif
                        @if (config('instagram_link'))
                            <li><a href="{{ config('instagram_link') }}" target="_blank" class="ico-instagram"><i
                                        class="fab fa-instagram"></i></a></li>
                        @endif
                        @if (config('linkedin_link'))
                            <li><a href="{{ config('linkedin_link') }}" target="_blank" class="ico-linkedin"><i
                                        class="fab fa-linkedin-in"></i></a></li>
                        @endif
                        @if (config('twitter_link'))
                            <li><a href="{{ config('twitter_link') }}" target="_blank" class="ico-twitter"><i
                                        class="fab fa-twitter"></i></a></li>
                        @endif
                        @if (config('telegram_link'))
                            <li><a href="{{ config('telegram_link') }}" target="_blank" class="ico-telegram"><i
                                        class="fab fa-telegram"></i></a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
