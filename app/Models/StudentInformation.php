<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentInformation extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function enrollees(){
        return $this->hasMany(Enrollee::class);
    }

    public function studentAddress(){
        return $this->hasOne(StudentAddress::class);

    }

    public function educationalInformation(){
        return $this->hasOne(EducationalInformation::class);
    }
    public function studentGuardian(){
        return $this->hasOne(StudentGuardian::class);
    }

    public function student(){
        return $this->hasOne(Student::class);
    }

    public function studentTransactions(){
        return $this->hasMany(StudentTransaction::class);
    }
}
