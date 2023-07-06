<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon icon -->
    <link rel="icon" href="{{ getFileUrl(config('favicon_icon'), 'logos') }}" type="image/x-icon">
    <title>{{ config('meta_title') }}</title>
    <meta name="author" content="Jthemes"/>
    <meta name="description" content="{{ config('meta_description') }}"/>
    <meta name="keywords" content="{{ config('meta_keywords') }}">
    <!-- Custom CSS -->
    <link href="{{ asset('admin-assets/dist/css/style.min.css') }}" rel="stylesheet">
</head>

<body>
<div class="main-wrapper">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Login box.scss -->
    <!-- ============================================================== -->
    <div class="error-box">
        <div class="error-body text-center">
            <h1 class="error-title">500</h1>
            <h3 class="text-uppercase error-subtitle">INTERNAL SERVER ERROR !</h3>
            <p class="text-muted my-3">{{ $exception->getMessage() }}</p>
        </div>
    </div>
</div>
<script src="{{ asset('frontend-assets/plugins/touchpdf-master/jquery.min.js') }}"></script>
<script src="{{ asset('admin-assets/assets/libs/popper.js/dist/popper.min.js') }}"></script>
<script src="{{ asset('frontend-assets/files/js/bootstrap.min.js') }}"></script>
<script>
    $(".preloader").fadeOut();
</script>
</body>

</html>
