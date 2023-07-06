@extends('admin.layouts.master')
@section('admin_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-4 col-6 d-flex align-items-center">
                                <h2 class="card-title text-capitalize">@lang('backend.menu_managers.header.list')</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger mt-2 d-flex justify-content-between px-2 py-1">
                                {!! implode('', $errors->all('<div class="align-self-center">:message</div>')) !!}
                                <button type="button" class="close align-self-start" data-dismiss="alert">×</button>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-8">
                                <div class="card">
                                    <div class="card-header px-0">
                                        <h4 class="card-title px-0">@lang('backend.menu_managers.label.menu_structure')</h4>
                                    </div>
                                    <div class="card-body my-0 p-1">
                                        @lang('backend.menu_managers.note.help')
                                        <div class="sortable">
                                            @foreach ($menu_items as $menu_key => $item)
                                                <div class="card my-2 bg-light" data-id="{{ $item->id }}">
                                                    <div class="card-header">
                                                        {{ $item->label }}
                                                        <div class="card-actions">
                                                            <a class="btn btn-default btn-sm btn-rounded text-white"
                                                               data-action="collapse"><i class="fas fa-eye"></i> @lang('backend.menu_managers.label.view_details_button')</a>
                                                        </div>
                                                    </div>
                                                    <div class="card-body collapse">
                                                        <form method="POST"
                                                              action="{{ route('admin.menu_manager.store') }}">
                                                            @csrf
                                                            <input type="hidden" name="menu_item_id"
                                                                   value="{{ $item->id }}">
                                                            <div class="form-group">
                                                                <label>@lang('backend.menu_managers.label.label')</label>
                                                                <span class="text-danger">*</span>
                                                                {!! Form::text('update_data['.$menu_key.'][label]', $item->label, [
                                                                    'class' => 'form-control',
                                                                    'data-validation' => 'required',
                                                                    'data-validation-error-msg' => __('validation.required', [
                                                                        'attribute' => strtolower(__('backend.menu_managers.label.label')),
                                                                    ]),
                                                                ]) !!}
                                                            </div>
                                                            <div class="form-group">
                                                                <label>@lang('backend.menu_managers.label.url')</label>
                                                                <span class="text-danger">*</span>
                                                                {!! Form::text('update_data['.$menu_key.'][link]', $item->link, [
                                                                    'class' => 'form-control',
                                                                    'data-validation' => 'required',
                                                                    'data-validation-error-msg' => __('validation.required', [
                                                                        'attribute' => strtolower(__('backend.menu_managers.label.url')),
                                                                    ]),
                                                                ]) !!}
                                                            </div>
                                                            <button type="submit" class="btn btn-success">@lang('global.button.update')
                                                            </button>
                                                            <a href="javascript:;" class="btn btn-danger"
                                                               onclick="confirmDelete('{{ route('admin.menu_manager.delete', $item->id) }}');">@lang('global.button.delete')</a>
                                                        </form>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <a href="javascript:;" id="updateSortOrder"
                                               class="btn btn-success">@lang('backend.menu_managers.button.update_sort_order')</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Right Side Section -->
                            <div class="col-xs-6 col-md-4">
                                <div class="card">
                                    <div class="card-header bg-light">
                                        <h2 class="card-title">@lang('backend.menu_managers.label.default_pages')</h2>
                                    </div>
                                    <form method="POST" action="{{ route('admin.menu_manager.store') }}">
                                        @csrf
                                        <div class="card-body p-2 border pb-0">
                                            @foreach ($default_items as $menu_index => $menu_item)
                                                <div class="form-group @if ($loop->last) mb-0 @endif">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                               name="default_items[]" id="default-item-{{ $menu_index }}"
                                                               value="{{ $menu_index }}"
                                                               @if (in_array($menu_index, $default_menu_items)) disabled checked @endif>
                                                        <label class="custom-control-label"
                                                               for="default-item-{{ $menu_index }}">{{ $menu_item }}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="card-footer bg-light">
                                            <button type="submit" class="btn btn-sm btn-success">
                                                @lang('backend.menu_managers.button.add_to_menu')
                                            </button>
                                        </div>
                                    </form>
                                </div>

                                <div class="card my-3">
                                    <div class="card-header bg-light">
                                        <h2 class="card-title">@lang('backend.menu_managers.label.custom_link')</h2>
                                    </div>
                                    <form method="POST" action="{{ route('admin.menu_manager.store') }}">
                                        @csrf
                                        <div class="card-body p-2 border">
                                            <div class="form-group">
                                                <label>@lang('backend.menu_managers.label.label')</label>
                                                <span class="text-danger">*</span>
                                                {!! Form::text('label', old('label'), [
                                                    'class' => 'form-control',
                                                    'data-validation' => 'required',
                                                    'data-validation-error-msg' => __('validation.required', [
                                                        'attribute' => strtolower(__('backend.menu_managers.label.label')),
                                                    ]),
                                                ]) !!}
                                            </div>
                                            <div class="form-group">
                                                <label>@lang('backend.menu_managers.label.url')</label>
                                                <span class="text-danger">*</span>
                                                {!! Form::text('link', old('link'), [
                                                    'class' => 'form-control',
                                                    'data-validation' => 'required',
                                                    'data-validation-error-msg' => __('validation.required', [
                                                        'attribute' => strtolower(__('backend.menu_managers.label.url')),
                                                    ]),
                                                ]) !!}
                                            </div>
                                        </div>
                                        <div class="card-footer bg-light">
                                            <button type="submit"
                                                    class="btn btn-sm btn-success">@lang('backend.menu_managers.button.add_to_menu')</button>
                                        </div>
                                    </form>
                                </div>
                                @if (count($pages) > 0)
                                    <div class="card my-3">
                                        <div class="card-header bg-light">
                                            <h2 class="card-title">@lang('backend.menu_managers.label.pages')</h2>
                                        </div>
                                        <form method="POST" action="{{ route('admin.menu_manager.store') }}">
                                            @csrf
                                            <div class="card-body p-2 border">
                                                @foreach ($pages as $page)
                                                    <div class="form-group @if ($loop->last) mb-0 @endif">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input"
                                                                   name="custom_pages[]" id="checkbox{{ $page->id }}"
                                                                   value="{{ $page->id }}" @if (in_array($page->id, $default_menu_pages)) disabled checked @endif>
                                                            <label class="custom-control-label"
                                                                   for="checkbox{{ $page->id }}">{{ $page->name }}</label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="card-footer bg-light">
                                                <button type="submit"
                                                        class="btn btn-sm btn-success">@lang('backend.menu_managers.button.add_to_menu')</button>
                                            </div>
                                        </form>
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer_scripts')
    <script src="{{ asset('admin-assets/assets/extra-libs/taskboard/js/jquery-ui.min.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            'use strict';
            $(".sortable").sortable({
                items: "> div",
                tolerance: "pointer",
                cursor: "move",
            });

            $("#updateSortOrder").on('click', function () {
                var sortMenuItems = $('.sortable').sortable('toArray', {
                    attribute: 'data-id'
                });
                $.ajax({
                    url: $app_url + "/admin/menu-manager/update-sort",
                    method: 'POST',
                    data: {
                        sortMenuItems: sortMenuItems
                    },
                    success: function (data) {
                        if (data.status) {
                            toastr.success(data.message, $plugin_translations.toastr_success_text, {
                                timeOut: 2000
                            });
                        } else {
                            toastr.error(data.message, $plugin_translations.toastr_error_text, {
                                timeOut: 2000
                            });
                        }
                    }
                });
            })
        })
    </script>
@endsection
