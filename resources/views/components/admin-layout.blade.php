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

    @filamentStyles
    @vite('resources/css/app.css')
</head>

<body class="font-sans antialiased">
    <img src="{{ asset('images/reii_bg.jpg') }}" class="fixed top-0 left-0 h-full w-full object-cover opacity-10"
        alt="">
    <div class="flex h-screen overflow-hidden bg-gray-200">
        <div class="hidden md:flex md:flex-shrink-0">
            <div class="flex relative flex-col w-64">
                <div class="flex flex-col flex-grow  overflow-y-auto bg-white border-r">
                    <div class="flex flex-col flex-shrink-0 sticky top-0 border-b py-4 px-4">
                        <a class=" flex space-x-2 items-center  focus:outline-none focus:ring " href="/">
                            <img src="{{ asset('images/reii_logo.png') }}" class="h-12" alt="">
                            <div>
                                <h1 class="font-bold text-xl text-orange-500">REII</h1>
                                <h1 class="text-xs leading-3 text-gray-500">Management System</h1>
                            </div>
                        </a>
                        <button class="hidden rounded-lg focus:outline-none focus:shadow-outline">
                            <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                                <path fill-rule="evenodd"
                                    d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z"
                                    clip-rule="evenodd"></path>
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                    <livewire:sidevar />

                </div>
            </div>
        </div>
        <div class="flex flex-col flex-1 w-0 overflow-hidden">

            <main class="relative flex-1 overflow-y-auto focus:outline-none">
                <header class="bg-gray-100 border-b z-30 border-gray-200 sticky top-0 ">
                    <div class=" mx-auto flex w-full justify-between items-center py-4 2xl:max-w-7xl">
                        <div>

                            <div class="flex space-x-2 items-end text-orange-600">

                                <div>
                                    <h1 class="font-semibold uppercase text-lg font-poppins text-orange-600">

                                        ROCKFORT EDUCATIONAL INSTITUTE INCORPORATED
                                    </h1>
                                    <h1 class="text-xs leading-3 text-gray-500">National Highway, Brgy. San Pablo,
                                        Tacurong City S.K
                                    </h1>
                                </div>
                            </div>

                        </div>

                        <div class="relative flex-shrink-0 ml-5" @click.away="open = false" x-data="{ open: false }">
                            <div class="flex space-x-3 items-center ">
                                <button @click="open = !open"
                                    class="flex bg-white rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2"
                                    id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                    <img src="{{ asset('images/sample.png') }}"
                                        class="h-12 w-12 object-cover border border-orange-500 shadow-lg rounded-xl"
                                        alt="">
                                </button>
                                <div>
                                    <h1 class="uppercase font-bold text-gray-700">{{ auth()->user()->name }}</h1>
                                    <h1 class="leadind-3 text-sm text-gray-500">{{ auth()->user()->role->name }}</h1>
                                </div>
                            </div>
                            <div x-show="open" x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute right-0 z-10 w-48 py-1 mt-2 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5  focus:outline-none"
                                role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                                tabindex="-1" style="display: none;">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-500" role="menuitem"
                                    tabindex="-1" id="user-menu-item-0">
                                    Your Profile
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="route('logout')"
                                        onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                        class="px-4 py-2 flex  space-x-2 items-center text-sm text-red-500 relative hover:text-red-600"
                                        role="menuitem" tabindex="-1" id="user-menu-item-2">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M8.9 7.56c.31-3.6 2.16-5.07 6.21-5.07h.13c4.47 0 6.26 1.79 6.26 6.26v6.52c0 4.47-1.79 6.26-6.26 6.26h-.13c-4.02 0-5.87-1.45-6.2-4.99">
                                            </path>
                                            <g stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                opacity=".4">
                                                <path d="M15 12H3.62M5.85 8.65L2.5 12l3.35 3.35"></path>
                                            </g>
                                        </svg>
                                        <span>
                                            Sign out
                                        </span>
                                    </a>
                                </form>
                            </div>
                        </div>


                    </div>
                </header>

                <div class="py-6 relative">
                    <div class=" mx-auto 2xl:max-w-7xl ">
                        <header
                            class="font-poppins relative font-bold uppercase text-2xl flex space-x-2 items-center text-orange-600">
                            <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                fill="currentColor" aria-hidden="true">
                                <path
                                    d="M20.04 6.82l-5.76-4.03c-1.57-1.1-3.98-1.04-5.49.13L3.78 6.83c-1 .78-1.79 2.38-1.79 3.64v6.9c0 2.55 2.07 4.63 4.62 4.63h10.78c2.55 0 4.62-2.07 4.62-4.62V10.6c0-1.35-.87-3.01-1.97-3.78z"
                                    opacity=".4"></path>
                                <path
                                    d="M12 18.75c-.41 0-.75-.34-.75-.75v-3c0-.41.34-.75.75-.75s.75.34.75.75v3c0 .41-.34.75-.75.75z">
                                </path>
                            </svg>
                            <span>@yield('title')</span>
                        </header>
                        <div class="mt-5">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    @filamentScripts
    @vite('resources/js/app.js')
</body>

</html>
