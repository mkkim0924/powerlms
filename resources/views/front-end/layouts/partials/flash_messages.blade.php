@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block mt-2  d-flex justify-content-between px-2 py-1">
        <strong class="align-self-center">{{ $message }}</strong>
        <button type="button" class="close align-self-start dtp-content" data-bs-dismiss="alert">×</button>
    </div>
@endif

@if ($message = Session::get('error'))
    <div class="alert alert-danger alert-block mt-2  d-flex justify-content-between px-2 py-1">
        <strong class=" align-self-center">{{ $message }}</strong>
            <button type="button" class="close align-self-start" data-bs-dismiss="alert">×</button>
    </div>
@endif

@if ($message = Session::get('warning'))
    <div class="alert alert-warning alert-block mt-2  d-flex justify-content-between px-2 py-1">
        <strong class="align-self-center">{{ $message }}</strong>
        <button type="button" class="close align-self-start" data-bs-dismiss="alert">×</button>
    </div>
@endif


@if ($message = Session::get('info'))
    <div class="alert alert-info alert-block mt-2  d-flex justify-content-between px-2 py-1">
        <strong class="align-self-center">{{ $message }}</strong>
        <button type="button" class="close align-self-start" data-bs-dismiss="alert">×</button>
    </div>
@endif

@if ($message = Session::get('flash_message'))
    <div class="alert alert-success alert-block mt-2  d-flex justify-content-between px-2 py-1 ">
        <strong class="align-self-center">{{ $message }}</strong>
        <button type="button" class="close align-self-start" data-bs-dismiss="alert">×</button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger mt-2 d-flex justify-content-between px-2 py-1">
        <div>
            {!! implode('', $errors->all(':message<br>')) !!}
        </div>
        <button type="button" class="close align-self-start" data-bs-dismiss="alert">×</button>
    </div>
@endif
