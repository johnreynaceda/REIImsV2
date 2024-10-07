<div x-data="{ successModalIsOpen: @entangle('receipt_modal') }">
    <x-button label="Add Payment" slate wire:click="$set('payment_modal', true)" rounded class="font-semibold"
        icon="cash" />

    <x-modal wire:model.defer="payment_modal" z-index="40" align="center" max-width="2xl">
        <x-card title="PAYMENT TRANSACTION">
            <div>
                {{ $this->form }}
            </div>


        </x-card>
    </x-modal>

    <!-- success Modal -->
    <div>

        <div x-cloak x-show="successModalIsOpen" x-transition.opacity.duration.200ms
            x-trap.inert.noscroll="successModalIsOpen" @keydown.esc.window="successModalIsOpen = false"
            @click.self="successModalIsOpen = false"
            class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8"
            role="dialog" aria-modal="true" aria-labelledby="successModalTitle">
            <!-- Modal Dialog -->
            <div x-show="successModalIsOpen"
                x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
                x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100"
                class="flex max-w-2xl flex-col gap-4 overflow-hidden rounded-2xl border border-slate-300 bg-white text-slate-700 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300">
                <!-- Dialog Header -->
                <div
                    class="flex items-center justify-between border-b border-slate-300 bg-slate-100/60 px-4 py-1 dark:border-slate-700 dark:bg-slate-900/20">
                    <div class="flex items-center justify-center rounded-full bg-green-600/20 text-green-600 p-1">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-6"
                            aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <a href="{{ route('admin.soa') }}" aria-label="close modal">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"
                            stroke="currentColor" fill="none" stroke-width="1.4" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </a>
                </div>
                <!-- Dialog Body -->
                <div class="text-center w-[40rem] px-4">
                    <div>
                        <div>
                            <div class="flex justify-end ">
                                <span>{{ now()->format('m-d') }}</span>
                                <span class="ml-10">{{ now()->format('y') }}</span>
                            </div>
                            <div class="grid grid-cols-4 w-full">
                                <div class="col-span-2 text-left ">{{ $student_name }}</div>
                                <div class=""></div>
                                <div class="">
                                    {{ str_replace('Grade', '', $student->studentInformation->educationalInformation->gradeLevel->name) }}
                                </div>
                            </div>
                            <table id="example" class="table-auto" style="width:100%">
                                <thead class="font-normal">
                                    <tr>
                                        <th class="text-center text-xs text-transparent border-gray-600 ">CATEGORY
                                        </th>

                                        <th class="text-center text-xs text-transparent border-gray-600 ">AMOUNT
                                        </th>


                                    </tr>
                                </thead>
                                <tbody class="">
                                    @php
                                        $default = 8;
                                        $sortedPayments = collect($payments)
                                            ->map(function ($item) {
                                                $item['amount'] = (float) $item['amount']; // Ensure 'amount' is a float
                                                return $item;
                                            })
                                            ->sortBy('category')
                                            ->values();
                                        $count = $sortedPayments->count();
                                        $remainingRows = $default - $count; // Calculate how many rows are left to fill
                                        $totalAmount = $sortedPayments->sum('amount'); // Calculate total amount
                                    @endphp

                                    @foreach ($sortedPayments as $item)
                                        <tr>
                                            <td
                                                class="text-gray-700 uppercase  text-transparent text-left border-gray-600 px-3 py-1">
                                                sdsdsd
                                            </td>
                                            <td class="text-gray-700 text-right border-gray-600 px-3 py-1">
                                                {{ number_format($item['amount'], 2) }}
                                            </td>
                                        </tr>
                                    @endforeach

                                    @if ($remainingRows > 0)
                                        @for ($i = 0; $i < $remainingRows; $i++)
                                            <tr>
                                                <td
                                                    class="text-gray-700 uppercase text-transparent text-left border-gray-600 px-3 py-1">
                                                    <!-- Empty row -->
                                                </td>
                                                <td class="text-gray-700 text-right border-gray-600 px-3 py-1">
                                                    <!-- Empty row -->
                                                </td>
                                            </tr>
                                        @endfor
                                    @endif

                                    <tr>
                                        <td
                                            class="text-gray-700 font-bold text-transparent text-left border-gray-600 px-3 py-1">
                                            Total
                                        </td>
                                        <td class="text-gray-700 font-bold text-right border-gray-600 px-3 py-1">
                                            {{ number_format($totalAmount, 2) }}
                                        </td>
                                    </tr>


                                </tbody>
                            </table>
                        </div>

                        <div class="hidden">
                            <div x-ref="printContainer" class="w-6/12">
                                <div class="flex justify-end ">
                                    <span>{{ now()->format('m-d') }}</span>
                                    <span class="ml-10">{{ now()->format('y') }}</span>
                                </div>
                                <div class="grid grid-cols-4 w-full">
                                    <div class="col-span-2 text-left ">{{ $student_name }}</div>
                                    <div class=""></div>
                                    <div class="">
                                        {{ str_replace('Grade', '', $student->studentInformation->educationalInformation->gradeLevel->name) }}
                                    </div>
                                </div>
                                <table id="example" class="table-auto" style="width:100%">
                                    <thead class="font-normal">
                                        <tr>
                                            <th class="text-center text-xs text-transparent border-gray-600 ">CATEGORY
                                            </th>

                                            <th class="text-center text-xs text-transparent border-gray-600 ">AMOUNT
                                            </th>


                                        </tr>
                                    </thead>
                                    <tbody class="">
                                        @php
                                            $default = 8;
                                            $sortedPayments = collect($payments)
                                                ->map(function ($item) {
                                                    $item['amount'] = (float) $item['amount']; // Ensure 'amount' is a float
                                                    return $item;
                                                })
                                                ->sortBy('category')
                                                ->values();
                                            $count = $sortedPayments->count();
                                            $remainingRows = $default - $count; // Calculate how many rows are left to fill
                                            $totalAmount = $sortedPayments->sum('amount'); // Calculate total amount
                                        @endphp

                                        @foreach ($sortedPayments as $item)
                                            <tr>
                                                <td
                                                    class="text-gray-700 uppercase  text-transparent text-left border-gray-600 px-3 py-1">
                                                    sdsdsd
                                                </td>
                                                <td class="text-gray-700 text-right border-gray-600 px-3 py-1">
                                                    {{ number_format($item['amount'], 2) }}
                                                </td>
                                            </tr>
                                        @endforeach

                                        @if ($remainingRows > 0)
                                            @for ($i = 0; $i < $remainingRows; $i++)
                                                <tr>
                                                    <td
                                                        class="text-gray-700 uppercase text-transparent text-left border-gray-600 px-3 py-1">
                                                        <!-- Empty row -->
                                                    </td>
                                                    <td class="text-gray-700 text-right border-gray-600 px-3 py-1">
                                                        <!-- Empty row -->
                                                    </td>
                                                </tr>
                                            @endfor
                                        @endif

                                        <tr>
                                            <td
                                                class="text-gray-700 font-bold text-transparent text-left border-gray-600 px-3 py-1">
                                                Total
                                            </td>
                                            <td class="text-gray-700 font-bold text-right border-gray-600 px-3 py-1">
                                                {{ number_format($totalAmount, 2) }}
                                            </td>
                                        </tr>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Dialog Footer -->
                        <div class="flex items-center justify-center border-slate-300 p-4 dark:border-slate-700">
                            <button type="button" @click="printOut($refs.printContainer.outerHTML);"
                                class="w-full cursor-pointer whitespace-nowrap rounded-2xl bg-orange-600 px-4 py-1 text-center text-sm font-semibold tracking-wide text-white transition hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600 active:opacity-100 active:outline-offset-0">
                                <span>Print Receipt</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>




    </div>
</div>
