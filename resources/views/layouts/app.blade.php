<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title', 'Hogwarts SRP')</title>
        <!-- Styles / Scripts -->
        @vite(['resources/js/app.js', 'resources/sass/app.scss'])
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
