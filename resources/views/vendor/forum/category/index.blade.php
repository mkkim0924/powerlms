{{-- $category is passed as NULL to the master layout view to prevent it from showing in the breadcrumbs --}}
@extends ('forum::master', ['category' => null])

@section ('content')
    <div class="d-flex flex-row justify-content-between mb-2">
        <h2 class="flex-grow-1" style="color: #0C4EAF;">{{ trans('forum::general.index') }}</h2>

        @can ('createCategories')
            <button type="button" class="btn btn-primary" data-open-modal="create-category">
                {{ trans('forum::categories.create') }}
            </button>

            @include ('forum::category.modals.create')
        @endcan
    </div>
    {{--<div class="container" id="category-header">
        <div class="row  rounded-3 py-2 px-3 bg-light-blue" >
            <div class=" col-4 col-sm-6">
                <h6 class="mb-0 text-brand">{{ trans_choice('forum::categories.category', 1) }}</h6>
            </div>
            <div class=" col-3 col-sm-1">
                <h6 class="mb-0 text-brand">{{ trans_choice('forum::threads.thread', 2) }}</h6>
            </div>
            <div class=" col-3  col-sm-1">
                <h6 class="mb-0 text-brand">{{ trans_choice('forum::posts.post', 2) }}</h6>
            </div>
            <div class=" col-2 col-sm-4">
                <h6 class="mb-0 text-brand"></h6>
            </div>
        </div>
    </div>--}}
    <hr>
    <h4>{{ trans_choice('forum::categories.category', 2) }}</h4>
    <br>
    @foreach ($categories as $category)
        @include ('forum::category.partials.list', ['titleClass' => 'lead'])
    @endforeach
@stop
