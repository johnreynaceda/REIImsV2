<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationalInformation extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function studentInformation(){
        return $this->belongsTo(StudentInformation::class);
    }

    public function gradeLevel(){
        return $this->belongsTo(GradeLevel::class);
    }
}
