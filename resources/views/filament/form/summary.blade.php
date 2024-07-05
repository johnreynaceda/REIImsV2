<div>
    <div class="p-2 bg-blue-600/80 px-4 uppercase font-bold text-white rounded-xl">
        PERSONAL INFORMATION
    </div>
    <div class="mx-2">
        <div class="grid grid-cols-4 gap-5 border-l border-r border-b p-6  w-full">
            <div>
                <h1 class="uppercase text-xs">Firstname</h1>
                <h1 class="uppercase text-md">{{ $this->firstname ?? 'Null' }}</h1>
            </div>
            <div>
                <h1 class="uppercase text-xs">Middlename</h1>
                <h1 class="uppercase text-md">{{ $this->middlename ?? 'Null' }}</h1>
            </div>
            <div>
                <h1 class="uppercase text-xs">Lastname</h1>
                <h1 class="uppercase text-md">{{ $this->lastname ?? 'Null' }}</h1>
            </div>
            <div>
                <h1 class="uppercase text-xs">Suffix</h1>
                <h1 class="uppercase text-md">{{ $this->suffix ?? 'Null' }}</h1>
            </div>
            <div>
                <h1 class="uppercase text-xs">Date of Birth</h1>
                <h1 class="uppercase text-md">
                    {{ \Carbon\Carbon::parse($this->date_of_birth)->format('F d, Y') ?? 'Null' }}
                </h1>
            </div>
            <div>
                <h1 class="uppercase text-xs">Gender</h1>
                <h1 class="uppercase text-md">
                    {{ $this->gender ?? 'Null' }}
                </h1>
            </div>
            <div>
                <h1 class="uppercase text-xs">Age</h1>
                <h1 class="uppercase text-md">
                    {{ $this->age ?? 'Null' }}
                </h1>
            </div>
            <div>
                <h1 class="uppercase text-xs">Email</h1>
                <h1 class="uppercase text-md">
                    {{ $this->email ?? 'Null' }}
                </h1>
            </div>
        </div>
    </div>
    <div class="p-2 bg-blue-600/80 px-4 uppercase font-bold text-white rounded-xl">
        PARENTS/GUARDIAN INFORMATION
    </div>
    <div class="mx-2">
        <div class="grid grid-cols-4 gap-5 border-l border-r border-b p-6  w-full">
            <div class="col-span-4 border-b">
                <span class="font-bold text-gray-700">MOTHER INFORMATION</span>
            </div>
            <div>
                <h1 class="uppercase text-xs">Firstname</h1>
                <h1 class="uppercase text-md">{{ $this->mother_firstname ?? 'Null' }}</h1>
            </div>
            <div>
                <h1 class="uppercase text-xs">Middlename</h1>
                <h1 class="uppercase text-md">{{ $this->mother_middlename ?? 'Null' }}</h1>
            </div>
            <div>
                <h1 class="uppercase text-xs">Lastname</h1>
                <h1 class="uppercase text-md">{{ $this->mother_lastname ?? 'Null' }}</h1>
            </div>
            <div>
                <h1 class="uppercase text-xs">Occupation</h1>
                <h1 class="uppercase text-md">{{ $this->mother_occupation ?? 'Null' }}</h1>
            </div>
            <div>
                <h1 class="uppercase text-xs">Contact Number</h1>
                <h1 class="uppercase text-md">
                    {{ $this->mother_contact_number ?? 'Null' }}
                </h1>
            </div>
            <div class="col-span-4 border-b">
                <span class="font-bold text-gray-700">FATHER INFORMATION</span>
            </div>
            <div>
                <h1 class="uppercase text-xs">Firstname</h1>
                <h1 class="uppercase text-md">{{ $this->father_firstname ?? 'Null' }}</h1>
            </div>
            <div>
                <h1 class="uppercase text-xs">Middlename</h1>
                <h1 class="uppercase text-md">{{ $this->father_middlename ?? 'Null' }}</h1>
            </div>
            <div>
                <h1 class="uppercase text-xs">Lastname</h1>
                <h1 class="uppercase text-md">{{ $this->father_lastname ?? 'Null' }}</h1>
            </div>
            <div>
                <h1 class="uppercase text-xs">Occupation</h1>
                <h1 class="uppercase text-md">{{ $this->father_occupation ?? 'Null' }}</h1>
            </div>
            <div>
                <h1 class="uppercase text-xs">Contact Number</h1>
                <h1 class="uppercase text-md">
                    {{ $this->father_contact_number ?? 'Null' }}
                </h1>
            </div>

        </div>
    </div>
    <div class="p-2 bg-blue-600/80 px-4 uppercase font-bold text-white rounded-xl">
        ADDRESS INFORMATION
    </div>
    <div class="mx-2">
        <div class="grid grid-cols-4 gap-5 border-l border-r border-b p-6  w-full">
            <div>
                <h1 class="uppercase text-xs">Province</h1>
                <h1 class="uppercase text-md">{{ $this->add_province ?? 'Null' }}</h1>
            </div>
            <div>
                <h1 class="uppercase text-xs">City/Municipality</h1>
                <h1 class="uppercase text-md">{{ $this->add_city ?? 'Null' }}</h1>
            </div>
            <div>
                <h1 class="uppercase text-xs">Barangay</h1>
                <h1 class="uppercase text-md">{{ $this->add_barangay ?? 'Null' }}</h1>
            </div>
            <div>
                <h1 class="uppercase text-xs">Street</h1>
                <h1 class="uppercase text-md">{{ $this->add_street ?? 'Null' }}</h1>
            </div>

        </div>
    </div>
    <div class="p-2 bg-blue-600/80 px-4 uppercase font-bold text-white rounded-xl">
        MEDICAL INFORMATION
    </div>
    <div class="mx-2">
        <div class="grid grid-cols-4 gap-5 border-l border-r border-b p-6  w-full">
            <div>
                <h1 class="uppercase text-xs">PHIC Number</h1>
                <h1 class="uppercase text-md">{{ $this->phic_number ?? 'Null' }}</h1>
            </div>
            <div>
                <h1 class="uppercase text-xs">Vaccination Status</h1>
                <h1 class="uppercase text-md">{{ $this->vaccination_status ?? 'Null' }}</h1>
            </div>
            <div>
                <h1 class="uppercase text-xs">Vaccination Date</h1>
                <h1 class="uppercase text-md">{{ $this->vaccination_date ?? 'Null' }}</h1>
            </div>
            <div>
                <h1 class="uppercase text-xs">Vaccine Name</h1>
                <h1 class="uppercase text-md">{{ $this->vaccine_name ?? 'Null' }}</h1>
            </div>

        </div>
    </div>
    <div class="p-2 bg-blue-600/80 px-4 uppercase font-bold text-white rounded-xl">
        EDUCATIONAL INFORMATION
    </div>
    <div class="mx-2">
        <div class="grid grid-cols-4 gap-5 border-l border-r border-b p-6  w-full">
            <div>
                <h1 class="uppercase text-xs">Learners Reference Number(LRN)</h1>
                <h1 class="uppercase text-md">{{ $this->lrn ?? 'Null' }}</h1>
            </div>
            <div>
                <h1 class="uppercase text-xs">Grade Level</h1>
                <h1 class="uppercase text-md">
                    {{ \App\Models\GradeLevel::where('id', $this->grade_level)->first()->name ?? 'Null' }}</h1>
            </div>
            <div>
                <h1 class="uppercase text-xs">Student Type</h1>
                <h1 class="uppercase text-md">{{ $this->student_type ?? 'Null' }}</h1>
            </div>
        </div>
    </div>
</div>
