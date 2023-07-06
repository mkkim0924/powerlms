<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" dir="{{ session('display_type') }}">
<head>
    @include('front-end.layouts.partials.head')
    @stack('css')
    <script>
        var $app_url = "{{ url('/') }}";
        var $layout_type = "{{ session('display_type') }}";
    </script>
</head>
<body>
<div id="loader-wrapper">
    <div id="loading">
        <div id="loading-center">
            <div class="cssload-loading"><i></i><i></i><i></i><i></i></div>
        </div>
    </div>
</div>
<div id="page" class="page">
    @include('front-end.layouts.partials.nav')
    <div class="inner-page-wrapper">
        @yield('content')
    </div>
    @include('front-end.layouts.partials.footer')
</div>
@include('front-end.layouts.partials.footer-scripts')
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@stack('footer_scripts')
</body>
</html>
