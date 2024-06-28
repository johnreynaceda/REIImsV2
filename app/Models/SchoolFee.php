<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolFee extends Model
{
    use HasFactory;
    protected $guarded = [];

public function grade_level_fees(){
    return $this->hasMany(GradeLevelFee::class);
}
}
