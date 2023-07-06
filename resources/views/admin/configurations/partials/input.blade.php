<div class="form-group">
    @if ($item->control_type == 'select_box' && ($item->identifier_key == 'front_home_layout'))
        <h4 class="card-title mb-3" style="color: #999;">@lang("backend.site_configuration.layouts_items_header")</h4>
        <div class="row">
            @for($i=1; $i<=9;$i++)
                <div class="col-12 col-lg-4 col-md-6">
                    <div class="layout-card @if($item->configuration_value == 'layout'.$i) clicked @endif">
                        <a href="javascript:;" class="layoutClick" data-layout="layout{{ $i }}">
                            <img src="{{ asset('frontend-assets/images/layout/Layout'.$i.'.png')}}"
                                 class="img-fluid d-block w-100 position-absolute" alt="">
                        </a>
                        <div class="arrow bounce">
                            <i class="fa fa-angle-down fa-3x" aria-hidden="true"></i>
                        </div>
                    </div>
                    <h4 class="text-center py-4">@lang("backend.site_configuration.label.layout") #{{ $i }}</h4>
                </div>
            @endfor
        </div>
        <input type="hidden" name="configuration_value[{{ $item->identifier }}]" value="{{ $item->configuration_value }}" id="layoutInput">
        <div class="form-actions text-center" id="fetchSectionDiv" style="display: none;">
            <a href="javascript:;" class="btn btn-success" id="fetchSectionBtn" data-layout="">
                Fetch Sections
            </a>
        </div>
        <div class="row" id="currentLayoutSection">
            <div class="col-sm-12">
                <h4 class="card-title mb-3" style="color: #999;">@lang("backend.site_configuration.label.sections")</h4>
                <input type="hidden" name="configuration_value[layout_sections_get]" value="1">
            </div>
            @foreach(\App\Models\SiteConfiguration::SECTIONS[$item->configuration_value] as $sectionKey)
            <div class="col-sm-6">
                <input type="checkbox" class="js-input-switch"
                       name="configuration_value[layout_sections][{{ $sectionKey }}]" id="{{ $sectionKey }}_key" @if(in_array($sectionKey, config('layout_sections'))) checked @endif>
                <label for="{{ $sectionKey }}_key">@lang("backend.site_configuration.layout_section.$sectionKey")</label>
            </div>
            @endforeach
        </div>
    @elseif ($item->control_type == 'select_box')
        <label>@lang("backend.site_configuration.label.$item->identifier_key")</label>
        {!! Form::select(
            'configuration_value[' . $item->identifier . ']',
            $select_configuration_values[$item->identifier],
            $item->configuration_value ?? '',
            ['class' => 'form-control select2SearchWithoutClear'],
        ) !!}
    @elseif($item->control_type == 'checkbox')
        <input type="checkbox" @if(count($configuration_group->siteConfigurations) > 0) class="js-input-switch parentSwitchInput"
               data-id="{{ $item->id }}" @endif
               name="configuration_value[{{ $item->identifier }}]" id="identifier{{ $item->id }}"
               @if (isset($item->configuration_value) && $item->configuration_value == 1) checked @endif>
        <label for="identifier{{ $item->id }}"> @lang("backend.site_configuration.label.$item->identifier_key")</label>
    @elseif($item->control_type == 'textarea')
        <label>@lang("backend.site_configuration.label.$item->identifier_key")</label>
        {!! Form::textarea(
            'configuration_value[' . $item->identifier . ']',
            $item->configuration_value ?? old('brief_description'),
            ['class' => 'form-control', 'id' => 'configuration_value[' . $item->identifier . ']', 'rows' => 2],
        ) !!}
    @elseif($item->control_type == 'file')
        <label>@lang("backend.site_configuration.label.$item->identifier_key")</label>
        <input type="file"
               name="configuration_value[{{ $item->identifier }}]"
               class="dropify"  data-show-remove="false"
               data-default-file="{{ getFileUrl($item->configuration_value, 'logos') }}">
    @else
        <label>@lang("backend.site_configuration.label.$item->identifier_key")</label>

        <input type="{{ $item->control_type }}" class="form-control" @if(!empty($item->parent_config_id)) data-validation="required"
               data-validation-error-msg = '{{ __("validation.required", ["attribute" => strtolower(__("backend.site_configuration.label.$item->identifier_key"))]) }}'  @endif
               name="configuration_value[{{ $item->identifier }}]"
               value="{{ $item->configuration_value }}">
    @endif
    @if(!empty($item->documentation_redirect_text))
        <span class="float-right">
        <a target="_blank" class="font-weight-bold font-italic"
           href="{{ $item->documentation_redirect_url }}"> @lang("backend.site_configuration.link_text.$item->documentation_redirect_text") </a>
        </span>
    @endif
    @if(!empty($item->note))
        <span class="help-block"><small>{!! __("backend.site_configuration.note.$item->note", ['image_dimension' => \App\Models\SiteConfiguration::IMAGE_DIMENSIONS[$item->identifier_key] ?? ""]) !!}</small></span>
    @endif
</div>
