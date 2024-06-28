<div>
    <div class="flex justify-end text-red-600 font-medium">
        @if ($this->cash_receive)
            @if ($this->remaining_cash > 0)
                <span>Cash Change: &#8369;{{ number_format($this->cash_change, 2) }}</span>
            @endif
        @endif
    </div>

    <div class="flex mt-5 justify-end text-red-600 font-medium">
        @if ($this->tuition)
            @if ($this->remaining_cash > 0)
                <span>Remaining Cash: &#8369;{{ number_format($this->remaining_cash, 2) }}</span>
            @endif
        @endif
    </div>
</div>
