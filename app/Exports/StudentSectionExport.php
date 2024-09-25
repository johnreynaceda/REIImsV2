<?php

namespace App\Exports;

use App\Models\StudentSection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class StudentSectionExport implements FromView
{
    public $section_id;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct( $section)
    {
        $this->section_id = $section;
    }

    public function view(): View
    {
        
        return view('export.studentsection', [
            'students' => StudentSection::where('section_id', $this->section_id)->get(),
        ]);
    }
}
