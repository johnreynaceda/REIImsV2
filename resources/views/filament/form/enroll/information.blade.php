<div>
    <div class="h-20 w-20 bg-orange-500 rounded-full">
        <img src="{{ asset('images/student.png') }}" class="h-20" alt="">
    </div>
    <div class="mt-2">
        <h1 class="uppercase font-bold text-xl text-gray-700">
            {{ $getRecord()->studentInformation->lastname . ', ' . $getRecord()->studentInformation->firstname . ' ' . $getRecord()->studentInformation->middlename[0] . '.' }}
        </h1>
        <h1 class="leading-3 uppercase text-gray-600 text-sm">
            {{ $getRecord()->studentInformation->studentAddress->barangay . ', ' . $getRecord()->studentInformation->studentAddress->city . ', ' . $getRecord()->studentInformation->studentAddress->province }}
        </h1>
    </div>
</div>
