<table id="example" x-ref="printContainer" class="min-w-full mt-5" style="width:100%">

    <thead class="">
        <tr>
            <td colspan="2" class=" text-left font-bold px-1 text-xs text-gray-700 py-2 ">
                {{-- {{ \Carbon\Carbon::parse($date_from)->format('m-d-Y') }}</td> --}}
        </tr>
        <tr>
            <th class="border text-left px-1 text-xs text-gray-700 py-2 whitespace-nowrap">OR NO.
            </th>
            <th class="border text-left px-1 text-xs text-gray-700 py-2">NAME</th>
            <th class="border text-left px-1 text-xs text-gray-700 py-2">GRADE</th>
            @php
                $records = $reports->pluck('id')->toArray();
                $categories = \App\Models\SaleCategory::whereIn(
                    'id',
                    \App\Models\PaymentTransaction::whereIn('student_transaction_id', $records)
                        ->distinct()
                        ->pluck('sale_category_id')
                        ->toArray(),
                )->get();
            @endphp
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
        @foreach ($reports as $item)
            <tr>
                <td class="border text-xs text-gray-700 px-3 py-1 whitespace-nowrap">
                    {{ $item->or_number }}</td>
                <td class="border text-xs text-gray-700 uppercase px-3 py-1 whitespace-nowrap">
                    {{-- 
                    @php
                        if (\App\Models\StudentInformation::where('id', $item->student_information_id)->count() > 0) {
                            $fullname =
                                $item->studentInformation->lastname . ', ' . $item->studentInformation->firstname;
                        } else {
                            $data = \App\Models\StudentPayment::where('id', $item->student_payment_id)->first()->student
                                ->studentInformation;
                            $fullname = $data->lastname . ', ' . $data->firstname;
                        }
                    @endphp
                    {{ $fullname }} --}}
                </td>
                <td class="border text-xs text-gray-700 px-3 py-1 whitespace-nowrap">
                    {{-- @php
                        if (\App\Models\StudentInformation::where('id', $item->student_information_id)->count() > 0) {
                            $grade = $item->studentInformation->educationalInformation->gradeLevel->name;
                        } else {
                            $data = \App\Models\StudentPayment::where('id', $item->student_payment_id)->first()->student
                                ->studentInformation;
                            $grade = $data->educationalInformation->gradeLevel->name;
                        }
                    @endphp
                    {{ $grade }} --}}
                </td>
                @php
                    $studentTotal = 0;
                @endphp
                @foreach ($categories as $index => $category)
                    <td class="border text-xs text-gray-700 px-3 py-1">
                        @php
                            $sale = \App\Models\PaymentTransaction::where('student_transaction_id', $item->id)
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
