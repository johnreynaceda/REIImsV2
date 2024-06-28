<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradeLevelFee extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function school_fee(){
        return $this->belongsTo(SchoolFee::class);
    }

    public function grade_level(){
        return $this->belongsTo(GradeLevel::class);
    }

    public function strands(){
        return $this->belongsToMany(Strand::class);
    }
}
