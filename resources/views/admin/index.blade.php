@section('title', 'Overview')
<x-admin-layout>
    <div>
        <!-- Card Section -->
        <div class="max-w-[85rem]  mx-auto">
            <!-- Grid -->
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                <!-- Card -->
                <div class="flex flex-col bg-white border shadow-sm rounded-xl">
                    <div class="p-4 md:p-5 flex gap-x-4">
                        <div class="flex-shrink-0 flex justify-center items-center size-[46px] bg-orange-100 rounded-lg">
                            <svg class="flex-shrink-0 size-5 text-gray-600" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                <circle cx="9" cy="7" r="4" />
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                            </svg>
                        </div>

                        <div class="grow">
                            <div class="flex items-center gap-x-2">
                                <p class="text-xs uppercase tracking-wide text-gray-500">
                                    Total Prelist
                                </p>
                                <div class="hs-tooltip">
                                    <div class="hs-tooltip-toggle">
                                        <svg class="flex-shrink-0 size-4 text-gray-500"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10" />
                                            <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
                                            <path d="M12 17h.01" />
                                        </svg>

                                    </div>
                                </div>
                            </div>
                            <div class="mt-1 flex items-center gap-x-2">
                                <h3 class="text-xl sm:text-2xl font-medium text-gray-800">
                                    {{ \App\Models\Enrollee::where('status', false)->count() }}
                                </h3>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col bg-white border shadow-sm rounded-xl">
                    <div class="p-4 md:p-5 flex gap-x-4">
                        <div
                            class="flex-shrink-0 flex justify-center items-center size-[46px] bg-orange-100 rounded-lg">
                            <svg class="flex-shrink-0 size-5 text-gray-600" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                <circle cx="9" cy="7" r="4" />
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                            </svg>
                        </div>

                        <div class="grow">
                            <div class="flex items-center gap-x-2">
                                <p class="text-xs uppercase tracking-wide text-gray-500">
                                    Total Enrolled Student
                                </p>
                                <div class="hs-tooltip">
                                    <div class="hs-tooltip-toggle">
                                        <svg class="flex-shrink-0 size-4 text-gray-500"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10" />
                                            <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
                                            <path d="M12 17h.01" />
                                        </svg>

                                    </div>
                                </div>
                            </div>
                            <div class="mt-1 flex items-center gap-x-2">
                                <h3 class="text-xl sm:text-2xl font-medium text-gray-800">
                                    {{ \App\Models\Student::count() }}
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col bg-white border shadow-sm rounded-xl">
                    <div class="p-4 md:p-5 flex gap-x-4">
                        <div
                            class="flex-shrink-0 flex justify-center items-center size-[46px] bg-orange-100 rounded-lg">
                            <svg class="flex-shrink-0 size-5 text-gray-600" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                <circle cx="9" cy="7" r="4" />
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                            </svg>
                        </div>

                        <div class="grow">
                            <div class="flex items-center gap-x-2">
                                <p class="text-xs uppercase tracking-wide text-gray-500">
                                    Total Documents
                                </p>
                                <div class="hs-tooltip">
                                    <div class="hs-tooltip-toggle">
                                        <svg class="flex-shrink-0 size-4 text-gray-500"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width=-2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10" />
                                            <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
                                            <path d="M12 17h.01" />
                                        </svg>

                                    </div>
                                </div>
                            </div>
                            <div class="mt-1 flex items-center gap-x-2">
                                <h3 class="text-xl sm:text-2xl font-medium text-gray-800">
                                    0
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- End Grid -->
        </div>

        <div class="mt-10 bg-white rounded-2xl p-5 shadow-xl">
            <div class="relative bg-white rounded-2xl shadow-xl p-5">
                <div class="flex space-x-3 items-center">
                    <img src="{{ asset('images/reii_logo.png') }}" class="h-14" alt="">
                    <div>
                        <h1 class="text-xl font-bold text-gray-700">ROCKFORT EDUCATIONAL INSTITUTE INC. </h1>
                        <h1 class="text-sm">National Highway, Brgy. San Pablo, Tacurong City S.K</h1>
                    </div>
                </div>
                <table id="example" class="table-auto  mt-5" style="width:100%">
                    <thead class="font-normal">
                        <tr>
                            <th class="border text-center border-gray-600 w-64 px-2 font-bold">GRADE LEVEL</th>
                            <th class="border text-center border-gray-600 px-2 font-bold py-2">NEW</th>
                            <th class="border text-center border-gray-600 px-2 font-bold py-2">OLD</th>
                        </tr>
                        <tr>
                            <th class="border text-center border-gray-600 w-64 px-2 font-bold py-2"></th>
                            <th class="border text-center border-gray-600 font-bold">
                                <div class="grid grid-cols-2 text-gray-600">
                                    <div class="border-r border-black">TODAY</div>
                                    <div>OVERALL</div>
                                </div>
                            </th>
                            <th class="border text-center border-gray-600 font-bold">
                                <div class="grid grid-cols-2 text-gray-600">
                                    <div class="border-r border-black">TODAY</div>
                                    <div>OVERALL</div>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total_new_today = 0;
                            $total_new_overall = 0;
                            $total_old_today = 0;
                            $total_old_overall = 0;
                        @endphp
                        @foreach (\App\Models\GradeLevel::all() as $item)
                            <tr>
                                <td
                                    class="border text-gray-700 uppercase text-center text-lg font-semibold border-gray-600 px-3">
                                    {{ $item->name }}
                                </td>
                                <td class="border text-gray-700 text-center border-gray-600">
                                    <div class="grid grid-cols-2 text-gray-600">
                                        <div class="border-r border-black">
                                            @php
                                                $new_today = \App\Models\Student::whereHas(
                                                    'studentInformation',
                                                    function ($query) use ($item) {
                                                        $query->whereHas('educationalInformation', function (
                                                            $record,
                                                        ) use ($item) {
                                                            $record
                                                                ->where('grade_level_id', $item->id)
                                                                ->where('student_type', 'NEW');
                                                        });
                                                    },
                                                )
                                                    ->whereDate('created_at', now())
                                                    ->count();
                                                $total_new_today += $new_today;
                                            @endphp
                                            {{ $new_today }}
                                        </div>
                                        <div>
                                            @php
                                                $new_overall = \App\Models\Student::whereHas(
                                                    'studentInformation',
                                                    function ($query) use ($item) {
                                                        $query->whereHas('educationalInformation', function (
                                                            $record,
                                                        ) use ($item) {
                                                            $record
                                                                ->where('grade_level_id', $item->id)
                                                                ->where('student_type', 'NEW');
                                                        });
                                                    },
                                                )->count();
                                                $total_new_overall += $new_overall;
                                            @endphp
                                            {{ $new_overall }}
                                        </div>
                                    </div>
                                </td>
                                <td class="border text-gray-700 text-center border-gray-600">
                                    <div class="grid grid-cols-2 text-gray-600">
                                        <div class="border-r border-black">
                                            @php
                                                $old_today = \App\Models\Student::whereHas(
                                                    'studentInformation',
                                                    function ($query) use ($item) {
                                                        $query->whereHas('educationalInformation', function (
                                                            $record,
                                                        ) use ($item) {
                                                            $record
                                                                ->where('grade_level_id', $item->id)
                                                                ->where('student_type', 'OLD');
                                                        });
                                                    },
                                                )
                                                    ->whereDate('created_at', now())
                                                    ->count();
                                                $total_old_today += $old_today;
                                            @endphp
                                            {{ $old_today }}
                                        </div>
                                        <div>
                                            @php
                                                $old_overall = \App\Models\Student::whereHas(
                                                    'studentInformation',
                                                    function ($query) use ($item) {
                                                        $query->whereHas('educationalInformation', function (
                                                            $record,
                                                        ) use ($item) {
                                                            $record
                                                                ->where('grade_level_id', $item->id)
                                                                ->where('student_type', 'OLD');
                                                        });
                                                    },
                                                )->count();
                                                $total_old_overall += $old_overall;
                                            @endphp
                                            {{ $old_overall }}
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td
                                class="border text-gray-700 uppercase text-center text-lg font-semibold border-gray-600 px-3">
                                TOTAL:
                            </td>
                            <td class="border text-gray-700 text-center border-gray-600">
                                <div class="grid grid-cols-2 text-gray-600">
                                    <div class="border-r border-black">
                                        {{ $total_new_today }}
                                    </div>
                                    <div>
                                        {{ $total_new_overall }}
                                    </div>
                                </div>
                            </td>
                            <td class="border text-gray-700 text-center border-gray-600">
                                <div class="grid grid-cols-2 text-gray-600">
                                    <div class="border-r border-black">
                                        {{ $total_old_today }}
                                    </div>
                                    <div>
                                        {{ $total_old_overall }}
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- End Card Section -->
    </div>
</x-admin-layout>
