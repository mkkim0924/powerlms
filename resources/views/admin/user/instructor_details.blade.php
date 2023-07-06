@extends('admin.layouts.master')
@section('admin_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-4 col-6 d-flex align-items-center">
                                <h2 class="card-title text-capitalize">@lang('backend.instructor.header.instructor_information')</h2>
                            </div>
                            <div class="col lg 4">
                                <span
                                    class="pull-right d-inline-block @if (session('display_type') == 'rtl') float-left @else float-right @endif">
                                    <a @if ($users->instructor_application_status == 1) href="{{ route('admin.instructors') }}"
                                    @else href="{{ route('admin.instructor_applications') }}" @endif
                                        class="btn btn-rounded btn-warning">
                                        <i class="fa fa-arrow-left" aria-hidden="true"></i>@lang('global.button.back')
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <h3 class="box-title m-t-40">@lang('backend.instructor.sub_header.personal_info')</h3>
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td width="50%">
                                                <p>@lang('backend.instructor.label.profile_image')</p>
                                                <img src="{{ getFileUrl($users->image, 'users/') }}"
                                                    alt="{{ $users->name }}" width="80">
                                            </td>
                                            <td width="50%">
                                                <p>@lang('backend.instructor.label.about')</p>
                                                {{ $users->bio }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="390">@lang('backend.instructor.label.name')</td>
                                            <td>{{ $users->name }} </td>
                                        </tr>
                                        <tr>
                                            <td>@lang('backend.instructor.label.email')</td>
                                            <td> {{ $users->email }} </td>
                                        </tr>
                                        <tr>
                                            <td>@lang('backend.instructor.label.mobile_number')</td>
                                            <td>{{ $users->mobile_number }} </td>
                                        </tr>
                                        <tr>
                                            <td>@lang('backend.instructor.label.experience')</td>
                                            <td>{{ $users->experience }} </td>
                                        </tr>
                                        <tr>
                                            <td>@lang('backend.instructor.label.address') </td>
                                            <td>{{ $users->address }} </td>
                                        </tr>
                                        @if ($users->instructor_application_message != null)
                                            <tr>
                                                <td>@lang('backend.instructor.label.message') </td>
                                                <td>{{ $users->instructor_application_message }} </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            @if ($users->instructor_application_status == 1)
                                <h3 class="box-title m-t-40">@lang('backend.instructor.sub_header.account_info')</h3>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td width="390">@lang('backend.instructor.label.bank_name')</td>
                                                <td>{{ $users->bank_name ?? "- - -" }} </td>
                                            </tr>
                                            <tr>
                                                <td>@lang('backend.instructor.label.account_number')</td>
                                                <td> {{ $users->account_number ?? "- - -" }} </td>
                                            </tr>
                                            <tr>
                                                <td>@lang('backend.instructor.label.IFSC/routing_number')</td>
                                                <td>{{ $users->ifsc_routing_number ?? "- - -" }} </td>
                                            </tr>
                                            <tr>
                                                <td>@lang('backend.instructor.label.bank_address')</td>
                                                <td>{{ $users->bank_address ?? "- - -" }} </td>
                                            </tr>
                                            <tr>
                                                <td>@lang('backend.instructor.label.country')</td>
                                                <td>{{ $users->country ?? "- - -" }} </td>
                                            </tr>
                                            <tr>
                                                <td>@lang('backend.instructor.label.zip_code')</td>
                                                <td>{{ $users->zip_code ?? "- - -" }} </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                    @if ($users->instructor_application_status == 3)
                        <div class="card-footer">
                            <a href="{{ route('admin.instructor_applications.status', [$users->id, 'approve']) }}"
                                class="btn btn-success mr-2">
                                @lang('global.button.approve') </a>
                            <a href="{{ route('admin.instructor_applications.status', [$users->id, 'delete']) }}"
                                class="btn btn-danger">
                                @lang('global.button.delete') </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
