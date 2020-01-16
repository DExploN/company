<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>
    @if(isset($description))
        <meta name="description" content="{{$description}}"/>
    @endif
    @if(isset($keywords))
        <meta name="keywords" content="{{$keywords}}"/>
@endif

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app" class="container-fluid m-0 p-0 overflow-hidden">

    <aside id="left-column" class="navbar-expand-lg navbar-dark">
        <header id="header">
            <button class="navbar-toggler menu-toggler" type="button">
                <span class="navbar-toggler-icon"></span>
            </button>
            <img src="{{asset('images/logo_ru_v.svg')}}" class="d-none d-lg-inline-block"/>
            <img src="{{asset('images/logo_ru_h.svg')}}" class="logo-h d-lg-none"/>

        </header>

        <nav class="menu">
            <div class="menu__languages">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

                    <a class="menu__lang @if(LaravelLocalization::getCurrentLocale() === $localeCode) menu__lang-active @endif"
                       rel="alternate" hreflang="{{ $localeCode }}"
                       href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                        {{ mb_strtoupper($localeCode) }}
                    </a>
                @endforeach
            </div>
            <ul class="menu__list">
                <li><a class="menu__link" href="/"><i
                            class="menu__link-picture fas fa-address-card fa-fw"></i>@lang('About company')</a></li>
                <li><a class="menu__link" href="{{route('portfolio.index')}}"><i
                            class="menu__link-picture fas fa-briefcase fa-fw"></i>@lang('Portfolio')</a>
                </li>
                <li>
                    <a class="menu__link" href="#"><i
                            class="menu__link-picture fas fa-user-plus fa-fw"></i>@lang('Jobs')</a>
                </li>


                @auth()
                    <h5 class="menu__admin-title">@lang('Admin dashboard')</h5>

                    <li>
                        <a class="menu__link @if(strpos(request()->route()->getAction('as'),'admin.portfolio')===0) menu__link-active @endif"
                           href="{{route('admin.portfolio.index')}}"><i
                                class="menu__link-picture fas fa-briefcase fa-fw"></i>@lang('Portfolio')</a>
                    </li>
                    <li>
                        <a class="menu__link @if(strpos(request()->route()->getAction('as'),'admin.page')===0) menu__link-active @endif"
                           href="{{route('admin.page.index')}}"><i
                                class="menu__link-picture fas fa-file fa-fw"></i>@lang('Pages')</a>
                    </li>
                    <li><a class="menu__link" href="/admin/translations">
                            <i class="menu__link-picture fas fa-language fa-fw"></i>@lang('Translation manager')</a>
                    </li>
                    <li>
                        <a class="menu__link" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i
                                class="menu__link-picture fas fa-sign-out-alt fa-fw"></i> {{ __('Logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endauth
            </ul>
        </nav>
    </aside>
    <main id="right-column">
        @if(isset($h1))
            <div class="title-box">
                <div class="container ">
                    <i class="title-box__picture fas fa-briefcase fa-fw"></i>
                    <h1 class="title-box__text">{{$h1}}</h1>
                </div>
            </div>
        @else
            <div class="tree-color">
                <span></span>
                <span></span>
                <span></span>
            </div>
        @endif

        <div class="container my-4 px-md-4 ">
            @if(session('success-message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('success-message')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif


            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                @yield('content')
        </div>
    </main>
    <div class="overlay menu-toggler"></div>
</div>
<!-- Scripts -->
<!-- its stop transition css bug -->
<script></script>
@prepend('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@endprepend
@stack('scripts')
</body>
</html>
