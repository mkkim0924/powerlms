@if(count($blogs) > 0 && in_array('blogs_section', config('layout_sections')))
    <section id="news-2" class="wide-60 news-section division">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title mb-70">
                        <h3 class="h3-sm">@lang('frontend.our_stories_and_news_section.our_stories_latest_news_title')</h3>
                        @lang('frontend.our_stories_and_news_section.our_stories_latest_news_note')

                        @if(count($blogs) > 4)
                            <div class="title-btn">
                                <a href="{{ route('blogs') }}" class="btn btn-tra-grey rose-hover">@lang('frontend.our_stories_and_news_section.read_more_stories_button')</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row d-flex align-items-center">
                @foreach($blogs->take(4) as $blog)
                    <div class="col-md-6 col-lg-3">
                        <div id="a2-1" class="article-2 b-right">
                            <p class="p-sm">{{ formatDate($blog->created_at, 'M d, Y') }}</p>
                            <h5 class="h5-sm"><a href="{{ route('blog_detail', $blog->slug) }}">{{ $blog->title }}</a>
                            </h5>
                            <p>{{ str_limit(strip_tags($blog->content), 250) }}</p>
                            <span>@lang('frontend.our_stories_and_news_section.by_text') {{ $blog->author_name }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
