<div class="container-fluid bg-dark">
    <div class="row">
        <div class="col-sm-12 text-center">
            <ul class="nav d-inline-flex nav-pills main-tabs px-sm-3 my-2 gap-3" id="pills-tab" role="tablist">
                <li class="nav-item"  role="presentation">
                    <a href="{{ route('my-courses') }}">
                        <button class="bg-light nav-link btn-outline-rose @if($current_tab == 'my-courses') active @endif" aria-selected="false">@lang('frontend.tabs.my_course')
                        </button>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a href="{{ route('my-webinars') }}">
                        <button class="bg-light nav-link btn-outline-rose @if($current_tab == 'my-webinars') active @endif" aria-selected="true">@lang('frontend.tabs.my_webinar')
                        </button>
                    </a>
                </li>

                <li class="nav-item" role="presentation">
                    <a href="{{ route('purchase') }}">
                        <button class="bg-light nav-link btn-outline-rose @if($current_tab == 'purchase') active @endif" aria-selected="true">@lang('frontend.tabs.purchase')
                        </button>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a href="{{ route('profile') }}">
                        <button class="bg-light nav-link  btn-outline-rose @if($current_tab == 'profile') active @endif" aria-selected="false">@lang('frontend.tabs.profile')
                        </button>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
