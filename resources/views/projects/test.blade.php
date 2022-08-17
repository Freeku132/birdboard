<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{--    Tailwind--}}
    @vite('resources/css/app.css')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="bg-gray-light">
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-yellow-500 bg-gradient {background-image:} shadow-sm" >

        <div class="container mx-auto">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="/images/Agro-Tom.png" width="150" alt="Birdboard" class="rounded-2xl shadow">

            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->

                <ul class="navbar-nav ms-3 sm:mt-1.5">
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class=" p-2 nav-link  bg-amber-400 rounded-xl h-9 text-black shadow "  href="#" role="button" data-bs-toggle="dropdown" >
                            Usługi
                        </a>

                        <div class="dropdown-menu dropdown-menu-end bg-primary text-white" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item text-white" href="#">
                               Orka
                            </a>
                            <a class="dropdown-item text-white" href="#">
                                Talerzowanie
                            </a>
                            <a class="dropdown-item text-white" href="#">
                                Koszenie nieużytków
                            </a>
                            <a class="dropdown-item text-white" href="#">
                                Głęboszowanie
                            </a>
                        </div>

                    </li>
                </ul>
                <ul class="navbar-nav ms-3 sm:mt-1.5">
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class=" p-2 nav-link bg-amber-400 rounded-xl h-9 text-black shadow "  href="#" role="button" data-bs-toggle="dropdown" >
                            Park Maszynowy
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-primary text-white" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item text-white" href="#">
                                Orka
                            </a>
                            <a class="dropdown-item text-white" href="#">
                                Talerzowanie
                            </a>
                            <a class="dropdown-item text-white" href="#">
                                Koszenie nieużytków
                            </a>
                            <a class="dropdown-item text-white" href="#">
                                Głęboszowanie
                            </a>
                        </div>

                    </li>
                </ul>
                <ul class="navbar-nav ms-3 sm:mt-1.5">
                    <li class="nav-item dropdown">
                    <a href="#" class="p-2 nav-link bg-amber-400 rounded-xl h-9 text-black shadow ">
                            Kontakt
                    </a>
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="bg-blue-400 flex">
        <div class="w-3/4">
        <h1>
            Witamy
        </h1>
        </div>
        <div class="w-1/4 position-fixed float-right">
            Kontakt:

        </div>
    </main>
</div>
</body>
</html>
