@extends('front-end.layouts.master')

@section('content')
    <div id="breadcrumb" class="division">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('frontend.blogs.breadcrumb_item.home')</a></li>
                            @if(\Illuminate\Support\Facades\Route::currentRouteName() == 'blog_category_detail')
                                <li class="breadcrumb-item"><a href="{{ route('blogs') }}">@lang('frontend.blogs.breadcrumb_item.all_blogs')</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $blog_category->name }}</li>
                            @else
                                <li class="breadcrumb-item active" aria-current="page">@lang('frontend.blogs.breadcrumb_item.blog_listing')</li>
                            @endif
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <section id="news-3" class="pt-100 news-section division">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="posts-holder pr-25">
                        @foreach($blogs as $blog)
                            <div class="article-3 row d-flex align-items-center b-bottom">
                                <!-- Article Preview -->
                                <div class="col-md-4">
                                    <img class="img-fluid" src="{{ getFileUrl($blog->image, 'blog') }}"
                                         alt="article-preview">
                                </div>
                                <div class="col-md-8">
                                    <h4 class="h4-sm">
                                        <a href="{{ route('blog_detail', $blog->slug) }}">{{ $blog->title }}</a>
                                    </h4>
                                    <span>{{ formatDate($blog->created_at, 'M d, Y') }} - @lang('frontend.blogs.by_text') {{ $blog->author_name }}
                                        </span>
                                    <p>{{ str_limit(strip_tags($blog->content), 250) }}
                                    </p>
                                    <div class="tags-cloud">
                                        <span class="badge"><a
                                                href="{{ route('blog_category_detail', $blog->categoryDetail->slug) }}">{{ $blog->categoryDetail->name }}</a></span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if($blogs->total() > 10)
                        <div class="page-pagination division">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        {!! $blogs->links("pagination.html") !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <aside id="sidebar" class="col-lg-3">
                    <div class="blog-categories sidebar-div mb-50">
                        <ul class="blog-category-list clearfix">
                            @foreach($blog_categories as $blog_category)
                                <li>
                                    <a href="{{ route('blog_category_detail', $blog_category->slug) }}">{{ $blog_category->name }}</a>
                                    <span>({{ $blog_category->relatedBlogs->count() }})</span></li>
                            @endforeach
                        </ul>
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection
