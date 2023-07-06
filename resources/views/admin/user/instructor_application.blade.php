@extends('admin.layouts.master')
@section('admin_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-4 col-6 d-flex align-items-center">
                                <h2 class="card-title text-capitalize">@lang('backend.instructor_applications.header.list')</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="table-responsive">
                                        <table id="zero_config" class="product-overview v-middle table">
                                            <thead>
                                            <tr>
                                                <th>@lang('backend.instructor_applications.label.name')</th>
                                                <th>@lang('backend.instructor_applications.label.email')</th>
                                                <th>@lang('backend.instructor_applications.label.actions')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($applications as $item)
                                                <tr>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->email }}</td>
                                                    <td>
                                                        @if($item->instructor_application_status == \App\Models\User::INSTRUCTOR_APPLICATION_PENDING_STATUS)
                                                            <a href="{{ route('admin.instructor_applications.status', [$item->id, 'approve']) }}"
                                                               class="btn waves-effect waves-light btn-rounded btn-sm btn-success">@lang('backend.instructor_applications.label.approve')</a>
                                                            <a href="javascript:;"
                                                               data-id="{{ $item->id }}"
                                                               class="btn waves-effect waves-light btn-rounded btn-sm btn-danger rejectInstructor">@lang('backend.instructor_applications.label.reject')</a>
                                                        @elseif($item->instructor_application_status == 3)
                                                            <a href="javascript:;"
                                                               class="btn btn-rounded btn-sm btn-danger">@lang('backend.instructor_applications.label.rejected')</a>
                                                        @endif
                                                        <a href="{{ route('admin.instructor.details', $item->id) }}"
                                                           class="btn btn-rounded btn-sm btn-info">
                                                            @if ($item->instructor_application_status == 3)
                                                                @lang('backend.instructor_applications.button.review')
                                                            @else
                                                                @lang('backend.instructor_applications.button.view_application')
                                                            @endif
                                                        </a>
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

    <div id="applicationRejectModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" id="rejected-app">
                <div class="modal-header">
                    <h4 class="modal-title">Why application is rejected?</h4>
                </div>
                <form action="{{ route('admin.instructor_applications.reject') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="modal-body pb-0">
                            <label for="recipient-name" class="control-label">@lang('backend.instructor_applications.label.reason')</label>
                            <input type="hidden" id="id" name="id">
                            <textarea name="application_reject_reason" data-validation="required" data-validation-error-msg="{{ __('validation.required', ['attribute' => strtolower(__('backend.instructor_applications.label.reason'))]) }}" class="form-control"
                                      cols="5" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">@lang('global.button.close')</button>
                        <button type="submit" value="Submit" class="btn btn-success waves-effect waves-light">@lang('global.button.submit')
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('footer_scripts')
    <script>
        $(document).ready(function () {
            'use strict';
            $(document).on('click', '.rejectInstructor', function () {
                $("#id").val($(this).data('id'));
                $('#applicationRejectModal').modal('show');
            });
        });
    </script>
@endsection
