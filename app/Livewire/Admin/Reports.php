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
use Livewire\Component;
use Maatwebsite\Excel\Excel;

class Reports extends Component
{
    public $selected_report;
    public $date_from, $date_to;

    public $grade_level_id;
    public $categories = [];
    public $expense_categories = [];
    public function render()
    {
        return view('livewire.admin.reports', [
            'report' => $this->generatedQuery(),
            'grade_levels' => GradeLevel::all(),
            'income' => SaleCategory::all(),
            'pictures' => PaymentTransaction::where('sale_category_id', 13)->get(),
        ]);
    }

    public function generatedQuery()
    {
        switch ($this->selected_report) {
            case 'Student Records':

                $data = Student::when($this->grade_level_id, function ($record) {
                    $record->whereHas('studentInformation.educationalInformation', function ($educ) {
                        $educ->where('grade_level_id', $this->grade_level_id);
                    });
                })->get();

                return $data;
                break;

            case 'Income':
                $recordsQuery = StudentTransaction::when($this->date_from && $this->date_to, function ($query) {
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

                $recordsQuery = Expense::when($this->date_from && $this->date_to, function ($query) {
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
    public function exportRecord()
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new StudentExport, 'students_record.xlsx');
    }



    public function fixedSoa()
    {
        $query = StudentPayment::all();

        foreach ($query as $key => $value) {
            $value->update([
                'total_payables' => $value->total_tuition + $value->total_misc,
            ]);
        }
    }
}
