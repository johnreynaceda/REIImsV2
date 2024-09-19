<div x-data>
    {{-- <x-button label="fix total SOA" wire:click="fixedSoa" /> --}}
    <div class="div flex space-x-3 items-end">
        <div class="w-64">
            <x-native-select label="Select Report" wire:model.live="selected_report">
                <option>Select an option</option>
                <option>Student Records</option>
                <option>Income</option>
                <option>Expenses</option>
            </x-native-select>

        </div>
        <x-button.circle icon="refresh" spinner />

    </div>
    @if ($selected_report != 'Student Records')
        <div class="mt-4 border-t pt-4 flex justify-between items-end">
            <div class="flex space-x-2 ">
                <div class="w-64">
                    <x-datetime-picker label="Date From" wire:model.live="date_from" without-time without-timezone />
                </div>
                <div class="w-64">
                    <x-datetime-picker label="Date To" wire:model.live="date_to" without-time without-timezone />
                </div>
            </div>
            <div class="flex space-x-2">
                <x-button dark label="Print Report" @click="printOut($refs.printContainer.outerHTML);" icon="printer" />
                <x-button positive label="Export Report" icon="printer" />
            </div>
        </div>
    @endif
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
                            <th class="border text-left px-1 text-xs text-gray-700 py-2 whitespace-nowrap">OR NO.</th>
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
                                            $fullname = '';
                                        }
                                    @endphp
                                    {{ $fullname }}
                                </td>
                                <td class="border text-xs text-gray-700 px-3 py-1 whitespace-nowrap">
                                    {{ $item->studentInformation->educationalInformation->gradeLevel->name ?? '' }}
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
                            <td class="border text-xs bg-gray-100 text-gray-700 uppercase px-3 py-1 whitespace-nowrap">
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
            <div class="overflow-x-auto">
                <table id="example" x-ref="printContainer" class="min-w-full mt-5" style="width:100%">
                    <thead class="">
                        <tr>
                            <td colspan="2" class=" text-left font-bold px-1 text-xs text-gray-700 py-2 ">
                                {{ \Carbon\Carbon::parse($date_from)->format('m-d-Y') }}</td>
                        </tr>
                        <tr>
                            <th class="border text-left px-1 text-xs text-gray-700 py-2 whitespace-nowrap">VOUCHER NO.
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
                            <td class="border bg-gray-100 text-xs text-gray-700 uppercase px-3 py-1 whitespace-nowrap">
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
                                <th class="border-2  text-left px-2 text-sm font-bold text-gray-700 py-2">FULLNAME</th>
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
</div>
