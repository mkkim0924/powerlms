@if (config('rights_company_name'))
    <footer class="footer text-center">
        @lang('backend.footer.rights_reserved_by_text') <a href="{{ config('rights_company_website_url') ?? '#' }}"
            target="_blank">{{ config('rights_company_name') }}</a>.
    </footer>
@endif
