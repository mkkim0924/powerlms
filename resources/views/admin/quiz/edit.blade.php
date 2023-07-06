@extends('admin.layouts.master')
@section('admin_content')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-4 col-6 d-flex align-items-center">
                                    <h2 class="card-title text-capitalize">@lang('backend.tests.header.edit')</h2>
                                </div>
                                <div class="col lg 4">
                                    <span class="pull-right d-inline-block @if(session('display_type')=='rtl') float-left @else float-right @endif">
                                         <a href="{{ route(request()->user_type.'.quiz') }}"
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
                                    <div class="card">
                                        {!! Form::open(['route'=>[request()->user_type.'.quiz.update', $quiz->id],'method' => 'POST', 'enctype'=> "multipart/form-data", 'files' => true, 'id' => "quizForm"]) !!}
                                        @include('admin.quiz.form', ['formMode' => 'edit'])
                                        {!! Form::close() !!}
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
