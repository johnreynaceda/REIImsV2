<div>
    <table id="example" class="table-auto mt-5" style="width:100%">
        <thead class="font-normal">
            <tr>
                <th class="border text-center border-gray-600 px-2 font-bold  py-2">CATEGORY
                </th>

                <th class="border text-center border-gray-600 px-2 font-bold  py-2">AMOUNT
                </th>


            </tr>
        </thead>
        <tbody class="">

            @forelse (\App\Models\ExpenseCategoryTransaction::where('expense_id', $getRecord()->id)->get() as $item)
                <tr>
                    <td class="border text-gray-700 uppercase  font-bold text-left border-gray-500 px-3 ">
                        {{ $item->expenseCategory->name }}
                    </td>

                    <td class="border text-gray-700  font-medium text-center border-gray-500 px-3 ">
                        &#8369;{{ number_format($item->amount, 2) }}
                    </td>
                </tr>

            @empty
            @endforelse
        </tbody>
    </table>
    <div class="mt-5 flex justify-end">
        <h1 class="font-semibold text-gray-600">TOTAL PAYABLES: <span
                class="text-red-600 text-xl font-poppins">&#8369;{{ number_format($getRecord()->total_payment, 2) }}</span>
        </h1>

    </div>
</div>
