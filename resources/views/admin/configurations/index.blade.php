@extends('admin.layouts.master')
@section('css')
    <link href="{{ asset('admin-assets/modules/configuration.css') }}" rel="stylesheet">
@endsection
@section('admin_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-4 col-6 d-flex align-items-center">
                                <h2 class="card-title text-capitalize">@lang('backend.site_configuration.header')</h2>
                            </div>
                            <div class="col lg 4">
                                <span
                                    class="pull-right d-inline-block @if (session('display_type') == 'rtl') float-left @else float-right @endif">
                                    <a href="{{ route('admin.troubleshoot') }}" class="btn btn-rounded btn-warning">
                                        @lang('backend.site_configuration.button.troubleshoot')
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                    @php $current_tab = Session::get('current_tab') ?? (request('current_tab') ?? 1) @endphp
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-2 col-xl-3 px-1">
                                <!-- Nav tabs -->
                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                     aria-orientation="vertical">
                                    @foreach ($configuration_groups as $configuration_group)
                                        <a class="nav-link @if ($current_tab == $configuration_group->id) active show @endif"
                                           id="v-pills-group-tab-{{ $configuration_group->id }}" data-toggle="pill"
                                           href="#v-pills-group-{{ $configuration_group->id }}" role="tab"
                                           aria-controls="v-pills-group-{{ $configuration_group->id }}"
                                           aria-selected="{{ $current_tab == $configuration_group->id }}">
                                            @lang("backend.site_configuration_groups.$configuration_group->title")</a>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-lg-10 col-xl-9">
                                <div class="tab-content" id="v-pills-tabContent">
                                    @foreach ($configuration_groups as $configuration_group)
                                        <div class="tab-pane fade @if ($current_tab == $configuration_group->id) active show @endif"
                                             id="v-pills-group-{{ $configuration_group->id }}" role="tabpanel"
                                             aria-labelledby="v-pills-group-tab-{{ $configuration_group->id }}">
                                            <form class="form-horizontal" method="POST"
                                                  action="{{ route('admin.configurations.update') }}"
                                                  enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="tab" value="{{ $configuration_group->id }}">
                                                @foreach ($configuration_group->siteConfigurations as $item)
                                                    @include('admin.configurations.partials.input')
                                                    @if (count($item->childConfigurations) > 0)
                                                        <div id="childGroup{{ $item->id }}" class="ml-5"
                                                             @if ($item->configuration_value == 0) style="display: none;" @endif>
                                                            @foreach ($item->childConfigurations as $childItem)
                                                                @include('admin.configurations.partials.input',
                                                                    ['item' => $childItem])
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                @endforeach
                                                <div class="form-actions">
                                                    <button type="submit" class="btn btn-success"><i
                                                            class="fa fa-check"></i>
                                                        @lang('global.button.save')
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer_scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            'use strict';
            $(".parentSwitchInput").change(function () {
                $("#childGroup" + $(this).data('id')).toggle($(this).is(':checked'));
            })

            $(".layout-card").scroll(function () {
                $(".arrow").css("opacity", 1 - $(window).scrollTop() / 250);
                //250 is fade pixels
            });

            $(document).on('click', '.layoutClick', function () {
                $('.layout-card').removeClass('clicked');
                $('#layoutInput').val($(this).data('layout'));
                $(this).parent('.layout-card').addClass('clicked');
                $("#fetchSectionBtn").attr('data-layout', $(this).data('layout'));
                $("#fetchSectionDiv").show();
                $("#currentLayoutSection").hide().html('');
            })

            $(document).on('click', "#fetchSectionBtn", function () {
                var layout = $(this).attr('data-layout');
                $.ajax({
                    url: $app_url + '/admin/get-sections/' + layout,
                    method: 'get',
                    dataType: 'json',
                    beforeSend: function () {
                        $("#currentLayoutSection").html('');
                    },
                    success: function (data) {
                        $("#currentLayoutSection").html(data.html).show();
                        let elems = Array.prototype.slice.call($("#currentLayoutSection").find(
                            '.js-input-switch'));
                        elems.forEach(function (item) {
                            new Switchery(item, {
                                size: 'small'
                            });
                        });
                        $("#fetchSectionDiv").hide();
                    }
                })
            });
        })
    </script>
@endsection
