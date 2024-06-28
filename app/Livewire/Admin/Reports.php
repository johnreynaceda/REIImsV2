<?php

namespace App\Livewire\Admin;

use App\Models\PaymentTransaction;
use App\Models\SaleCategory;
use App\Models\StudentTransaction;
use Livewire\Component;

class Reports extends Component
{
    public $selected_report;
    public $date_from, $date_to;
    public $categories = [];
    public function render()
    {
        return view('livewire.admin.reports',[
            'report' => $this->generatedQuery(),
        ]);
    }

    public function generatedQuery(){
        switch ($this->selected_report) {
            case 'Student Records':
                return[];
                break;

            case 'Income':
                $data = StudentTransaction::when($this->date_from && $this->date_to, function($record){
                    $record->whereDate('created_at', '<=', $this->date_from)->whereDate('created_at', '>=', $this->date_to);
                })->get();
                $records = $data->pluck('id');
                $this->categories = SaleCategory::whereIn('id', PaymentTransaction::whereIn('student_transaction_id', $records)->distinct()
                ->pluck('sale_category_id'))->get();
                return $data;
                break;

            default:
                return [];
                break;
        }
    }
}
