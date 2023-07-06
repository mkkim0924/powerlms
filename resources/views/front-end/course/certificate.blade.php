<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> @lang('frontend.certificate.certificate_title')</title>

    <style type="text/css">
        body {
            padding: 0;
            margin: 0;
        }
        @page {size: 700px 500px; margin:0!important; padding:0!important}
    </style>
</head>
<body style="background-image: url({{ getFileUrl(config('certificate_background_image'), 'logos') }}); background-size: contain;
    background-repeat: no-repeat; background-position: center;  position: relative; ">
<div style="font-size: 3rem;color: #232162;font-family: Roboto, sans-serif;width: 100%; text-align: center;position: absolute;left: 0;right: 0; top:4rem;
                 font-weight:bold;text-transform: uppercase; ">@lang('frontend.certificate.certificate_text')
</div>
<div style="font-size: 1.5rem;color: #232162;font-family: Roboto, sans-serif;width: 100%; text-align: center;position: absolute;left: 0;right: 0; top:8rem;
                 font-weight:normal;text-transform: uppercase;">@lang('frontend.certificate.of_completion_text')
</div>
<div style="font-size: 1rem;color: #232162;font-family: Roboto, sans-serif;width: 100%; text-align: center;position: absolute;left: 0;right: 0; top:12rem;
                 font-weight:normal;text-transform: uppercase;">@lang('frontend.certificate.this_certificate_presented_to_text')
</div>
<div style="font-size: 2.2rem;color: #232162;font-family: Muli, sans-serif;width: 100%; text-align: center;position: absolute;left: 0;right: 0; top:14rem;
                 font-weight: normal;font-style:italic;text-transform: capitalize;">{{ auth()->user()->name }}</div>
<div style="font-size: 1rem;color: #232162;font-family: Roboto, sans-serif;width: 100%; text-align: center;position: absolute;left: 0;right: 0; top:18rem;
                 font-weight: normal;">@lang('frontend.certificate.due_to_completion_of_this_course_text') <br> {{ $course->name }}</div>
<div style="width: 100%; text-align: center;position: absolute;left: 0;right: 0; top:20.5rem;
                 "><img src="{{ getFileUrl(config('logo'), 'logos') }}" alt="" style="width: 185px; height: auto;"></div>
<div style=" position: absolute;left: 25%; bottom: 4.5rem; color: #232162;font-size: 1.2rem;border-bottom: 1px solid #afafd6;font-family: Roboto, sans-serif;">{{ formatDate($courseUserDetail->certificate_date, 'd/m/Y') }}</div>
<div style=" position: absolute;left: 29%; bottom: 2.9rem; color: #232162;font-size: 1.2rem;font-family: Roboto, sans-serif;text-transform: capitalize;">@lang('frontend.certificate.date_label')</div>
<div style=" position: absolute;right: 25%; bottom: 4.5rem; color: #232162;font-size: 1.2rem;border-bottom: 1px solid #afafd6;font-family: Roboto, sans-serif;">
    <img src="{{ getFileUrl(config('certificate_signature_image'), 'logos') }}" alt="" style="width: 95px;height: auto;"></div>
<div style=" position: absolute;right: 26%; bottom: 2.9rem; color: #232162;font-size: 1.2rem;font-family: Roboto, sans-serif;text-transform: capitalize;">@lang('frontend.certificate.signature')</div>
</body>
</html>
