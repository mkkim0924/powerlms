@extends('admin.layouts.master')
@section('admin_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-4 col-6 d-flex align-items-center">
                                <h2 class="card-title text-capitalize">Course Survey Report</h2>
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
                                                <th>Course Name</th>
                                                <th>Survey Name</th>
                                                <th>Survey Type</th>
                                                <th>Created Date</th>
                                                <th>Average Response</th>
                                                <th>Total Response</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($survey as $item)
                                                <tr>
                                                    <td>{{ $item->course_name }}</td>
                                                    <td>{{ $item->survey_name }}</td>
                                                    <td>{{ $item->survey_type }}</td>
                                                    <td>{{ formatDate($item->create_date) }}</td>
                                                    <td>{{ $item->total_submit !=0 ? number_format(($item->total_submit/($item->total_skip+$item->total_submit))*100, 2, '.', '') .'%' : '--' }}</td>
                                                    <td>{{ $item->total_submit !=0 ? $item->total_submit.'/'.$item->total_skip+$item->total_submit : '--' }}</td>
                                                    <td>
                                                         <a href="{{ route(request()->user_type.'.course_survey_report.details', $item->course_surveys_id) }}"
                                                        class="btn btn-primary btn-sm">View Detail</a>
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
@endsection
