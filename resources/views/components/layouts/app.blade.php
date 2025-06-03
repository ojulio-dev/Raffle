<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Raffle Application</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app,js'])
    </head>
    <body class="bg-[#FDFDFC] text-[#1b1b18] dark:bg-gray-950 dark:text-gray-200">

        @auth
            
            <x-ui.nav>

                <x-ui.nav.item route="home">
                    Home
                </x-ui.nav.item>

                @can('admin')

                    <x-ui.nav.item route="admin.raffle">
                        Raffle
                    </x-ui.nav.item>

                @endcan

                <x-ui.nav.item route="logout">
                    Logout
                </x-ui.nav.item>

            </x-ui.nav>

        @else   

            <x-ui.nav>

                <x-ui.nav.item route="home">
                    Home
                </x-ui.nav.item>

                <x-ui.nav.item route="login">
                    Login
                </x-ui.nav.item>

            </x-ui.nav>

        @endauth

        <x-ui.container>

            {{ $slot }}

        </x-ui.container>
    </body>
</html>
