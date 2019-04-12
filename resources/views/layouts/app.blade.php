<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env('app_name') }}</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css' integrity='sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU' crossorigin='anonymous'>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-primary">
            <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name','') }}</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                        @if(Auth::check())
                            @can('admin-only', Auth::user())
                                <li class="nav-item"><a class="nav-link" href="{{ url('/dashboard') }}">Dashboard</a></li>                            
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Masterdata</a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ url('/category') }}">Category</a>
                                        <a class="dropdown-item" href="{{ url('/contestant') }}">Contestants</a>
                                        <a class="dropdown-item" href="{{ url('/round') }}">Stages of Competition</a>
                                    </div>
                                </li>
                            @else
                                <li><a class="nav-link" href="{{ url('/judge-dashboard') }}">Dashboard</a></li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Preliminary Round</a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ url('/judge-category/swim-wear') }}">Swim Wear</a>
                                        <a class="dropdown-item" href="{{ url('/judge-category/cocktail-dress') }}">Cocktail Dress</a>
                                        <a class="dropdown-item" href="{{ url('/judge-category/festival-costume') }}">Festival Costume</a>
                                        <a class="dropdown-item" href="{{ url('/judge-category/maranao-inspired-gown') }}">Maranao Inspired Gown</a>
                                        <a class="dropdown-item" href="{{ url('/judge-category/preliminary-interview') }}">Preliminary Interview</a>
                                    </div>
                                </li>
                                <li><a class="nav-link" href="{{ url('/judge-category/question-and-answer') }}">Question & Answer</a></li>
                            @endcan
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @else
                            @can('admin-only',Auth::user())
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endcan
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4" style="margin-top:45px;">
            @yield('content')
            <notifications group="app-notification" position="bottom right" animation-type="velocity"/>
        </main>
    </div>
</body>
</html>
