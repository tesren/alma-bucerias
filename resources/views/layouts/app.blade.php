<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- Fuente --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">

        @yield('titles')

        @include('components.favicon')

        @livewireStyles

        @vite(['resources/css/app.css'])
    </head>

    <body>
        <!-- Page Content -->
        <main class="position-relative">
            <livewire:nav-bar />

            {{ $slot }}
            
        </main>

       
        <livewire:whatsap-btn />


        {{-- Footer --}}
        @include('components.footer')


        @livewireScripts

        @vite(['resources/js/app.js'])

    </body>

</html>