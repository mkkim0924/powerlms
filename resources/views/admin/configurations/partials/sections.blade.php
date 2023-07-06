<div class="col-sm-12">
    <h4 class="card-title mb-3" style="color: #999;">Sections</h4>
    <input type="hidden" name="configuration_value[layout_sections_get]" value="1">
</div>
@foreach($sections as $sectionKey)
    <div class="col-sm-6">
        <input type="checkbox" class="js-input-switch"
               name="configuration_value[layout_sections][{{ $sectionKey }}]" id="{{ $sectionKey }}_key" checked>
        <label for="{{ $sectionKey }}_key">@lang("backend.site_configuration.layout_section.$sectionKey")</label>
    </div>
@endforeach
