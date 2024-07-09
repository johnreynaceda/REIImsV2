@section('title', 'Dashboard')
<x-business-office-layout>
    <div>
        <div class="mt-10 bg-white rounded-2xl p-5 shadow-xl">
            <div class="relative bg-white rounded-2xl shadow-xl p-5">
                <div class="flex space-x-3 items-center">
                    <img src="{{ asset('images/reii_logo.png') }}" class="h-14" alt="">
                    <div>
                        <h1 class="text-xl font-bold text-gray-700">ROCKFORT EDUCATIONAL INSTITUTE INC. </h1>
                        <h1 class="text-sm">National Highway, Brgy. San Pablo, Tacurong City S.K</h1>
                    </div>
                </div>
                <table id="example" class="table-auto mt-5" style="width:100%">
                    <thead class="font-normal">
                        <tr>
                            <th class="border text-center border-gray-600 w-64 px-2 font-bold">GRADE LEVEL</th>
                            <th class="border text-center border-gray-600 px-2 font-bold py-2">NEW</th>
                            <th class="border text-center border-gray-600 px-2 font-bold py-2">OLD</th>
                            <th class="border text-center border-gray-600 px-2 font-bold py-2">TOTAL</th>
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
                            <th class="border text-center border-gray-600 w-64 px-2 font-bold py-2"></th>
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
                                <td class="border text-gray-700 text-center border-gray-600">
                                    @php
                                        $overall_total = $new_overall + $old_overall;
                                    @endphp
                                    {{ $overall_total }}
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
                            <td class="border text-gray-700 text-center border-gray-600">
                                @php
                                    $grand_total = $total_new_overall + $total_old_overall;
                                @endphp
                                {{ $grand_total }}
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-business-office-layout>
