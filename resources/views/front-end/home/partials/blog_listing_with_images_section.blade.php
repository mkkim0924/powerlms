@if(count($blogs) > 0)
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title mb-60">
                    <h4 class="h4-xl">@lang('frontend.blog_listing_with_images_section.our_stories_latest_news_title')</h4>
                    @lang('frontend.blog_listing_with_images_section.our_stories_latest_news_note')

                    @if(count($blogs) > 8)
                        <div class="title-btn">
                            <a href="{{ route('blogs') }}" class="btn btn-tra-grey rose-hover">@lang('frontend.blog_listing_with_images_section.read_more_stories_button')</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row news-grid">
        @foreach($blogs->take(8) as $blog)
            <div class="col-sm-6 col-lg-4 col-xl-3">
                <div class="article-1">
                    <a href="{{ route('blog_detail', $blog->slug) }}">
                        <div class="hover-overlay">
                            <img class="img-fluid" src="{{ getFileUrl($blog->image, 'blog') }}"
                                 alt="article-preview">
                            <div class="item-overlay"></div>
                        </div>
                        <div class="article-meta">
                            <h5 class="h5-md"><span>{{ $blog->title }}</span>
                            </h5>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endif
