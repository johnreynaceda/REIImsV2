<div class="flex flex-col flex-grow mt-5">
    <nav class="flex-1 px-2 bg-white">
        <p class="px-4 pt-4 text-xs font-semibold text-gray-400 uppercase">
            Analytics
        </p>
        <ul>
            <li>
                <a class="inline-flex items-center w-full px-4 py-2 mt-1 text-sm font-medium text-gray-600 transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-orange-500/80 hover:scale-95 hover:text-white"
                    href="{{ route('admin.dashboard') }}">
                    <svg class="w-5 h-5 md hydrated" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        fill="currentColor" aria-hidden="true">
                        <path
                            d="M22 7.81v.69H9V2h7.19C19.83 2 22 4.17 22 7.81zM22 15.5v.69c0 3.64-2.17 5.81-5.81 5.81H9v-6.5h13z"
                            opacity=".4"></path>
                        <path d="M9 2v20H7.81C4.17 22 2 19.83 2 16.19V7.81C2 4.17 4.17 2 7.81 2H9z">
                        </path>
                        <path d="M22 8.5H9v7h13v-7z" opacity=".6"></path>
                    </svg>
                    <span class="ml-4">
                        Overview
                    </span>
                </a>
            </li>
        </ul>
        <p class="px-4 pt-8 text-xs font-semibold text-gray-400 uppercase">
            GENERAL
        </p>
        <ul>
            <li>
                <a class="{{ request()->routeIs('admin.enrollee') ? 'bg-orange-500/80 text-white scale-95' : '' }}  inline-flex items-center w-full px-4 py-2 mt-1 text-sm font-medium text-gray-600 transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-orange-500/80 hover:scale-95 hover:text-white"
                    href="{{ route('admin.enrollee') }}">
                    <svg class="w-5 h-5 md hydrated" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        fill="currentColor" aria-hidden="true">
                        <path
                            d="M21.66 10.44l-.98 4.18c-.84 3.61-2.5 5.07-5.62 4.77-.5-.04-1.04-.13-1.62-.27l-1.68-.4c-4.17-.99-5.46-3.05-4.48-7.23l.98-4.19c.2-.85.44-1.59.74-2.2 1.17-2.42 3.16-3.07 6.5-2.28l1.67.39c4.19.98 5.47 3.05 4.49 7.23z"
                            opacity=".4"></path>
                        <path
                            d="M15.06 19.39c-.62.42-1.4.77-2.35 1.08l-1.58.52c-3.97 1.28-6.06.21-7.35-3.76L2.5 13.28c-1.28-3.97-.22-6.07 3.75-7.35l1.58-.52c.41-.13.8-.24 1.17-.31-.3.61-.54 1.35-.74 2.2l-.98 4.19c-.98 4.18.31 6.24 4.48 7.23l1.68.4c.58.14 1.12.23 1.62.27z">
                        </path>
                    </svg>
                    <span class="ml-4">
                        Enrollees
                    </span>
                </a>
            </li>
            <li>
                <a class="{{ request()->routeIs('admin.soa') ? 'bg-orange-500/80 text-white scale-95' : '' }}  inline-flex items-center w-full px-4 py-2 mt-1 text-sm font-medium text-gray-600 transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-orange-500/80 hover:scale-95 hover:text-white"
                    href="{{ route('admin.soa') }}">
                    <svg class="w-5 h-5 md hydrated" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        fill="currentColor" aria-hidden="true">
                        <path
                            d="M21.25 22H2.75c-.41 0-.75-.34-.75-.75s.34-.75.75-.75h18.5c.41 0 .75.34.75.75s-.34.75-.75.75z">
                        </path>
                        <path
                            d="M20.59 13.7l-7.23 7.23a3.618 3.618 0 01-5.12.01l-4.61-4.61L15.99 3.97l4.61 4.61a3.618 3.618 0 01-.01 5.12z"
                            opacity=".4"></path>
                        <path
                            d="M15.99 3.97L3.62 16.33l-.91-.91a3.618 3.618 0 01.01-5.12l7.23-7.23a3.618 3.618 0 015.12-.01l.92.91zM12.89 17.6l-1.35 1.35c-.28.28-.73.28-1.01 0a.712.712 0 010-1.01l1.35-1.35c.28-.28.73-.28 1.01 0s.28.73 0 1.01zM17.27 13.22l-2.69 2.69c-.28.28-.73.28-1.01 0a.712.712 0 010-1.01l2.69-2.69c.28-.28.73-.28 1.01 0 .27.28.27.73 0 1.01z">
                        </path>
                    </svg>
                    <span class="ml-4">
                        SOA
                    </span>
                </a>
            </li>
        </ul>
        <p class="px-4 pt-5 text-xs font-semibold text-gray-400 uppercase">
            MANAGEMENT
        </p>
        <ul>

            <li>
                <a class="{{ request()->routeIs('admin.students') ? 'bg-orange-500/80 text-white scale-95' : '' }}  inline-flex items-center w-full px-4 py-2 mt-1 text-sm font-medium text-gray-600 transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-orange-500/80 hover:scale-95 hover:text-white"
                    href="{{ route('admin.students') }}">
                    <svg class="w-5 h-5 md hydrated" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        fill="currentColor" aria-hidden="true">
                        <path d="M12 12a5 5 0 100-10 5 5 0 000 10z"></path>
                        <path
                            d="M12 14.5c-5.01 0-9.09 3.36-9.09 7.5 0 .28.22.5.5.5h17.18c.28 0 .5-.22.5-.5 0-4.14-4.08-7.5-9.09-7.5z"
                            opacity=".4"></path>
                        <path
                            d="M22.77 20.68l-.76-.76c.4-.6.63-1.32.63-2.09a3.82 3.82 0 10-3.82 3.82c.77 0 1.49-.23 2.09-.63l.76.76c.15.15.35.23.55.23.2 0 .4-.08.55-.23.31-.31.31-.8 0-1.1z">
                        </path>
                    </svg>
                    <span class="ml-4">
                        Students
                    </span>
                </a>
            </li>
            <li>
                <a class="inline-flex items-center w-full px-4 py-2 mt-1 text-sm font-medium text-gray-600 transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-orange-500/80 hover:scale-95 hover:text-white"
                    href="#">
                    <svg class="w-5 h-5 md hydrated" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        fill="currentColor" aria-hidden="true">
                        <path d="M12 12a5 5 0 100-10 5 5 0 000 10z"></path>
                        <path
                            d="M12 14.5c-5.01 0-9.09 3.36-9.09 7.5 0 .28.22.5.5.5h17.18c.28 0 .5-.22.5-.5 0-4.14-4.08-7.5-9.09-7.5z"
                            opacity=".4"></path>
                        <path
                            d="M22.77 20.68l-.76-.76c.4-.6.63-1.32.63-2.09a3.82 3.82 0 10-3.82 3.82c.77 0 1.49-.23 2.09-.63l.76.76c.15.15.35.23.55.23.2 0 .4-.08.55-.23.31-.31.31-.8 0-1.1z">
                        </path>
                    </svg>
                    <span class="ml-4">
                        Teachers
                    </span>
                </a>
            </li>
        </ul>
        <ul>
            <li>
                <div x-data="{ open: false }">
                    <button
                        class="inline-flex items-center w-full px-4 py-2 mt-1 text-xs font-medium text-gray-600 transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-orange-500/80 hover:scale-95 hover:text-white group"
                        @click="open = ! open">
                        <span class="inline-flex items-center">
                            <svg class="w-5 h-5 md hydrated" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                fill="currentColor" aria-hidden="true">
                                <path
                                    d="M20.5 10.19h-2.89c-2.37 0-4.3-1.93-4.3-4.3V3c0-.55-.45-1-1-1H8.07C4.99 2 2.5 4 2.5 7.57v8.86C2.5 20 4.99 22 8.07 22h7.86c3.08 0 5.57-2 5.57-5.57v-5.24c0-.55-.45-1-1-1z"
                                    opacity=".4"></path>
                                <path
                                    d="M15.8 2.21c-.41-.41-1.12-.13-1.12.44v3.49c0 1.46 1.24 2.67 2.75 2.67.95.01 2.27.01 3.4.01.57 0 .87-.67.47-1.07-1.44-1.45-4.02-4.06-5.5-5.54z">
                                </path>
                            </svg>
                            <span class="ml-4">
                                Grade & Section
                            </span>
                        </span>
                        <svg fill="currentColor" viewBox="0 0 20 20" :class="{ 'rotate-180': open, 'rotate-0': !open }"
                            class="inline w-5 h-5 ml-auto transition-transform duration-200 transform group-hover:text-accent rotate-0">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <div class="p-2 pl-6 -px-px" x-show="open" @click.outside="open = false" style="display: none;">
                        <ul>
                            <li>
                                <a href="{{ route('admin.grade_level') }}" title=""
                                    class="inline-flex items-center w-full p-2 pl-3 text-sm font-medium text-gray-500 rounded-lg hover:text-orange-500 group hover:border hover:border-orange-500 hover:bg-gray-50">
                                    <span class="inline-flex items-center w-full">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            fill="currentColor" aria-hidden="true">
                                            <path
                                                d="M16 2H8C4 2 2 4 2 8v13c0 .55.45 1 1 1h13c4 0 6-2 6-6V8c0-4-2-6-6-6z"
                                                opacity=".4"></path>
                                            <path
                                                d="M17 8.75H7c-.41 0-.75.34-.75.75s.34.75.75.75h10c.41 0 .75-.34.75-.75s-.34-.75-.75-.75zM14 13.75H7c-.41 0-.75.34-.75.75s.34.75.75.75h7c.41 0 .75-.34.75-.75s-.34-.75-.75-.75z">
                                            </path>
                                        </svg>
                                        <span class="ml-4">
                                            Grade Levels
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#" title="#"
                                    class="inline-flex items-center w-full p-2 pl-3 text-sm font-medium text-gray-500 rounded-lg hover:text-orange-500 group hover:border hover:border-orange-500 hover:bg-gray-50">
                                    <span class="inline-flex items-center w-full">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            fill="currentColor" aria-hidden="true">
                                            <path
                                                d="M16 2H8C4 2 2 4 2 8v13c0 .55.45 1 1 1h13c4 0 6-2 6-6V8c0-4-2-6-6-6z"
                                                opacity=".4"></path>
                                            <path
                                                d="M17 8.75H7c-.41 0-.75.34-.75.75s.34.75.75.75h10c.41 0 .75-.34.75-.75s-.34-.75-.75-.75zM14 13.75H7c-.41 0-.75.34-.75.75s.34.75.75.75h7c.41 0 .75-.34.75-.75s-.34-.75-.75-.75z">
                                            </path>
                                        </svg>
                                        <span class="ml-4">
                                            Sections
                                        </span>
                                    </span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
            </li>
            <li>
                <a class="{{ request()->routeIs('admin.school_fees') ? 'bg-orange-500/80 text-white scale-95' : '' }}  inline-flex items-center w-full px-4 py-2 mt-1 text-sm font-medium text-gray-600 transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-orange-500/80 hover:scale-95 hover:text-white"
                    href="{{ route('admin.school_fees') }}">
                    <svg class="w-5 h-5 md hydrated" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        fill="currentColor" aria-hidden="true">
                        <path d="M21 7v10c0 3-1.5 5-5 5H8c-3.5 0-5-2-5-5V7c0-3 1.5-5 5-5h8c3.5 0 5 2 5 5z"
                            opacity=".4"></path>
                        <path
                            d="M18.5 9.25h-2c-1.52 0-2.75-1.23-2.75-2.75v-2c0-.41.34-.75.75-.75s.75.34.75.75v2c0 .69.56 1.25 1.25 1.25h2c.41 0 .75.34.75.75s-.34.75-.75.75zM12 13.75H8c-.41 0-.75-.34-.75-.75s.34-.75.75-.75h4c.41 0 .75.34.75.75s-.34.75-.75.75zM16 17.75H8c-.41 0-.75-.34-.75-.75s.34-.75.75-.75h8c.41 0 .75.34.75.75s-.34.75-.75.75z">
                        </path>
                    </svg>
                    <span class="ml-4">
                        School Fees
                    </span>
                </a>
            </li>
            <li>
                <a class="inline-flex items-center w-full px-4 py-2 mt-1 text-sm font-medium text-gray-600 transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-orange-500/80 hover:scale-95 hover:text-white"
                    href="#">
                    <svg class="w-5 h-5 md hydrated" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        fill="currentColor" aria-hidden="true">
                        <path d="M21 7v10c0 3-1.5 5-5 5H8c-3.5 0-5-2-5-5V7c0-3 1.5-5 5-5h8c3.5 0 5 2 5 5z"
                            opacity=".4"></path>
                        <path
                            d="M18.5 9.25h-2c-1.52 0-2.75-1.23-2.75-2.75v-2c0-.41.34-.75.75-.75s.75.34.75.75v2c0 .69.56 1.25 1.25 1.25h2c.41 0 .75.34.75.75s-.34.75-.75.75zM12 13.75H8c-.41 0-.75-.34-.75-.75s.34-.75.75-.75h4c.41 0 .75.34.75.75s-.34.75-.75.75zM16 17.75H8c-.41 0-.75-.34-.75-.75s.34-.75.75-.75h8c.41 0 .75.34.75.75s-.34.75-.75.75z">
                        </path>
                    </svg>
                    <span class="ml-4">
                        SHS Strands
                    </span>
                </a>
            </li>
            <li>
                <a class="inline-flex items-center w-full px-4 py-2 mt-1 text-sm font-medium text-gray-600 transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-orange-500/80 hover:scale-95 hover:text-white"
                    href="{{ route('admin.subsidies') }}">
                    <svg class="w-5 h-5 md hydrated" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        fill="currentColor" aria-hidden="true">
                        <path d="M21 7v10c0 3-1.5 5-5 5H8c-3.5 0-5-2-5-5V7c0-3 1.5-5 5-5h8c3.5 0 5 2 5 5z"
                            opacity=".4"></path>
                        <path
                            d="M18.5 9.25h-2c-1.52 0-2.75-1.23-2.75-2.75v-2c0-.41.34-.75.75-.75s.75.34.75.75v2c0 .69.56 1.25 1.25 1.25h2c.41 0 .75.34.75.75s-.34.75-.75.75zM12 13.75H8c-.41 0-.75-.34-.75-.75s.34-.75.75-.75h4c.41 0 .75.34.75.75s-.34.75-.75.75zM16 17.75H8c-.41 0-.75-.34-.75-.75s.34-.75.75-.75h8c.41 0 .75.34.75.75s-.34.75-.75.75z">
                        </path>
                    </svg>
                    <span class="ml-4">
                        Subsidies
                    </span>
                </a>
            </li>

        </ul>
    </nav>
    <div class="mb-5">
        <p class="px-4 pt-4 text-xs font-semibold text-gray-400 uppercase">
            OTHERS
        </p>
        <ul>
            <li>
                <div x-data="{ open: false }">
                    <button
                        class="inline-flex items-center w-full px-4 py-2 mt-1 text-sm font-medium text-green-600 transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-orange-500/80 hover:scale-95 hover:text-white group"
                        @click="open = ! open">
                        <span class="inline-flex items-center">
                            <svg class="w-5 h-5 md hydrated" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                fill="currentColor" aria-hidden="true">
                                <path
                                    d="M20.5 10.19h-2.89c-2.37 0-4.3-1.93-4.3-4.3V3c0-.55-.45-1-1-1H8.07C4.99 2 2.5 4 2.5 7.57v8.86C2.5 20 4.99 22 8.07 22h7.86c3.08 0 5.57-2 5.57-5.57v-5.24c0-.55-.45-1-1-1z"
                                    opacity=".4"></path>
                                <path
                                    d="M15.8 2.21c-.41-.41-1.12-.13-1.12.44v3.49c0 1.46 1.24 2.67 2.75 2.67.95.01 2.27.01 3.4.01.57 0 .87-.67.47-1.07-1.44-1.45-4.02-4.06-5.5-5.54z">
                                </path>
                            </svg>
                            <span class="ml-4">
                                Sales
                            </span>
                        </span>
                        <svg fill="currentColor" viewBox="0 0 20 20"
                            :class="{ 'rotate-180': open, 'rotate-0': !open }"
                            class="inline w-5 h-5 ml-auto transition-transform duration-200 transform group-hover:text-accent rotate-0">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <div class="p-2 pl-6 -px-px" x-show="open" @click.outside="open = false"
                        style="display: none;">
                        <ul>
                            <li>
                                <a href="{{ route('admin.sales-transaction') }}" title="#"
                                    class="inline-flex items-center w-full p-2 pl-3 text-xs font-medium text-gray-500 rounded-lg hover:text-orange-500 group hover:border hover:border-orange-500 hover:bg-gray-50">
                                    <span class="inline-flex items-center w-full">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            fill="currentColor" aria-hidden="true">
                                            <path
                                                d="M16 2H8C4 2 2 4 2 8v13c0 .55.45 1 1 1h13c4 0 6-2 6-6V8c0-4-2-6-6-6z"
                                                opacity=".4"></path>
                                            <path
                                                d="M17 8.75H7c-.41 0-.75.34-.75.75s.34.75.75.75h10c.41 0 .75-.34.75-.75s-.34-.75-.75-.75zM14 13.75H7c-.41 0-.75.34-.75.75s.34.75.75.75h7c.41 0 .75-.34.75-.75s-.34-.75-.75-.75z">
                                            </path>
                                        </svg>
                                        <span class="ml-4">
                                            Transactions
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.sale-category') }}" title="#"
                                    class="inline-flex items-center w-full p-2 pl-3 text-xs font-medium text-gray-500 rounded-lg hover:text-orange-500 group hover:border hover:border-orange-500 hover:bg-gray-50">
                                    <span class="inline-flex items-center w-full">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            fill="currentColor" aria-hidden="true">
                                            <path
                                                d="M16 2H8C4 2 2 4 2 8v13c0 .55.45 1 1 1h13c4 0 6-2 6-6V8c0-4-2-6-6-6z"
                                                opacity=".4"></path>
                                            <path
                                                d="M17 8.75H7c-.41 0-.75.34-.75.75s.34.75.75.75h10c.41 0 .75-.34.75-.75s-.34-.75-.75-.75zM14 13.75H7c-.41 0-.75.34-.75.75s.34.75.75.75h7c.41 0 .75-.34.75-.75s-.34-.75-.75-.75z">
                                            </path>
                                        </svg>
                                        <span class="ml-4">
                                            Categories
                                        </span>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
            <li>
                <div x-data="{ open: false }">
                    <button
                        class="inline-flex items-center w-full px-4 py-2 mt-1 text-sm font-medium text-red-600 transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-orange-500/80 hover:scale-95 hover:text-white group"
                        @click="open = ! open">
                        <span class="inline-flex items-center">
                            <svg class="w-5 h-5 md hydrated" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                fill="currentColor" aria-hidden="true">
                                <path
                                    d="M20.5 10.19h-2.89c-2.37 0-4.3-1.93-4.3-4.3V3c0-.55-.45-1-1-1H8.07C4.99 2 2.5 4 2.5 7.57v8.86C2.5 20 4.99 22 8.07 22h7.86c3.08 0 5.57-2 5.57-5.57v-5.24c0-.55-.45-1-1-1z"
                                    opacity=".4"></path>
                                <path
                                    d="M15.8 2.21c-.41-.41-1.12-.13-1.12.44v3.49c0 1.46 1.24 2.67 2.75 2.67.95.01 2.27.01 3.4.01.57 0 .87-.67.47-1.07-1.44-1.45-4.02-4.06-5.5-5.54z">
                                </path>
                            </svg>
                            <span class="ml-4">
                                Expenses
                            </span>
                        </span>
                        <svg fill="currentColor" viewBox="0 0 20 20"
                            :class="{ 'rotate-180': open, 'rotate-0': !open }"
                            class="inline w-5 h-5 ml-auto transition-transform duration-200 transform group-hover:text-accent rotate-0">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <div class="p-2 pl-6 -px-px" x-show="open" @click.outside="open = false"
                        style="display: none;">
                        <ul>
                            <li>
                                <a href="{{ route('admin.expenses-transaction') }}" title="#"
                                    class="inline-flex items-center w-full p-2 pl-3 text-xs font-medium text-gray-500 rounded-lg hover:text-orange-500 group hover:border hover:border-orange-500 hover:bg-gray-50">
                                    <span class="inline-flex items-center w-full">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            fill="currentColor" aria-hidden="true">
                                            <path
                                                d="M16 2H8C4 2 2 4 2 8v13c0 .55.45 1 1 1h13c4 0 6-2 6-6V8c0-4-2-6-6-6z"
                                                opacity=".4"></path>
                                            <path
                                                d="M17 8.75H7c-.41 0-.75.34-.75.75s.34.75.75.75h10c.41 0 .75-.34.75-.75s-.34-.75-.75-.75zM14 13.75H7c-.41 0-.75.34-.75.75s.34.75.75.75h7c.41 0 .75-.34.75-.75s-.34-.75-.75-.75z">
                                            </path>
                                        </svg>
                                        <span class="ml-4">
                                            Transactions
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.expenses-category') }}" title="#"
                                    class="inline-flex items-center w-full p-2 pl-3 text-xs font-medium text-gray-500 rounded-lg hover:text-orange-500 group hover:border hover:border-orange-500 hover:bg-gray-50">
                                    <span class="inline-flex items-center w-full">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            fill="currentColor" aria-hidden="true">
                                            <path
                                                d="M16 2H8C4 2 2 4 2 8v13c0 .55.45 1 1 1h13c4 0 6-2 6-6V8c0-4-2-6-6-6z"
                                                opacity=".4"></path>
                                            <path
                                                d="M17 8.75H7c-.41 0-.75.34-.75.75s.34.75.75.75h10c.41 0 .75-.34.75-.75s-.34-.75-.75-.75zM14 13.75H7c-.41 0-.75.34-.75.75s.34.75.75.75h7c.41 0 .75-.34.75-.75s-.34-.75-.75-.75z">
                                            </path>
                                        </svg>
                                        <span class="ml-4">
                                            Categories
                                        </span>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
        <p class="px-4 pt-4 text-xs font-semibold text-gray-400 uppercase">
            PRINTABLES
        </p>
        <ul>
            <li>
                <a class="{{ request()->routeIs('admin.reports') ? 'bg-orange-500/80 text-white scale-95' : '' }}  inline-flex items-center w-full px-4 py-2 mt-1 text-sm font-medium text-gray-600 transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-orange-500/80 hover:scale-95 hover:text-white"
                    href="{{ route('admin.reports') }}">
                    <svg class="w-5 h-5 md hydrated" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        fill="currentColor" aria-hidden="true">
                        <path d="M21 7v10c0 3-1.5 5-5 5H8c-3.5 0-5-2-5-5V7c0-3 1.5-5 5-5h8c3.5 0 5 2 5 5z"
                            opacity=".4"></path>
                        <path
                            d="M18.5 9.25h-2c-1.52 0-2.75-1.23-2.75-2.75v-2c0-.41.34-.75.75-.75s.75.34.75.75v2c0 .69.56 1.25 1.25 1.25h2c.41 0 .75.34.75.75s-.34.75-.75.75zM12 13.75H8c-.41 0-.75-.34-.75-.75s.34-.75.75-.75h4c.41 0 .75.34.75.75s-.34.75-.75.75zM16 17.75H8c-.41 0-.75-.34-.75-.75s.34-.75.75-.75h8c.41 0 .75.34.75.75s-.34.75-.75.75z">
                        </path>
                    </svg>
                    <span class="ml-4">
                        Reports
                    </span>
                </a>
            </li>

        </ul>
        <p class="px-4 pt-4 text-xs font-semibold text-gray-400 uppercase">
            OPTIONS
        </p>
        <ul>
            <li>
                <div x-data="{ open: false }">
                    <button
                        class="inline-flex items-center w-full px-4 py-2 mt-1 text-sm font-medium text-gray-600 transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-orange-500/80 hover:scale-95 hover:text-white group"
                        @click="open = ! open">
                        <span class="inline-flex items-center">
                            <svg class="w-5 h-5 md hydrated" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                fill="currentColor" aria-hidden="true">
                                <path
                                    d="M2 12.88v-1.76c0-1.04.85-1.9 1.9-1.9 1.81 0 2.55-1.28 1.64-2.85-.52-.9-.21-2.07.7-2.59l1.73-.99c.79-.47 1.81-.19 2.28.6l.11.19c.9 1.57 2.38 1.57 3.29 0l.11-.19c.47-.79 1.49-1.07 2.28-.6l1.73.99c.91.52 1.22 1.69.7 2.59-.91 1.57-.17 2.85 1.64 2.85 1.04 0 1.9.85 1.9 1.9v1.76c0 1.04-.85 1.9-1.9 1.9-1.81 0-2.55 1.28-1.64 2.85.52.91.21 2.07-.7 2.59l-1.73.99c-.79.47-1.81.19-2.28-.6l-.11-.19c-.9-1.57-2.38-1.57-3.29 0l-.11.19c-.47.79-1.49 1.07-2.28.6l-1.73-.99a1.899 1.899 0 01-.7-2.59c.91-1.57.17-2.85-1.64-2.85-1.05 0-1.9-.86-1.9-1.9z"
                                    opacity=".4"></path>
                                <path d="M12 15.25a3.25 3.25 0 100-6.5 3.25 3.25 0 000 6.5z"></path>
                            </svg>
                            <span class="ml-4">
                                Settings
                            </span>
                        </span>
                        <svg fill="currentColor" viewBox="0 0 20 20"
                            :class="{ 'rotate-180': open, 'rotate-0': !open }"
                            class="inline w-5 h-5 ml-auto transition-transform duration-200 transform group-hover:text-accent rotate-0">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <div class="p-2 pl-6 -px-px" x-show="open" @click.outside="open = false"
                        style="display: none;">
                        <ul>
                            <li>
                                <a href="{{ route('admin.settings.users') }}" title="#"
                                    class="inline-flex items-center w-full p-2 pl-3 text-xs font-medium text-gray-500 rounded-lg hover:text-orange-500 group hover:border hover:border-orange-500 hover:bg-gray-50">
                                    <span class="inline-flex items-center w-full">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            fill="currentColor" aria-hidden="true">
                                            <path
                                                d="M18 13c-.94 0-1.81.33-2.5.88A3.97 3.97 0 0014 17c0 .75.21 1.46.58 2.06A3.97 3.97 0 0018 21c1.01 0 1.93-.37 2.63-1 .31-.26.58-.58.79-.94.37-.6.58-1.31.58-2.06 0-2.21-1.79-4-4-4zm2.07 3.57l-2.13 1.97c-.14.13-.33.2-.51.2-.19 0-.38-.07-.53-.22l-.99-.99a.754.754 0 010-1.06c.29-.29.77-.29 1.06 0l.48.48 1.6-1.48c.3-.28.78-.26 1.06.04s.26.77-.04 1.06z">
                                            </path>
                                            <path
                                                d="M21.09 21.5c0 .28-.22.5-.5.5H3.41c-.28 0-.5-.22-.5-.5 0-4.14 4.08-7.5 9.09-7.5 1.03 0 2.03.14 2.95.41-.59.7-.95 1.61-.95 2.59 0 .75.21 1.46.58 2.06.2.34.46.65.76.91.7.64 1.63 1.03 2.66 1.03 1.12 0 2.13-.46 2.85-1.2.16.54.24 1.11.24 1.7z"
                                                opacity=".4"></path>
                                            <path d="M12 12a5 5 0 100-10 5 5 0 000 10z"></path>
                                        </svg>
                                        <span class="ml-4">
                                            Users
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#" title="#"
                                    class="inline-flex items-center w-full p-2 pl-3 text-xs font-medium text-gray-500 rounded-lg hover:text-orange-500 group hover:border hover:border-orange-500 hover:bg-gray-50">
                                    <span class="inline-flex items-center w-full">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            fill="currentColor" aria-hidden="true">
                                            <path
                                                d="M19.79 4.22c-2.96-2.95-7.76-2.95-10.7 0-2.07 2.05-2.69 5-1.89 7.6l-4.7 4.7c-.33.34-.56 1.01-.49 1.49l.3 2.18c.11.72.78 1.4 1.5 1.5l2.18.3c.48.07 1.15-.15 1.49-.5l.82-.82c.2-.19.2-.51 0-.71l-1.94-1.94a.754.754 0 010-1.06c.29-.29.77-.29 1.06 0l1.95 1.95c.19.19.51.19.7 0l2.12-2.11c2.59.81 5.54.18 7.6-1.87 2.95-2.95 2.95-7.76 0-10.71zM14.5 12a2.5 2.5 0 010-5 2.5 2.5 0 010 5z"
                                                opacity=".4"></path>
                                            <path d="M14.5 12a2.5 2.5 0 100-5 2.5 2.5 0 000 5z">
                                            </path>
                                        </svg>
                                        <span class="ml-4">
                                            Roles
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.settings.school-year') }}" title="#"
                                    class="inline-flex items-center w-full p-2 pl-3 text-xs font-medium text-gray-500 rounded-lg hover:text-orange-500 group hover:border hover:border-orange-500 hover:bg-gray-50">
                                    <span class="inline-flex items-center w-full">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M8 1.25a.75.75 0 01.75.75v3a.75.75 0 01-1.5 0V2A.75.75 0 018 1.25zM16 1.25a.75.75 0 01.75.75v3a.75.75 0 01-1.5 0V2a.75.75 0 01.75-.75z"
                                                clip-rule="evenodd"></path>
                                            <path
                                                d="M21.5 8.37v8.76c0 .16-.01.32-.02.47H2.52c-.01-.15-.02-.31-.02-.47V8.37A4.87 4.87 0 017.37 3.5h9.26a4.87 4.87 0 014.87 4.87z"
                                                opacity=".4"></path>
                                            <path
                                                d="M21.48 17.6a4.876 4.876 0 01-4.85 4.4H7.37c-2.53 0-4.61-1.93-4.85-4.4h18.96zM13.53 11.62c.45-.31.73-.77.73-1.39 0-1.3-1.04-1.97-2.26-1.97-1.22 0-2.27.67-2.27 1.97 0 .62.29 1.09.73 1.39-.61.36-.96.94-.96 1.62 0 1.24.95 2.01 2.5 2.01 1.54 0 2.5-.77 2.5-2.01 0-.68-.35-1.27-.97-1.62zM12 9.5c.52 0 .9.29.9.79 0 .49-.38.8-.9.8s-.9-.31-.9-.8c0-.5.38-.79.9-.79zm0 4.5c-.66 0-1.14-.33-1.14-.93 0-.6.48-.92 1.14-.92.66 0 1.14.33 1.14.92 0 .6-.48.93-1.14.93z">
                                            </path>
                                        </svg>
                                        <span class="ml-4">
                                            School Years
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.active-semester') }}" title="#"
                                    class="inline-flex items-center w-full p-2 pl-3 text-xs font-medium text-gray-500 rounded-lg hover:text-orange-500 group hover:border hover:border-orange-500 hover:bg-gray-50">
                                    <span class="inline-flex items-center w-full">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M8 1.25a.75.75 0 01.75.75v3a.75.75 0 01-1.5 0V2A.75.75 0 018 1.25zM16 1.25a.75.75 0 01.75.75v3a.75.75 0 01-1.5 0V2a.75.75 0 01.75-.75z"
                                                clip-rule="evenodd"></path>
                                            <path
                                                d="M21.5 8.37v8.76c0 .16-.01.32-.02.47H2.52c-.01-.15-.02-.31-.02-.47V8.37A4.87 4.87 0 017.37 3.5h9.26a4.87 4.87 0 014.87 4.87z"
                                                opacity=".4"></path>
                                            <path
                                                d="M21.48 17.6a4.876 4.876 0 01-4.85 4.4H7.37c-2.53 0-4.61-1.93-4.85-4.4h18.96zM13.53 11.62c.45-.31.73-.77.73-1.39 0-1.3-1.04-1.97-2.26-1.97-1.22 0-2.27.67-2.27 1.97 0 .62.29 1.09.73 1.39-.61.36-.96.94-.96 1.62 0 1.24.95 2.01 2.5 2.01 1.54 0 2.5-.77 2.5-2.01 0-.68-.35-1.27-.97-1.62zM12 9.5c.52 0 .9.29.9.79 0 .49-.38.8-.9.8s-.9-.31-.9-.8c0-.5.38-.79.9-.79zm0 4.5c-.66 0-1.14-.33-1.14-.93 0-.6.48-.92 1.14-.92.66 0 1.14.33 1.14.92 0 .6-.48.93-1.14.93z">
                                            </path>
                                        </svg>
                                        <span class="ml-4">
                                            Active Semester
                                        </span>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
