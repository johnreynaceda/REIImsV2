<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherPayment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function saleCategory(){
        return $this->belongsTo(SaleCategory::class);
    }

    public function otherPaymentStudents(){
        return $this->hasMany(OtherPaymentStudent::class);
    }
}
