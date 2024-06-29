<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseCategoryTransaction extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function expense(){
        return $this->belongsTo(Expense::class);
    }

    public function expenseCategory(){
        return $this->belongsTo(ExpenseCategory::class);
    }
}
