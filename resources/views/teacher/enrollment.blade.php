<x-teacher-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl uppercase text-gray-800 leading-tight">
            {{ __('Add Student') }}
        </h2>
    </x-slot>
    <div class="relative">
        <livewire:admin.enrollee.new-enrollee />
    </div>
</x-teacher-layout>
