<?php

namespace App\Livewire\Teacher;

use App\Models\StudentInformation;
use Livewire\Component;

class RecordStudent extends Component
{
    public $student_id;

    public function mount(){
        $this->student_id = request('id');
    }

    public function render()
    {
        return view('livewire.teacher.record-student',[
            'student' => StudentInformation::where('id', $this->student_id)->first(),
        ]);
    }
}
