<?php

namespace App\Livewire\Admin;

use App\Models\ActiveSemester;
use App\Models\PaymentTerms;
use App\Models\Student;
use App\Models\StudentPayment;
use App\Models\StudentSection;
use App\Models\StudentTransaction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\HeaderActionsPosition;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use App\Models\Section;
use Livewire\Component;

class ManageSection extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public $dues;
    public $section_id;
    public $section_name;

    public $student;

    public $student_id;
    public $department;
    public $payment_terms;

    public $semester;
    public $grade_level_id;
    public $due_date;

    public function table(Table $table): Table
    {
        return $table
            ->query(StudentSection::query()->where('section_id', $this->section_id))->headerActions([
                Action::make('student')->label('Add Student')->icon('heroicon-c-user')->action(
                    function($record, $data){
                        foreach ($data['students'] as $key => $value) {
                            StudentSection::create([
                                'student_id' => $value,
                                'section_id' => $this->section_id,
                            ]);
                        }
                    }
                )->form([

                    Select::make('students')->multiple()->searchable()
                    ->options(function () {
                        // Retrieve the grade level ID from the section
                        $gradeLevelId = Section::where('id', $this->section_id)->first()->grade_level_id;

                        $already_in_section = StudentSection::all()->pluck('student_id')->toArray();

                        // Fetch the students matching the criteria
                        $students = Student::whereNotIn('id', $already_in_section)->whereHas('studentInformation', function ($info) use ($gradeLevelId) {
                            $info->whereHas('educationalInformation', function ($educ) use ($gradeLevelId) {
                                $educ->where('grade_level_id', $gradeLevelId);
                            });
                        })->get();

                        // Map with keys to get the student ID and last name
                        return $students->mapWithKeys(function ($record) {
                            return [$record->id => strtoupper($record->studentInformation->lastname). ', '. strtoupper($record->studentInformation->firstname)];
                        });
                    }),
                ]),
            ], position: HeaderActionsPosition::Bottom)
            ->columns([
                TextColumn::make('student_id')->label('STUDENT NAME')->formatStateUsing(
                    fn($record) => $record->student->studentInformation->lastname. ', '. $record->student->studentInformation->firstname
                )->searchable(),
                TextColumn::make('section.name')->label('SECTION')->searchable(),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                Action::make('print_billind')->color('success')->label('Print SOA')->button()->icon('heroicon-o-printer')->form(function($record){
                    $this->student_id = $record->student_id;
                    $count = StudentPayment::where('student_id', Student::where('id', $this->student_id)->first()->id)->where('active_sem', ActiveSemester::first()->active)->first();
        $this->department = Student::where('id', $this->student_id)->first()->studentInformation->educationalInformation->gradeLevel->department;
        $this->grade_level_id = Student::where('id', $this->student_id)->first()->studentInformation->educationalInformation->grade_level_id;
                    return [

                        ViewField::make('rating')->view('filament.form.print-button'),
                    ];
                })->modalHeading('PRINT BILLING STATEMENT')->modalSubmitAction(false),
                Action::make('change')->label('Change Section')->icon('heroicon-c-arrow-right-end-on-rectangle')->action(
                    function($record, $data){
                        $record->update([
                            'section_id' => $data['section'],
                        ]);
                    }
                )->form([
                    Select::make('section')->options(
                        function(){
                            $gradeLevelId = Section::where('id', $this->section_id)->first()->grade_level_id;

                             return Section::where('grade_level_id', $gradeLevelId)->pluck('name', 'id');
                        }
                    )
                ])->modalWidth('xl'),
                DeleteAction::make('delete'),
            ])
            ->bulkActions([
                // ...
            ])->emptyStateHeading('No Grade Level yet!')->emptyStateIcon('heroicon-c-tag')->emptyStateDescription('Once you write your first data, it will appear here.');
    }

    public function mount(){
        $this->section_id = request('id');
        $this->section_name = Section::where('id', $this->section_id)->first()->name;
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

        $this->dues = $this->department == 'SHS' ? StudentPayment::where('student_id', $this->student_id)->where('active_sem', ActiveSemester::first()->active)->first() : StudentPayment::where('student_id', $this->student_id)->where('active_sem', '1st Semester')->first();
       $this->student =  Student::where('id', $this->student_id)->first();
        return view('livewire.admin.manage-section');
    }
}
