<?php

namespace App\Livewire\Admin;

use App\Models\Student;
use Livewire\Component;

class StudentInformation extends Component
{
    public $student_id;

    public function mount(){
        $this->student_id = request('id');
    }
    public function render()
    {
        return view('livewire.admin.student-information',[
            'student' => Student::where('id', $this->student_id)->first()->studentInformation,
        ]);
    }
}
