<?php

namespace App\Livewire\Admin;

use App\Exports\StudentExport;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\ExpenseCategoryTransaction;
use App\Models\PaymentTransaction;
use App\Models\SaleCategory;
use App\Models\StudentTransaction;
use Livewire\Component;
use Maatwebsite\Excel\Excel;

class Reports extends Component
{
    public $selected_report;
    public $date_from, $date_to;
    public $categories = [];
    PUBLIC $expense_categories = [];
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
                $recordsQuery = StudentTransaction::when($this->date_from && $this->date_to, function($query) {
                    $query->whereDate('created_at', '>=', $this->date_from)
                          ->whereDate('created_at', '<=', $this->date_to);
                });

                if (!$this->date_from && !$this->date_to) {
                    $recordsQuery->take(5); // Limit to 5 records if date_from and date_to are not selected
                }

                $data = $recordsQuery->orderBy('or_number', 'ASC')->get();
                $records = $data->pluck('id');

                $this->categories = SaleCategory::whereIn('id', PaymentTransaction::whereIn('student_transaction_id', $records)->distinct()
                                ->pluck('sale_category_id'))->get();

                return $data;
                break;

            default:

            $recordsQuery = Expense::when($this->date_from && $this->date_to, function($query) {
                return $query->whereDate('date_of_transaction', '>=', $this->date_from)
                             ->whereDate('date_of_transaction', '<=', $this->date_to);
            });

                if (!$this->date_from && !$this->date_to) {
                $recordsQuery->take(5); // Limit to 5 records if date_from and date_to are not selected
                }

                $data = $recordsQuery->orderBy('voucher_number', 'ASC')->get();
                $records = $data->pluck('id');

                $this->expense_categories = ExpenseCategory::whereIn('id', ExpenseCategoryTransaction::whereIn('expense_id', $records)->distinct()
                            ->pluck('expense_category_id'))->get();

                return $data;
                break;
        }



    }
    public function exportRecord(){
        return \Maatwebsite\Excel\Facades\Excel::download(new StudentExport, 'students_record.xlsx');
    }
}
