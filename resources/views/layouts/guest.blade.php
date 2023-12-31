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

    <!-- Scripts -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0  bg-cover bg-fixed bg-center h-screen"
    style="background-image: url('{{ asset('/assets/images/bg2.png') }}');">
        <div class="animate__animated animate__flipInX animate__delay-1s">
            <a href="/">
                <img src="{{ asset('assets/images/icon.png') }}" alt=""
                    class="w-50 h-40 fill-current">
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg animate__animated animate__zoomIn animate__delay-1s">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
