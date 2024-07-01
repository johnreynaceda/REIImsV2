<x-teacher-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl uppercase text-gray-800 leading-tight">
            {{ __('Record') }}
        </h2>
    </x-slot>
    <div class="relative">
        <livewire:teacher.record-student />
    </div>
    <script>
        function printOut(data) {
            var mywindow = window.open('', '', 'height=1000,width=1000');
            mywindow.document.head.innerHTML =
                '<title></title><link rel="stylesheet" href="{{ Vite::asset('resources/css/app.css') }}" />';
            mywindow.document.body.innerHTML = '<div>' + data +
                '</div><script src="{{ Vite::asset('resources/js/app.js') }}"/>';

            mywindow.document.close();
            mywindow.focus(); // necessary for IE >= 10
            setTimeout(() => {
                mywindow.print();
                return true;
            }, 1000);
        }
    </script>
</x-teacher-layout>
