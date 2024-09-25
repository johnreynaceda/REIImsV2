<table>
    <thead>
        <tr>
            <th>FULLNAME</th>
            <th>SECTION</th>
            <th>GRADE LEVEL</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($students as $item)
            @php
                $section = \App\Models\Section::where('id', $item->section_id)->first();
            @endphp
            <tr>
                <td class="uppercase">
                    {{ $item->student->studentInformation->lastname . ', ' . $item->student->studentInformation->firstname . ' ' . ($item->student->studentInformation->middlename == null ? '' : $item->student->studentInformation->middlename[0] . '.') }}
                </td>
                <td class="uppercase">{{ $section->name }}</td>
                <td class="uppercase">{{ $section->gradeLevel->name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
