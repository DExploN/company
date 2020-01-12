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
<!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
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
                <a class="menu__lang menu__lang-active" href="#">RU</a>
                <a class="menu__lang" href="#">EN</a>
            </div>
            <ul class="menu__list">
                <li><a class="menu__link" href="/"><i class="menu__link-picture fas fa-address-card fa-fw"></i>О
                        Компании</a></li>
                <li><a class="menu__link" href="/portfolio"><i class="menu__link-picture fas fa-briefcase fa-fw"></i>Портфолио</a>
                </li>
                <li>
                    <a class="menu__link" href="#"><i class="menu__link-picture fas fa-user-plus fa-fw"></i>Вакансии</a>
                </li>

                @auth()
                    <h5 class="menu__admin-title">Админ панель</h5>

                    <li><a class="menu__link" href="{{route('portfolio.index')}}"><i
                                class="menu__link-picture fas fa-briefcase fa-fw"></i>Портфолио</a>
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
            @yield('content')
        </div>
    </main>
    <div class="overlay menu-toggler"></div>
</div>
<!-- its stop transition css bug -->
<script></script>
</body>
</html>
