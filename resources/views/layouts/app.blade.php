<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>PlaystationCenter</title>

    <!-- Add Favicon -->
    <link rel="icon" href="{{ asset('assets/images/icon.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- Animate Refresh --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    {{-- Animate OnScroll --}}
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    {{-- Daisyui --}}
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.5.1/dist/full.css" rel="stylesheet" type="text/css" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Script Css --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/output.css') }}"> --}}


</head>

<body class="font-sans antialiased bg-cover bg-fixed bg-center h-full overflow-x-hidden"
    style="background-image: url('{{ asset('/assets/images/bg2.png') }}');">
    <div>
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow animate__animated animate__fadeIn animate__delay-1s">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>

        {{-- Page Footer --}}
        <footer class="border-t bottom-0 w-full bg-bottom animate__animated animate__fadeInUp bg-black">
            <div class="w-full max-w-screen-xl mx-auto p-4 md:py-4">
                <div class="flex flex-col items-center">
                    <a href="/" class="flex items-center mb-3 sm:mb-0">
                        <img src="{{ asset('assets/images/icon.png') }}" alt=""
                            class="block h-9 w-auto fill-current">
                        <span class="self-center text-2xl font-semibold whitespace-nowrap text-white ml-6">Playstation
                            Center</span>
                    </a>
                </div>
                <hr class="my-4 border-white sm:mx-auto lg:my-6" />
                <span class="block text-sm text-gray-400 sm:text-center text-center">© 2023 <a href="/"
                        class="hover:underline text-center">Playstation Center™</a>. All Rights Reserved.</span>
            </div>
        </footer>
        <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
        <script>
            AOS.init();
        </script>
    </div>
</body>

</html>
