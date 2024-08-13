<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function studentInformation(){
        return $this->belongsTo(StudentInformation::class);
    }

    public function studentPayments(){
        return $this->hasMany(StudentPayment::class);
    }

    public function studentSections(){
        return $this->hasMany(StudentSection::class);
    }

    public function otherPaymentStudents(){
        return $this->hasMany(OtherPaymentStudent::class);
    }
}
