@extends('front-end.layouts.master')

@section('content')
<div class="inner-page-wrapper">
    <div id="breadcrumb" class="division">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a
                                    href="{{ route('home') }}">@lang('frontend.instructor_list.breadcrumb_item.home')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                @lang('frontend.instructor_list.breadcrumb_item.our_instructors')</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <section id="team-1" class="wide-60 team-ection division">
        <div class="container">
            <div class="row">
                @foreach ($instructors as $item)
                @php $links = json_decode($item['social_links']); @endphp
                <div class="col-sm-6 col-lg-3">
                    <div class="team-member">
                        <div class="team-member-photo clearfix">
                            <img class="img-fluid" style="height: 200px" alt="image"
                                src="{{ getFileUrl($item->image ?? 'default-placeholder.jpg', 'users') }}" />
                            <div class="tm-social clearfix">
                                <ul class="text-center clearfix">
                                    @if (isset($links->facebook))<li><a href="{{ $links->facebook }}" target="_blank"
                                            class="ico-facebook"><i class="fab fa-facebook-f"></i></a></li> @endif
                                    @if (isset($links->twitter))<li><a href="{{ $links->twitter }}"  target="_blank"
                                            class="ico-twitter"><i class="fab fa-twitter"></i></a></li> @endif
                                    @if (isset($links->linkedin)) <li><a href="{{ $links->linkedin }}"  target="_blank"
                                            class="ico-linkedin"><i class="fab fa-linkedin"></i></a></li> @endif
                                </ul>
                            </div>
                        </div>
                        <a href="{{ route('instructor.details', encrypt(['id' => $item->id])) }}">
                            <div class="tm-meta">
                                <h5 class="h5-md">{{ $item->name }}</h5>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @if($instructors->total() > 12)
    <div class="page-pagination division">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    {!! $instructors->links("pagination.html") !!}
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
