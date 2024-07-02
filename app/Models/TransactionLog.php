<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionLog extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function studentTransaction(){
        return $this->belongsTo(StudentTransaction::class);
    }

    public function expense(){
        return $this->belongsTo(Expense::class);
    }
}
