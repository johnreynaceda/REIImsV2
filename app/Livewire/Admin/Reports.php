<?php

namespace App\Livewire\Admin;

use App\Exports\StudentExport;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\ExpenseCategoryTransaction;
use App\Models\GradeLevel;
use App\Models\PaymentTransaction;
use App\Models\SaleCategory;
use App\Models\Student;
use App\Models\StudentPayment;
use App\Models\StudentTransaction;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Maatwebsite\Excel\Excel;

class Reports extends Component
{
    public $selected_report;
    public $date_from, $date_to;

    public $grade_level_id;
    public $categories = [];
    PUBLIC $expense_categories = [];
    public function render()
    {
        return view('livewire.admin.reports',[
            'report' => $this->generatedQuery(),
            'grade_levels' => GradeLevel::all(),
        ]);
    }

    public function generatedQuery(){
        switch ($this->selected_report) {
            case 'Student Records':

                $data = Student::when($this->grade_level_id, function($record){
                    $record->whereHas('studentInformation.educationalInformation', function($educ) {
                        $educ->where('grade_level_id', $this->grade_level_id);
                    });
                })->get();

                return $data;
                break;

            case 'Income':
                DB::statement("SET SESSION max_execution_time=60000"); // Set max execution time to 60 seconds (MySQL only)

                $recordsQuery = StudentTransaction::select(['id', 'or_number'])
                    ->when($this->date_from && $this->date_to, function ($query) {
                        $query->whereBetween('created_at', [$this->date_from, $this->date_to]);
                    }, function ($query) {
                        $query->limit(5); // Limit to 5 records if no date range is selected
                    });
                
                $data = $recordsQuery->orderBy('or_number', 'ASC')->get();
                
                // Extract IDs as an array for optimized queries
                $records = $data->pluck('id')->toArray();
                
                $this->categories = SaleCategory::whereIn(
                    'id',
                    PaymentTransaction::whereIn('student_transaction_id', $records)
                        ->select('sale_category_id')
                        ->distinct()
                        ->pluck('sale_category_id')
                )->get();

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

    public function fixedSoa(){
            $query = StudentPayment::all();

            foreach ($query as $key => $value) {
                $value->update([
                    'total_payables' => $value->total_tuition + $value->total_misc,
                ]);
            }
    }
}
