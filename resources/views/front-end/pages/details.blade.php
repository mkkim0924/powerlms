@extends('front-end.layouts.master')
@section('content')
    @php
    $meta['meta_title'] = $page->meta_title ?? null;
    $meta['meta_description'] = $page->meta_description ?? null;
    $meta['meta_keywords'] = $page->meta_keywords ?? null;
    @endphp
    <div id="breadcrumb" class="division">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('frontend.page_details.breadcrumb_item.home')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $page->name }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <section class="bg-05 page-hero-section division">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="hero-txt white-color">
                        <h3 class="h3-xs">{{ $page->name }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="courses-3" class="wide-60 courses-section division">
        <div class="container">
            {!! $page->content !!}
        </div>
    </section>
@endsection
