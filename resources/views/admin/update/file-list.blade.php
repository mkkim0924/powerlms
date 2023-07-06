@extends('admin.layouts.master')
@section('admin_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-4 col-6 d-flex align-items-center">
                                <h2 class="card-title text-capitalize">@lang('backend.updates.header.update_theme')</h2>
                            </div>
                            <div class="col lg 4 ">
                                <span class="pull-right d-inline-block float-right">
                                    @lang('backend.update.current_version') {{ config('app.version') }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h4>@lang('backend.update.file_replaced_text')</h4>
                        <ul class="file-list">
                            @foreach($files as $file)
                                <li>{{$file}}</li>
                            @endforeach
                        </ul>
                        <form method="post" id="update-files" action="{{route('admin.update-files')}}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="file_name" value="{{ $file_name }}">
                            <div class="form-group col-12 ">
                                <button value="cancel" name="submit" class="btn btn-danger mt-auto mr-5">@lang('global.button.cancel')</button>
                                <button value="update" name="submit" class="btn btn-primary mt-auto">@lang('global.button.update')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer_scripts')
    <script type="text/javascript" src="{{asset('admin-assets/assets/libs/block-ui/jquery.blockUI.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            'use strict';

            $("form").submit(function () {
                $.blockUI({
                    message: '<i class="fas fa-spin fa-sync text-white"></i>',
                    overlayCSS: {
                        backgroundColor: '#000',
                        opacity: 0.5,
                        cursor: 'wait'
                    },
                    css: {
                        border: 0,
                        padding: 0,
                        backgroundColor: 'transparent'
                    }
                });
            });
        });
    </script>
@endsection
