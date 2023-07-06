@extends('admin.layouts.master')
@section('admin_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-4 col-6 d-flex align-items-center">
                                <h2 class="card-title text-capitalize">@lang('backend.widgets.header.list')</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="table-responsive mt-4">
                                        <table id="zero_config" class="product-overview v-middle table">
                                            <thead>
                                            <tr>
                                                <th>@lang('backend.widgets.label.identifier')</th>
                                                <th>@lang('backend.widgets.label.Preview')</th>
                                                <th>@lang('backend.widgets.label.actions')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($widgets as $item)
                                                <tr>
                                                    <td>{{ __('backend.site_configuration.layout_section.'.$item->identifier) }}</td>
                                                    <td><a href="javascript:;" data-image="{{ url('frontend-assets/images/'.\App\Models\Widget::PREVIEW_IMAGE[$item->identifier]) }}"
                                                           class="btn waves-effect waves-light btn-rounded btn-sm btn-success openPreviewImageModal">@lang('global.button.preview')</a></td>
                                                    <td>
                                                        <a href="{{ route('admin.widgets.edit', $item->id) }}"
                                                           class="text-inverse p-r-10 ab" data-toggle="tooltip"
                                                           data-original-title="@lang('global.button.edit')"><i
                                                                class="fas fa-pencil-alt text-inverse mr-2"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">@lang('backend.widgets.title.section_preview')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <img src="" id="imgPreview" alt="Image" style="width: -webkit-fill-available;">
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
@section('footer_scripts')
    <script type="text/javascript">
        $(document).ready(function (){
            'use strict';
            $(document).on('click', '.openPreviewImageModal', function (){
                $("#imgPreview").attr('src', $(this).data('image'));
                $("#previewModal").modal('show');
            })
        })
    </script>
@endsection

