<?php

namespace App\Livewire\Admin;

use App\Models\ActiveSemester;
use App\Models\PaymentTransaction;
use App\Models\SaleCategory;
use App\Models\Student;
use App\Models\StudentPayment;
use App\Models\StudentTransaction;
use Carbon\Carbon;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Form;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use App\Models\Shop\Product;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use WireUi\Traits\Actions;

class SoaPayment extends Component implements HasForms
{
    use InteractsWithForms;
    use Actions;


    #[Reactive]
    public $student_id;

    public $total_book_with_discount = 0;

    public $book_fully_paid = false;

    public $payment_modal = false;

    public $student_name;
    public $student;
    public $payments = [];

    public $section;

    public $receipt_modal = false;


    public function mount($student_id)
    {
      
        $this->student_id = $student_id;
        
        $student = Student::where('id', $this->student_id)->first();
        
        $this->student = $student;
        $this->student_name = $student->studentInformation->lastname. ', '. $student->studentInformation->firstname. ' '. ($student->studentInformation->middlename == null ? '' : $student->studentInformation->middlename[0].'.');
        $payment = StudentPayment::where('student_id', $this->student_id)->first();
        $this->total_book_with_discount = $payment->total_book;
        $this->section = Student::where('id', $this->student_id)->first()->studentSections->first()->section->name;
    }


    public $or_number, $cash_receive = 0;

    public function updatedBookFullyPaid(){
        $payment = StudentPayment::where('student_id', $this->student_id)->first();
        if ($this->book_fully_paid == true) {
            $this->total_book_with_discount = $payment->total_book - ($payment->total_book * 0.15);
        }else{
            $this->total_book_with_discount = $payment->total_book;
        }
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Repeater::make('payments')->label('')->createItemButtonLabel('Add Payment')->live()
                ->schema([
                    Select::make('category')->searchable()
                        ->options(SaleCategory::all()->pluck('name', 'id')),
                    TextInput::make('amount')->numeric(),
                ])
                ->columns(2),
                ViewField::make('rating')
                ->view('filament.form.payment-total')
                    ]);
    }

    public function proceedPayment($total){

        $this->validate([
            'payments' => 'required',
        ]);

        

        $payment = StudentPayment::where('student_id', $this->student_id)->first();
         $department = Student::where('id', $this->student_id)->first()->studentInformation->educationalInformation->gradeLevel->department;

         $gradelevel = Student::where('id', $this->student_id)->first()->studentInformation->educationalInformation->gradeLevel->id;

         $book_amount = $payment->total_book - ((float)$payment->total_book * 0.15);

         $total_discount = (float)$payment->total_book * 0.15;

         


        $transaction = StudentTransaction::create([
            'student_payment_id' => $payment->id,
            'student_information_id' => Student::where('id', $this->student_id)->first()->student_information_id,
            'transaction_number' => 'TR'. Carbon::parse(now())->format('Ymd'). '000'. StudentTransaction::count() + 1,
            'or_number' => $this->or_number,
            'total_amount' => $this->cash_receive,
            'active_semester' => $department == 'SHS' ? ActiveSemester::first()->active : '1st Semester'
        ]);

        foreach ($this->payments as $key => $value) {
           PaymentTransaction::create([
            'student_transaction_id' => $transaction->id,
            'sale_category_id' => $value['category'],
            'paid_amount' => $value['amount'],
           ]);

           if (SaleCategory::where('id', $value['category'])->first()->name == 'Tuition') {
           $payment->update([
            'total_tuition' => $payment->total_tuition - $value['amount'],
            'total_payables' => $payment->total_payables - $value['amount'],
           ]);
           }elseif (SaleCategory::where('id', $value['category'])->first()->name == 'Miscellaneous') {
            $payment->update([
                'total_misc' => $payment->total_misc - $value['amount'],
                'total_payables' => $payment->total_payables - $value['amount'],
               ]);
           }elseif (SaleCategory::where('id', $value['category'])->first()->name == 'Books') {
            if ($payment->book_fee_updated == false) {
                $payment->update([
                    'total_book' => $payment->total_book + $value['amount'],
                    'total_payables' => $payment->total_payables ,
                   ]);
            }else{
                $payment->update([
                    'total_book' => $this->book_fully_paid == true ? $payment->total_book - ($value['amount'] + $total_discount) : $payment->total_book - $value['amount'],
                    'total_payables' => $this->book_fully_paid == true ? $payment->total_payables - ($value['amount'] + $total_discount) : $payment->total_payables - $value['amount'],
                   ]);
            }
           }else{

           }


        }

        $this->dialog()->success(
            $title = 'Payment Transaction',
            $description = 'Successfully Rendered.'
        );

        $this->payment_modal = false;
        $this->receipt_modal = true;
        // return redirect()->route('admin.soa');
    }



    public function payment($total){
        $this->dialog()->confirm([

            'title' => 'Are you Sure?',
            'icon' => 'warning',
            'description' => 'Proceed Payment',

            'acceptLabel' => 'Yes, save it',

            'method'      => 'proceedPayment',
            'params' => $total

        ]);


    }

    public function render()
    {
        return view('livewire.admin.soa-payment');
    }
}
