@extends('admin.layouts.master')
@section('admin_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-4 d-flex align-items-center">
                                <h2 class="card-title text-capitalize">@lang('backend.admin.manage_admins.header.create')</h2>
                            </div>
                            <div class="col lg 4">
                                <span class="pull-right d-inline-block @if(session('display_type')=='rtl') float-left @else float-right @endif">
                                    <a href="{{ route('admin.admin_users') }}"
                                       class="btn btn-rounded btn-warning">
                                        <i class="fa fa-arrow-left" aria-hidden="true"></i> @lang('global.button.back')
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.admin_users.store') }}" method="post">
                            @csrf
                            @include('admin.admin-users.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
