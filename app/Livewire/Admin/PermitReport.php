<?php

namespace App\Livewire\Admin;

use App\Models\GradeLevel;
use App\Models\Section;
use App\Models\Student;
use App\Models\StudentTransaction;
use Livewire\Component;

class PermitReport extends Component
{
    public $month;
    public $section;
    public $grade_level;
    public $filter;
    public function render()
    {
        return view('livewire.admin.permit-report',[
            'permits' => $this->generatedReport(),
            'grade_levels' => GradeLevel::get(),
            'sections' => Section::where('grade_level_id', $this->grade_level)->get(),
        ]);
    }

    public function generatedReport(){
        return Student::when($this->grade_level, function($record){
            $record->whereHas('studentInformation.educationalInformation', function($educ) {
                $educ->where('grade_level_id', $this->grade_level);
            });
        })->when($this->section, function($section){
            $section->whereHas('studentSections', function($r){
                $r->where('section_id', $this->section);
            });
        })->get();
    }
}
