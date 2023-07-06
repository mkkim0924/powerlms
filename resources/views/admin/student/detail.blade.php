@extends('admin.layouts.master')
@section('admin_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-4 col-6">
                                <h4 class="card-title text-capitalize">@lang('backend.students.header.details')</h4>
                            </div>
                            <div class="col-lg-8">
                                <span class="pull-right d-inline-block float-right">
                                    <a href="{{ route('admin.students') }}" class="btn btn-rounded btn-warning">
                                        <i class="fa fa-arrow-left" aria-hidden="true"></i> @lang('global.button.back')
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-pills m-t-30 m-b-30">
                            <li class="nav-item"><a href="#navpills-1" class="nav-link show active" data-toggle="tab"
                                    aria-expanded="false">@lang('backend.students.tab.student_info')</a>
                            </li>
                            <li class="nav-item"><a href="#navpills-2" class="nav-link show" data-toggle="tab"
                                    aria-expanded="false">@lang('backend.students.tab.course_info')</a></li>
                        </ul>
                        <div class="tab-content br-n pn">
                            <div id="navpills-1" class="tab-pane show active">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-4 d-flex align-items-center justify-content-center">
                                                        <img src="{{ getFileUrl($student->image ?? 'default-placeholder.jpg', 'users') }}"
                                                            class="rounded-circle student-img" width="150">
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <tbody>
                                                                    <tr>
                                                                        <td width="390">@lang('backend.students.label.name')</td>
                                                                        <td> {{ $student->name }} </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td width="390">@lang('backend.students.label.email')</td>
                                                                        <td> {{ $student->email }} </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td width="390">@lang('backend.students.label.mobile_number')</td>
                                                                        <td> {{ $student->mobile_number ?? '- - -' }} </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td width="390">@lang('backend.students.label.address')</td>
                                                                        <td> {{ $student->address ?? '- - -' }} </td>
                                                                    </tr>
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
                            <div id="navpills-2" class="tab-pane show">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table id="zero_config" class="product-overview v-middle table">
                                                <thead>
                                                    <tr>
                                                        <th>@lang('backend.students.label.course_name')</th>
                                                        <th>@lang('backend.students.label.price')</th>
                                                        <th>@lang('backend.students.label.progress')</th>
                                                        <th>@lang('backend.students.label.enroll_date')</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($courseDetails as $item)
                                                        <tr>
                                                            <td>{{ $item->courseDetails->name ?? '- - -' }}</td>
                                                            <td>{!! $item->courseDetails->is_free == 1
                                                                ? '<span class="label label-success">'.__('backend.students.free_text').'</span>'
                                                                : '<span class="label label-info">' . formatPrice($item->courseDetails->price) . '</span>' !!}</td>
                                                            <td><span>{{ $item->progress }}%</span></td>
                                                            <td>{{ formatDate($item->created_at) }}</span></td>
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
    </div>
@endsection
