<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>

<!-- SITE TITLE -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ $meta['meta_title'] ?? config('meta_title') }}</title>
<meta name="author" content="Jthemes"/>
<meta name="description" content="{{ $meta['meta_description'] ?? config('meta_description') }}"/>
<meta name="keywords" content="{{ $meta['meta_keywords'] ?? config('meta_keywords') }}">
<!-- FAVICON AND TOUCH ICONS  -->
<link rel="shortcut icon" href="{{ getFileUrl(config('favicon_icon'), 'logos') }}" type="image/x-icon">
<link rel="icon" href="{{ getFileUrl(config('favicon_icon'), 'logos') }}" type="image/x-icon">

<!-- GOOGLE FONTS -->
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Muli:400,600,700,800,900&display=swap" rel="stylesheet">

<!-- BOOTSTRAP CSS -->
<link href="{{ asset('frontend-assets/files/css/bootstrap.min.css') }}" rel="stylesheet">

<!-- FONT ICONS -->
<link href="https://use.fontawesome.com/releases/v5.11.0/css/all.css" rel="stylesheet" crossorigin="anonymous">
<link href="{{ asset('frontend-assets/files/css/flaticon.css') }}" rel="stylesheet">

<!-- PLUGINS STYLESHEET -->
<link href="{{ asset('frontend-assets/files/css/menu.css') }}" rel="stylesheet">
<link id="effect" href="{{ asset('frontend-assets/files/css/dropdown-effects/fade-down.css') }}" media="all"
      rel="stylesheet">
<link href="{{ asset('frontend-assets/files/css/magnific-popup.css') }}" rel="stylesheet">
<link href="{{ asset('frontend-assets/files/css/flexslider.css') }}" rel="stylesheet">
<link href="{{ asset('frontend-assets/files/css/owl.carousel.min.css') }}" rel="stylesheet">
<link href="{{ asset('frontend-assets/files/css/owl.theme.default.min.css') }}" rel="stylesheet">


<!-- ON SCROLL ANIMATION -->
<link href="{{ asset('frontend-assets/files/css/animate.css') }}" rel="stylesheet">

<!-- ROOT COLOR CSS -->
<link href="{{ asset('frontend-assets/files/css/color.css') }}" rel="stylesheet">

<!-- TEMPLATE CSS -->
<link href="{{ asset('frontend-assets/files/css/style.css') }}" rel="stylesheet">

<!-- RESPONSIVE CSS -->
<link href="{{ asset('frontend-assets/files/css/responsive.css') }}" rel="stylesheet">
<link href="{{ asset('frontend-assets/css/custom.css') }}" rel="stylesheet">

{{-- VAlidation CSS --}}
<link href="{{ asset('admin-assets/assets/extra-libs/jquery-form-validator/jquery.form-validator.min.css') }}"
      rel="stylesheet"/>

@if(!empty(config('google_tag_manager_code')))
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{config('google_tag_manager_code') }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', '{{config('google_tag_manager_code')}}');
    </script>
@endif
