<?php

namespace App\Livewire\Admin;

use App\Models\ActiveSemester;
use App\Models\PaymentTerms;
use App\Models\PaymentTransaction;
use App\Models\SaleCategory;
use App\Models\SchoolFee;
use App\Models\Student;
use App\Models\StudentPayment;
use App\Models\StudentTransaction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Yaza\LaravelGoogleDriveStorage\Gdrive;
use Flasher\SweetAlert\Prime\SweetAlertInterface;

class StatementAccount extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;
    public $student_id;

    public $receipt_data;
    public $section;

    public $records;
    public $payments = [];
    PUBLIC $department;
    public $payment_modal = false;
    public $grade_level_id;

    public $file;

    public $due_date;

    public $payment_terms;

    public $student_name;

    public $semester;

    public $receipt_modal = false;

    // public function send(){

    //     // $fileId = Gdrive::put($this->file->getClientOriginalName(), $this->file->getRealPath());

    //     $folderPath = 'REII/SF10';

    //     // Get the file name
    //     $fileName = $this->file->getClientOriginalName();

    //     // Read the file contents as a string
    //     $fileContents = file_get_contents($this->file->path());

    //     // Write the file to the specified folder
    //     Storage::disk('google')->getAdapter()->write($folderPath . '/' . $fileName, $fileContents, new \League\Flysystem\Config([]));
    // }

    public function mount(){
        $this->semester = ActiveSemester::first()->active;

    }

    public function table(Table $table): Table
    {
        return $table
            ->query(StudentTransaction::query()->when($this->student_id, function($student){
                $student->whereHas('studentPayment', function($record){
                    $record->where('student_id', $this->student_id);
                });
            }))
            ->columns([
                TextColumn::make('or_number')->label('OR NO.')->searchable(),
                TextColumn::make('total_amount')->label('AMOUNT')->formatStateUsing(
                    function($record){
                        return '₱'.number_format($record->total_amount,2);
                    }
                )->searchable(),
                TextColumn::make('created_at')->date()->label('DATE'),
            ])
            ->filters([
                // ...
            ])
            ->actions([
              ViewAction::make('view')->label('VIEW')->color('warning')->size('sm')->form([
                ViewField::make('payments')
    ->view('filament.form.payments')
              ])->modalWidth('xl')->modalHeading('VIEW PAYMENT DETAILS'),
              Action::make('void')->label('VOID')->size('sm')->icon('heroicon-s-x-circle')->color('danger'),
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
               Select::make('student_id')->live()->label('SELECT STUDENT')->searchable()->options(Student::get()->mapWithKeys(
                function($record){
                    return [$record->id => strtoupper($record->studentInformation->lastname.', ' . $record->studentInformation->firstname )];
                }
               ))
            ]);

    }
    public function view($id){
        sleep(1);

        $this->payments = StudentTransaction::where('id', $id)->first();
        $this->payment_modal = true;
    }

    public function void($id){
    //     sleep(1);
    //     $data = StudentTransaction::where('id', $id)->first();
    //    foreach ($data->paymentTransactions as $key => $value) {
    //    switch (SaleCategory::where('id', $value->sale_category_id)->first()->name) {
    //     case 'Tuition':
    //        $payment = StudentPayment::where('student_id', $this->student_id)->first();
    //        $payment->update([
    //         'total_tuition' => $payment->total_tuition + $value->paid_amount,
    //         'total_payables' => $payment->total_payables + $value->paid_amount,
    //        ]);
    //         break;
    //     case 'Miscellaneous':
    //        $payment = StudentPayment::where('student_id', $this->student_id)->first();
    //        $payment->update([
    //         'total_misc' => $payment->total_misc + $value->paid_amount,
    //         'total_payables' => $payment->total_payables + $value->paid_amount,
    //        ]);
    //         break;
    //     case 'Books':
    //        $payment = StudentPayment::where('student_id', $this->student_id)->first();
    //        $payment->update([
    //         'total_misc' => $payment->total_misc + $value->paid_amount,
    //         'total_payables' => $payment->total_payables + $value->paid_amount,
    //        ]);
    //         break;

    //     default:
    //         # code...
    //         break;
    //    }
    //    }
        // $this->payments = StudentTransaction::where('id', $id)->first();
        // $this->payment_modal = true;
    }

    public function updatedStudentId(){
       if ($this->student_id == null) {
        return redirect()->route('admin.soa');
       }else{
        $count = StudentPayment::where('student_id', Student::where('id', $this->student_id)->first()->id)->where('active_sem', ActiveSemester::first()->active)->first();
        $this->department = Student::where('id', $this->student_id)->first()->studentInformation->educationalInformation->gradeLevel->department;
        $this->grade_level_id = Student::where('id', $this->student_id)->first()->studentInformation->educationalInformation->grade_level_id;



        if ($this->department == 'K-10') {

        }else{
            if ($count) {
                if ($count->count() > 0) {

                }else{
                    dd('sdsdsd');
                }
            }else{
                sweetalert('The Student has not been enrolled for second sem');
                return redirect()->route('admin.soa');

            }
        }
       }


    }

    public function printReceipt($id){
        sleep(1);
        $data = StudentTransaction::where('id', $id)->first();
        $this->student_name = $data->studentInformation->lastname. ', '. $data->studentInformation->firstname. ' '. ($data->studentInformation->middlename == null ? '' : ($data->studentInformation->middlename[0]. '.'));
        $this->receipt_data = $data;
        $this->section = $data->studentPayment->student->studentSections->first()->section->name;
       
        $this->receipt_modal = true;
    }


    public function render()
    {

        if ($this->department) {
            if ($this->department == 'K-10') {
                $this->records = StudentTransaction::where('student_information_id', Student::where('id', $this->student_id)->first()->student_information_id)->orWhereHas('studentPayment', function($payment){
                    $payment->where('active_sem', '1st Semester')->where('student_id', $this->student_id);
                })->get();
                // whereHas('studentPayment', function($payment){
                //     $payment->where('active_sem', '1st Semester')->where('student_id', $this->student_id);
                // })->
            }else{
                if ($this->semester == '1st Semester') {
                    $this->records = StudentTransaction::whereHas('studentPayment', function($payment){
                        $payment->where('active_sem', '1st Semester')->where('student_id', $this->student_id);
                    })->get();
                   }else{
                    $this->records = StudentTransaction::whereHas('studentPayment', function($payment){
                        $payment->where('active_sem', '2nd Semester')->where('student_id', $this->student_id);
                    })->get();
                   }
            }
        }
        $this->payment_terms = PaymentTerms::where('is_active', true)->first()->terms;
        return view('livewire.admin.statement-account',[
            'dues' => $this->department == 'SHS' ? StudentPayment::where('student_id', $this->student_id)->where('active_sem', ActiveSemester::first()->active)->first() : StudentPayment::where('student_id', $this->student_id)->where('active_sem', '1st Semester')->first(),
            'student' => Student::where('id', $this->student_id)->first(),

        ]);
    }
}
