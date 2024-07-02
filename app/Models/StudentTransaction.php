<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentTransaction extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function studentPayment(){
        return $this->belongsTo(StudentPayment::class);
    }

    public function paymentTransactions(){
        return $this->hasMany(PaymentTransaction::class);
    }

    public function studentInformation(){
        return $this->belongsTo(StudentInformation::class);
    }

    public function transactionLog(){
        return $this->hasOne(TransactionLog::class);
    }
}
