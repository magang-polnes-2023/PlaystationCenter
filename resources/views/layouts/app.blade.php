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

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-black bg-cover bg-fixed bg-center h-screen"
style="background-image: url('{{ asset('/assets/images/bg2.png') }}');"">
    <div>
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
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
        <footer class="border-t bottom-0 w-full bg-bottom">
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
    </div>
</body>

</html>
