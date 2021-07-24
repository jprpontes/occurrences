<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}" defer></script>
    <script src="{{ asset('js/bootstrap-datepicker.pt-BR.min.js') }}" defer></script>

    <script>
        @auth
            window.Roles = {!! json_encode(Auth::user()->allRoles->toArray(), true) !!};
        @else
            window.Roles = [];
        @endauth
    </script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
</head>
<body>
    @routes
    <div id="app">
        @auth
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand text-uppercase" href="{{ route('home') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <div class="d-flex">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- Left Side Of Navbar -->
                            <ul class="navbar-nav mr-auto">

                            </ul>

                            <!-- Right Side Of Navbar -->
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item">
                                    <a class="nav-link nav-link-icon active" aria-current="page" href="{{ route('steps.index') }}"><i class="mdi mdi-ray-start-vertex-end"></i>Etapas</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link nav-link-icon active" aria-current="page" href="{{ route('sectors.index') }}"><i class="mdi mdi-family-tree"></i>Setores</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link nav-link-icon active" aria-current="page" href="{{ route('users.index') }}"><i class="mdi mdi-account-group"></i>Usuários</a>
                                </li>

                                <li class="nav-item dropdown d-flex align-items-center ms-3">
                                    <a class="nav-link dropdown-toggle d-flex align-items-center p-0" href="#" role="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <Avatar username="{{ Auth::user()->name }}" :size="30" class="bg-gray-200 border-gray-600 text-gray-600 border"></Avatar>

                                        <span class="ms-1">{{ Auth::user()->name }}</span>
                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                        <li>
                                            <a class="dropdown-item dropdown-item-icon" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                                            <i class="mdi mdi-logout-variant"></i>
                                                {{ __('Sair') }}
                                            </a>
                                        </li>
                                    </ul>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        @endauth

        <main class="pt-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
