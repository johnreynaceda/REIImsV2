<div x-data>
    <div class="flex justify-between">
        <div class="flex space-x-3">
            <div class="w-56">
                <x-native-select label="Select Month" wire:model.live="month">
                    <option>Select An Option</option>
                    @foreach (range(1, 12) as $month)
                        <option value="{{ $month }}">{{ date('F', mktime(0, 0, 0, $month, 1)) }}</option>
                    @endforeach
                </x-native-select>
            </div>
            <div class="w-56">
                <x-native-select label="Select Year" wire:model.live="year">
                    <option>Select An Option</option>
                    @foreach ($years as $item)
                        <option>{{ $item }}</option>
                    @endforeach
                </x-native-select>
            </div>
        </div>
        <div>
            <x-button dark label="Print Report" @click="printOut($refs.printContainer.outerHTML);" icon="printer" />
        </div>
    </div>
    <div class="mt-5">
        <table id="example" x-ref="printContainer" class="min-w-full mt-5" style="width:100%">
            <thead>
                <tr>
                    <th class="border text-left px-1 text-xs text-gray-700 py-2 whitespace-nowrap">OR NO.</th>
                    <th class="border text-left px-1 text-xs text-gray-700 py-2">NAME</th>
                    <th class="border text-left px-1 text-xs text-gray-700 py-2">GRADE</th>
                    @foreach ($saleCategories as $item)
                        <th class="border text-left px-1 text-xs text-gray-700 py-2">{{ $item->name }}</th>
                    @endforeach
                    <th class="border text-left px-1 text-xs text-gray-700 py-2">TOTAL</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $columnTotals = array_fill(0, count($saleCategories), 0);
                    $grandTotal = 0;
                @endphp

                @forelse ($reports as $item)
                    @php
                        $rowTotal = 0;
                    @endphp
                    <tr>
                        <td class="border text-xs text-gray-700 px-3 py-1 whitespace-nowrap">
                            {{ $item->or_number }}
                        </td>
                        <td class="border text-xs text-gray-700 uppercase px-3 py-1 whitespace-nowrap">
                            {{ $item->student_payment_id
                                ? $item->studentPayment->student->studentInformation->lastname .
                                    ', ' .
                                    $item->studentPayment->student->studentInformation->firstname
                                : $item->studentInformation->lastname . ', ' . $item->studentInformation->firstname }}
                        </td>
                        <td class="border text-xs text-gray-700 px-3 py-1 whitespace-nowrap">
                            {{ $item->student_payment_id
                                ? $item->studentPayment->student->studentInformation->educationalInformation->gradeLevel->name
                                : $item->studentInformation->educationalInformation->gradeLevel->name }}
                        </td>
                        @foreach ($saleCategories as $index => $trans)
                            @php
                                $amount =
                                    $item->paymentTransactions->where('sale_category_id', $trans->id)->first()
                                        ->paid_amount ?? 0;
                                $rowTotal += $amount;
                                $columnTotals[$index] += $amount;
                            @endphp
                            <td class="border text-xs text-gray-700 px-3 py-1 whitespace-nowrap">
                                {{ number_format($amount, 2) }}
                            </td>
                        @endforeach
                        <td class="border text-xs text-gray-700 px-3 py-1 whitespace-nowrap font-bold">
                            {{ number_format($rowTotal, 2) }}
                        </td>
                    </tr>
                    @php
                        $grandTotal += $rowTotal;
                    @endphp
                @empty
                    <tr>
                        <td colspan="{{ count($saleCategories) + 4 }}" class="border text-center text-gray-500 py-2">
                            No records found.
                        </td>
                    </tr>
                @endforelse

                <!-- TOTAL ROW -->
                <tr class="bg-gray-100">
                    <td class="border text-xs text-gray-700 px-3 py-1 whitespace-nowrap"></td>
                    <td class="border text-xs text-gray-700 uppercase px-3 py-1 whitespace-nowrap font-bold">TOTAL</td>
                    <td class="border text-xs text-gray-700 px-3 py-1 whitespace-nowrap"></td>
                    @foreach ($columnTotals as $total)
                        <td class="border text-xs text-gray-700 px-3 py-1 whitespace-nowrap font-bold">
                            {{ number_format($total, 2) }}
                        </td>
                    @endforeach
                    <td class="border text-xs text-gray-700 px-3 py-1 whitespace-nowrap font-bold">
                        {{ number_format($grandTotal, 2) }}
                    </td>
                </tr>
            </tbody>
        </table>

    </div>
</div>
