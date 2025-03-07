<div x-data>
    @php
        $handbook = 0;
        $pe = 0;

        $soa_tuition = 0;
        $soa_misc = 0;
        $soa_medical = 0;
        $soa_id = 0;
        $soa_dev = 0;
        $soa_enroll = 0;
        $bookssss = 0;
        $soa_pe = 0;
        $soa_handbook = 0;
        // $soa;
    @endphp

    <div class="mb-5 w-72">
        <x-datetime-picker wire:model.live="due_date" label="Due Date" without-time without-timezone />
    </div>
    <x-button label="PRINT" @click="printOut($refs.printContainer.outerHTML);" dark class="font-semibold"
        icon="printer" />


    <div class="border-t mt-5">
        <div x-ref="printContainer">
            @if ($this->student_id)
                    @if ($this->student_id)
                            <div class=" w-6/12 rounded-xl  p-5">
                                <div class="div flex flex-col justify-center items-center">
                                    <img src="{{ asset('images/soa-bg.jpg') }}" class=" h-14" c alt="">
                                </div>
                                <h1 class="mt-2 text-center font-bold text-sm font-poppins text-gray-800">BILLING INVOICE</h1>
                                <h1 class="mt-2 text-right font-medium text-xs font-poppins text-gray-800 ">Date:
                                    {{ now()->format('F d, Y') }}
                                </h1>
                                <div class="mt-3 font-poppins text-xs">
                                    <div class="flex space-x-1">
                                        <span>NAME :</span>
                                        <h1 class="flex-1 text-center text-sm font-bold border-b uppercase">
                                            @if ($this->student->studentInformation->middlename_is_null == true)
                                                {{ $this->student->studentInformation->lastname }},
                                                {{ $this->student->studentInformation->firstname }}
                                                {{ $this->student->studentInformation->suffix }}
                                            @else
                                                {{ $this->student->studentInformation->lastname }},
                                                {{ $this->student->studentInformation->firstname }}
                                                {{ $this->student->studentInformation->middlename[0] }}.
                                                {{ $this->student->studentInformation->suffix }}
                                            @endif
                                        </h1>
                                    </div>
                                    <div class="grid grid-cols-2 mt-1">
                                        <div class="flex space-x-1">
                                            <span>GRADE :</span>
                                            <h1 class="flex-1 text-center border-b uppercase">
                                                {{ $this->student->studentInformation->educationalInformation->gradeLevel->name }}</span>
                                        </div>
                                        <div class="flex space-x-1">
                                            <span>SECTION :</span>
                                            <h1 class="flex-1 text-center border-b uppercase">
                                                {{ $this->student->studentSections->first()->section->name ?? '' }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-5 flex justify-end">
                                    <div class=" w-1/2">
                                        <span class="font-semibold text-sm text-right text-gray-700">Grand Total: &#8369;
                                            @php
                                                $grand_total = 0;
                                                $grade_level =
                                                    $this->student->studentInformation->educationalInformation->gradeLevel->id;
                                                $tui_applied = $this->student->studentPayments
                                                    ->where(
                                                        'active_sem',
                                                        $this->department == 'SHS'
                                                        ? \App\Models\ActiveSemester::first()->active
                                                        : '1st Semester',
                                                    )
                                                    ->first()->applied_tuition_subd;
                                                $tui_subd = $tui_applied != null ? $tui_applied : 0;
                                                $misc_applied = $this->student->studentPayments
                                                    ->where(
                                                        'active_sem',
                                                        $this->department == 'SHS'
                                                        ? \App\Models\ActiveSemester::first()->active
                                                        : '1st Semester',
                                                    )
                                                    ->first()->applied_misc_subd;
                                                $misc_subd = $misc_applied != null ? $misc_applied : 0;

                                                foreach (\App\Models\GradeLevelFee::where('grade_level_id', $grade_level)->get() as $key => $value) {
                                                    if ($value->school_fee->name) {
                                                        switch ($value->school_fee->name) {
                                                            case 'Tuition':
                                                                $discount =
                                                                    ($value->school_fee->amount * (float) $tui_subd) / 100;
                                                                $total =
                                                                    $this->department == 'SHS'
                                                                    ? ($value->school_fee->amount - $discount) / 2
                                                                    : $value->school_fee->amount - $discount;
                                                                $soa_tuition = $total;
                                                                break;
                                                            case 'Miscellaneous':
                                                                $discount =
                                                                    ($value->school_fee->amount * (float) $misc_subd) / 100;
                                                                $total =
                                                                    $this->department == 'SHS'
                                                                    ? ($value->school_fee->amount - $discount) / 2
                                                                    : $value->school_fee->amount - $discount;
                                                                $soa_misc = $total;
                                                                break;

                                                            case 'Medical/Dental':
                                                                $total =
                                                                    $this->department == 'SHS'
                                                                    ? $value->school_fee->amount / 2
                                                                    : $value->school_fee->amount;
                                                                $soa_dental = $total;
                                                                break;
                                                            case 'School ID':
                                                                $total =
                                                                    $this->department == 'SHS'
                                                                    ? $value->school_fee->amount / 2
                                                                    : $value->school_fee->amount;
                                                                $soa_id = $total;
                                                                break;

                                                            case 'P.E Uniform':
                                                                $total = $value->school_fee->amount;
                                                                $soa_pe = $total;
                                                                break;
                                                            case 'Developmental Fee':
                                                                $total = $value->school_fee->amount;
                                                                $soa_dev = $total;
                                                                break;
                                                            case 'Enrolment Fee':
                                                                $total = $value->school_fee->amount;
                                                                $soa_enroll = $total;
                                                                break;
                                                            case 'Handbook':
                                                                $total = $value->school_fee->amount;
                                                                $soa_handbook = $total;
                                                                break;

                                                            default:
                                                                $total = $value->school_fee->amount;
                                                                // dd($value->school_fee->name . '-' . $value->school_fee->amount);
                                                                break;
                                                        }
                                                        $grand_total += $total;
                                                    }
                                                }
                                            @endphp
                                            {{ number_format($grand_total, 2) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="mt-2 text-xs font-poppins">
                                    <table id="example" class="table-auto" style="width:100%">
                                        <thead class="font-normal">
                                            <tr>
                                                <th
                                                    class="border w-80 text-center text-xs border-gray-700 text-gray-700 px-2 font-semibold  py-2">
                                                    PARTICULARS
                                                </th>

                                                <th
                                                    class="border text-center text-xs border-gray-700 text-gray-700 px-2 font-semibold  py-2">
                                                    MONTHLY DUES
                                                </th>
                                                <th
                                                    class="border text-center text-xs border-gray-700 text-gray-700 px-2 font-semibold  py-2">
                                                    REMAINING
                                                    BALANCE
                                                </th>

                                            </tr>
                                        </thead>
                                        <tbody class="">
                                            <tr>
                                                <td class="border text-gray-700 text-xs font-semibold text-left border-gray-700 px-3 ">
                                                    TUITION
                                                    FEE <span class="text-[0.5rem]">(&#8369;{{ number_format($soa_tuition, 2) }})</span>
                                                </td>

                                                <td class="border text-gray-700 text-xs font-medium text-center border-gray-700 px-3 ">
                                                    @php
                                                        // Fetch Tuition Transactions
                                                        $tuition = \App\Models\StudentTransaction::where('student_payment_id', $this->dues->id)
                                                            ->pluck('id')
                                                            ->toArray();

                                                        // Count Paid Transactions for Tuition
                                                        $total_counter = \App\Models\PaymentTransaction::whereIn('student_transaction_id', $tuition)
                                                            ->where('paid_amount', '>', 0)
                                                            ->whereHas('saleCategory', function ($category) {
                                                                $category->where('name', 'like', 'tuition');
                                                            })
                                                            ->count();

                                                        // Determine Payment Terms Based on Department
                                                        $tuition_term = $this->department == 'SHS' ? $this->payment_terms / 2 : $this->payment_terms;

                                                        // Initialize Tuition Amount
                                                        $total_tuition = 0;

                                                        // Check if Tuition Terms is greater than 0 to avoid division by zero
                                                        if ($tuition_term > 0) {
                                                            $remaining_terms = $tuition_term - $total_counter;

                                                            // Only divide if remaining terms are greater than 0
                                                            if ($remaining_terms > 0) {
                                                                $total_tuition = $this->dues->total_tuition / $remaining_terms;
                                                            } else {
                                                                $total_tuition = 0; // No remaining terms, set to zero
                                                            }
                                                        }
                                                    @endphp

                                                    &#8369;{{ number_format($total_tuition, 2) }}


                                                    &#8369;{{ number_format($total_tuition, 2) }}
                                                </td>
                                                <td class="border text-gray-700 text-xs font-medium text-center border-gray-700 px-3 ">
                                                    &#8369;{{ number_format($this->dues->total_tuition, 2) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border text-gray-700 text-xs font-semibold text-left border-gray-700 px-3 ">
                                                    MISCELLANEOUS FEE <span
                                                        class="text-[0.5rem]">(&#8369;{{ number_format($soa_misc, 2) }})</span>
                                                </td>

                                                <td class="border text-gray-700 text-xs font-medium text-center border-gray-700 px-3 ">


                                                    @php
                                                        // Calculate Miscellaneous
                                                        $misc = \App\Models\StudentTransaction::where(
                                                            'student_payment_id',
                                                            $this->dues->id,
                                                        )
                                                            ->pluck('id')
                                                            ->toArray();

                                                        $total_misc_count = \App\Models\PaymentTransaction::whereIn(
                                                            'student_transaction_id',
                                                            $misc,
                                                        )
                                                            ->where('paid_amount', '>', 0)
                                                            ->whereHas('saleCategory', function ($category) {
                                                                $category->where('name', 'like', 'Miscellaneous');
                                                            })
                                                            ->count();

                                                        // Determine the correct payment term
                                                        $misc_term =
                                                            $this->department == 'SHS'
                                                            ? $this->payment_terms / 2
                                                            : $this->payment_terms;

                                                        // Check if total misc count is equal to payment terms
                                                        if ($total_misc_count >= $misc_term) {
                                                            $total_misc = $this->dues->total_misc; // Assign the total amount
                                                        } else {
                                                            $remaining_terms = $misc_term - $total_misc_count;
                                                            $total_misc =
                                                                $remaining_terms > 0
                                                                ? $this->dues->total_misc / $remaining_terms
                                                                : 0;
                                                        }
                                                    @endphp

                                                    &#8369;{{ number_format($total_misc, 2) }}
                                                </td>
                                                <td class="border text-gray-700 text-xs font-medium text-center border-gray-700 px-3 ">
                                                    &#8369;{{ number_format($this->dues->total_misc, 2) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border text-gray-700 text-xs font-semibold text-left border-gray-700 px-3 ">
                                                    DEVELOPMENT FEE <span
                                                        class="text-[0.5rem]">(&#8369;{{ number_format(1000, 2) }})</span>
                                                </td>

                                                <td class="border text-gray-700 text-xs font-medium text-center border-gray-700 px-3 ">
                                                    -
                                                </td>
                                                <td class="border text-gray-700 text-xs font-medium text-center border-gray-700 px-3 ">
                                                    -
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border text-gray-700 text-xs font-semibold text-left border-gray-700 px-3 ">
                                                    ENROLMENT FEE <span
                                                        class="text-[0.5rem]">(&#8369;{{ number_format(500, 2) }})</span>
                                                </td>

                                                <td class="border text-gray-700 text-xs font-medium text-center border-gray-700 px-3 ">
                                                    -
                                                </td>
                                                <td class="border text-gray-700 text-xs font-medium text-center border-gray-700 px-3 ">
                                                    -
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border text-gray-700 text-xs font-semibold text-left border-gray-700 px-3 ">
                                                    MEDICAL/DENTAL
                                                    FEE <span class="text-[0.5rem]">(&#8369;{{ number_format($soa_dental, 2) }})</span>
                                                </td>

                                                <td class="border text-gray-700 text-xs font-medium text-center border-gray-700 px-3 ">
                                                    -
                                                </td>
                                                <td class="border text-gray-700 text-xs font-medium text-center border-gray-700 px-3 ">
                                                    -
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border text-gray-700 text-xs font-semibold text-left border-gray-700 px-3 ">
                                                    SCHOOL ID <span
                                                        class="text-[0.5rem]">(&#8369;{{ number_format($soa_id, 2) }})</span>
                                                </td>

                                                <td class="border text-gray-700 text-xs font-medium text-center border-gray-700 px-3 ">
                                                    -
                                                </td>
                                                <td class="border text-gray-700 text-xs font-medium text-center border-gray-700 px-3 ">
                                                    -
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border text-gray-700 text-xs font-semibold text-left border-gray-700 px-3 ">
                                                    BOOKS <span class="text-[0.5rem]">(&#8369; )</span>
                                                </td>

                                                <td class="border text-gray-700 text-xs font-medium text-center border-gray-700 px-3 ">

                                                    @php
                                                        // Get book transaction IDs for the student
                                                        $books = \App\Models\StudentTransaction::where(
                                                            'student_payment_id',
                                                            $this->dues->id,
                                                        )
                                                            ->pluck('id')
                                                            ->toArray();

                                                        // Count the number of paid book transactions
                                                        $paid_books_count = \App\Models\PaymentTransaction::whereIn(
                                                            'student_transaction_id',
                                                            $books,
                                                        )
                                                            ->where('paid_amount', '>', 0)
                                                            ->whereHas('saleCategory', function ($category) {
                                                                $category->where('name', 'like', 'Books');
                                                            })
                                                            ->count();

                                                        // Determine total_books based on fee update status
                                                        if (!$this->dues->book_fee_updated) {
                                                            $total_books = 500;
                                                        } else {
                                                            // Calculate the divisor and guard against zero
                                                            $divisor = max(6 - $paid_books_count, 1); // Minimum divisor is 1
                                                            $total_books = (float) $this->dues->total_book / $divisor;
                                                        }
                                                    @endphp

                                                    &#8369;{{ number_format($total_books, 2) }}
                                                </td>

                                                <td class="border text-gray-700 text-xs font-medium text-center border-gray-700 px-3 ">
                                                    @if ($this->dues->book_fee_updated == false)
                                                        &#8369;0.00
                                                    @else
                                                        &#8369;{{ number_format($this->dues->total_book, 2) }}
                                                    @endif
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="border text-xs text-gray-700 font-semibold text-left  border-gray-700 px-3 ">
                                                    P.E UNIFORM <span class="text-[0.5rem]">(&#8369;{{ number_format($pe, 2) }})</span>
                                                </td>
                                                <td class="border text-xs text-gray-700 font-medium text-center border-gray-700 px-3 ">
                                                    -
                                                </td>
                                                <td class="border text-xs text-gray-700 font-medium text-center border-gray-700 px-3 ">


                                                    &#8369;{{ number_format($pe, 2) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border text-sm text-gray-700 font-bold text-left border-gray-700 px-3">
                                                    HANDBOOK
                                                </td>
                                                <td class="border text-sm text-gray-700 font-medium text-center border-gray-700 px-3">
                                                    -
                                                </td>
                                                <td class="border text-sm text-gray-700 font-medium text-center border-gray-700 px-3">
                                                    @php
                                                        $amount = \App\Models\OtherPayment::whereHas('saleCategory', function ($query, ) {
                                                            $query->where('name', 'LIKE', '%' . 'HANDBOOK' . '%');
                                                        })
                                                            ->whereHas('otherPaymentStudents', function ($students) {
                                                                $students->where('student_id', $this->student->id);
                                                            })
                                                            ->first();

                                                        if ($amount) {
                                                            $is_paid = \App\Models\PaymentTransaction::where(
                                                                'sale_category_id',
                                                                $amount->sale_category_id,
                                                            )
                                                                ->whereHas('studentTransaction', function ($query) {
                                                                    $student_info_id = \App\Models\Student::where(
                                                                        'id',
                                                                        $this->student->id,
                                                                    )->first()->student_information_id;
                                                                    $query->where('student_information_id', $student_info_id);
                                                                })
                                                                ->get();

                                                            $handbook = $is_paid->count() > 0 ? 0 : $amount->amount;
                                                        } else {
                                                            $handbook = 0;
                                                        }
                                                    @endphp

                                                    &#8369;{{ number_format($handbook, 2) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border text-gray-700 text-xs font-semibold text-left  border-gray-700 px-3 ">
                                                    TOTAL
                                                </td>
                                                <td
                                                    class="border text-gray-700 text-xs font-semibold text-center border-gray-700 px-3 ">
                                                    &#8369;{{ number_format($total_tuition + $total_misc + $total_books, 2) }}
                                                </td>
                                                <td class="border text-xs font-semibold text-center border-gray-700 px-3 ">
                                                    &#8369;{{ number_format($this->dues->total_payables + $handbook + $pe, 2) }}

                                                </td>

                                            </tr>



                                        </tbody>

                                    </table>
                                    <div class="mt-2">
                                        <p class="text-[0.5rem] ">Kindly settle your account for the month of <span
                                                class="font-bold uppercase text-red-600">{{ \Carbon\Carbon::parse($this->due_date)->format('F') ?? '' }}</span>
                                            on
                                            or before <span
                                                class="font-bold text-red-600 uppercase">{{ \Carbon\Carbon::parse($this->due_date)->format('F d, Y') ?? '' }}.</span>


                                        </p>
                                        <p class="font-bold  text-[0.5rem] italic">Please disregard this notice if
                                            payment
                                            has been made.
                                        </p>
                                        <p class="text-[0.5rem] ">Thank you and Good Bless.</p>
                                    </div>

                                </div>
                            </div>
                    @endif
            @endif
        </div>
    </div>
</div>