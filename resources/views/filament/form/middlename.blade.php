<div class="grid grid-cols-3 gap-5">
    <div class="col-span-2 ">
        <label for="" class="text-sm text-gray-700  font-medium">Middlename</label>
        @if ($this->no_middlename)
            <x-input class="mt-1 h-10" disabled />
        @else
            <x-input class="mt-1 h-10" />
        @endif
    </div>
    <div class="flex items-end">
        <x-checkbox id="right-label" wire:model.live="no_middlename" label="No Middlename" wire:model.defer="model" />
    </div>
</div>
