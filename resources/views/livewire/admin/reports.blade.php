<div x-data>
    <div class="w-64">
        <x-native-select label="Select Report" wire:model.live="selected_report">
            <option>Select an option</option>
            <option>Student Records</option>
            <option>Income</option>
            <option>Expenses</option>
        </x-native-select>
    </div>
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
    <div class="mt-10 mx-auto">
        @if ($selected_report == 'Income')
            <div class="overflow-x-auto">
                <table id="example" x-ref="printContainer" class="min-w-full mt-5" style="width:100%">
                    <thead class="">
                        <tr>
                            <th class="border text-left px-1 text-xs text-gray-700 py-2 whitespace-nowrap">OR NO.</th>
                            <th class="border text-left px-1 text-xs text-gray-700 py-2">NAME</th>
                            <th class="border text-left px-1 text-xs text-gray-700 py-2">GRADE</th>
                            @foreach ($categories as $category)
                                <th class="border text-left px-1 text-xs uppercase text-gray-700 py-2">
                                    {{-- @php
                                        $name = '';
                                        switch ($category->name) {
                                            case 'Tuition':
                                                $name = 'TF';
                                                break;

                                            default:
                                                # code...
                                                break;
                                        }
                                    @endphp --}}
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
                                    {{ $item->studentInformation->lastname }},
                                    {{ $item->studentInformation->firstname }}{{ $item->studentInformation->middlename ? ' ' . $item->studentInformation->middlename[0] . '.' : '' }}
                                </td>
                                <td class="border text-xs text-gray-700 px-3 py-1 whitespace-nowrap">
                                    {{ $item->studentInformation->educationalInformation->gradeLevel->name }}
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
                                        {{ $sale ? $sale->paid_amount : '' }}
                                    </td>
                                @endforeach
                                <td class="border text-xs text-gray-700 px-3 py-1">
                                    {{ $studentTotal }}
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
                                <td class="border text-xs bg-gray-100 text-gray-700 px-3 py-1">{{ $categoryTotal }}</td>
                            @endforeach
                            <td class="border text-xs bg-gray-100 text-gray-700 px-3 py-1">{{ $grandTotal }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
