<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @hasSection('title')

            <title>@yield('title') - {{ config('app.name') }}</title>
        @else
            <title>{{ config('app.name') }}</title>
        @endif

        <!-- Favicon -->
		<link rel="shortcut icon" href="{{ url(asset('favicon.ico')) }}">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ url(mix('css/app.css')) }}">
        @livewireStyles

        <!-- Scripts -->
        <script src="{{ url(mix('js/app.js')) }}" defer></script>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>

    <body>
        <header class="border-bottom bg-light">
            <div class="container py-1">
                <div class="row">
                    <div class="col-md-4">
                        <a href="{{ route('home') }}"><img src={{ asset('images/logo-voce-recomenda-2.png') }} class="img-fluid" alt="Você recomenda?"></a>
                    </div>
                    <div class="col-md-8 text-end align-self-center">
                        @if (Route::has('login'))
                        <div class="space-x-4">
                            @auth
                            <a href="{{ route('my-account') }}" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                                Minha conta
                            </a>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                                Sair
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            @else
                            <a href="{{ route('login') }}"
                                class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">Entrar</a>
        
                            @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">Registrar</a>
                            @endif
                            @endauth
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </header>
        @yield('body')

        @livewireScripts
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        @include('sweetalert::alert')
        @yield('js-includes')
        @yield('js-scripts')    
    </body>
</html>
