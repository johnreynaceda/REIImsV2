<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentPayment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function studentTransactions(){
        return $this->hasMany(StudentTransaction::class);
    }

    public function student(){
        return $this->belongsTo(Student::class);
    }
}
