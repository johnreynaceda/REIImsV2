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
        $total_books = 0;
        // $soa;
    @endphp
    <div class="flex justify-between items-end">
        <div class="w-96">
            {{ $this->form }}
        </div>
        <div>
            @if ($student_id)
                {{-- <livewire:soa.add-payment :student_id="$student_id" /> --}}
                <livewire:admin.soa-payment :student_id="$student_id" />
            @endif
        </div>
    </div>
    @if ($student_id)
        <div class="grid grid-cols-2 mt-5 gap-5 w-full">
            <div class="">
                <div class="bg-white rounded-xl shadow-xl p-5">
                    <div class="flex space-x-2 w-full justify-center ">
                        <img src="{{ asset('images/soa-bg.jpg') }}" class="h-14" alt="">
                    </div>
                    <h1 class="mt-3 text-center font-bold font-poppins text-gray-800">BILLING INVOICE</h1>
                    <h1 class="mt-3 text-right font-medium text-sm font-poppins text-gray-800 ">Date:
                        {{ now()->format('F d, Y') }}
                    </h1>
                    <div class="mt-5 font-poppins">
                        <div class="flex space-x-1">
                            <span>NAME :</span>
                            <h1 class="flex-1 text-center font-bold border-b uppercase">
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
                                </span>
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
                    <div class="mt-5 font-poppins">
                        <table id="example" class="table-auto mt-5" style="width:100%">
                            <thead class="font-normal">
                                <tr>
                                    <th class="border text-center border-gray-700 text-gray-800 px-2 font-bold  py-2">
                                        PARTICULARS
                                    </th>

                                    <th class="border text-center border-gray-700 text-gray-800 px-2 font-bold  py-2">
                                        MONTHLY DUES
                                    </th>
                                    <th class="border text-center border-gray-700 text-gray-800 px-2 font-bold  py-2">
                                        REMAINING
                                        BALANCE
                                    </th>

                                </tr>
                            </thead>
                            <tbody class="">
                                <tr>
                                    <td class="border text-gray-700 text-sm font-bold text-left border-gray-700 px-3 ">
                                        TUITION FEE</td>

                                    <td
                                        class="border text-gray-700 text-sm font-medium text-center border-gray-700 px-3 ">
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
                                        class="border text-gray-700 text-sm font-medium text-center border-gray-700 px-3 ">
                                        &#8369;{{ number_format($dues->total_tuition, 2) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border text-gray-700 text-sm font-bold text-left border-gray-700 px-3 ">
                                        MISCELLANEOUS FEE
                                    </td>

                                    <td
                                        class="border text-gray-700 text-sm font-medium text-center border-gray-700 px-3 ">


                                        @php
                                            // Calculate Miscellaneous
                                            $misc = \App\Models\StudentTransaction::where(
                                                'student_payment_id',
                                                $dues->id,
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

                                            // Handle division by zero
                                            $misc_term =
                                                $department == 'SHS'
                                                    ? $payment_terms / 2 - $total_misc_count
                                                    : $payment_terms - $total_misc_count;
                                            $total_misc = $misc_term > 0 ? $dues->total_misc / $misc_term : 0;

                                        @endphp

                                        &#8369;{{ number_format($total_misc, 2) }}
                                    </td>
                                    <td
                                        class="border text-gray-700 text-sm font-medium text-center border-gray-700 px-3 ">
                                        &#8369;{{ number_format($dues->total_misc, 2) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border text-gray-700 text-sm font-bold text-left border-gray-700 px-3 ">
                                        DEVELOPMENT FEE
                                    </td>

                                    <td
                                        class="border text-gray-700 text-sm font-medium text-center border-gray-700 px-3 ">
                                        -
                                    </td>
                                    <td
                                        class="border text-gray-700 text-sm font-medium text-center border-gray-700 px-3 ">
                                        -
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border text-gray-700 text-sm font-bold text-left border-gray-700 px-3 ">
                                        ENROLMENT FEE
                                    </td>

                                    <td
                                        class="border text-gray-700 text-sm font-medium text-center border-gray-700 px-3 ">
                                        -
                                    </td>
                                    <td
                                        class="border text-gray-700 text-sm font-medium text-center border-gray-700 px-3 ">
                                        -
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border text-gray-700 text-sm font-bold text-left border-gray-700 px-3 ">
                                        MEDICAL/DENTAL
                                        FEE</td>

                                    <td
                                        class="border text-gray-700 text-sm font-medium text-center border-gray-700 px-3 ">
                                        -
                                    </td>
                                    <td
                                        class="border text-gray-700 text-sm font-medium text-center border-gray-700 px-3 ">
                                        -
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border text-gray-700 text-sm font-bold text-left border-gray-700 px-3 ">
                                        SCHOOL ID</td>

                                    <td
                                        class="border text-gray-700 text-sm font-medium text-center border-gray-700 px-3 ">
                                        -
                                    </td>
                                    <td
                                        class="border text-gray-700 text-sm font-medium text-center border-gray-700 px-3 ">
                                        -
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border text-gray-700 text-sm font-bold text-left border-gray-700 px-3 ">
                                        BOOKS</td>

                                    <td
                                        class="border text-gray-700 text-sm font-medium text-center border-gray-700 px-3 ">

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
                                        class="border text-gray-700 text-sm font-medium text-center border-gray-700 px-3 ">
                                        @if ($dues->book_fee_updated == false)
                                            &#8369;0.00
                                        @else
                                            &#8369;{{ number_format($dues->total_book, 2) }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border text-sm text-gray-700 font-bold text-left  border-gray-700 px-3 ">
                                        P.E UNIFORM
                                    </td>
                                    <td
                                        class="border text-sm text-gray-700 font-medium text-center border-gray-700 px-3 ">
                                        -
                                    </td>
                                    <td
                                        class="border text-sm text-gray-700 font-medium text-center border-gray-700 px-3 ">
                                        @php
                                            $amount = \App\Models\OtherPayment::whereHas('saleCategory', function (
                                                $query,
                                            ) {
                                                $query->where('name', 'LIKE', '%' . 'P.E' . '%');
                                            })
                                                ->whereHas('otherPaymentStudents', function ($students) use (
                                                    $student_id,
                                                ) {
                                                    $students->where('student_id', $student_id);
                                                })
                                                ->first();
                                            // dd($amount);

                                            if ($amount) {
                                                $is_paid = \App\Models\PaymentTransaction::where(
                                                    'sale_category_id',
                                                    $amount->sale_category_id,
                                                )
                                                    ->whereHas('studentTransaction', function ($query) use (
                                                        $student_id,
                                                    ) {
                                                        $student_info_id = \App\Models\Student::where(
                                                            'id',
                                                            $student_id,
                                                        )->first()->student_information_id;
                                                        $query->where('student_information_id', $student_info_id);
                                                    })
                                                    ->get();

                                                if ($is_paid->count() > 0) {
                                                    $pe = 0;
                                                } else {
                                                    $pe = $amount->amount;
                                                }
                                            } else {
                                                $pe = 0;
                                            }

                                        @endphp

                                        &#8369;{{ number_format($pe, 2) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border text-sm text-gray-700 font-bold text-left  border-gray-700 px-3 ">
                                        HANDBOOK
                                    </td>
                                    <td
                                        class="border text-sm text-gray-700 font-medium text-center border-gray-700 px-3 ">
                                        -
                                    </td>
                                    <td
                                        class="border text-sm text-gray-700 font-medium text-center border-gray-700 px-3 ">
                                        @php
                                            $amount = \App\Models\OtherPayment::whereHas('saleCategory', function (
                                                $query,
                                            ) {
                                                $query->where('name', 'LIKE', '%' . 'HANDBOOK' . '%');
                                            })
                                                ->whereHas('otherPaymentStudents', function ($students) use (
                                                    $student_id,
                                                ) {
                                                    $students->where('student_id', $student_id);
                                                })
                                                ->first();

                                            if ($amount) {
                                                $is_paid = \App\Models\PaymentTransaction::where(
                                                    'sale_category_id',
                                                    $amount->sale_category_id,
                                                )
                                                    ->whereHas('studentTransaction', function ($query) use (
                                                        $student_id,
                                                    ) {
                                                        $student_info_id = \App\Models\Student::where(
                                                            'id',
                                                            $student_id,
                                                        )->first()->student_information_id;
                                                        $query->where('student_information_id', $student_info_id);
                                                    })
                                                    ->get();

                                                if ($is_paid->count() > 0) {
                                                    $handbook = 0;
                                                } else {
                                                    $handbook = $amount->amount;
                                                }
                                            } else {
                                                $handbook = 0;
                                            }

                                        @endphp

                                        &#8369;{{ number_format($handbook, 2) }}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="border text-gray-700 font-bold text-left  border-gray-700 px-3 ">
                                        TOTAL
                                    </td>
                                    <td class="border text-gray-700 font-semibold text-center border-gray-700 px-3 ">
                                        &#8369;{{ number_format($total_tuition + $total_misc + $total_books, 2) }}
                                    </td>
                                    <td class="border text-red-600 font-semibold text-center border-gray-700 px-3 ">
                                        &#8369;{{ number_format($dues->total_payables + $handbook + $pe, 2) }}
                                    </td>

                                </tr>



                            </tbody>

                        </table>
                        {{-- <div class="mt-5 font-sans grid grid-cols-2 gap-5 z-20">
                            <x-datetime-picker label="Due Date" without-timezone without-time
                                wire:model.live="due_date" />
                            <div></div>
                            <x-button label="PRINT SOA" icon="printer"
                                @click="printOut($refs.printContainer.outerHTML);" slate class="font-semibold" />
                        </div> --}}
                    </div>
                </div>
            </div>
            {{-- @dump(\App\Models\Student::where('id', $student_id)->first()->student_information_id) --}}
            <div class="bg-white rounded-xl  shadow-xl">
                <div class="flex justify-between border-b items-end py-3 px-5">
                    <h1 class="font-bold font-poppins text-lg text-orange-500">PAYMENT RECORDS</h1>
                    <x-button label="Print Record" icon="printer" slate class="font-medium" />
                </div>

                <div class="p-5">
                    @if ($department === 'SHS')
                        <div class="w-36">
                            <x-native-select label="Select Semester:" wire:model.live="semester">
                                <option>1st Semester</option>
                                <option>2nd Semester</option>
                            </x-native-select>
                        </div>
                    @endif
                    <table id="example" class="table-auto mt-5" style="width:100%">
                        <thead class="font-normal">
                            <tr>
                                <th class="border  text-left  text-gray-600 px-2 font-semibold  py-1 text-sm">
                                    TR NO.
                                </th>

                                <th class="border text-left  text-gray-600 px-2 font-semibold  py-1 text-sm">
                                    OR NO.
                                </th>
                                <th class="border text-left  text-gray-600 px-2 font-semibold  py-1 text-sm">
                                    AMOUNT
                                </th>
                                <th class="border text-left  text-gray-600 px-2 font-semibold  py-1 text-sm">
                                    DOP
                                </th>
                                <th class="border text-left  text-gray-600 px-2 font-semibold  py-1 text-sm">

                                </th>
                                <th class="border text-left  text-gray-600 px-2 font-semibold  py-1 text-sm">

                                </th>
                            </tr>
                        </thead>
                        <tbody class="">
                            @forelse ($records as $item)
                                <tr>
                                    <td class="border text-gray-600 text-sm font-medium text-left px-3  ">
                                        <p class="truncate w-20">
                                            {{ $item->transaction_number }}</p>
                                    </td>
                                    <td class="border text-gray-600 text-sm font-medium text-left px-3  ">
                                        {{ $item->or_number }}</td>
                                    <td class="border text-gray-600 text-sm font-medium text-left px-3  ">
                                        &#8369;{{ number_format($item->total_amount, 2) }}</td>
                                    <td class="border text-gray-600 text-sm font-medium text-left px-3  ">
                                        {{ \Carbon\Carbon::parse($item->created_at)->format('F d, Y') }}</td>
                                    <td class="border text-gray-600 text-sm font-medium text-left px-3  ">
                                        <button wire:click="view({{ $item->id }})"
                                            class="flex text-yellow-500 hover:text-yellow-600 text-sm items-center">
                                            <svg wire:target="view({{ $item->id }})" wire:loading.class="hidden"
                                                width="15" height="15" viewBox="0 0 15 15" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7.5 11C4.80285 11 2.52952 9.62184 1.09622 7.50001C2.52952 5.37816 4.80285 4 7.5 4C10.1971 4 12.4705 5.37816 13.9038 7.50001C12.4705 9.62183 10.1971 11 7.5 11ZM7.5 3C4.30786 3 1.65639 4.70638 0.0760002 7.23501C-0.0253338 7.39715 -0.0253334 7.60288 0.0760014 7.76501C1.65639 10.2936 4.30786 12 7.5 12C10.6921 12 13.3436 10.2936 14.924 7.76501C15.0253 7.60288 15.0253 7.39715 14.924 7.23501C13.3436 4.70638 10.6921 3 7.5 3ZM7.5 9.5C8.60457 9.5 9.5 8.60457 9.5 7.5C9.5 6.39543 8.60457 5.5 7.5 5.5C6.39543 5.5 5.5 6.39543 5.5 7.5C5.5 8.60457 6.39543 9.5 7.5 9.5Z"
                                                    fill="currentColor" fill-rule="evenodd" clip-rule="evenodd">
                                                </path>
                                            </svg>
                                            <svg wire:loading wire:target="view({{ $item->id }})"
                                                class="animate animate-spin" width="15" height="15"
                                                viewBox="0 0 15 15" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M1.84998 7.49998C1.84998 4.66458 4.05979 1.84998 7.49998 1.84998C10.2783 1.84998 11.6515 3.9064 12.2367 5H10.5C10.2239 5 10 5.22386 10 5.5C10 5.77614 10.2239 6 10.5 6H13.5C13.7761 6 14 5.77614 14 5.5V2.5C14 2.22386 13.7761 2 13.5 2C13.2239 2 13 2.22386 13 2.5V4.31318C12.2955 3.07126 10.6659 0.849976 7.49998 0.849976C3.43716 0.849976 0.849976 4.18537 0.849976 7.49998C0.849976 10.8146 3.43716 14.15 7.49998 14.15C9.44382 14.15 11.0622 13.3808 12.2145 12.2084C12.8315 11.5806 13.3133 10.839 13.6418 10.0407C13.7469 9.78536 13.6251 9.49315 13.3698 9.38806C13.1144 9.28296 12.8222 9.40478 12.7171 9.66014C12.4363 10.3425 12.0251 10.9745 11.5013 11.5074C10.5295 12.4963 9.16504 13.15 7.49998 13.15C4.05979 13.15 1.84998 10.3354 1.84998 7.49998Z"
                                                    fill="currentColor" fill-rule="evenodd" clip-rule="evenodd">
                                                </path>
                                            </svg>
                                            <span>VIEW</span>
                                        </button>
                                    </td>
                                    <td class="border text-gray-600 text-sm font-medium text-left px-3  ">
                                        <button wire:click="void({{ $item->id }})"
                                            class="flex text-red-500 hover:text-red-600 text-sm items-center">
                                            <svg wire:target="void({{ $item->id }})" wire:loading.class="hidden"
                                                width="15" height="15" viewBox="0 0 15 15" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7.5 11C4.80285 11 2.52952 9.62184 1.09622 7.50001C2.52952 5.37816 4.80285 4 7.5 4C10.1971 4 12.4705 5.37816 13.9038 7.50001C12.4705 9.62183 10.1971 11 7.5 11ZM7.5 3C4.30786 3 1.65639 4.70638 0.0760002 7.23501C-0.0253338 7.39715 -0.0253334 7.60288 0.0760014 7.76501C1.65639 10.2936 4.30786 12 7.5 12C10.6921 12 13.3436 10.2936 14.924 7.76501C15.0253 7.60288 15.0253 7.39715 14.924 7.23501C13.3436 4.70638 10.6921 3 7.5 3ZM7.5 9.5C8.60457 9.5 9.5 8.60457 9.5 7.5C9.5 6.39543 8.60457 5.5 7.5 5.5C6.39543 5.5 5.5 6.39543 5.5 7.5C5.5 8.60457 6.39543 9.5 7.5 9.5Z"
                                                    fill="currentColor" fill-rule="evenodd" clip-rule="evenodd">
                                                </path>
                                            </svg>
                                            <svg wire:loading wire:target="void({{ $item->id }})"
                                                class="animate animate-spin" width="15" height="15"
                                                viewBox="0 0 15 15" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M1.84998 7.49998C1.84998 4.66458 4.05979 1.84998 7.49998 1.84998C10.2783 1.84998 11.6515 3.9064 12.2367 5H10.5C10.2239 5 10 5.22386 10 5.5C10 5.77614 10.2239 6 10.5 6H13.5C13.7761 6 14 5.77614 14 5.5V2.5C14 2.22386 13.7761 2 13.5 2C13.2239 2 13 2.22386 13 2.5V4.31318C12.2955 3.07126 10.6659 0.849976 7.49998 0.849976C3.43716 0.849976 0.849976 4.18537 0.849976 7.49998C0.849976 10.8146 3.43716 14.15 7.49998 14.15C9.44382 14.15 11.0622 13.3808 12.2145 12.2084C12.8315 11.5806 13.3133 10.839 13.6418 10.0407C13.7469 9.78536 13.6251 9.49315 13.3698 9.38806C13.1144 9.28296 12.8222 9.40478 12.7171 9.66014C12.4363 10.3425 12.0251 10.9745 11.5013 11.5074C10.5295 12.4963 9.16504 13.15 7.49998 13.15C4.05979 13.15 1.84998 10.3354 1.84998 7.49998Z"
                                                    fill="currentColor" fill-rule="evenodd" clip-rule="evenodd">
                                                </path>
                                            </svg>
                                            <span>VOID</span>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                    {{-- {{ $this->table }} --}}

                </div>
            </div>
        </div>
    @else
        <div class="
                mt-5 rounded-2xl py-10 bg-white grid place-content-center">
            <svg data-name="Layer 1" class="animate-linear-progress" xmlns="http://www.w3.org/2000/svg"
                width="500" height="500" viewBox="0 0 797.5 834.5" xmlns:xlink="http://www.w3.org/1999/xlink">
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
                <path d="M543.2777,521.89228s16.68055,50.91958,2.63377,49.16373-20.19224-43.89619-20.19224-43.89619Z"
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
    @endif



    {{-- PRINTABLE --}}
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
                                    $grade_level = $student->studentInformation->educationalInformation->gradeLevel->id;
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
                                                    $discount = ($value->school_fee->amount * (float) $tui_subd) / 100;
                                                    $total =
                                                        $department == 'SHS'
                                                            ? ($value->school_fee->amount - $discount) / 2
                                                            : $value->school_fee->amount - $discount;
                                                    $soa_tuition = $total;
                                                    break;
                                                case 'Miscellaneous':
                                                    $discount = ($value->school_fee->amount * (float) $misc_subd) / 100;
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
                                            class="text-[0.5rem]">(&#8369;{{ number_format($soa_id, 2) }})</span></td>

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
                            <p class="text-[0.5rem] ">Kindly settle your account for the month <span
                                    class="font-bold uppercase text-red-600">{{ \Carbon\Carbon::parse($due_date)->format('F') ?? '' }}</span>
                                on
                                or before <span
                                    class="font-bold text-red-600 uppercase">{{ \Carbon\Carbon::parse($due_date)->format('m-d-y') ?? '' }}</span>

                                <span class="font-bold  text-[0.5rem] italic">Please disregard this notice if payment
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
    {{-- ///PRINTABLE --}}


    <x-modal wire:model.defer="payment_modal">
        <x-card title="PAYMENTS">
            <div>
                <div>
                    <table id="example" class="table-auto mt-5" style="width:100%">
                        <thead class="font-normal">
                            <tr>
                                <th class="border text-center border-gray-700 px-2 font-bold  py-2">CATEGORY
                                </th>

                                <th class="border text-center border-gray-700 px-2 font-bold  py-2">AMOUNT
                                </th>


                            </tr>
                        </thead>
                        <tbody class="">
                            @if ($payments)
                                @forelse ($payments->paymentTransactions as $item)
                                    <tr>
                                        <td
                                            class="border text-gray-700 uppercase  font-bold text-center border-gray-700 px-3 ">
                                            {{ $item->saleCategory->name }}
                                        </td>

                                        <td
                                            class="border text-gray-700  font-medium text-center border-gray-700 px-3 ">
                                            &#8369;{{ number_format($item->paid_amount, 2) }}
                                        </td>
                                    </tr>

                                @empty
                                @endforelse
                            @endif
                        </tbody>
                    </table>
                    <div class="mt-5 flex justify-end">
                        <h1 class="font-semibold text-gray-600">TOTAL PAYABLES: <span
                                class="text-red-600 text-xl font-poppins">&#8369;{{ number_format($payments ? $payments->paymentTransactions->sum('paid_amount') : 0, 2) }}</span>
                        </h1>

                    </div>
                    <div class="mt-10 flex justify-end">
                        <h1 class="font-semibold underline text-gray-600">BY: <span
                                class="text-red-600 font-poppins">{{ $payments->transactionLog->user_name ?? '' }}</span>
                        </h1>

                    </div>
                </div>

            </div>

            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>
</div>
