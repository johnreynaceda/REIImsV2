<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    @wireUiScripts
    @filamentStyles
    @vite('resources/css/app.css')
</head>

<body class="font-sans text-gray-900 antialiased ">
    <img src="{{ asset('images/reii_bg.jpg') }}" class="fixed top-0 left-0 h-full w-full object-cover opacity-20"
        alt="">
    <div class="min-h-screen flex flex-col sm:justify-center  items-center pt-6 sm:pt-0 bg-orange-100">
        <div class="relative">
            <a href="/">
                <x-application-logo class="w-28 h-28 fill-current text-gray-500" />
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-6 bg-white relative shadow-md overflow-hidden sm:rounded-lg">
            <p class="text-center text-xl font-extrabold font-poppins text-gray-700">ROCKFORT EDUCATIONAL INSTITUTE
                INCORPORATED</p>
            <div class="mt-5">
                {{ $slot }}
            </div>
        </div>
    </div>
    @filamentScripts
    @vite('resources/js/app.js')
</body>

</html>
