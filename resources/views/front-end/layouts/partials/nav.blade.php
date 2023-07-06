<header id="header" class="header white-menu navbar-dark noPrint">
    <div class="header-wrapper noPrint">
        <!-- MOBILE HEADER -->
        <div class="wsmobileheader clearfix">
            <div class="r ">
                <div class="row w-100 mx-0 ">
                    <div class="col-3 @if (session('display_type') == 'rtl') order-3 @endif ">
                        <a id="wsnavtoggle" class="wsanimated-arrow"><span></span></a>
                    </div>
                    <div class="col-6 @if (session('display_type') == 'rtl') order-2 @endif">
                        <a href="{{ route('home') }}"
                           class="smllogo smllogo-black @if (session('display_type') == 'rtl') ms-sm-auto @else  mx-sm-auto @endif ">
                            <img src="{{ getFileUrl(config('logo'), 'logos') }}" width="152" height="35" alt="mobile-logo"/>
                        </a>
                        <a href="{{ route('home') }}" class="smllogo smllogo-white mx-sm-auto ">
                            <img src="{{ getFileUrl(config('logo_white'), 'logos') }}" width="152" height="35" alt="mobile-logo"/></a>
                    </div>
                    <div class="col-3 ps-0 text-end @if (session('display_type') == 'rtl') order-1 @endif">
                        @if(!auth()->check())
                            <a href="{{ route('login') }}"
                               class="btn btn-rose tra-black-hover last-link px-1 py-2 get-strated-btn">@lang('frontend.nav.get_started_button')</a>
                        @else
                            <div class="dropdown content-dropdown">
                                <button class="btn rounded-circle dropdown-toggle" type="button" id="dropdownMenuButton3"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                    <a href="#" class="lang-select">
                                        <img id="profileImage"
                                             src="{{ getFileUrl(auth()->user()->image ?? 'default-placeholder.jpg', 'users') }}"
                                             alt="flag-icon">
                                    </a>
                                </button>
                                <ul class="dropdown-menu sub-menu" aria-labelledby="dropdownMenuButton3">
                                    @if (auth()->user()->type == 1 && auth()->user()->instructor_application_status == 1)
                                        <li aria-haspopup="true" class="instructor"><a
                                                href="{{ route('instructor.dashboard') }}">@lang('frontend.nav.dropdown_menu_item.instructor')</a>
                                        </li>
                                    @endif
                                    <li aria-haspopup="true"><a href="{{ route('my-courses') }}">@lang('frontend.nav.dropdown_menu_item.my_courses')</a>
                                    </li>
                                    <li aria-haspopup="true"><a href="{{ route('purchase') }}">@lang('frontend.nav.dropdown_menu_item.purchase_history') </a>
                                    </li>
                                    <li aria-haspopup="true"><a href="{{ route('profile') }}">@lang('frontend.nav.dropdown_menu_item.profile')</a>
                                    </li>
                                    <li aria-haspopup="true"><a href="{{ route('logout') }}">@lang('frontend.nav.dropdown_menu_item.logout')</a>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
                <a class="topbartoggler d-block d-md-none" href="javascript:void(0)" data-toggle="collapse"
                   data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="true"
                   aria-label="Toggle navigation">
                    <i class="ti-more"></i>
                </a>
            </div>
            {{-- search bar for mobile --}}
            <span class="container-fluid mt-3 mt-sm-1" id="HeaderSearchBarContainer" style="display: block;">
                    <div class="row w-100 px-0 mx-auto my-2">
                        <div class="search-bar px-0" id="mobile-search-bar">
                            <i class="fa fa-search"></i>
                            <input type="text" autocomplete="off" id="search-megamenu-input" name="search_input"
                                   class="form-control mobileSearchInput" placeholder="@lang('frontend.nav.search_courses_placeholder')">
                            <div class="megaMenu mobileMegaMenu" id="megaMenu">
                            </div>
                        </div>
                    </div>
                </span>
        </div>
        <!-- NAVIGATION MENU -->
        <div class="wsmainfull menu clearfix">
            <div class="wsmainwp clearfix d-flex align-items-center justify-content-between">
                <!-- For Retina Ready displays take a image with double the amount of pixels that your image will be displayed (e.g 344 x 80 pixels) -->
                <div class="desktoplogo"><a href="{{ route('home') }}" class="logo-black"><img
                            src="{{ getFileUrl(config('logo'), 'logos') }}" width="172" height="40"
                            alt="header-logo"></a></div>
                <div class="desktoplogo"><a href="{{ route('home') }}" class="logo-white"><img
                            src="{{ getFileUrl(config('logo_white'), 'logos') }}" width="172" height="40"
                            alt="header-logo"></a></div>

                <div class="search searchbox-search flex-grow-1 my-auto me-xl-3 ms-xl-5 d-none d-md-block"
                     id="main-search">
                    <i class="fa fa-search"></i>
                    <div class="search-inputs">
                        <input type="text" class="search-control one desktopSearchInput" autocomplete="off"
                               id="search-megamenu-input" name="search_input" placeholder="@lang('frontend.nav.search_courses_placeholder')">
                        <input type="text" class="search-control two suggestion">
                    </div>
                    {{-- search mega menu --}}
                    <div class="megaMenu desktopMegaMenu" id="megaMenu"></div>
                    {{-- search mega menu --}}
                </div>
                @if (session('display_type') != 'rtl')
                    <nav class="wsmenu clearfix">
                        <ul class="wsmenu-list">
                            {{-- for mobile view --}}
                            <li class="head-nav-text d-block d-lg-none">Most popular</li>
                            @foreach ($categories->take(6) as $category)
                                <li aria-haspopup="true"
                                    class=" categoroy-dropdown profile-dropdown d-block d-lg-none second-menu">
                                    {{ $category->name }}
                                    <span class="wsmenu-click wsarrow wsmenu-arrow"></span>
                                    <ul class="sub-menu last-sub-menu">
                                        @foreach ($category->courses->take(6) as $course)
                                            <li aria-haspopup="true" class="sub-mobile-category">
                                                <a href="{{ route('course_detail', $course->slug) }}">
                                                    {{ $course->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                            <li class="head-nav-text d-block d-lg-none">More From PowerLMS</li>
                            <li aria-haspopup="true"
                                class=" content-dropdown profile-dropdown d-block d-lg-none second-menu">
                                @foreach ($menu_items as $menu_item)
                                    <a href="{{ asset($menu_item->link) }}">@lang('frontend.nav.custom_menu_item.' . str_slug($menu_item->label, '_'))</a>
                                @endforeach
                            </li>
                            <li class="head-nav-text d-block d-lg-none">Choose Language</li>
                            <li aria-haspopup="true"
                                class=" language-dropdown profile-dropdown d-block d-lg-none second-menu">
                                <h5></h5>
                                <i class="fas fa-globe"></i> {{ $locale_list[app()->getLocale()] ?? '' }}
                                <span class="wsmenu-click wsarrow wsmenu-arrow"></span>
                                <ul class="sub-menu last-sub-menu">
                                    @foreach ($locale_list as $lang => $lang_name)

                                            <li aria-haspopup="true" class="sub-mobile-category">
                                                <a href="{{ route('language.swap', $lang) }}">
                                                    {{ $lang_name }} @if (app()->getLocale() == $lang) <i class="fas fa-check d-block text-success"></i> @endif</a>
                                            </li>

                                    @endforeach
                                </ul>
                            </li>
                            {{-- for desktop view --}}

                            <li aria-haspopup="true" class="wsmenu-click d-none d-lg-block topHeaderDropDownMenu"
                                id="navbarDropdown">
                                <a class="nav-link d-flex align-items-center show"
                                   href="{{ route('categories') }}">@lang('frontend.nav.categories_text')
                                    <span class="wsarrow wsmenu-arrow"></span>
                                </a>
                                <div class="d-flex dropdown-menu col-menu-container p-0 bg-transparent main-menu"
                                     style="display:none;">
                                    <div class="flex-fill col-menu align-items-stretch category-level-1 bg-white">
                                        <ul class="ps-0 sub-menu">
                                            @foreach ($categories as $category)
                                                <li class="category-dropdown dropdown-item d-flex justify-content-between"
                                                    data-show_class="level-category-{{ $category->id }}">
                                                    <a href="{{ route('category_detail', $category->slug) }}">
                                                            <span class="text-wrap pe-2">
                                                                {{ $category->name }}
                                                            </span>
                                                        <i class="fas fa-angle-right text-end d-flex justify-content-end"></i>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @foreach ($categories as $category)
                                        <div
                                            class="flex-fill col-menu align-items-stretch category-courses-dropdown level-category-{{ $category->id }} bg-white">
                                            <ul class="ps-0 sub-menu">
                                                @foreach ($category->courses->take(6) as $course)
                                                    <li class="dropdown-item d-flex justify-content-between">
                                                        <a href="{{ route('course_detail', $course->slug) }}">
                                                            <span class="text-wrap pe-2">{{ $course->name }}</span>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endforeach
                                </div>
                            </li>
                            <li aria-haspopup="true" class="li-mobile-none">
                                <a href="#" class="lang-select"><i class="fas fa-globe me-0"></i>
                                    ({{ strtoupper(app()->getLocale()) }})
                                    <span class="wsarrow"></span>
                                </a>
                                <ul class="sub-menu ">
                                    @foreach ($locale_list as $lang => $lang_name)
                                        @if (app()->getLocale() != $lang)
                                            <li aria-haspopup="true"><a href="{{ route('language.swap', $lang) }}">
                                                    {{ $lang_name }}</a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                            @if (!auth()->check())
                                <li class="nl-simple li-mobile-none" aria-haspopup="true">
                                    <a href="{{ route('login') }}"
                                       class="btn btn-rose tra-black-hover last-link">@lang('frontend.nav.get_started_button')</a>
                                </li>
                                {{--  for hamburger --}}
                                <li aria-haspopup="true" class="hamburger-menu li-mobile-none position-relative">
                                    <a href="#" class="wsanimated-arrow"><i class="fas fa-bars me-0"></i>
                                        <span class="wsarrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        @foreach ($menu_items as $menu_item)
                                            <li aria-haspopup="true"><a
                                                    href="{{ asset($menu_item->link) }}">@lang('frontend.nav.custom_menu_item.' . str_slug($menu_item->label, '_'))</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                {{-- for hamburger --}}
                            @else
                                @if (auth()->user()->instructor_application_status == 1)
                                    <li class="nl-simple d-none d-lg-block" aria-haspopup="true">
                                        <a href="{{ route('instructor.dashboard') }}">
                                            @lang('frontend.nav.dropdown_menu_item.instructor')
                                        </a>
                                    </li>
                                @else
                                    @if(config('disable_instructor_registration') != 1)
                                        <li class="nl-simple d-none d-lg-block" aria-haspopup="true">
                                            <a href="{{ route('instructor.become') }}">
                                                @lang('frontend.nav.dropdown_menu_item.become_an_instructor')
                                            </a>
                                        </li>
                                    @endif
                                @endif
                            @endif
                            @if (auth()->check())
                                <li aria-haspopup="true" class="profile-dropdown li-mobile-none position-relative">
                                    <span class="wsmenu-click"><i class="wsmenu-arrow"></i></span>
                                    <a href="#" class="lang-select">
                                        <img id="profileImage"
                                             src="{{ getFileUrl(auth()->user()->image ?? 'default-placeholder.jpg', 'users') }}"
                                             alt="flag-icon">
                                    </a>
                                    <ul class="sub-menu course-dropdown ">
                                        @foreach ($menu_items as $menu_item)
                                            <li aria-haspopup="true"><a
                                                    href="{{ asset($menu_item->link) }}">@lang('frontend.nav.custom_menu_item.' . str_slug($menu_item->label, '_'))</a>
                                            </li>
                                        @endforeach
                                        <li aria-haspopup="true"><a
                                                href="{{ route('my-courses') }}">@lang('frontend.nav.dropdown_menu_item.my_courses')</a>
                                        </li>
                                        <li aria-haspopup="true"><a href="{{ route('purchase') }}">@lang('frontend.nav.dropdown_menu_item.purchase_history')
                                            </a>
                                        </li>
                                        <li aria-haspopup="true"><a
                                                href="{{ route('profile') }}">@lang('frontend.nav.dropdown_menu_item.profile')</a>
                                        </li>
                                        <li aria-haspopup="true"><a
                                                href="{{ route('logout') }}">@lang('frontend.nav.dropdown_menu_item.logout')</a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                        </ul>
                    </nav>
                    @include('front-end.layouts.partials.unread_chats')
                @else
                    {{-- for direction rtl --}}
                    <nav class="wsmenu clearfix">
                        <ul class="wsmenu-list">
                            {{-- for mobile view --}}
                            <li class="head-nav-text d-block d-lg-none">Most popular</li>
                            @foreach ($categories->take(6) as $category)
                                <li aria-haspopup="true"
                                    class=" categoroy-dropdown profile-dropdown d-block d-lg-none second-menu">
                                    {{ $category->name }}
                                    <span class="wsmenu-click wsarrow wsmenu-arrow"></span>
                                    <ul class="sub-menu last-sub-menu">
                                        @foreach ($category->courses->take(6) as $course)
                                            <li aria-haspopup="true" class="sub-mobile-category">
                                                <a href="{{ route('course_detail', $course->slug) }}">
                                                    {{ $course->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                            <li class="head-nav-text d-block d-lg-none">More From PowerLMS</li>
                            <li aria-haspopup="true"
                                class=" content-dropdown profile-dropdown d-block d-lg-none second-menu">
                                @foreach ($menu_items as $menu_item)
                                    <a href="{{ asset($menu_item->link) }}">@lang('frontend.nav.custom_menu_item.' . str_slug($menu_item->label, '_'))</a>
                                @endforeach
                            </li>
                            <li class="head-nav-text d-block d-lg-none">Choose Language</li>
                            <li aria-haspopup="true"
                                class=" language-dropdown profile-dropdown d-block d-lg-none second-menu">
                                <h5></h5>
                                <i class="fas fa-globe"></i> {{ $locale_list[app()->getLocale()] ?? '' }}
                                <span class="wsmenu-click wsarrow wsmenu-arrow"></span>
                                <ul class="sub-menu last-sub-menu">
                                    @foreach ($locale_list as $lang => $lang_name)
                                        <li aria-haspopup="true" class="sub-mobile-category">
                                            <a href="{{ route('language.swap', $lang) }}">
                                                {{ $lang_name }} @if (app()->getLocale() == $lang) <i class="fas fa-check d-block text-success"></i> @endif </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            {{--  for desktop view --}}
                            @if (auth()->check())
                                <li aria-haspopup="true" class="profile-dropdown li-mobile-none position-relative">
                                    <span class="wsmenu-click"><i class="wsmenu-arrow"></i></span>
                                    <a href="#" class="lang-select">
                                        <img id="profileImage"
                                             src="{{ getFileUrl(auth()->user()->image ?? 'default-placeholder.jpg', 'users') }}"
                                             alt="flag-icon">
                                    </a>
                                    <ul class="sub-menu course-dropdown ">
                                        @foreach ($menu_items as $menu_item)
                                            <li aria-haspopup="true"><a
                                                    href="{{ asset($menu_item->link) }}">@lang('frontend.nav.custom_menu_item.' . str_slug($menu_item->label, '_'))</a>
                                            </li>
                                        @endforeach
                                        <li aria-haspopup="true"><a
                                                href="{{ route('my-courses') }}">@lang('frontend.nav.dropdown_menu_item.my_courses')</a>
                                        </li>
                                        <li aria-haspopup="true"><a href="{{ route('purchase') }}">@lang('frontend.nav.dropdown_menu_item.purchase_history')
                                            </a>
                                        </li>
                                        <li aria-haspopup="true"><a
                                                href="{{ route('profile') }}">@lang('frontend.nav.dropdown_menu_item.profile')</a>
                                        </li>
                                        <li aria-haspopup="true"><a
                                                href="{{ route('logout') }}">@lang('frontend.nav.dropdown_menu_item.logout')</a>
                                        </li>
                                    </ul>
                                </li>
                                @if (auth()->user()->instructor_application_status == 1)
                                    <li class="nl-simple d-none d-lg-block" aria-haspopup="true">
                                        <a href="{{ route('instructor.dashboard') }}">@lang('frontend.nav.dropdown_menu_item.instructor')</a>
                                    </li>
                                @else
                                    <li class="nl-simple d-none d-lg-block" aria-haspopup="true">
                                        <a href="{{ route('instructor.become') }}">@lang('frontend.nav.dropdown_menu_item.become_an_instructor')</a>
                                    </li>
                                @endif
                            @endif
                            @if (!auth()->check())
                                <li class="nl-simple li-mobile-none" aria-haspopup="true">
                                    <a href="{{ route('login') }}"
                                       class="btn btn-rose tra-black-hover last-link">@lang('frontend.nav.get_started_button')</a>
                                </li>
                                {{--   for hamburger --}}
                                <li aria-haspopup="true" class="hamburger-menu li-mobile-none position-relative">
                                    <a href="#" class="wsanimated-arrow"><i class="fas fa-bars me-0"></i>
                                        <span class="wsarrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        @foreach ($menu_items as $menu_item)
                                            <li aria-haspopup="true">
                                                <a href="{{ asset($menu_item->link) }}">
                                                    @lang('frontend.nav.custom_menu_item.' . str_slug($menu_item->label, '_'))
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                {{--  for hamburger --}}
                            @endif
                            <li aria-haspopup="true" class="li-mobile-none">
                                <a href="#" class="lang-select"><i class="fas fa-globe me-0"></i></i>
                                    ({{ strtoupper(app()->getLocale()) }})
                                    <span class="wsarrow"></span>
                                </a>
                                <ul class="sub-menu ">
                                    @foreach ($locale_list as $lang => $lang_name)
                                        @if (app()->getLocale() != $lang)
                                            <li aria-haspopup="true"><a href="{{ route('language.swap', $lang) }}">
                                                    {{ $lang_name }}</a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>

                            <li aria-haspopup="true" class="wsmenu-click d-none d-lg-block topHeaderDropDownMenu"
                                id="navbarDropdown">
                                <a class="nav-link d-flex align-items-center show"
                                   href="{{ route('categories') }}">@lang('frontend.nav.categories_text')
                                    <span class="wsarrow wsmenu-arrow"></span>
                                </a>
                                <div class="d-flex dropdown-menu col-menu-container p-0 bg-transparent main-menu"
                                     style="display:none;margin-right: -21%;">
                                    <div class="flex-fill col-menu align-items-stretch category-level-1 bg-white">
                                        <ul class="ps-0 sub-menu">
                                            @foreach ($categories as $category)
                                                <li class="category-dropdown dropdown-item d-flex justify-content-between"
                                                    data-show_class="level-category-{{ $category->id }}">
                                                    <a href="{{ route('category_detail', $category->slug) }}"><span
                                                            class="text-wrap pe-2">{{ $category->name }}</span>
                                                        <i
                                                            class="fas fa-angle-left text-start d-flex justify-content-start"></i>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @foreach ($categories as $category)
                                        <div
                                            class="flex-fill col-menu align-items-stretch category-courses-dropdown level-category-{{ $category->id }} bg-white">
                                            <ul class="ps-0 sub-menu">
                                                @foreach ($category->courses->take(6) as $course)
                                                    <li class="dropdown-item d-flex justify-content-between">
                                                        <a href="{{ route('course_detail', $course->slug) }}">
                                                            <span class="text-wrap pe-2">{{ $course->name }}</span>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endforeach
                                </div>
                            </li>
                        </ul>
                    </nav>
                    @include('front-end.layouts.partials.unread_chats')
                @endif
                {{-- end for direction rtl --}}
            </div>
        </div>
    </div>
</header>
