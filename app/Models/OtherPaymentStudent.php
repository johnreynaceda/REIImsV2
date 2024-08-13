<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherPaymentStudent extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function otherPayment(){
        return $this->belongsTo(OtherPayment::class);
    }

    public function student(){
        return $this->belongsTo(Student::class);
    }
}
