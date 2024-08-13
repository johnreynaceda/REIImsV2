<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function paymentTransactions(){
        return $this->hasMany(PaymentTransaction::class);
    }

    public function otherPayments(){
        return $this->hasMany(OtherPayment::class);
    }
}
