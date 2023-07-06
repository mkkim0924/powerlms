@extends('admin.layouts.master')
@section('admin_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-4 col-6 d-flex align-items-center">
                                @if (!isset($live_lesson))
                                <h2 class="card-title text-capitalize">@lang('backend.live_lessons.header.create')</h2>
                                @else
                                <h2 class="card-title text-capitalize">@lang('backend.live_lessons.header.edit')</h2>
                                @endif

                            </div>
                            <div class="col lg 4">
                                <span class="pull-right d-inline-block @if(session('display_type')=='rtl') float-left @else float-right @endif">
                                    <a href="{{ route(request()->user_type . '.live_lessons') }}"
                                       class="btn btn-rounded btn-warning">
                                        <i class="fa fa-arrow-left" aria-hidden="true"></i> @lang('global.button.back')
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                @if (isset($live_lesson))
                                    <form class="form-horizontal" role="form" method="post"
                                        action="{{ route(request()->user_type . '.live_lessons.update', $live_lesson->id) }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @include('admin.live_lesson.form')
                                    </form>
                               @else
                                    <form class="form-horizontal" role="form" method="post"
                                        action="{{ route(request()->user_type . '.live_lessons.store') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @include('admin.live_lesson.form')
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
