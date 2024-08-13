<table>
    <thead>
        <tr>
            <th>ID NO.</th>
            <th>LRN</th>
            <th>FIRSTNAME</th>
            <th>MIDDLE INITIAL</th>
            <th>LASTNAME</th>
            <th>SUFFIX</th>
            <th>GRADE/YEAR</th>
            <th>SECTION</th>
            <th>PARENT/GUARDIAN</th>
            <th>PHONE NO.</th>
            <th>ADDRESS</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($students as $student)
            @php
                $data = \App\Models\StudentGuardian::where('student_information_id', $student->studentInformation->id)
                    ->where('relationship', 'Mother')
                    ->first();

                $address = \App\Models\StudentAddress::where(
                    'student_information_id',
                    $student->studentInformation->id,
                )->first();
            @endphp
            <tr>
                <td class="uppercase">{{ $student->id_number ?? 'NULL' }}</td>
                <td class="uppercase">{{ $student->studentInformation->educationalInformation->lrn }}</td>
                <td class="uppercase">{{ strtoupper($student->studentInformation->firstname) }}</td>
                <td class="uppercase">
                    {{ strtoupper($student->studentInformation->middlename == null ? '' : $student->studentInformation->middlename[0] . '.') }}
                </td>
                <td class="uppercase">{{ strtoupper($student->studentInformation->lastname) }}</td>
                <td class="uppercase">
                    {{ strtoupper($student->studentInformation->suffix == null ? '' : $student->studentInformation->suffix) }}
                </td>
                <td class="uppercase">
                    {{ strtoupper($student->studentInformation->educationalInformation->gradeLevel->name) }}</td>
                <td class="uppercase">
                    @php
                        $section = \App\Models\StudentSection::where('student_id', $student->id)->first();
                    @endphp
                    {{ strtoupper($section->section->name ?? '') }}</td>
                <td class="uppercase">

                    {{ strtoupper($data->firstname . ' ' . $data->lastname) }}
                </td>
                <td class="uppercase">
                    {{ $data->contact_number }}
                </td>
                <td class="uppercase">
                    {{ strtoupper($address->street == 'NA' ? '' : $address->street) }},
                    BRGY. {{ strtoupper($address->barangay) }}, {{ strtoupper($address->city) }},
                    {{ strtoupper($address->province) }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
