@extends('front-end.layouts.master')
@section('content')
    @php
        $meta['meta_title'] = $blog->meta_title ?? null;
        $meta['meta_description'] = $blog->meta_description ?? null;
        $meta['meta_keywords'] = $blog->meta_keywords ?? null;
    @endphp
    <div id="breadcrumb" class="division">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('frontend.blog_details.breadcrumb_item.home')</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('blogs') }}">@lang('frontend.blog_details.breadcrumb_item.back_to_blog')</a></li>
                            <li class="breadcrumb-item active"
                                aria-current="page">{{ str_limit($blog->title, 30) }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <section id="single-post" class="wide-80 single-post-section division">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="single-post-wrapper">
                        <div class="single-post-title mb-35 text-center">
                            <h3 class="h3-md">{{ $blog->title }}</h3>
                            <div class="single-post-data">
                                <p>@lang('frontend.blog_details.posted_by_text') {{ $blog->author_name }} @lang('frontend.blog_details.posted_by_text') {{ formatDate($blog->created_at, 'M d, Y') }}
                                    @lang('frontend.blog_details.in_text') <a href="{{ route('blog_category_detail', $blog->categoryDetail->slug) }}">
                                        {{ $blog->categoryDetail->name }}</a>
                                </p>
                            </div>
                        </div>

                        {!! $blog->content !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if(count($relatedBlogs) > 0)
        <section id="news-2" class="bg-whitesmoke wide-60 news-section division">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title mb-60">
                            <h4 class="h4-sm">@lang('frontend.blog_details.related_posts_title') :</h4>
                        </div>
                    </div>
                </div>
                <div class="row d-flex align-items-center">
                    @foreach($relatedBlogs as $relatedBlog)
                        <div class="col-md-6 col-lg-3">
                            <div id="a2-1" class="article-2 b-right">
                                <p class="p-sm">{{ formatDate($relatedBlog->created_at, 'M d, Y') }}</p>
                                <h5 class="h5-sm"><a
                                        href="{{ route('blog_detail', $relatedBlog->slug) }}">{{ $relatedBlog->title }}</a>
                                </h5>
                                <p>{{ str_limit(strip_tags($relatedBlog->content), 100) }}</p>
                                <span>@lang('frontend.blog_details.posted_by_text') {{ $relatedBlog->author_name }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
