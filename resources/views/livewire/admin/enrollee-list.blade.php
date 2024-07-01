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

    <x-modal wire:model.defer="record_modal" max-width="4xl">
        <x-card title="Edit Records">
            <div class="space-y-4">
                <div class="border rounded-xl px-5 py-5">
                    <h1 class="font-bold  text-xl">STUDENT INFORMATION</h1>
                    <div class="mt-5 grid grid-cols-3 gap-4">
                        <x-input label="Firstname" wire:model.live="fname" />
                        <x-input label="Middlename" wire:model.live="mname" />
                        <x-input label="Lastname" wire:model.live="lname" />
                        <x-input label="Suffix" wire:model.live="suffix" />
                        <x-datetime-picker without-time without-timezone label="Date of Birth" wire:model.live="dob" />
                        <x-input label="Gender" wire:model.live="gender" />
                        <x-input label="Age" wire:model.live="age" />
                        <x-input label="Email" wire:model.live="email" />
                    </div>
                    <div class="flex mt-3 justify-end">
                        <x-button dark icon="save" label="Save" wire:click="saveStudentInfo"
                            spinner="saveStudentInfo" />
                    </div>
                </div>
                <div class="border rounded-xl px-5 py-5">
                    <h1 class="font-bold uppercase  text-xl"> Guardian information</h1>
                    <div>
                        <h1 class="font-bold mt-5 uppercase  text-lg"> Father Information</h1>
                        <div class=" grid grid-cols-3 gap-4">
                            <x-input label="Firstname" wire:model.live="father_fname" />
                            <x-input label="Middlename" wire:model.live="father_mname" />
                            <x-input label="Lastname" wire:model.live="father_lname" />
                            <x-input label="occupation" wire:model.live="father_occupation" />
                            <x-input label="Contact" wire:model.live="father_contact" />
                        </div>
                    </div>
                    <div>
                        <h1 class="font-bold mt-5 uppercase  text-lg"> Mother Information</h1>
                        <div class=" grid grid-cols-3 gap-4">
                            <x-input label="Firstname" wire:model.live="mother_fname" />
                            <x-input label="Middlename" wire:model.live="mother_mname" />
                            <x-input label="Lastname" wire:model.live="mother_lname" />
                            <x-input label="occupation" wire:model.live="mother_occupation" />
                            <x-input label="Contact" wire:model.live="mother_contact" />
                        </div>
                    </div>
                    <div class="flex mt-3 justify-end">
                        <x-button dark icon="save" label="Save" wire:click="saveGuardianInfo"
                            spinner="saveGuardianInfo" />
                    </div>
                </div>

                <div class="border rounded-xl px-5 py-5">
                    <h1 class="font-bold  text-xl">ADDRESS INFORMATION</h1>
                    <div class="mt-5 grid grid-cols-3 gap-4">
                        <x-input label="Province" wire:model.live="province" />
                        <x-input label="Municipality/City" wire:model.live="municipality" />
                        <x-input label="Barangay" wire:model.live="barangay" />
                        <x-input label="Street" wire:model.live="street" />

                    </div>
                    <div class="flex mt-3 justify-end">
                        <x-button dark icon="save" label="Save" wire:click="saveAddressInfo"
                            spinner="saveAddressInfo" />
                    </div>
                </div>
                <div class="border rounded-xl px-5 py-5">
                    <h1 class="font-bold  text-xl">MEDICAL INFORMATION</h1>
                    <div class="mt-5 grid grid-cols-3 gap-4">
                        <x-input label="PHIC NO." wire:model.live="phic_number" />
                        <x-input label="Vaccination Status" wire:model.live="vaccine_status" />
                        <x-datetime-picker label="Vaccination Date" without-time without-timezone
                            wire:model.live="vaccine_date" />
                        <x-input label="Vaccine Name" wire:model.live="vaccine_name" />

                    </div>
                    <div class="flex mt-3 justify-end">
                        <x-button dark icon="save" label="Save" wire:click="saveMedicalInfo"
                            spinner="saveMedicalInfo" />
                    </div>
                </div>
                <div class="border rounded-xl px-5 py-5">
                    <h1 class="font-bold  text-xl">Educational INFORMATION</h1>
                    <div class="mt-5 grid grid-cols-3 gap-4">
                        <x-input label="Learners Reference Number(LRN)" wire:model.live="lrn" />
                        <x-native-select label="Select Grade Level" wire:model.live="grade_level_id">
                            <option>Select An Option</option>
                            @foreach ($grade_level as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </x-native-select>
                        <x-native-select label="Select Grade Level" wire:model.live="student_type">
                            <option>Select An Option</option>
                            <option>NEW</option>
                            <option>OLD</option>

                        </x-native-select>

                    </div>
                    <div class="flex mt-3 justify-end">
                        <x-button dark icon="save" label="Save" wire:click="saveEducationalInfo"
                            spinner="saveEducationalInfo" />
                    </div>
                </div>
            </div>

        </x-card>
    </x-modal>
</div>
