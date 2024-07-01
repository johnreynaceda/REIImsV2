<div>
    <div class="border rounded-xl px-5 py-5">
        <h1 class="font-bold  text-xl">STUDENT INFORMATION</h1>
        <div class="mt-5 grid grid-cols-3 gap-4">
            <x-input label="Firstname" wire:model="fname" />
            <x-input label="Middlename" wire:model="" />
            <x-input label="Lastname" wire:model="" />
            <x-input label="Suffix" wire:model="" />
            <x-datetime-picker without-time without-timezone label="Date of Birth" wire:model="" />
            <x-input label="Gender" wire:model="" />
            <x-input label="Age" wire:model="" />
            <x-input label="Email" wire:model="" />
        </div>

    </div>
</div>
