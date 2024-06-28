<div>
    @if (auth()->user()->role_id == 1)
        <div class="w-72">
            {{ $this->form }}
        </div>
    @endif
    @if ($type == 1)
        <div class="mt-5">
            {{ $this->table }}
        </div>
    @else
        <div class="mt-5">
            <livewire:shs-enrollee />
        </div>
    @endif

</div>
