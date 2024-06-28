<x-teacher-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl uppercase text-gray-800 leading-tight">
            {{ __('Prelisting') }}
        </h2>
    </x-slot>
    <div class="relative">
        <livewire:admin.enrollee-list />
    </div>
</x-teacher-layout>
