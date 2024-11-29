<div x-data="{ enroll: $wire.entangle('enroll_modal') }">
    <div class="flex justify-between items-center border-b-2 border-orange-500">
        <div>
            <div class="h-20 w-20 bg-orange-500 rounded-full">
                <img src="{{ asset('images/student.png') }}" class="h-20" alt="">
            </div>
            <div class="mt-2  pb-3">
                <h1 class="uppercase font-bold text-xl text-gray-700">
                    {{ $enrollee->studentInformation->lastname . ', ' . $enrollee->studentInformation->firstname . ' ' . ($enrollee->studentInformation->middlename == null ? '' : $enrollee->studentInformation->middlename[0] . '.') }}
                </h1>
                <div class="flex space-x-1 items-end">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-4 w-4 text-gray-600"
                        fill="currentColor">
                        <path
                            d="M17.0839 15.812C19.6827 13.0691 19.6379 8.73845 16.9497 6.05025C14.2161 3.31658 9.78392 3.31658 7.05025 6.05025C4.36205 8.73845 4.31734 13.0691 6.91612 15.812C7.97763 14.1228 9.8577 13 12 13C14.1423 13 16.0224 14.1228 17.0839 15.812ZM12 23.7279L5.63604 17.364C2.12132 13.8492 2.12132 8.15076 5.63604 4.63604C9.15076 1.12132 14.8492 1.12132 18.364 4.63604C21.8787 8.15076 21.8787 13.8492 18.364 17.364L12 23.7279ZM12 12C10.3431 12 9 10.6569 9 9C9 7.34315 10.3431 6 12 6C13.6569 6 15 7.34315 15 9C15 10.6569 13.6569 12 12 12Z">
                        </path>
                    </svg>
                    <h1 class="leading-3 uppercase text-gray-600 text-sm">
                        {{ $enrollee->studentInformation->studentAddress->barangay . ', ' . $enrollee->studentInformation->studentAddress->city . ', ' . $enrollee->studentInformation->studentAddress->province }}
                    </h1>
                </div>
            </div>
        </div>
        <div>
            <h1 class="uppercase font-bold text-gray-600">Active Semester</h1>
            <h1 class="text-center text-2xl font-semibold text-orange-500">2ND SEM</h1>
            <div class="flex flex-col space-y-1 text-gray-700 items-center">
                <h1 class="text-sm font-medium underline">From Private(77.7778%)</h1>
                <h1 class="text-sm font-medium underline">From Public(97.2222%)</span>
                    <h1 class="text-sm font-medium underline">From StateU(97.2222%)</span>
            </div>
        </div>
    </div>
    <div class="mt-5 grid grid-cols-2 gap-5">
        <div class="">
            <div>
                <div class="bg-gray-200 p-2 rounded-t-xl flex space-x-2 items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5 text-gray-500"
                        fill="currentColor">
                        <path
                            d="M3 6H21V18H3V6ZM2 4C1.44772 4 1 4.44772 1 5V19C1 19.5523 1.44772 20 2 20H22C22.5523 20 23 19.5523 23 19V5C23 4.44772 22.5523 4 22 4H2ZM13 8H19V10H13V8ZM18 12H13V14H18V12ZM10.5 10C10.5 11.3807 9.38071 12.5 8 12.5C6.61929 12.5 5.5 11.3807 5.5 10C5.5 8.61929 6.61929 7.5 8 7.5C9.38071 7.5 10.5 8.61929 10.5 10ZM8 13.5C6.067 13.5 4.5 15.067 4.5 17H11.5C11.5 15.067 9.933 13.5 8 13.5Z">
                        </path>
                    </svg>
                    <h1 class="font-semibold font-poppins text-orange-500">ENROLLEE INFORMATION</h1>
                </div>
                <div class="border-x border-b grid grid-cols-3 gap-5 rounded-b-xl p-2 py-3">
                    <x-input label="ID Number" placeholder="" />
                    <div class="col-span-2">
                        <x-input label="Learner Reference Number (LRN) " wire:model="lrn" placeholder="" />
                    </div>
                    <x-native-select label="Grade Level" wire:model.live="grade_level">
                        <option>Select an Option</option>
                        @foreach ($levels as $level)
                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                        @endforeach
                    </x-native-select>
                    <x-native-select label="School Year" wire:model="school_year">
                        <option>Select an Option</option>
                        @foreach ($years as $year)
                            <option value="{{ $year->id }}">{{ $year->year }}</option>
                        @endforeach

                    </x-native-select>
                    @if ($department == 'SHS')
                        <x-native-select label="Strand" wire:model="strand_id">
                            <option>Select an Option</option>
                            @foreach ($strands as $strand)
                                <option value="{{ $strand->id }}">{{ $strand->name }}</option>
                            @endforeach
                        </x-native-select>
                    @endif
                </div>
            </div>
        </div>
        <div>
            <div>
                <div class=" grid grid-cols-3 gap-5 rounded-b-xl p-2 py-3">
                    <x-input label="Tuition Discount" placeholder="" suffix="%" wire:model.live="tuition_sub" />
                    <x-input label="Miscellaneous Discount" placeholder="" suffix="%" wire:model.live="misc_sub" />
                    <x-native-select label="Discount" wire:model.live="discount">
                        <option>Select an Option</option>
                        <option>JHS-ESC</option>
                        <option>SHS-VP</option>
                        <option>Rockfort Scholarhip</option>
                    </x-native-select>
                </div>
                <div class="bg-gray-200 p-2 rounded-t-xl flex space-x-2 items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5 text-gray-500"
                        fill="currentColor">
                        <path
                            d="M3 6H21V18H3V6ZM2 4C1.44772 4 1 4.44772 1 5V19C1 19.5523 1.44772 20 2 20H22C22.5523 20 23 19.5523 23 19V5C23 4.44772 22.5523 4 22 4H2ZM13 8H19V10H13V8ZM18 12H13V14H18V12ZM10.5 10C10.5 11.3807 9.38071 12.5 8 12.5C6.61929 12.5 5.5 11.3807 5.5 10C5.5 8.61929 6.61929 7.5 8 7.5C9.38071 7.5 10.5 8.61929 10.5 10ZM8 13.5C6.067 13.5 4.5 15.067 4.5 17H11.5C11.5 15.067 9.933 13.5 8 13.5Z">
                        </path>
                    </svg>
                    <h1 class="font-semibold font-poppins text-orange-500">STUDENT PAYMENTS</h1>
                </div>
                <div class="border-x border-b p-2 py-3">
                    @php
                        $total_amount = 0;
                        $tuition = 0;
                        $misc = 0;
                        $books = 0;
                        $dental = 0;
                        $school_id = 0;
                    @endphp

                    @foreach ($default_payments as $item)
                        <li class="flex text-sm justify-between border-b items-center">
                            <span>{{ $item->school_fee->name ?? '' }}</span>
                            <span>
                                @php
                                    $total = 0;
                                    if (!empty($item->school_fee->name)) {
                                        switch ($item->school_fee->name) {
                                            case 'Tuition':
                                                $discount =
                                                    (($department == 'K-10'
                                                        ? $item->school_fee->amount
                                                        : $item->school_fee->amount / 2) *
                                                        (float) ($tuition_sub ?? 0)) /
                                                    100;
                                                $total =
                                                    ($department == 'K-10'
                                                        ? $item->school_fee->amount
                                                        : $item->school_fee->amount / 2) - $discount;
                                                $tuition += $total;
                                                break;
                                            case 'Miscellaneous':
                                                $feeAmount =
                                                    $department == 'K-10'
                                                        ? $item->school_fee->amount
                                                        : $item->school_fee->amount / 2;
                                                $discount = ($feeAmount * (float) ($misc_sub ?? 0)) / 100;
                                                $total = $feeAmount - $discount;
                                                $misc += $total;
                                                break;
                                            case 'Medical/Dental':
                                                $total = 0;
                                                $dental += $total;
                                                break;
                                            case 'Developmental Fee':
                                                $total = 0;
                                                $dental += $total;
                                                break;
                                            case 'School ID':
                                                $total = 0;
                                                $school_id += $total;
                                                break;
                                            case 'Books':
                                                $total = 0;
                                                $school_id += $total;
                                                break;
                                            default:
                                                $total = $item->school_fee->amount;
                                                break;
                                        }
                                        $total_amount += $total;
                                    }
                                @endphp
                                &#8369;{{ number_format($total, 2) }}
                            </span>
                        </li>
                    @endforeach
                    <li class="flex text-sm justify-between border-b items-center">
                        <span></span>
                        <span class="font-bold text-red-600">
                            TOTAL: &#8369;{{ number_format($total_amount, 2) }}
                        </span>
                    </li>
                </div>

                <div class="bg-gray-200 p-2 flex space-x-2 items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5 text-gray-500"
                        fill="currentColor">
                        <path
                            d="M3 6H21V18H3V6ZM2 4C1.44772 4 1 4.44772 1 5V19C1 19.5523 1.44772 20 2 20H22C22.5523 20 23 19.5523 23 19V5C23 4.44772 22.5523 4 22 4H2ZM13 8H19V10H13V8ZM18 12H13V14H18V12ZM10.5 10C10.5 11.3807 9.38071 12.5 8 12.5C6.61929 12.5 5.5 11.3807 5.5 10C5.5 8.61929 6.61929 7.5 8 7.5C9.38071 7.5 10.5 8.61929 10.5 10ZM8 13.5C6.067 13.5 4.5 15.067 4.5 17H11.5C11.5 15.067 9.933 13.5 8 13.5Z">
                        </path>
                    </svg>
                    <h1 class="font-semibold font-poppins text-orange-500">REQUIRED DOWNPAYMENTS
                    </h1>
                </div>

                <div class="border-x border-b rounded-b-xl p-2 py-3">
                    @php
                        $total_amounts = 0;
                    @endphp

                    @foreach ($payments as $item)
                        <li class="flex text-sm justify-between border-b items-center">
                            <span>{{ $item->school_fee->name ?? 'sds' }}</span>
                            <span>
                                @php
                                    if (!empty($item->school_fee->name)) {
                                        $total = 0;
                                        switch ($item->school_fee->name) {
                                            case 'Books':
                                                $total = 0;
                                                break;
                                            default:
                                                $total = $item->school_fee->amount;
                                                break;
                                        }
                                        $total_amounts += $total;
                                    }
                                @endphp
                                @if ($item->school_fee->name == 'Books')
                                    <div class="py-1 w-56">
                                        <x-input class="h-8 text-right" type="number" wire:model.live="book_dp" />
                                    </div>
                                @else
                                    &#8369;{{ number_format($total, 2) }}
                                @endif
                            </span>
                        </li>
                    @endforeach
                    <li class="flex text-sm justify-between border-b items-center">
                        <span></span>
                        <span class="font-bold text-red-600">
                            TOTAL DOWNPAYMENT: &#8369;{{ number_format($total_amounts + (float) ($book_dp ?? 0), 2) }}
                        </span>
                    </li>
                </div>

            </div>
        </div>
    </div>
    <div class="mt-5 flex justify-between items-center">
        <x-button label="Cancel" class="font-semibold" negative icon="arrow-left" />
        <x-button label="ENROLL STUDENT" class="font-semibold"
            wire:click="enrollStudent({{ $total_amount }}, {{ $total_amounts + (float) ($book_dp ?? 0) }},{{ $tuition }}, {{ $misc }})"
            positive right-icon="academic-cap" />
    </div>

    <div x-show="enroll" class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <!--
          Background backdrop, show/hide based on modal state.

          Entering: "ease-out duration-300"
            From: "opacity-0"
            To: "opacity-100"
          Leaving: "ease-in duration-200"
            From: "opacity-100"
            To: "opacity-0"
        -->
        <div x-show="enroll" x-cloak x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

        <div class="fixed inset-0 z-50 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <!--
              Modal panel, show/hide based on modal state.

              Entering: "ease-out duration-300"
                From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                To: "opacity-100 translate-y-0 sm:scale-100"
              Leaving: "ease-in duration-200"
                From: "opacity-100 translate-y-0 sm:scale-100"
                To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            -->
                <div x-show="enroll" x-cloak x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="relative transform overflow-hidden rounded-xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-3xl">
                    <div class="bg-white relative">
                        <div class="h-10 w-full relative bg-orange-500 overflow-hidden rounded-b-2xl shadow-lg">
                            <img src="{{ asset('images/reii_bg.jpg') }}"
                                class="absolute object-cover opacity-50 h-full w-full" alt="">
                        </div>
                        <div class="div flex items-end space-x-3 p-5 justify-start">

                            <div>
                                <h1 class="font-semibold text-gray-600">TOTAL PAYABLES: <span
                                        class="text-red-600 text-xl font-poppins">&#8369;{{ number_format($total_payables, 2) }}</span>
                                </h1>
                                <h1 class="font-semibold text-gray-600">TOTAL DOWNPAYMENT: <span
                                        class="text-red-600 text-xl font-poppins">&#8369;{{ number_format($total_downpayment, 2) }}</span>
                                </h1>
                            </div>
                        </div>
                        <div class="p-5">
                            {{ $this->form }}
                        </div>
                    </div>
                    <div class="bg-gray-100 px-4 py-3 flex justify-between items-center">
                        <x-button label="Cancel" negative flat />
                        <x-button label="Submit to Enroll" right-icon="arrow-right" positive
                            wire:click="submitEnroll" spinner="submitEnroll" />


                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
