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
    <div class="flex justify-between items-end">
        <div class="flex space-x-2 items-center text-gray-600">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"
                class="icon icon-tabler icons-tabler-outline icon-tabler-home-edit">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M9 21v-6a2 2 0 0 1 2 -2h2c.645 0 1.218 .305 1.584 .78" />
                <path d="M20 11l-8 -8l-9 9h2v7a2 2 0 0 0 2 2h4" />
                <path d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z" />
            </svg>
            <h1 class="text-2xl uppercase font-semibold">{{ $section_name }}</h1>
        </div>
        <x-button label="Print Section" dark icon="printer" class="font-semibold" wire:click="printSection"
            spinner="printSection" />
    </div>
    <div class="mt-5">
        {{ $this->table }}
    </div>
    @if ($student_id)
        <div class="hidden">
            <div x-ref="printContainer">
                @if ($student_id)
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
                                    @if ($student->studentInformation->middlename_is_null == true)
                                        {{ $student->studentInformation->lastname }},
                                        {{ $student->studentInformation->firstname }}
                                        {{ $student->studentInformation->suffix }}
                                    @else
                                        {{ $student->studentInformation->lastname }},
                                        {{ $student->studentInformation->firstname }}
                                        {{ $student->studentInformation->middlename[0] }}.
                                        {{ $student->studentInformation->suffix }}
                                    @endif
                                </h1>
                            </div>
                            <div class="grid grid-cols-2 mt-1">
                                <div class="flex space-x-1">
                                    <span>GRADE :</span>
                                    <h1 class="flex-1 text-center border-b uppercase">
                                        {{ $student->studentInformation->educationalInformation->gradeLevel->name }}</span>
                                </div>
                                <div class="flex space-x-1">
                                    <span>SECTION :</span>
                                    <h1 class="flex-1 text-center border-b uppercase">
                                        {{ $student->studentSections->first()->section->name ?? '' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 flex justify-end">
                            <div class=" w-1/2">
                                <span class="font-semibold text-sm text-right text-gray-700">Grand Total: &#8369;
                                    @php
                                        $grand_total = 0;
                                        $grade_level =
                                            $student->studentInformation->educationalInformation->gradeLevel->id;
                                        $tui_applied = $student->studentPayments
                                            ->where(
                                                'active_sem',
                                                $department == 'SHS'
                                                    ? \App\Models\ActiveSemester::first()->active
                                                    : '1st Semester',
                                            )
                                            ->first()->applied_tuition_subd;
                                        $tui_subd = $tui_applied != null ? $tui_applied : 0;
                                        $misc_applied = $student->studentPayments
                                            ->where(
                                                'active_sem',
                                                $department == 'SHS'
                                                    ? \App\Models\ActiveSemester::first()->active
                                                    : '1st Semester',
                                            )
                                            ->first()->applied_misc_subd;
                                        $misc_subd = $misc_applied != null ? $misc_applied : 0;

                                        foreach (
                                            \App\Models\GradeLevelFee::where('grade_level_id', $grade_level)->get()
                                            as $key => $value
                                        ) {
                                            if ($value->school_fee->name) {
                                                switch ($value->school_fee->name) {
                                                    case 'Tuition':
                                                        $discount =
                                                            ($value->school_fee->amount * (float) $tui_subd) / 100;
                                                        $total =
                                                            $department == 'SHS'
                                                                ? ($value->school_fee->amount - $discount) / 2
                                                                : $value->school_fee->amount - $discount;
                                                        $soa_tuition = $total;
                                                        break;
                                                    case 'Miscellaneous':
                                                        $discount =
                                                            ($value->school_fee->amount * (float) $misc_subd) / 100;
                                                        $total =
                                                            $department == 'SHS'
                                                                ? ($value->school_fee->amount - $discount) / 2
                                                                : $value->school_fee->amount - $discount;
                                                        $soa_misc = $total;
                                                        break;

                                                    case 'Medical/Dental':
                                                        $total =
                                                            $department == 'SHS'
                                                                ? $value->school_fee->amount / 2
                                                                : $value->school_fee->amount;
                                                        $soa_dental = $total;
                                                        break;
                                                    case 'School ID':
                                                        $total =
                                                            $department == 'SHS'
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
                                        <td
                                            class="border text-gray-700 text-xs font-semibold text-left border-gray-700 px-3 ">
                                            TUITION
                                            FEE <span
                                                class="text-[0.5rem]">(&#8369;{{ number_format($soa_tuition, 2) }})</span>
                                        </td>

                                        <td
                                            class="border text-gray-700 text-xs font-medium text-center border-gray-700 px-3 ">
                                            @php
                                                $tuition = \App\Models\StudentTransaction::where(
                                                    'student_payment_id',
                                                    $dues->id,
                                                )
                                                    ->pluck('id')
                                                    ->toArray();
                                                $total_counter = \App\Models\PaymentTransaction::whereIn(
                                                    'student_transaction_id',
                                                    $tuition,
                                                )
                                                    ->where('paid_amount', '>', 0)
                                                    ->whereHas('saleCategory', function ($category) {
                                                        $category->where('name', 'like', 'tuition');
                                                    })
                                                    ->count();

                                                $total_tuition =
                                                    $department == 'SHS'
                                                        ? $dues->total_tuition / ($payment_terms / 2 - $total_counter)
                                                        : $dues->total_tuition / ($payment_terms - $total_counter);
                                            @endphp

                                            &#8369;{{ number_format($total_tuition, 2) }}
                                        </td>
                                        <td
                                            class="border text-gray-700 text-xs font-medium text-center border-gray-700 px-3 ">
                                            &#8369;{{ number_format($dues->total_tuition, 2) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="border text-gray-700 text-xs font-semibold text-left border-gray-700 px-3 ">
                                            MISCELLANEOUS FEE <span
                                                class="text-[0.5rem]">(&#8369;{{ number_format($soa_misc, 2) }})</span>
                                        </td>

                                        <td
                                            class="border text-gray-700 text-xs font-medium text-center border-gray-700 px-3 ">


                                            @php
                                                $misc = \App\Models\StudentTransaction::where(
                                                    'student_payment_id',
                                                    $dues->id,
                                                )
                                                    ->pluck('id')
                                                    ->toArray();
                                                $total_misc = \App\Models\PaymentTransaction::whereIn(
                                                    'student_transaction_id',
                                                    $misc,
                                                )
                                                    ->where('paid_amount', '>', 0)
                                                    ->whereHas('saleCategory', function ($category) {
                                                        $category->where('name', 'like', 'Miscellaneous');
                                                    })
                                                    ->count();
                                                // $total_misc = $dues->total_misc / (10 - $total_misc);
                                                $total_misc =
                                                    $department == 'SHS'
                                                        ? $dues->total_misc / ($payment_terms / 2 - $total_misc)
                                                        : $dues->total_misc / ($payment_terms - $total_misc);
                                            @endphp

                                            &#8369;{{ number_format($total_misc, 2) }}
                                        </td>
                                        <td
                                            class="border text-gray-700 text-xs font-medium text-center border-gray-700 px-3 ">
                                            &#8369;{{ number_format($dues->total_misc, 2) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="border text-gray-700 text-xs font-semibold text-left border-gray-700 px-3 ">
                                            DEVELOPMENT FEE <span
                                                class="text-[0.5rem]">(&#8369;{{ number_format(1000, 2) }})</span>
                                        </td>

                                        <td
                                            class="border text-gray-700 text-xs font-medium text-center border-gray-700 px-3 ">
                                            -
                                        </td>
                                        <td
                                            class="border text-gray-700 text-xs font-medium text-center border-gray-700 px-3 ">
                                            -
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="border text-gray-700 text-xs font-semibold text-left border-gray-700 px-3 ">
                                            ENROLMENT FEE <span
                                                class="text-[0.5rem]">(&#8369;{{ number_format(500, 2) }})</span>
                                        </td>

                                        <td
                                            class="border text-gray-700 text-xs font-medium text-center border-gray-700 px-3 ">
                                            -
                                        </td>
                                        <td
                                            class="border text-gray-700 text-xs font-medium text-center border-gray-700 px-3 ">
                                            -
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="border text-gray-700 text-xs font-semibold text-left border-gray-700 px-3 ">
                                            MEDICAL/DENTAL
                                            FEE <span
                                                class="text-[0.5rem]">(&#8369;{{ number_format($soa_dental, 2) }})</span>
                                        </td>

                                        <td
                                            class="border text-gray-700 text-xs font-medium text-center border-gray-700 px-3 ">
                                            -
                                        </td>
                                        <td
                                            class="border text-gray-700 text-xs font-medium text-center border-gray-700 px-3 ">
                                            -
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="border text-gray-700 text-xs font-semibold text-left border-gray-700 px-3 ">
                                            SCHOOL ID <span
                                                class="text-[0.5rem]">(&#8369;{{ number_format($soa_id, 2) }})</span>
                                        </td>

                                        <td
                                            class="border text-gray-700 text-xs font-medium text-center border-gray-700 px-3 ">
                                            -
                                        </td>
                                        <td
                                            class="border text-gray-700 text-xs font-medium text-center border-gray-700 px-3 ">
                                            -
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="border text-gray-700 text-xs font-semibold text-left border-gray-700 px-3 ">
                                            BOOKS <span class="text-[0.5rem]">(&#8369; )</span>
                                        </td>

                                        <td
                                            class="border text-gray-700 text-xs font-medium text-center border-gray-700 px-3 ">


                                            @php
                                                $books = \App\Models\StudentTransaction::where(
                                                    'student_payment_id',
                                                    $dues->id,
                                                )
                                                    ->pluck('id')
                                                    ->toArray();

                                                $total_books = \App\Models\PaymentTransaction::whereIn(
                                                    'student_transaction_id',
                                                    $books,
                                                )
                                                    ->where('paid_amount', '>', 0)
                                                    ->whereHas('saleCategory', function ($category) {
                                                        $category->where('name', 'like', 'Books');
                                                    })
                                                    ->count();

                                                if ($dues->book_fee_updated == false) {
                                                    $total_books = 500;
                                                } else {
                                                    $total_books =
                                                        $dues->total_book == 1000
                                                            ? 0
                                                            : $dues->total_book / (6 - $total_books);
                                                }
                                            @endphp

                                            &#8369;{{ number_format($total_books, 2) }}
                                        </td>
                                        <td
                                            class="border text-gray-700 text-xs font-medium text-center border-gray-700 px-3 ">
                                            @if ($dues->book_fee_updated == false)
                                                &#8369;0.00
                                            @else
                                                &#8369;{{ number_format($dues->total_book, 2) }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="border text-xs text-gray-700 font-semibold text-left  border-gray-700 px-3 ">
                                            P.E UNIFORM <span
                                                class="text-[0.5rem]">(&#8369;{{ number_format($pe, 2) }})</span>
                                        </td>
                                        <td
                                            class="border text-xs text-gray-700 font-medium text-center border-gray-700 px-3 ">
                                            -
                                        </td>
                                        <td
                                            class="border text-xs text-gray-700 font-medium text-center border-gray-700 px-3 ">


                                            &#8369;{{ number_format($pe, 2) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="border text-xs text-gray-700 font-semibold text-left  border-gray-700 px-3 ">
                                            STUDENT HAND BOOK <span
                                                class="text-[0.5rem]">(&#8369;{{ number_format($handbook, 2) }})</span>
                                        </td>
                                        <td
                                            class="border text-xs text-gray-700 font-medium text-center border-gray-700 px-3 ">
                                            -
                                        </td>
                                        <td
                                            class="border text-xs text-gray-700 font-medium text-center border-gray-700 px-3 ">


                                            &#8369;{{ number_format($handbook, 2) }}

                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="border text-gray-700 text-xs font-semibold text-left  border-gray-700 px-3 ">
                                            TOTAL
                                        </td>
                                        <td
                                            class="border text-gray-700 text-xs font-semibold text-center border-gray-700 px-3 ">
                                            &#8369;{{ number_format($total_tuition + $total_misc + $total_books, 2) }}
                                        </td>
                                        <td class="border text-xs font-semibold text-center border-gray-700 px-3 ">
                                            &#8369;{{ number_format($dues->total_payables + $handbook + $pe, 2) }}

                                        </td>

                                    </tr>



                                </tbody>

                            </table>
                            <div class="mt-2">
                                <p class="text-[0.5rem] ">Kindly settle your account for the month of <span
                                        class="font-bold uppercase text-red-600">{{ \Carbon\Carbon::parse($due_date)->format('F') ?? '' }}</span>
                                    on
                                    or before <span
                                        class="font-bold text-red-600 uppercase">{{ \Carbon\Carbon::parse($due_date)->format('m-d-y') ?? '' }}</span>

                                    <span class="font-bold  text-[0.5rem] italic">Please disregard this notice if
                                        payment
                                        has been made.
                                    </span>
                                </p>
                                <p class="text-[0.5rem] ">Thank you and Good Bless.</p>
                            </div>

                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>
