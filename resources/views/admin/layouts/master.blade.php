<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" dir="{{ session('display_type') }}">

<head>
    @include('admin.layouts.partials.head')

    @include('admin.layouts.global.css')
    @yield('css')
    <script>
        var $app_url = "<?php echo e(url('/')); ?>";
        var $datatable_language_url = "https://cdn.datatables.net/plug-ins/1.10.20/i18n/{{ $locale_list[config('app.locale')] ?? 'English' }}.json";
        var $plugin_translations = {
            'dropify_default' : '{{ __('global.dropify.default') }}',
            'dropify_error' : '{{ __('global.dropify.error') }}',
            'dropify_remove' : '{{ __('global.dropify.remove') }}',
            'dropify_replace' : '{{ __('global.dropify.replace') }}',
            'select2_placeholder' : '{{ __('global.select2.placeholder') }}',
            'select2_empty_records' : '{{ __('global.select2.empty_records') }}',
            'button_next' : '{{ __('global.button.next') }}',
            'button_previous' : '{{ __('global.button.previous') }}',
            'button_finish' : '{{ __('global.button.finish') }}',
            'delete_confirmation_title' : '{{ __('global.delete_confirmation_modal.title') }}',
            'delete_confirmation_yes_btn' : '{{ __('global.delete_confirmation_modal.yes_button_text') }}',
            'delete_confirmation_no_btn' : '{{ __('global.delete_confirmation_modal.no_button_text') }}',
            'toastr_success_text' : '{{ __('global.toastr.success_text') }}',
            'toastr_error_text' : '{{ __('global.toastr.error_text') }}',
            'toastr_warning_text' : '{{ __('global.toastr.warning_text') }}',
        }
    </script>
</head>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper" class="boxed-layout">
        @include('admin.layouts.partials.header')
        @if (request()->user_type == 'admin')
            @include('admin.layouts.partials.nav')
        @elseif(request()->user_type == 'instructor' && auth()->user()->instructor_application_status == 1)
            @include('admin.layouts.partials.instructor_navbar')
        @endif
        <div @if(!Request::is('admin/translations') && !Request::is('admin/translations/*')) class="page-wrapper" @endif>
            @yield('admin_content')
        </div>
    </div>
    @include('admin.layouts.partials.footer')
    @include('admin.layouts.global.js')
    <script>
        $(function () {
            'use strict';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.validate({
                modules: 'security, logic',
                scrollToTopOnError: false
            });

            @if (Session::has('success'))
            toastr.success("{{ \Illuminate\Support\Facades\Session::get('success') }}", $plugin_translations.toastr_success_text, {
                timeOut: 2000
            });
            @endif
            @if (Session::has('warning'))
            toastr.warning("{{ \Illuminate\Support\Facades\Session::get('warning') }}", $plugin_translations.toastr_warning_text, {
                timeOut: 2000
            });
            @endif
            @if (Session::has('error'))
            toastr.error("{{ \Illuminate\Support\Facades\Session::get('error') }}", $plugin_translations.toastr_error_text, {
                timeOut: 2000
            });
            @endif
        });
    </script>
    @yield('footer_scripts')
    <script type="text/javascript" src="{{ asset('admin-assets/modules/global.js') }}"></script>
</body>

</html>
