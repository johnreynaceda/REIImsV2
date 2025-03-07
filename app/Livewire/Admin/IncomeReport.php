<?php

namespace App\Livewire\Admin;

use App\Models\SaleCategory;
use App\Models\StudentTransaction;
use Livewire\Component;

class IncomeReport extends Component
{
   public $month;
   public $year;


    public function render()
    {
        
        return view('livewire.admin.income-report',[
            'years' => StudentTransaction::selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year'),

            'saleCategories' => SaleCategory::all(),
            'reports' => $this->generatedQuery(),
        ]);
        
    }

    public function generatedQuery(){
        return StudentTransaction::whereMonth('created_at', $this->month)
            ->whereYear('created_at', $this->year)
            ->orderBy('or_number', 'asc')
            ->get();
    }
}
