<div class="border-t-2 p-1 pt-3 ">
    <div class="mt-5 grid grid-cols-1 gap-3 w-64">
        <x-input label="OR Number:" wire:model.live="or_number" type="number" />
        <x-input label="Cash Receive" wire:model.live="cash_receive" prefix="₱" type="number" />
    </div>
    <div class="mt-5  text-red-600 font-bold flex justify-between items-end">
        <div>
            <span class="text-xl">
                @php
                    $total = 0;
                    foreach ($this->payments as $key => $item) {
                        $total += (float) $item['amount'];
                    }
                @endphp
                TOTAL: &#8369;{{ number_format($total, 2) }}

            </span>
            <h1 class="text-sm font-medium">
                @php
                    $change = (float) $this->cash_receive - $total;
                @endphp
                Change: &#8369;{{ number_format($change, 2) }}
            </h1>
        </div>
        <x-button label="Proceed Payment" spinner="proceedPayment" wire:click="payment({{ $total }})"
            right-icon="cash" dark />
    </div>
</div>
