@extends('admin.layouts.master')
@section('css')
@endsection
@section('admin_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-4  col-6 d-flex align-items-center">
                                <h2 class="card-title  text-capitalize">@lang('backend.backup.header')</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.backup.updateSettings') }}" method="POST">
                            @csrf
                            <h4 class="text-center text-danger">@lang('backend.backup.label.note')</h4>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <p class="d-inline float-left">
                                            <input type="checkbox" name="backup.status"
                                                   class="js-input-switch" {{ config('backup.status') == 1 ? 'checked' : '' }}>
                                            <span class="ml-2">@lang('backend.backup.label.enable_disable')</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body" id="backupInputs" @if(config('backup.status') == 0) style="display: none;" @endif>
                                    <div class="form-group">
                                        <label for="email">@lang('backend.backup.label.email_notification')</label>
                                        {!! Form::text('backup.notifications.mail.to', config('backup.notifications.mail.to'), ['class' => 'form-control', 'id' => 'email']) !!}
                                    </div>
{{--                                    <div class="form-group">--}}
{{--                                        <label for="app_token">App Token</label>--}}
{{--                                        {!! Form::text('filesystems.disks.dropbox.token', config('filesystems.disks.dropbox.token'), ['class' => 'form-control', 'id' => 'app_token']) !!}--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="app_secret">App Secret</label>--}}
{{--                                        {!! Form::text('filesystems.disks.dropbox.app_secret', config('backup.notifications.mail.app_secret'), ['class' => 'form-control', 'id' => 'app_secret']) !!}--}}
{{--                                    </div>--}}
                                    <div class="form-group">
                                        <label>@lang('backend.backup.label.backup_files')</label>
                                        <div class="custom-control custom-radio mr-sm-2">
                                            <input type="radio" name="backup.content" class="custom-control-input" id="database" value="db" @if(config('backup.content') == 'db' || empty(config('backup.content'))) checked @endif>
                                            <label class="custom-control-label" for="database">@lang('backend.backup.label.database')</label>
                                        </div>
                                        <div class="custom-control custom-radio mr-sm-2">
                                            <input type="radio" name="backup.content" class="custom-control-input" id="databaseAndStorageFiles" value="db_storage" @if(config('backup.content') == 'db_storage') checked @endif>
                                            <label class="custom-control-label" for="databaseAndStorageFiles">@lang('backend.backup.label.database_and_storage_files')</label>
                                        </div>
                                        <div class="custom-control custom-radio mr-sm-2">
                                            <input type="radio" name="backup.content" class="custom-control-input" id="databaseAndApplicationFiles" value="all" @if(config('backup.content') == 'all') checked @endif>
                                            <label class="custom-control-label" for="databaseAndApplicationFiles">@lang('backend.backup.label.database_and_application_files')</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="backup_schedule">@lang('backend.backup.label.backup_schedule')</label>
                                        {!! Form::select('backup.schedule', [1 => 'Daily', 2 => 'Weekly', 3 => 'Monthly'], config('backup.schedule'), ['class' => 'form-control', 'id' => 'backup_schedule']) !!}
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success"><i class="fa fa-check"></i>
                                    @lang('global.button.save')
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer_scripts')
    <script>
        $(document).ready(function () {
            $('.js-input-switch').change(function () {
                $("#backupInputs").toggle($(this).prop('checked') === true);
            });
        });
    </script>
@endsection
