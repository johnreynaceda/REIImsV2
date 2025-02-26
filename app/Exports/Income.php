<?php

namespace App\Exports;
use App\Models\PaymentTransaction;
use App\Models\SaleCategory;
use App\Models\StudentTransaction;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use Maatwebsite\Excel\Concerns\FromCollection;

class Income implements FromView
{
 


    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('export.income',[
            'reports' => $this->generatedQuery(),
        ]);
    }

    public function generatedQuery()
{
    // Set default dates if they are not provided
    $dateFrom = $this->date_from ?? '2024-10-01';
    $dateTo = $this->date_to ?? '2024-10-31';

    // Optimize date filtering using `whereBetween`
    $data = StudentTransaction::whereBetween('created_at', [$dateFrom, $dateTo])
        ->orderBy('or_number', 'ASC')
        ->get(['id', 'or_number', 'created_at']); // Fetch only needed columns

    $records = $data->pluck('id')->toArray();

    $this->categories = SaleCategory::whereIn(
        'id',
        PaymentTransaction::whereIn('student_transaction_id', $records)
            ->distinct()
            ->pluck('sale_category_id')
            ->toArray()
    )->get();

    return $data;
}
}
