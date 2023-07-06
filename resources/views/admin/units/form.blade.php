@include('admin.layouts.partials.flash_messages')
<div id="wizard2">
    <h3>@lang('backend.chapters.label.basic_info')</h3>
    <section>
        @include('admin.units.tabs.general')
    </section>
    <h3>@lang('backend.chapters.label.media')</h3>
    <section>
        @include('admin.units.tabs.media')
    </section>
    <h3>@lang('backend.chapters.label.attachments')</h3>
    <section>
        @include('admin.units.tabs.attachments')
    </section>
    <h3>@lang('backend.chapters.label.faq')</h3>
    <section>
        @include('admin.units.tabs.faqs')
    </section>
</div>
@section('css')
    <link href="{{ asset('admin-assets/assets/extra-libs/jquery-steps/jquery.steps.css') }}" rel="stylesheet">
    <link href="{{ asset('admin-assets/assets/libs/bootstrap-datepicker/dist/bootstrap-timepicker.min.css') }}"
          rel="stylesheet">
@endsection
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('admin-assets/assets/extra-libs/jquery-steps/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('admin-assets/assets/libs/bootstrap-datepicker/dist/js/bootstrap-timepicker.min.js') }}"></script>
    <script type="text/javascript">
        var is_edit = "{{ isset($unit) ? true : false }}";
        var getSectionByCourseURL = "{{ route(request()->user_type.'.getSectionByCourse') }}";
    </script>
    <script type="text/javascript" src="{{ asset('admin-assets/modules/unit_form.js') }}"></script>
@endsection
