<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="{{ asset('favicon.ico') }}">
        <title>@yield('title', 'Hogwarts SRP')</title>
        <!-- Styles / Scripts -->
        @vite(['resources/js/app.js', 'resources/sass/app.scss'])
        @livewireStyles
    </head>
    <body>
        <header>
            @auth
                @include('layouts.nav')
            @endauth
        </header>

        <main class="container-fluid">
            @yield('content')
        </main>
    </body>
</html>
