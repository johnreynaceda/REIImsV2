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
    <x-dialog z-index="z-50" blur="md" align="center" />
    <img src="{{ asset('images/reii_bg.jpg') }}" class="fixed top-0 left-0 h-full w-full object-cover opacity-10"
        alt="">
    <div>

        <div>

            <!-- Navigation starts -->
            <nav class="w-full mx-auto bg-white   shadow relative z-10">
                <div class="justify-between container px-6 h-16 flex items-center lg:items-stretch mx-auto">
                    <div class="flex items-center">
                        <div aria-label="Home" role="img" class="mr-10 flex items-center">
                            <img src="{{ asset('images/reii_logo.png') }}" class="h-12" alt="logo">
                        </div>
                        <ul class="pr-32 xl:flex hidden space-x-4 items-center h-full">
                            <li
                                class="cursor-pointer h-full flex items-center text-sm text-gray-600 hover:text-orange-500 font-medium">
                                <a href="{{ route('business-office.dashboard') }}"> Dashboard</a>
                            </li>
                            <li
                                class="cursor-pointer h-full flex items-center text-sm text-gray-600 hover:text-orange-500 font-medium">
                                <a href="{{ route('business-office.enrollee') }}"> Enrollee</a>
                            </li>
                            <li
                                class="cursor-pointer h-full flex items-center text-sm text-gray-600 hover:text-orange-500 font-medium">
                                <a href="{{ route('business-office.soa') }}"> SOA</a>
                            </li>
                            <li
                                class="cursor-pointer h-full flex items-center text-sm text-gray-600 hover:text-orange-500 font-medium">
                                <a href="{{ route('business-office.students') }}"> Students</a>
                            </li>
                            <li
                                class="cursor-pointer h-full flex items-center text-sm text-gray-600 hover:text-orange-500 font-medium">
                                <div @click.away="open = false" class="relative lg:mx-auto" x-data="{ open: false }">
                                    <button @click="open = !open"
                                        class="flex flex-row items-end w-full  py-2 mt-2 focus:outline-none focus:text-orange-500  md:inline md:mt-0 focus:shadow-outline">
                                        <span> Sales </span>
                                        <svg fill="currentColor" viewBox="0 0 20 20"
                                            :class="{ 'rotate-180': open, 'rotate-0': !open }"
                                            class="inline size-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1 rotate-0">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                    <div x-show="open" x-transition:enter="transition ease-out duration-100"
                                        x-transition:enter-start="transform opacity-0 scale-95"
                                        x-transition:enter-end="transform opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-75"
                                        x-transition:leave-start="transform opacity-100 scale-100"
                                        x-transition:leave-end="transform opacity-0 scale-95"
                                        class="absolute z-50 w-40  px-2 mt-3 transform -translate-x-1/2 left-1/2 sm:px-0"
                                        style="display: none;">
                                        <div
                                            class="overflow-hidden rounded-lg shadow-lg ring-1 ring-black ring-opacity-5">
                                            <div class="relative p-2 bg-white ">
                                                <ul class="space-y-2">
                                                    <li class="text-gray-600 hover:text-orange-500">
                                                        <a href="{{ route('business-office.sales-transaction') }}">Sales
                                                            Transaction</a>
                                                    </li>
                                                    <li class="text-gray-600 hover:text-orange-500">
                                                        <a href="{{ route('business-office.sales-category') }}">Sales
                                                            Category</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li
                                class="cursor-pointer h-full flex items-center text-sm text-gray-600 hover:text-orange-500 font-medium">
                                <div @click.away="open = false" class="relative lg:mx-auto" x-data="{ open: false }">
                                    <button @click="open = !open"
                                        class="flex flex-row items-end w-full  py-2 mt-2 focus:outline-none focus:text-orange-500  md:inline md:mt-0 focus:shadow-outline">
                                        <span> Expenses </span>
                                        <svg fill="currentColor" viewBox="0 0 20 20"
                                            :class="{ 'rotate-180': open, 'rotate-0': !open }"
                                            class="inline size-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1 rotate-0">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                    <div x-show="open" x-transition:enter="transition ease-out duration-100"
                                        x-transition:enter-start="transform opacity-0 scale-95"
                                        x-transition:enter-end="transform opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-75"
                                        x-transition:leave-start="transform opacity-100 scale-100"
                                        x-transition:leave-end="transform opacity-0 scale-95"
                                        class="absolute z-10 w-48  px-2 mt-3 transform -translate-x-1/2 left-1/2 sm:px-0"
                                        style="display: none;">
                                        <div
                                            class="overflow-hidden rounded-lg shadow-lg ring-1 ring-black ring-opacity-5">
                                            <div class="relative p-2 bg-white ">
                                                <ul class="space-y-2">
                                                    <li class="text-gray-600 hover:text-orange-500">
                                                        <a href="{{ route('business-office.expense-transaction') }}">Expense
                                                            Transaction</a>
                                                    </li>
                                                    <li class="text-gray-600 hover:text-orange-500">
                                                        <a href="{{ route('business-office.expense-category') }}">Expense
                                                            Category</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li
                                class="cursor-pointer h-full flex items-center text-sm text-gray-600 hover:text-orange-500 font-medium">
                                <a href="{{ route('business-office.reports') }}"> Reports</a>
                            </li>
                        </ul>
                    </div>
                    <div class="h-full xl:flex hidden items-center justify-end">
                        <div class="h-full flex items-center">
                            <livewire:user-dropdown />
                        </div>
                    </div>
                    <div class="visible xl:hidden flex items-center">
                        <div>
                            <button id="menu"
                                class="text-gray-800 rounded focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800"
                                onclick="sidebarHandler(true) ">
                                <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/light_with_dark_page_title_and_white_box-svg7.svg"
                                    alt="toggler">
                            </button>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navigation ends -->
            <!-- Page title starts -->
            <div class="bg-gradient-to-tr from-orange-600 to-orange-500 bg-opacity-60 pt-8 pb-16 relative">
                <div
                    class="container relative px-6 mx-auto flex flex-col lg:flex-row items-start lg:items-center justify-between">
                    <div class="flex-col flex lg:flex-row items-start lg:items-center">

                        <div class="ml-0 my-6 lg:my-0">
                            <h4 class="text-2xl font-bold leading-tight text-white mb-2">@yield('title')</h4>
                            <p class="flex items-center text-gray-100 text-xs">
                                <span class="cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-home">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                        <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                        <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                    </svg>
                                </span>
                                <span class="mx-2">&gt;</span>
                                <span class="cursor-pointer">@yield('title')</span>

                            </p>
                        </div>
                    </div>
                    <div>
                        <div>
                            <h1 class="font-semibold uppercase text-lg font-poppins text-white">

                                ROCKFORT EDUCATIONAL INSTITUTE INCORPORATED
                            </h1>
                            <h1 class="text-xs leading-3 text-right text-gray-100">National Highway, Brgy. San Pablo,
                                Tacurong City S.K
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page title ends -->
            <div class="container px-6 mx-auto">
                <!-- Remove class [ h-64 ] when adding a card block -->
                <div class="rounded-xl shadow relative bg-white z-10 -mt-8 mb-8 w-full p-10">
                    {{ $slot }}
                </div>
            </div>
        </div>



    </div>
    @filamentScripts
    @vite('resources/js/app.js')
</body>

</html>
