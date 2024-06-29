<?php

namespace App\Livewire\Admin\Enrollee;

use App\Models\ActiveSemester;
use App\Models\PaymentTerms;
use App\Models\PaymentTransaction;
use App\Models\Post;
use App\Models\SaleCategory;
use App\Models\Strand;
use App\Models\Student;
use App\Models\StudentPayment;
use App\Models\StudentTransaction;
use Carbon\Carbon;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use App\Models\EducationalInformation;
use App\Models\Enrollee;
use App\Models\GradeLevel;
use App\Models\GradeLevelFee;
use App\Models\SchoolFee;
use App\Models\SchoolYear;
use Illuminate\Support\Facades\DB;
use WireUi\Traits\Actions;
use Livewire\Component;
use Flasher\SweetAlert\Prime\SweetAlertInterface;

class EnrollStudent extends Component implements HasForms
{
    use InteractsWithForms;
    use Actions;
    public $enrollee_id;

    public $department;
    public $student_id;
    public $strand_id;
    public $id_number, $lrn, $grade_level,$school_year;
    public $payments, $tuition_sub , $misc_sub, $book_dp;
    public $enroll_modal = false;

    public $total_payables = 0, $total_downpayment = 0;

    public $or_number, $cash_receive,$total_payment, $tuition, $misc, $developmental, $enrollment,$medical,$school_id, $books;

    public $total_tuition, $total_misc, $total_books;

    public $remaining_cash = 0;
    public $cash_change = 0;

    public $payment_terms;

    public $default_payments;

    public $discount;

    public $active_sem;

    public function mount(){
        $this->enrollee_id = request('id');
        $this->student_id  = Enrollee::where('id', $this->enrollee_id)->first()->student_information_id;
        $this->lrn = Enrollee::where('id', $this->enrollee_id)->first()->studentInformation->educationalInformation->lrn;
        $this->grade_level = Enrollee::where('id', $this->enrollee_id)->first()->studentInformation->educationalInformation->grade_level_id;
        $this->department = GradeLevel::where('id', $this->grade_level)->first()->department;
    }





    public function form(Form $form): Form
    {
        return $form
            ->schema([
              Fieldset::make('')->schema([
                TextInput::make('or_number')->label('OR Number')->required(),
                ViewField::make('rating')->label('')
    ->view('filament.form.empty'),
    TextInput::make('cash_receive')->label('Cash Received')->live()->prefix('₱')->required(),
    TextInput::make('total_payment')->label('Total Amount')->disabled()->prefix('₱')->required(),

              ]),
              Fieldset::make('')->schema([
                TextInput::make('tuition')->label('Tuition')->prefix('₱')->live()->required(),
                TextInput::make('misc')->label('Miscellaneous')->prefix('₱')->live()->required(),
                TextInput::make('developmental')->label('Developmental Fee')->live()->prefix('₱')->required(),
                TextInput::make('enrollment')->label('Enrollment Fee')->live()->prefix('₱')->required(),
                TextInput::make('medical')->label('Medical/Dental')->live()->prefix('₱')->required(),
                TextInput::make('school_id')->label('School ID')->prefix('₱')->required()->live(),
                TextInput::make('books')->label('Books')->prefix('₱')->live()->required(),
              ]),

              ]);
    }

    public function enrollStudent($total, $downpayment, $tuition, $misc){

        $year = Carbon::now()->format('y').''.Carbon::now()->addYear()->format('y');
        $count = Student::all()->count();

        $student_count = $count += 1;

        $this->id_number = sprintf("%s-%04d", $year, $student_count);


        $this->validate([
            'book_dp' => 'required',
            'school_year' => 'required',
            'strand_id' => $this->department == 'SHS' ? 'required' : ''
        ]);

        $this->total_payables = $total;
        $this->total_downpayment = $downpayment;
        $this->total_payment = $downpayment;
        $this->total_tuition = $tuition;
        $this->total_misc = $misc;
        $this->books = $this->book_dp;
        $this->enroll_modal = true;


    }

    public function submitEnroll(){
        $this->dialog()->confirm([
            'title'       => 'Are you Sure?',
            'description' => 'Enroll Student?',
            'acceptLabel' => 'Yes, enroll now',
            'method'      => 'submitPayment',
        ]);
    }

    public function submitPayment(){
        $this->validate([
            'or_number' => 'required',
            'cash_receive' => 'required',
        ]);

        $gradelevel = GradeLevel::where('id', $this->grade_level)->first()->department;

        DB::beginTransaction();
            $student = Student::create([
                'student_information_id' => $this->student_id,
                'id_number' => $this->id_number,
                'department' => $gradelevel,
                'strand_id' => $this->strand_id ? $this->strand_id : null,
                'grant_as' => $this->discount ? $this->discount : null,
            ]);

            $student_payment = StudentPayment::create([
                'student_id' => $student->id,
                'school_year_id' => $this->school_year,
                'applied_tuition_subd' => $this->tuition_sub,
                'applied_misc_subd' => $this->misc_sub,
                'total_payables' => ($this->total_payables + $this->book_dp) - $this->cash_receive,
               'required_downpaymennt' => $this->total_downpayment,
               'total_tuition' => $this->total_tuition - $this->tuition,
               'total_misc' => $this->total_misc - $this->misc,
               'total_book' => $this->books,
               'active_sem' => '1st Semester',
            ]);

            $student_transaction = StudentTransaction::create([
                'student_payment_id' => $student_payment->id,
                'student_information_id' => $this->student_id,
                'transaction_number' => 'TR'. Carbon::parse(now())->format('Ymd'). '000'. StudentTransaction::count() + 1,
                'or_number' => $this->or_number,
                'total_amount' => $this->cash_receive,
            ]);

            foreach (SaleCategory::whereIn('name',  ['Tuition', 'Miscellaneous','Developmental Fee','Enrolment Fee', 'Medical/Dental','School ID', 'Books'])->get() as $key => $value) {
              switch ($value->name) {
                case 'Tuition':
                    PaymentTransaction::create([
                        'student_transaction_id' => $student_transaction->id,
                        'sale_category_id' => $value->id,
                        'paid_amount' => $this->tuition,
                      ]);
                    break;
                    case 'Miscellaneous':
                        PaymentTransaction::create([
                            'student_transaction_id' => $student_transaction->id,
                            'sale_category_id' => $value->id,
                            'paid_amount' => $this->misc,
                          ]);
                        break;
                        case 'Developmental Fee':
                            PaymentTransaction::create([
                                'student_transaction_id' => $student_transaction->id,
                                'sale_category_id' => $value->id,
                                'paid_amount' => $this->developmental,
                              ]);
                            break;
                            case 'Enrolment Fee':
                                PaymentTransaction::create([
                                    'student_transaction_id' => $student_transaction->id,
                                    'sale_category_id' => $value->id,
                                    'paid_amount' => $this->enrollment,
                                  ]);
                                break;

                                case 'Medical/Dental':
                                    PaymentTransaction::create([
                                        'student_transaction_id' => $student_transaction->id,
                                        'sale_category_id' => $value->id,
                                        'paid_amount' => $this->medical,
                                      ]);
                                    break;
                                    case 'School ID':
                                        PaymentTransaction::create([
                                            'student_transaction_id' => $student_transaction->id,
                                            'sale_category_id' => $value->id,
                                            'paid_amount' => $this->school_id,
                                          ]);
                                        break;
                                        case 'Books':
                                            PaymentTransaction::create([
                                                'student_transaction_id' => $student_transaction->id,
                                                'sale_category_id' => $value->id,
                                                'paid_amount' => $this->books,
                                              ]);
                                            break;


                default:
                    # code...
                    break;
              }
            }

            $enrollee = Enrollee::where('student_information_id', $this->student_id)->first();
            $enrollee->update([
                'status' => true,
            ]);

        DB::commit();
        $this->enroll_modal = false;
        sweetalert()->success('Student successfully enrolled.');
        if (auth()->user()->role_id == 2) {
            return redirect()->route('business-office.enrollee');
        }else{
            return redirect()->route('admin.enrollee');
        }
    }

    public function render()
    {
        $this->active_sem = ActiveSemester::first()->active;
        $this->payment_terms = PaymentTerms::where('is_active', true)->first()->terms;
        $this->remaining_cash = (float)$this->cash_receive - ((float)$this->tuition + (float)$this->misc + (float)$this->developmental + (float)$this->enrollment + (float)$this->medical + (float)$this->school_id + (float)$this->books);
        $this->cash_change = (float)$this->cash_receive - $this->total_payment;
        $this->payments = GradeLevelFee::where('grade_level_id', $this->grade_level)->whereHas('school_fee', function($record){
            $record->whereNotIn('name', ['Tuition', 'Miscellaneous']);
        })->get()->take(5);
        $this->default_payments = GradeLevelFee::where('grade_level_id', $this->grade_level)->get()->take(7);
                return view('livewire.admin.enrollee.enroll-student',[
            'enrollee' => Enrollee::where('id', $this->enrollee_id)->first(),
            'levels' => GradeLevel::all(),
            'years' => SchoolYear::all(),
            'strands' => Strand::all(),
        ]);
    }
}
