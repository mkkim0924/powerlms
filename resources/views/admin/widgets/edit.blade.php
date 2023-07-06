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
                                    <h2 class="card-title text-capitalize ">@lang('backend.widgets.header.edit')</h2>
                                </div>
                                <div class="col lg 4">
                                    <span
                                        class="pull-right d-inline-block @if (session('display_type') == 'rtl') float-left @else float-right @endif">
                                        <a href="{{ route('admin.widgets') }}" class="btn btn-rounded btn-warning">
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
                                        <div class="card-body">
                                            {!! Form::open([
                                                'route' => ['admin.widgets.update', $widget->id],
                                                'method' => 'POST',
                                                'enctype' => 'multipart/form-data',
                                                'files' => true,
                                                'id' => 'quizForm',
                                            ]) !!}
                                            <div class="row row-sm">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>@lang('backend.widgets.label.image') @if (isset(\App\Models\Widget::DIMENSIONS[$widget->identifier]))
                                                                ({{ \App\Models\Widget::DIMENSIONS[$widget->identifier] }})
                                                            @endif
                                                        </label>
                                                        <input type="file" accept="image/*" class="dropify"
                                                            data-show-remove="false"
                                                            data-allowed-file-extensions="png jpg jpeg svg"
                                                            data-default-file="{{ getFileUrl($widget->image, 'widgets') }}"
                                                            name="image" id="image">
                                                    </div>
                                                </div>
                                                @if ($widget->identifier == 'video_promotion_section_widget')
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>@lang('backend.widgets.label.video_url')</label>
                                                            {!! Form::text('video_url', $widget->video_url ?? old('video_url'), [
                                                                'class' => 'form-control',
                                                                'placeholder' => 'https://www.youtube.com/embed/XXXXXXXXXXX',
                                                            ]) !!}
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <hr>
                                            <ul class="nav nav-pills m-t-30 m-b-30">
                                                @foreach ($locale_list as $locale_code => $locale_name)
                                                    <li class=" nav-item"><a href="#navpills-{{ $locale_code }}"
                                                            class="nav-link @if ($loop->first) show active @endif"
                                                            data-toggle="tab" aria-expanded="false">{{ $locale_name }}
                                                            @if ($locale_code == $default_language_code)
                                                            @lang('backend.widgets.text.default_language')
                                                            @endif
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <div class="tab-content br-n pn">
                                                @foreach ($locale_list as $locale_code => $locale_name)
                                                    <div id="navpills-{{ $locale_code }}"
                                                        class="tab-pane @if ($loop->first) show active @endif">
                                                        <div class="row mt-4">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>@lang('backend.widgets.label.title')</label>
                                                                    {!! Form::text("title[$locale_code]", $widget->title[$locale_code] ?? old("title[$locale_code]"), [
                                                                        'class' => 'form-control',
                                                                    ]) !!}
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>@lang('backend.widgets.label.description')</label>
                                                                    {!! Form::textarea(
                                                                        "description[$locale_code]",
                                                                        $widget->description[$locale_code] ?? old("description[$locale_code]"),
                                                                        [
                                                                            'class' => 'form-control html_editor',
                                                                        ],
                                                                    ) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="form-actions">
                                                <button type="submit" class="btn btn-success"><i class="fa fa-check"></i>
                                                    @lang('global.button.save') </button>
                                            </div>
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
    </div>
@endsection
