@include('admin.layouts.partials.flash_messages')
<div id="wizard2">
    <h3>@lang('backend.courses.step.basic_info')</h3>
    <section>
        @include('admin.courses.tabs.general')
    </section>
    <h3>@lang('backend.courses.step.additional_info')</h3>
    <section>
        @include('admin.courses.tabs.additional_info')
    </section>
    <h3>@lang('backend.courses.step.pricing')</h3>
    <section>
        @include('admin.courses.tabs.price_info')
    </section>
    <h3>@lang('backend.courses.step.media')</h3>
    <section>
        @include('admin.courses.tabs.media')
    </section>
    <h3>@lang('backend.courses.step.SEO_details')</h3>
    <section>
        @include('admin.courses.tabs.seo_details')
    </section>
</div>
@section('css')
    <link href="{{ asset('admin-assets/assets/extra-libs/jquery-steps/jquery.steps.css') }}" rel="stylesheet">
@endsection
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('admin-assets/assets/extra-libs/jquery-steps/jquery.steps.min.js') }}">
    </script>
    <script type="text/javascript">
        var is_edit = "{{ isset($course) && $formMode == 'edit' ? true : false }}";
    </script>
    <script type="text/javascript" src="{{ asset('admin-assets/modules/course_form.js') }}"></script>
@endsection
