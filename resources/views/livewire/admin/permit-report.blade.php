<div x-data>
    <div class="mt-10">
        <div class="mt-4 border-t border-b pt-4 pb-4 flex justify-between items-end">
            <div class="flex space-x-2 ">
                <div>
                    <x-native-select label="Select Month" wire:model.live="month">
                        <option>Select an option</option>
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </x-native-select>
                </div>
                <div>
                    <x-native-select label="Select Grade Level" wire:model.live="grade_level">
                        <option>Select an option</option>
                        @foreach ($grade_levels as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </x-native-select>
                </div>
                <div>
                    @if ($grade_level)
                        <x-native-select label="Select Section" wire:model.live="section">
                            <option>Select an option</option>
                            @foreach ($sections as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </x-native-select>
                    @endif
                </div>
            </div>
            <div class="flex space-x-2">
                <x-button dark label="Print Report" @click="printOut($refs.printContainer.outerHTML);" icon="printer" />
                {{-- <x-button positive label="Export Report" icon="printer" /> --}}
            </div>
        </div>
        <div class="my-2">
            <span wire:loading wire:target="month" class="text-red-500 animate-pulse">Please wait while generating your
                report.</span>
        </div>
        <div class="mt-5" x-ref="printContainer">
            <div class="flex space-x-2 items-center">
                <img src="{{ asset('images/reii_logo.png') }}" class="h-14" alt="">
                <div>
                    <h1 class="font-bold text-lg text-orange-500">ROCKFORT EDUCATIONAL INSTITUTE INCORPORATED</h1>
                    <h1 class="leading-3 text-gray-700 font-medium">Permit Report</h1>
                </div>
            </div>
            <div class="mt-5">
                <table id="example" class="min-w-full mt-5" style="width:100%">
                    <thead class="">

                        <tr>
                            <th class="border text-left text-sm px-3  text-gray-700 py-2 whitespace-nowrap">STUDENT
                                FULLNAME
                            </th>
                            <th class="border text-left text-sm px-3  text-gray-700 py-2">GRADE LEVEL</th>

                            <th class="border text-left text-sm px-3  text-gray-700 py-2">SECTION</th>
                            <th class="border text-left text-sm px-3  text-gray-700 py-2">TUITION</th>
                            <th class="border text-left text-sm px-3  text-gray-700 py-2">MISCELLANEOUS</th>
                            <th class="border text-left text-sm px-3  text-gray-700 py-2">BOOKS</th>
                            <th class="border text-left text-sm px-3  text-gray-700 py-2">PREVIOUS</th>
                            <th class="border text-left text-sm px-3  text-gray-700 py-2">CURRENT</th>
                            <th class="border text-left text-sm px-3  text-gray-700 py-2">BALANCE</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        @forelse ($permits as $student)
                            @php
                                // Get student payment
                                $payment = \App\Models\StudentPayment::where('student_id', $student->id)->first();

                                // If no payment found, set current_month and previous_total to null
                                $current_month = null;
                                $previous_total = null;

                                if ($payment) {
                                    // Get the current month transactions
                                    $current_month = \App\Models\StudentTransaction::where(
                                        'student_payment_id',
                                        $payment->id,
                                    )
                                        ->whereMonth('created_at', $month) // Assumes $month is set correctly
                                        ->get();

                                    // Get all transactions before the current month
                                    $previous_total = \App\Models\StudentTransaction::where(
                                        'student_payment_id',
                                        $payment->id,
                                    )
                                        ->whereMonth('created_at', '<', $month) // Gets all transactions before the start of the current month
                                        ->get();
                                }
                            @endphp

                            <tr>

                                <td class="border text-sm text-gray-700 px-3 py-1 whitespace-nowrap">
                                    {{ $student->studentInformation->lastname . ', ' . $student->studentInformation->firstname . ' ' . ($student->studentInformation->middlename == null ? '' : $student->studentInformation->middlename[0] . '.') }}
                                </td>
                                <td class="border text-sm text-gray-700 px-3 py-1 whitespace-nowrap">
                                    {{ $student->studentInformation->educationalInformation->gradeLevel->name }}
                                </td>
                                <td class="border text-sm text-gray-700 px-3 py-1 whitespace-nowrap">
                                    {{ $student->studentSections->first()->section->name ?? '' }}
                                </td>
                                <td class="border text-sm text-gray-700 px-3 py-1 whitespace-nowrap">
                                    {{-- Assuming the relation paymentTransactions exists, and using it to calculate the sum --}}
                                    {{ $current_month
                                        ? number_format(
                                            $current_month->sum(function ($transaction) {
                                                return $transaction->paymentTransactions->where('sale_category_id', 1)->sum('paid_amount');
                                            }),
                                            2,
                                        )
                                        : '0.00' }}
                                </td>
                                <td class="border text-sm text-gray-700 px-3 py-1 whitespace-nowrap">
                                    {{ $current_month
                                        ? number_format(
                                            $current_month->sum(function ($transaction) {
                                                return $transaction->paymentTransactions->where('sale_category_id', 2)->sum('paid_amount');
                                            }),
                                            2,
                                        )
                                        : '0.00' }}
                                </td>
                                <td class="border text-sm text-gray-700 px-3 py-1 whitespace-nowrap">
                                    {{ $current_month
                                        ? number_format(
                                            $current_month->sum(function ($transaction) {
                                                return $transaction->paymentTransactions->where('sale_category_id', 7)->sum('paid_amount');
                                            }),
                                            2,
                                        )
                                        : '0.00' }}
                                </td>
                                <td class="border text-sm text-gray-700 px-3 py-1 whitespace-nowrap">
                                    {{ $previous_total ? number_format($previous_total->sum('total_amount'), 2) : '0.00' }}
                                </td>
                                <td class="border text-sm text-gray-700 px-3 py-1 whitespace-nowrap">
                                    {{ $current_month ? number_format($current_month->sum('total_amount'), 2) : '0.00' }}
                                </td>
                                <td class="border text-sm text-gray-700 px-3 py-1 whitespace-nowrap">
                                    {{ $payment ? number_format($payment->total_payables, 2) : '0.00' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9"
                                    class="border text-sm text-gray-700 px-3 py-1 whitespace-nowrap text-center">
                                    <span>Please select month you want to generate</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
