<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentTransaction extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function studentTransaction(){
        return $this->belongsTo(StudentTransaction::class);
    }

    public function saleCategory(){
        return $this->belongsTo(SaleCategory::class);
    }
}
