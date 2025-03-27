<div x-data>
    {{-- <x-button label="fix total SOA" wire:click="fixedSoa" /> --}}
    <div class="div flex space-x-3 items-end">
        <div class="w-64">
            <x-native-select label="Select Report" wire:model.live="selected_report">
                <option>Select an option</option>
                <option>Student Records</option>
                <option>Income</option>
                <option>Expenses</option>
                <option>Permit</option>
                <option>Monthly Income</option>
                <option>2X2 ID Picture</option>
            </x-native-select>

        </div>
        <x-button.circle icon="refresh" spinner />

    </div>
    @if ($selected_report != 'Permit')
        <div class="mt-4 border-t pt-4 flex justify-between items-end">
            <div class="flex space-x-2 items-end ">
                <div class="w-64">
                    <x-datetime-picker label="Date From" wire:model.live="date_from" without-time without-timezone />
                </div>
                <div class="w-64">
                    <x-datetime-picker label="Date To" wire:model.live="date_to" without-time without-timezone />
                </div>
                <div>
                    <x-button label="Monthly" href="{{ route('admin.income-report') }}" />
                </div>

            </div>
            <div class="flex space-x-2">
                <x-button dark label="Print Report" @click="printOut($refs.printContainer.outerHTML);" icon="printer" />
                <x-button positive label="Export Report" icon="printer" />
            </div>
        </div>
    @endif

    @if ($selected_report)
        <div class="mt-10 mx-auto">
            @if ($selected_report == 'Income')

                <div class="overflow-x-auto">

                    <table id="example" x-ref="printContainer" class="min-w-full mt-5" style="width:100%">

                        <thead class="">
                            <tr>
                                <td colspan="2" class=" text-left font-bold px-1 text-xs text-gray-700 py-2 ">
                                    {{ \Carbon\Carbon::parse($date_from)->format('m-d-Y') }}</td>
                            </tr>
                            <tr>
                                <th class="border text-left px-1 text-xs text-gray-700 py-2 whitespace-nowrap">OR NO.
                                </th>
                                <th class="border text-left px-1 text-xs text-gray-700 py-2">NAME</th>
                                <th class="border text-left px-1 text-xs text-gray-700 py-2">GRADE</th>
                                @foreach ($categories as $category)
                                    <th class="border text-left px-1 text-xs uppercase text-gray-700 py-2">

                                        {{ $category->name }}
                                    </th>
                                @endforeach
                                <th class="border text-left px-1 text-xs text-gray-700 py-2">TOTAL</th>
                            </tr>
                        </thead>
                        <tbody class="">
                            @php
                                $grandTotal = 0;
                                $categoryTotals = array_fill(0, count($categories), 0);
                            @endphp
                            @foreach ($report as $item)
                                <tr>
                                    <td class="border text-xs text-gray-700 px-3 py-1 whitespace-nowrap">
                                        {{ $item->or_number }}</td>
                                    <td class="border text-xs text-gray-700 uppercase px-3 py-1 whitespace-nowrap">

                                        @php
                                            if (
                                                \App\Models\StudentInformation::where(
                                                    'id',
                                                    $item->student_information_id,
                                                )->count() > 0
                                            ) {
                                                $fullname =
                                                    $item->studentInformation->lastname .
                                                    ', ' .
                                                    $item->studentInformation->firstname;
                                            } else {
                                                $data = \App\Models\StudentPayment::where(
                                                    'id',
                                                    $item->student_payment_id,
                                                )->first()->student->studentInformation;
                                                $fullname = $data->lastname . ', ' . $data->firstname;
                                            }
                                        @endphp
                                        {{ $fullname }}
                                    </td>
                                    <td class="border text-xs text-gray-700 px-3 py-1 whitespace-nowrap">
                                        @php
                                            if (
                                                \App\Models\StudentInformation::where(
                                                    'id',
                                                    $item->student_information_id,
                                                )->count() > 0
                                            ) {
                                                $grade =
                                                    $item->studentInformation->educationalInformation->gradeLevel->name;
                                            } else {
                                                $data = \App\Models\StudentPayment::where(
                                                    'id',
                                                    $item->student_payment_id,
                                                )->first()->student->studentInformation;
                                                $grade = $data->educationalInformation->gradeLevel->name;
                                            }
                                        @endphp
                                        {{ $grade }}
                                    </td>
                                    @php
                                        $studentTotal = 0;
                                    @endphp
                                    @foreach ($categories as $index => $category)
                                        <td class="border text-xs text-gray-700 px-3 py-1">
                                            @php
                                                $sale = \App\Models\PaymentTransaction::where(
                                                    'student_transaction_id',
                                                    $item->id,
                                                )
                                                    ->where('sale_category_id', $category->id)
                                                    ->first();
                                                $amount = $sale ? $sale->paid_amount : 0;
                                                $studentTotal += $amount;
                                                $categoryTotals[$index] += $amount;
                                            @endphp
                                            @if ($sale)
                                                {{ number_format($sale->paid_amount, 2) }}
                                            @else
                                            @endif
                                        </td>
                                    @endforeach
                                    <td class="border text-xs text-gray-700 px-3 py-1">
                                        {{ number_format($studentTotal, 2) }}
                                    </td>
                                    @php
                                        $grandTotal += $studentTotal;
                                    @endphp
                                </tr>
                            @endforeach
                            <tr>
                                <td class="border text-xs bg-gray-100 text-gray-700 px-3 py-1 whitespace-nowrap"></td>
                                <td
                                    class="border text-xs bg-gray-100 text-gray-700 uppercase px-3 py-1 whitespace-nowrap">
                                    TOTAL
                                </td>
                                <td class="border text-xs bg-gray-100 text-gray-700 px-3 py-1 whitespace-nowrap"></td>
                                @foreach ($categoryTotals as $categoryTotal)
                                    <td class="border text-xs bg-gray-100 text-gray-700 px-3 py-1">
                                        {{ number_format($categoryTotal, 2) }}</td>
                                @endforeach
                                <td class="border text-xs bg-gray-100 text-gray-700 px-3 py-1">
                                    {{ number_format($grandTotal, 2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
        <div class="mt-10 mx-auto">
            @if ($selected_report == 'Expenses')
                {{-- <div class="mt-4 border-t pt-4 flex justify-between items-end">
                    <div class="flex space-x-2 ">
                        <div class="w-64">
                            <x-datetime-picker label="Date From" wire:model.live="date_from" without-time
                                without-timezone />
                        </div>
                        <div class="w-64">
                            <x-datetime-picker label="Date To" wire:model.live="date_to" without-time
                                without-timezone />
                        </div>
                    </div>
                    <div class="flex space-x-2">
                        <x-button dark label="Print Report" @click="printOut($refs.printContainer.outerHTML);"
                            icon="printer" />
                        <x-button positive label="Export Report" icon="printer" />
                    </div>
                </div> --}}
                <div class="overflow-x-auto">
                    <table id="example" x-ref="printContainer" class="min-w-full mt-5" style="width:100%">
                        <thead class="">
                            <tr>
                                <td colspan="2" class=" text-left font-bold px-1 text-xs text-gray-700 py-2 ">
                                    {{ \Carbon\Carbon::parse($date_from)->format('m-d-Y') }}</td>
                            </tr>
                            <tr>
                                <th class="border text-left px-1 text-xs text-gray-700 py-2 whitespace-nowrap">VOUCHER
                                    NO.
                                </th>
                                <th class="border text-left px-1 text-xs text-gray-700 py-2">NAME</th>
                                @foreach ($expense_categories as $category)
                                    <th class="border text-left px-1 text-xs uppercase text-gray-700 py-2">
                                        {{ $category->name }}</th>
                                @endforeach
                                <th class="border text-left px-1 text-xs text-gray-700 py-2">TOTAL</th>
                            </tr>
                        </thead>
                        <tbody class="">
                            @php
                                $category_totals = [];
                                $grand_total = 0;
                            @endphp

                            @foreach ($report as $item)
                                @php
                                    $item_total = 0;
                                @endphp
                                <tr>
                                    <td class="border text-xs text-gray-700 px-3 py-1 whitespace-nowrap">
                                        {{ $item->voucher_number }}</td>
                                    <td class="border text-xs text-gray-700 uppercase px-3 py-1 whitespace-nowrap">
                                        {{ $item->name }}</td>
                                    @foreach ($expense_categories as $category)
                                        <td class="border text-xs text-gray-700 px-3 py-1 whitespace-nowrap">
                                            @php
                                                $sale = \App\Models\ExpenseCategoryTransaction::where(
                                                    'expense_id',
                                                    $item->id,
                                                )
                                                    ->where('expense_category_id', $category->id)
                                                    ->sum('amount');
                                                $item_total += $sale;
                                                if (!isset($category_totals[$category->id])) {
                                                    $category_totals[$category->id] = 0;
                                                }
                                                $category_totals[$category->id] += $sale;
                                            @endphp
                                            @if ($sale > 0)
                                                {{ number_format($sale, 2) }}
                                            @else
                                            @endif
                                        </td>
                                    @endforeach
                                    <td class="border text-xs text-gray-700 px-3 py-1">
                                        @if ($item_total > 0)
                                            {{ number_format($item_total, 2) }}
                                        @else
                                        @endif
                                    </td>
                                </tr>
                                @php
                                    $grand_total += $item_total;
                                @endphp
                            @endforeach

                            <tr>
                                <td class="border bg-gray-100 text-xs text-gray-700 px-3 py-1 whitespace-nowrap"></td>
                                <td
                                    class="border bg-gray-100 text-xs text-gray-700 uppercase px-3 py-1 whitespace-nowrap">
                                    TOTAL</td>
                                @foreach ($expense_categories as $category)
                                    <td class="border bg-gray-100 text-xs text-gray-700 px-3 py-1 whitespace-nowrap">
                                        {{ number_format($category_totals[$category->id], 2) }}
                                    </td>
                                @endforeach
                                <td class="border bg-gray-100 text-xs text-gray-700 px-3 py-1">
                                    {{ number_format($grand_total, 2) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
        <div class="mt-10 mx-auto">
            @if ($selected_report == 'Student Records')
                <div class="">

                    <div class="flex justify-between items-end">
                        <div class="w-64">
                            <x-native-select label="Grade Level" wire:model.live="grade_level_id">
                                <option>Select an Option</option>

                                @foreach ($grade_levels as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach

                            </x-native-select>
                        </div>
                        <div class="flex space-x-3 items-center">
                            <x-button dark label="Print Report" @click="printOut($refs.printContainer.outerHTML);"
                                icon="printer" />
                            <x-button label="Export Record" positive icon="document-text" wire:click="exportRecord"
                                spinner="exportRecord" />
                        </div>
                    </div>
                    <div class="mt-10">
                        <table id="example" x-ref="printContainer" class="table-auto mt-3" style="width:100%">

                            <thead class="font-normal">
                                <tr>
                                    <th class="border-2  text-left px-2 text-sm font-bold text-gray-700 py-2"></th>
                                    <th class="border-2  text-left px-2 text-sm font-bold text-gray-700 py-2">FULLNAME
                                    </th>
                                    <th class="border-2  text-left px-2 text-sm font-bold text-gray-700 py-2">
                                        BIRTHDATE
                                    </th>
                                    <th class="border-2  text-left px-2 text-sm font-bold text-gray-700 py-2">
                                        GUARDIAN
                                    </th>
                                    <th class="border-2  text-left px-2 text-sm font-bold text-gray-700 py-2">
                                        CONTACT NO.
                                    </th>
                                    <th class="border-2  text-left px-2 text-sm font-bold text-gray-700 py-2">
                                        GRADE LEVEL
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="">
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($report as $student)
                                    @php
                                        $father = \App\Models\StudentGuardian::where(
                                            'student_information_id',
                                            $student->student_information_id,
                                        )
                                            ->where('relationship', 'Father')
                                            ->first();
                                        $mother = \App\Models\StudentGuardian::where(
                                            'student_information_id',
                                            $student->student_information_id,
                                        )
                                            ->where('relationship', 'Mother')
                                            ->first();

                                    @endphp
                                    <tr>
                                        <td class="border-2  text-gray-700  px-3 py-1">
                                            {{ $i++ }}
                                        </td>
                                        <td class="border-2  text-gray-700 uppercase  px-3 py-1">
                                            {{ $student->studentInformation->lastname . ' ' . $student->studentInformation->firstname . ' ' . ($student->studentInformation->middlename == null ? '' : $student->studentInformation->middlename[0] . '.') }}
                                        </td>

                                        <td class="border-2  text-gray-700  px-3 py-1">
                                            {{ \Carbon\Carbon::parse($student->studentInformation->birthdate)->format('F d, Y') }}
                                        </td>
                                        <td class="border-2  text-gray-700  px-3 py-1">

                                            {{ ($father->firstname == 'NA' ? '' : $father->firstname) . ' ' . ($father->lastname == 'NA' ? '' : $father->lastname) }}
                                            /
                                            {{ $mother->firstname . ' ' . $mother->lastname }}
                                        </td>
                                        <td class="border-2  text-gray-700  px-3 py-1">
                                            {{ $father->contact_number }} / {{ $mother->contact_number }}
                                        </td>
                                        <td class="border-2  text-gray-700  px-3 uppercase py-1">
                                            {{ $student->studentInformation->educationalInformation->gradeLevel->name }}
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
        @if ($selected_report == 'Permit')
            <livewire:admin.permit-report />
        @endif

        @if ($selected_report == 'Monthly Income')
            <div>
                @php
                    $grandTotal = 0;
                @endphp

                @foreach ($income as $item)
                    @php
                        $totalPaid = $item->paymentTransactions
                            ->whereBetween('studentTransaction.created_at', [$date_from, $date_to])
                            ->sum('paid_amount');

                        $grandTotal += $totalPaid;
                    @endphp

                    <ul>
                        <li> {{ $item->name }} - {{ number_format($totalPaid, 2) }} </li>
                    </ul>
                @endforeach

                <h1>Grand Total: {{ number_format($grandTotal, 2) }}</h1>

            </div>
        @endif

        @if ($selected_report == '2X2 ID Picture')
            <div x-ref="printContainer">
                <div class="mt-10">
                    <table id="example" class="table-auto mt-3" style="width:100%">

                        <thead class="font-normal">
                            <tr>
                                <th class="border-2  text-left px-2 text-sm font-bold text-gray-700 py-2"></th>
                                <th class="border-2  text-left px-2 text-sm font-bold text-gray-700 py-2">FULLNAME
                                </th>
                                <th class="border-2  text-left px-2 text-sm font-bold text-gray-700 py-2">
                                    GRADE LEVEL
                                </th>
                                <th class="border-2  text-left px-2 text-sm font-bold text-gray-700 py-2">
                                    SECTION
                                </th>
                            </tr>
                        </thead>
                        <tbody class="">
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($pictures as $item)
                                @php
                                    $name = '';
                                    $grade_level;
                                    $section;

                                    $transaction = \App\Models\StudentTransaction::where(
                                        'id',
                                        $item->student_transaction_id,
                                    )->first();

                                    if ($transaction) {
                                        $student = $transaction->studentInformation;

                                        if ($transaction->student_payment_id) {
                                            $students = \App\Models\StudentPayment::where(
                                                'id',
                                                $transaction->student_payment_id,
                                            )->first()?->student?->studentInformation;
                                        } else {
                                            $students = null;
                                        }

                                        $name = $student
                                            ? $student->lastname . ' ' . $student->firstname
                                            : ($students
                                                ? $students->firstname . ' ' . $students->lastname
                                                : \App\Models\StudentInformation::where(
                                                        'id',
                                                        $transaction->student_information_id,
                                                    )->first()->firstname ?? '');
                                        $grade_level = $student->educationalInformation->gradeLevel->name ?? '';
                                        $info_id = $student->id ?? '';
                                        $info_id = $student->id ?? null;

                                        $sec = $info_id
                                            ? \App\Models\StudentInformation::where('id', $info_id)->first()?->student
                                            : null;

                                        $section = $sec?->studentSections?->first()?->section?->name ?? '';
                                    }
                                @endphp
                                <tr>
                                    <td class="border-2  text-gray-700  px-3 py-1">
                                        {{ $i++ }}
                                    </td>
                                    <td class="border-2  text-gray-700 uppercase  px-3 py-1">

                                        {{ $name }}
                                    </td>

                                    <td class="border-2  text-gray-700  px-3 py-1">
                                        {{ $grade_level }}
                                    </td>
                                    <td class="border-2  text-gray-700  px-3 py-1">
                                        {{ $section }}
                                    </td>


                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    @else
        <div>
            <div class="
                mt-5 rounded-2xl py-10 bg-white grid place-content-center">
                <svg data-name="Layer 1" class="animate-linear-progress" xmlns="http://www.w3.org/2000/svg"
                    width="500" height="500" viewBox="0 0 797.5 834.5"
                    xmlns:xlink="http://www.w3.org/1999/xlink">
                    <title>void</title>
                    <ellipse cx="308.5" cy="780" rx="308.5" ry="54.5" fill="#3f3d56" />
                    <circle cx="496" cy="301.5" r="301.5" fill="#3f3d56" />
                    <circle cx="496" cy="301.5" r="248.89787" opacity="0.05" />
                    <circle cx="496" cy="301.5" r="203.99362" opacity="0.05" />
                    <circle cx="496" cy="301.5" r="146.25957" opacity="0.05" />
                    <path
                        d="M398.42029,361.23224s-23.70394,66.72221-13.16886,90.42615,27.21564,46.52995,27.21564,46.52995S406.3216,365.62186,398.42029,361.23224Z"
                        transform="translate(-201.25 -32.75)" fill="#d0cde1" />
                    <path
                        d="M398.42029,361.23224s-23.70394,66.72221-13.16886,90.42615,27.21564,46.52995,27.21564,46.52995S406.3216,365.62186,398.42029,361.23224Z"
                        transform="translate(-201.25 -32.75)" opacity="0.1" />
                    <path
                        d="M415.10084,515.74682s-1.75585,16.68055-2.63377,17.55847.87792,2.63377,0,5.26754-1.75585,6.14547,0,7.02339-9.65716,78.13521-9.65716,78.13521-28.09356,36.8728-16.68055,94.81576l3.51169,58.82089s27.21564,1.75585,27.21564-7.90132c0,0-1.75585-11.413-1.75585-16.68055s4.38962-5.26754,1.75585-7.90131-2.63377-4.38962-2.63377-4.38962,4.38961-3.51169,3.51169-4.38962,7.90131-63.2105,7.90131-63.2105,9.65716-9.65716,9.65716-14.92471v-5.26754s4.38962-11.413,4.38962-12.29093,23.70394-54.43127,23.70394-54.43127l9.65716,38.62864,10.53509,55.3092s5.26754,50.04165,15.80262,69.356c0,0,18.4364,63.21051,18.4364,61.45466s30.72733-6.14547,29.84941-14.04678-18.4364-118.5197-18.4364-118.5197L533.62054,513.991Z"
                        transform="translate(-201.25 -32.75)" fill="#2f2e41" />
                    <path
                        d="M391.3969,772.97846s-23.70394,46.53-7.90131,48.2858,21.94809,1.75585,28.97148-5.26754c3.83968-3.83968,11.61528-8.99134,17.87566-12.87285a23.117,23.117,0,0,0,10.96893-21.98175c-.463-4.29531-2.06792-7.83444-6.01858-8.16366-10.53508-.87792-22.826-10.53508-22.826-10.53508Z"
                        transform="translate(-201.25 -32.75)" fill="#2f2e41" />
                    <path
                        d="M522.20753,807.21748s-23.70394,46.53-7.90131,48.28581,21.94809,1.75584,28.97148-5.26754c3.83968-3.83969,11.61528-8.99134,17.87566-12.87285a23.117,23.117,0,0,0,10.96893-21.98175c-.463-4.29531-2.06792-7.83444-6.01857-8.16367-10.53509-.87792-22.826-10.53508-22.826-10.53508Z"
                        transform="translate(-201.25 -32.75)" fill="#2f2e41" />
                    <circle cx="295.90488" cy="215.43252" r="36.90462" fill="#ffb8b8" />
                    <path
                        d="M473.43048,260.30832S447.07,308.81154,444.9612,308.81154,492.41,324.62781,492.41,324.62781s13.70743-46.39439,15.81626-50.61206Z"
                        transform="translate(-201.25 -32.75)" fill="#ffb8b8" />
                    <path
                        d="M513.86726,313.3854s-52.67543-28.97148-57.943-28.09356-61.45466,50.04166-60.57673,70.2339,7.90131,53.55335,7.90131,53.55335,2.63377,93.05991,7.90131,93.93783-.87792,16.68055.87793,16.68055,122.90931,0,123.78724-2.63377S513.86726,313.3854,513.86726,313.3854Z"
                        transform="translate(-201.25 -32.75)" fill="#d0cde1" />
                    <path
                        d="M543.2777,521.89228s16.68055,50.91958,2.63377,49.16373-20.19224-43.89619-20.19224-43.89619Z"
                        transform="translate(-201.25 -32.75)" fill="#ffb8b8" />
                    <path
                        d="M498.50359,310.31267s-32.48318,7.02339-27.21563,50.91957,14.9247,87.79237,14.9247,87.79237l32.48318,71.11182,3.51169,13.16886,23.70394-6.14547L528.353,425.32067s-6.14547-108.86253-14.04678-112.37423A33.99966,33.99966,0,0,0,498.50359,310.31267Z"
                        transform="translate(-201.25 -32.75)" fill="#d0cde1" />
                    <polygon points="277.5 414.958 317.885 486.947 283.86 411.09 277.5 414.958" opacity="0.1" />
                    <path
                        d="M533.896,237.31585l.122-2.82012,5.6101,1.39632a6.26971,6.26971,0,0,0-2.5138-4.61513l5.97581-.33413a64.47667,64.47667,0,0,0-43.1245-26.65136c-12.92583-1.87346-27.31837.83756-36.182,10.43045-4.29926,4.653-7.00067,10.57018-8.92232,16.60685-3.53926,11.11821-4.26038,24.3719,3.11964,33.40938,7.5006,9.18513,20.602,10.98439,32.40592,12.12114,4.15328.4,8.50581.77216,12.35457-.83928a29.721,29.721,0,0,0-1.6539-13.03688,8.68665,8.68665,0,0,1-.87879-4.15246c.5247-3.51164,5.20884-4.39635,8.72762-3.9219s7.74984,1.20031,10.062-1.49432c1.59261-1.85609,1.49867-4.559,1.70967-6.99575C521.28248,239.785,533.83587,238.70653,533.896,237.31585Z"
                        transform="translate(-201.25 -32.75)" fill="#2f2e41" />
                    <circle cx="559" cy="744.5" r="43" fill="#fa8f44" />
                    <circle cx="54" cy="729.5" r="43" fill="#fa8f44" />
                    <circle cx="54" cy="672.5" r="31" fill="#fa8f44" />
                    <circle cx="54" cy="624.5" r="22" fill="#fa8f44" />
                </svg>
            </div>
        </div>
    @endif


</div>
