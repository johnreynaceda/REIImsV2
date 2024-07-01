<div x-data>
    <div class="grid grid-cols-3 gap-4">
        <div class="">
            <div class="bg-white rounded-xl ">
                <div class="flex space-x-3 px-5 pt-5 items-center">
                    <img src="{{ asset('images/student.png') }}"
                        class="h-20 w-20 p-1 rounded-full border-2 border-orange-500 shadow-xl" alt="">
                    <div>
                        <h1 class="uppercase text-xl font-bold text-gray-700">
                            {{ $student->lastname . ', ' . $student->firstname . ' ' . ($student->middlename_is_null ? '' : $student->middlename[0] . '.') }}
                        </h1>

                        <h1 class="font-semibold text-gray-600">{{ $student->educationalInformation->gradeLevel->name }}
                        </h1>
                        <h1 class="font-semibold text-gray-600">ID NO: {{ $student->student->id_number }}</h1>
                    </div>
                </div>
                <div class="mt-2 px-6 pb-2 border-b flex space-x-1 items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" class="text-red-600" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-map-pin">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                        <path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z" />
                    </svg>
                    <h1 class="uppercase  text-sm font-medium text-gray-700">
                        {{ $student->studentAddress->barangay . ', ' . $student->studentAddress->city . ', ' . $student->studentAddress->province }}
                    </h1>
                </div>
                <div class="p-5 space-y-2 ">

                    <button
                        class="border w-full flex space-x-2 justify-center text-gray-700 p-2 shadow hover:bg-gray-500 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-info-square">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 9h.01" />
                            <path d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14z" />
                            <path d="M11 12h1v4h1" />
                        </svg>
                        <span class="font-semibold">PERSONAL INFORMATION</span>
                    </button>
                    <button
                        class="border w-full flex space-x-2 justify-center text-gray-700 p-2 shadow hover:bg-gray-500 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-info-square">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 9h.01" />
                            <path d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14z" />
                            <path d="M11 12h1v4h1" />
                        </svg>
                        <span class="font-semibold">PARENT'S INFORMATION</span>
                    </button>
                    <button
                        class="border w-full flex space-x-2 justify-center text-gray-700 p-2 shadow hover:bg-gray-500 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-info-square">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 9h.01" />
                            <path d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14z" />
                            <path d="M11 12h1v4h1" />
                        </svg>
                        <span class="font-semibold">ADDRESS INFORMATION</span>
                    </button>
                    <button
                        class="border w-full flex space-x-2 justify-center text-gray-700 p-2 shadow hover:bg-gray-500 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-info-square">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 9h.01" />
                            <path d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14z" />
                            <path d="M11 12h1v4h1" />
                        </svg>
                        <span class="font-semibold">MEDICAL INFORMATION</span>
                    </button>
                    <button
                        class="border w-full flex space-x-2 justify-center text-gray-700 p-2 shadow hover:bg-gray-500 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-info-square">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 9h.01" />
                            <path d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14z" />
                            <path d="M11 12h1v4h1" />
                        </svg>
                        <span class="font-semibold">EDUCATIONAL INFORMATION</span>
                    </button>
                </div>
            </div>
        </div>
        <div class=" col-span-2 ">
            <div class="rounded-xl bg-white">
                <div class="px-5 py-3 border-b flex justify-end">
                    <x-button label="PRINT FORM" dark icon="printer"
                        @click="printOut($refs.printContainer.outerHTML);" />
                    <div class="s hidden">
                        <div class="" x-ref="printContainer">
                            <div class="flex justify-center items-center">
                                <img src="{{ asset('images/soa-bg.jpg') }}" class="h-16" alt="">
                            </div>
                            <div class="mt-4 text-center font-black  text-lg">
                                ENROLMENT FORM
                            </div>
                            <div class="mt-4 text-center font-bold  ">
                                S.Y.2024-2025
                            </div>
                            <div class="mt-4 text-right flex text-sm justify-end fon-bold  ">
                                <span>DATE(MM/DD/YYYY): </span>
                                <span class="underline">{{ \Carbon\Carbon::now()->format('m/d/Y') }}</span>
                            </div>
                            <div class=" mt-4 text-sm grid grid-cols-2 gap-5 font-bold ">
                                <div class="flex">
                                    <span>LRN:</span>
                                    <span class="border-b border-gray-600 flex-1 pl-1">
                                        {{ $student->educationalInformation->lrn ?? '' }}</span>
                                </div>
                                <div class="flex">
                                    <span>PHIC NUMBER:</span>
                                    <span class="border-b border-gray-600 flex-1 pl-1">
                                        {{ $student->medicalInformation->phic_number ?? '' }}</span>
                                </div>
                            </div>
                            <div class="mt-4">
                                <div class="flex font-bold  text-sm">
                                    <span>NAME OF PUPIL/STUDENT:</span>
                                    <span
                                        class="border-b border-gray-600 uppercase  flex  flex-1  pl-1 justify-between items-start font-bold  text-sm">
                                        <span>{{ $student->lastname ?? '' }}</span>
                                        <span>{{ $student->firstname ?? '' }}</span>
                                        <span>{{ $student->middlename ?? '' }}</span>
                                        <span>{{ $student->suffix ?? '' }}</span>
                                    </span>
                                </div>
                            </div>
                            <div class="mt-2">
                                <div class="flex font-bold  text-xs">
                                    <span class=" text-sm opacity-0">NAME OF PUPIL/STUDENT:</span>
                                    <span class="flex-1 flex justify-between items-start font-bold  text-xs">
                                        <span>(LAST NAME)</span>
                                        <span>(FIRST NAME)</span>
                                        <span>(MIDDLE NAME)</span>
                                        <span>(SUFFIX)</span>
                                    </span>
                                </div>
                            </div>
                            <div class=" mt-4 text-sm grid grid-cols-3 w-full gap-5 font-bold ">
                                <div class="flex col-span-2">
                                    <span class="flex">EMAIL AD.(OF THE CHILD)</span>
                                    <span
                                        class="border-b border-gray-600 flex-1 pl-1">{{ $student->email ?? '' }}</span>
                                </div>
                                <div class="flex">
                                    <span>PASSWORD:</span>
                                    <span class="border-b"></span>
                                </div>
                            </div>
                            <div class=" mt-4 text-sm grid grid-cols-2 gap-5 font-bold ">
                                <div class="flex">
                                    <span>GRADE LEVEL THIS YEAR:</span>
                                    <span
                                        class="border-b uppercase border-gray-600 flex-1 pl-1">{{ $student->educationalInformation->gradeLevel->name ?? '' }}</span>
                                </div>
                                <div class="flex space-x-4  ">
                                    <div>NEW
                                        ({{ ($student->educationalInformation->student_type == 'NEW' ? '/' : '') ?? '' }})
                                    </div>

                                    <div class="ml-5">OLD
                                        ({{ ($student->educationalInformation->student_type == 'OLD' ? '/' : '') ?? '' }})
                                    </div>
                                </div>
                            </div>
                            <div class=" mt-4 text-sm flex w-full justify-between items-center font-bold ">
                                <div class="flex">
                                    <span>DATE OF BIRTH(MM/DD/YYYY)</span>
                                    <span
                                        class="border-b uppercase border-gray-600 flex flex-1 w-full pl-1">{{ \Carbon\Carbon::parse($student->birthdate)->format('F, d Y') ?? '' }}</span>
                                </div>
                                <div class="flex">
                                    <span>AGE:</span>
                                    <span
                                        class="border-b uppercase border-gray-600 flex flex-1 pl-1">{{ $student->age ?? '' }}</span>
                                </div>
                                <div class="flex uppercase  pl-1 space-x-4">
                                    <div>MALE ({{ ($student->gender == 'Male' ? '/' : '') ?? '' }})</div>
                                    <div class="ml-5">FEMALE ({{ ($student->gender == 'Female' ? '/' : '') ?? '' }})
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 flex font-bold  text-sm">
                                <span>ADDRESS:</span>
                                <span
                                    class="border-b uppercase border-gray-600 flex flex-1 w-full pl-1">{{ $student->studentAddress->barangay ?? '' }}
                                    {{ $student->studentAddress->city ?? '' }},
                                    {{ $student->studentAddress->province ?? '' }}</span>
                            </div>
                            <div class="mt-4 flex space-x-2 font-bold  text-sm">
                                <span>VACCINATION STATUS:</span>
                                <span class="flex flex-1 text-xs font-sans justify-between items-center">
                                    <span>()NONE</span>
                                    <div class="flex">
                                        <span>DATE:</span>
                                        <span></span>
                                        <span>()1ST DOSE</span>
                                    </div>
                                    <div class="flex">
                                        <span>DATE:</span>
                                        <span></span>
                                        <span>()COMPLETED 2 DOSES</span>
                                    </div>
                                    <div class="flex">
                                        <span>DATE:</span>
                                        <span></span>
                                        <span>()WITH BOOSTER</span>
                                    </div>
                                </span>
                            </div>
                            <div class="mt-4">
                                <div class="flex font-bold  text-sm">
                                    <span>NAME OF MOTHER:</span>
                                    <span
                                        class="border-b border-gray-600 uppercase  flex  flex-1 pl-1  justify-between items-start font-bold  text-sm">
                                        <div>
                                            {{ \App\Models\StudentGuardian::where('student_information_id', $student->id)->where('relationship', 'Mother')->first()->lastname ?? '' }}
                                        </div>
                                        <div>
                                            {{ \App\Models\StudentGuardian::where('student_information_id', $student->id)->where('relationship', 'Mother')->first()->firstname ?? '' }}
                                        </div>
                                        <div>
                                            {{ \App\Models\StudentGuardian::where('student_information_id', $student->id)->where('relationship', 'Mother')->first()->middlename ?? '' }}
                                        </div>
                                        <div>
                                            {{ \App\Models\StudentGuardian::where('student_information_id', $student->id)->where('relationship', 'Mother')->first()->suffix ?? '' }}
                                        </div>
                                    </span>
                                </div>
                            </div>
                            <div class="mt-2">
                                <div class="flex font-bold  text-xs">
                                    <span class="text-opacity-0 text-sm w-36"></span>
                                    <span class="flex-1 flex justify-between items-start font-bold  text-xs">
                                        <span>(LAST NAME)</span>
                                        <span>(FIRST NAME)</span>
                                        <span>(MIDDLE NAME)</span>
                                        <span>(SUFFIX)</span>
                                    </span>
                                </div>
                            </div>
                            <div class=" mt-4 text-sm grid grid-cols-2 gap-5 font-bold ">
                                <div class="flex">
                                    <span>OCCUPATION:</span>
                                    <span
                                        class="border-b border-gray-600 flex-1 pl-1">{{ \App\Models\StudentGuardian::where('student_information_id', $student->id)->where('relationship', 'Mother')->first()->occupation ?? '' }}</span>
                                </div>
                                <div class="flex">
                                    <span>CONTACT NO.:</span>
                                    <span
                                        class="border-b border-gray-600 flex-1 pl-1">{{ \App\Models\StudentGuardian::where('student_information_id', $student->id)->where('relationship', 'Mother')->first()->contact ?? '' }}</span>
                                </div>
                            </div>
                            <div class="mt-4">
                                <div class="flex font-bold  text-sm">
                                    <span>NAME OF FATHER:</span>
                                    <span
                                        class="border-b border-gray-600 uppercase  flex  flex-1 pl-1 justify-between items-start font-bold  text-sm">
                                        <span>{{ \App\Models\StudentGuardian::where('student_information_id', $student->id)->where('relationship', 'Father')->first()->lastname ?? '' }}</span>
                                        <span>{{ \App\Models\StudentGuardian::where('student_information_id', $student->id)->where('relationship', 'Father')->first()->firstname ?? '' }}</span>
                                        <span>{{ \App\Models\StudentGuardian::where('student_information_id', $student->id)->where('relationship', 'Father')->first()->middlename ?? '' }}</span>
                                        <span>{{ \App\Models\StudentGuardian::where('student_information_id', $student->id)->where('relationship', 'Father')->first()->suffix ?? '' }}</span>
                                    </span>
                                </div>
                            </div>
                            <div class="mt-2">
                                <div class="flex font-bold  text-xs">
                                    <span class="text-opacity-0 text-sm w-36"></span>
                                    <span class="flex-1 flex justify-between items-start font-bold  text-xs">
                                        <span>(LAST NAME)</span>
                                        <span>(FIRST NAME)</span>
                                        <span>(MIDDLE NAME)</span>
                                        <span>(SUFFIX)</span>
                                    </span>
                                </div>
                            </div>
                            <div class=" mt-4 text-sm grid grid-cols-2 gap-5 font-bold ">
                                <div class="flex">
                                    <span>OCCUPATION:</span>
                                    <span
                                        class="border-b border-gray-600 flex-1 pl-1">{{ \App\Models\StudentGuardian::where('student_information_id', $student->id)->where('relationship', 'Father')->first()->occupation ?? '' }}</span>
                                </div>
                                <div class="flex">
                                    <span>CONTACT NO.:</span>
                                    <span
                                        class="border-b border-gray-600 flex-1 pl-1">{{ \App\Models\StudentGuardian::where('student_information_id', $student->id)->where('relationship', 'Father')->first()->contact_number ?? '' }}</span>
                                </div>
                            </div>
                            <div class="mt-4 ml-10 flex flex-col">
                                <span class="font-bold">THIS IS TO CERTIFY THAT:</span>
                                <span class="text-xs pl-10 font-medium">The Information provided are true and
                                    correct.</span>
                            </div>
                            <div class="mt-4 flex justify-end">
                                <div>
                                    <div>____________________________________</div>
                                    <div class="text-sm text-center font-bold">SIGNATURE OVER PRINTED NAME</div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <header class="text-center text-red-600 font-bold ">FOR TRANSFEREES ONLY</header>
                            </div>
                            <div class=" mt-4 text-sm grid grid-cols-2 gap-5 font-bold ">
                                <div class="flex">
                                    <span>LAST GRADE LEVEL COMPLETED</span>
                                    <span class="border-b border-gray-600 flex-1 pl-1"></span>
                                </div>
                                <div class="flex">
                                    <span>SCHOOL YEAR:</span>
                                    <span class="border-b border-gray-600 flex-1 pl-1"></span>
                                </div>
                            </div>
                            <div class="mt-4 flex font-bold  text-sm">
                                <span>NAME OF SCHOOL:</span>
                                <span class="border-b uppercase border-gray-600 flex flex-1 w-full pl-1"></span>
                            </div>
                            <div class="mt-4 flex font-bold  text-sm">
                                <span>SCHOOL ADDRESS:</span>
                                <span class="border-b uppercase border-gray-600 flex flex-1 w-full pl-1"></span>
                            </div>

                            <div class="mt-4">
                                <header class="text-center font-bold ">ADMISSION SLIP</header>
                            </div>
                            <div class=" mt-4 text-sm grid grid-cols-2 gap-5 font-bold ">
                                <div class="flex">
                                    <span>DATE OF ADMISSION(MM/DD/YYYY)</span>
                                    <span class="border-b border-gray-600 flex-1 pl-1"></span>
                                </div>
                            </div>
                            <div class="mt-4">
                                <div class="flex font-bold  text-sm">
                                    <span>NAME OF PUPIL/STUDENT:</span>
                                    <span
                                        class="border-b border-gray-600 uppercase  flex  flex-1  pl-1 justify-between items-start font-bold  text-sm">
                                        <span>{{ $student->lastname ?? '' }}</span>
                                        <span>{{ $student->firstname ?? '' }}</span>
                                        <span>{{ $student->middlename ?? '' }}</span>
                                        <span>{{ $student->suffix ?? '' }}</span>
                                    </span>
                                </div>
                            </div>
                            <div class="mt-2">
                                <div class="flex font-bold  text-xs">
                                    <span class="opacity-0 text-sm ">NAME OF PUPIL/STUDENT:</span>
                                    <span class="flex-1 flex justify-between items-start font-bold  text-xs">
                                        <span>(LAST NAME)</span>
                                        <span>(FIRST NAME)</span>
                                        <span>(MIDDLE NAME)</span>
                                        <span>(SUFFIX)</span>
                                    </span>
                                </div>
                            </div>
                            <div class=" mt-4 text-sm grid grid-cols-3 gap-5 font-bold ">
                                <div class="flex">
                                    <span>ADMISSION NO:</span>
                                    <span class="border-b border-gray-600 flex-1 pl-1">
                                    </span>
                                </div>
                                <div class="flex">
                                    <span>GRADE LEVEL:</span>
                                    <span class="border-b border-gray-600 flex-1 pl-1">
                                    </span>
                                </div>
                                <div class="flex">
                                    <span>TIME:</span>
                                    <span class="border-b border-gray-600 flex-1 pl-1">
                                    </span>
                                </div>
                            </div>
                            <div class="mt-4 flex justify-between items-center">
                                <div>
                                    <div>______________________________</div>
                                    <div class="text-sm text-center font-bold">ADMISSION OFFICER</div>
                                </div>
                                <div>
                                    <div class="font-bold text-center">LITO G. SALAYOG</div>
                                    <div class="text-sm border-t-2 border-black text-center font-bold">SCHOOL
                                        ADMINISTRATOR</div>
                                </div>
                            </div>
                            <div class="mt-10 opacity-0">
                                dssdsd
                            </div>
                            <div class="mt-96">
                                <p>I HEREBY CERTIFY that the information provided in this form is complete, true and
                                    correct to the
                                    best of my knowledge. </p>
                                <p class="mt-4 text-justify">FURTHER, I HEREBY ACKNOWLEDGE that I have read and
                                    understood the
                                    school policy
                                    of ROCKFORT EDUCATIONAL INSTITUTE, INC. (REII) and agree to it as well. I give my
                                    consent to
                                    REII to collect, use and process my personal information. I understand that my
                                    consent does not
                                    preclude the existence of other criteria for lawful processing of personal data, and
                                    does not
                                    waive any of my rights under the Data Privacy Act of 2012 and other applicable laws.
                                </p>

                                <div class="mt-10 flex flex-col justify-center items-center">
                                    <span>_________________________________________</span>
                                    <span>Signature Over Printed Name of Guardian/Student</span>
                                </div>
                                <div class="mt-5 flex flex-col justify-center items-center">
                                    <span>____________________</span>
                                    <span>DATE</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-5 ">
                    Coming soon...
                </div>
            </div>
        </div>
    </div>
</div>
