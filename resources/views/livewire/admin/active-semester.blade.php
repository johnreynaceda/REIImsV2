<div>
    <div class="border w-96 bg-white p-5 flex py-10 flex-col items-center rounded-2xl shadow-xl">
        <div>
            Active Semester
        </div>
        <div class="text-2xl mt-5 font-bold uppercase underline text-orange-500 ">
            {{ $active }}
        </div>
    </div>
    <div class="mt-5 w-96">
        <x-native-select label="Active Semester" wire:model.live="active">
            <option>Select an Option</option>
            <option>1st Semester</option>
            <option>2nd Semester</option>
        </x-native-select>
    </div>

    <div class="mt-10">
        <h1 class="text-2xl font-bold text-orange-500">PAYMENT TERMS</h1>
        <div class="w-96 mt-5">
            {{ $this->table }}
        </div>
    </div>
</div>
