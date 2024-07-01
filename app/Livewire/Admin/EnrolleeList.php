<?php

namespace App\Livewire\Admin;

use App\Models\EducationalInformation;
use App\Models\Enrollee;
use App\Models\GradeLevel;
use App\Models\GradeLevelFee;
use App\Models\MedicalInformation;
use App\Models\SchoolFee;
use App\Models\SchoolYear;
use App\Models\Strand;
use App\Models\StudentAddress;
use App\Models\StudentGuardian;
use App\Models\StudentInformation;
use Carbon\Carbon;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\HeaderActionsPosition;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class EnrolleeList extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public $type = 1;

    public $record_modal = false;

    public $info_id;

    public $fname, $mname, $lname, $suffix, $dob, $gender, $age, $email;
    public $father_fname, $father_mname, $father_lname, $father_occupation, $father_contact;
    public $mother_fname, $mother_mname, $mother_lname, $mother_occupation, $mother_contact;

    public $province,$municipality,$barangay,$street;

    public $phic_number, $vaccine_status, $vaccine_date, $vaccine_name;

    public $lrn, $grade_level_id, $student_type;

    public function table(Table $table): Table
    {
        return $table
            ->query(Enrollee::query()->orderBy('created_at', 'DESC')->whereStatus('false'))->headerActions([
            Action::make('enrollee')->hidden(auth()->user()->role_id == 2)->label(auth()->user()->role_id == 1 && auth()->user()->role_id == 2 ? 'New Enrollee' : 'New Student')->icon('heroicon-s-user-plus')->url(fn (): string => auth()->user()->role_id == 1 ? route('admin.enrollee-add') : route('teacher.enrollment'))
        ], position: HeaderActionsPosition::Bottom)
            ->columns([
                TextColumn::make('studentInformation.firstname')->label('FULLNAME')->formatStateUsing(
                    fn ($record) => strtoupper($record->studentInformation->lastname. ', ' .$record->studentInformation->firstname. ' ' . ($record->studentInformation->middlename == null ? '' : $record->studentInformation->middlename[0].'.'))
                )->size('md'),
                TextColumn::make('studentInformation.gender')->label('GENDER')->size('md'),
                TextColumn::make('studentInformation.educationalInformation.gradeLevel.name')->label('GRADE LEVEL')->size('md')->searchable(),
                TextColumn::make('studentInformation.birthdate')->date()->label('BIRTHDATE')->size('md'),
                TextColumn::make('studentInformation.studentAddress')->label('ADDRESS')->size('md')->formatStateUsing(
                    fn($record) =>  strtoupper($record->studentInformation->studentAddress->barangay).', '. $record->studentInformation->studentAddress->city.', '. $record->studentInformation->studentAddress->province
                )

            ])
            ->filters([

            ])
            ->actions([

                ActionGroup::make([
                    Action::make('enroll')->label('ENROLL STUDENT')->icon("heroicon-c-academic-cap")->color('success')->url(
                        fn ($record) => auth()->user()->role_id == 1 ? route('admin.enrollee.enroll', $record->id) : route('business-office.enroll-student', $record->id)
                    ),
                    EditAction::make('edit')->color('warning'),
                    DeleteAction::make('delete'),
                ])->hidden(auth()->user()->role_id == 3),
                ActionGroup::make([
                   Action::make('view_profile')->icon('heroicon-o-eye')->color('warning')->url(
                    fn($record) => route('teacher.record', $record->id),
                   )->openUrlInNewTab(),
                    Action::make('edit')->label('Edit Records')->icon('heroicon-m-pencil-square')->color('success')->action(
                        function($record){
                            $this->info_id = $record->student_information_id;
                            $this->fname = $record->studentInformation->firstname;
                            $this->mname = $record->studentInformation->middlename;
                            $this->lname = $record->studentInformation->lastname;
                            $this->suffix = $record->studentInformation->suffix;
                            $this->dob = $record->studentInformation->birthdate;
                            $this->gender = $record->studentInformation->gender;
                            $this->age = $record->studentInformation->age;
                            $this->email = $record->studentInformation->email;

                            //guardian
                            $this->father_fname = StudentGuardian::where('student_information_id', $this->info_id)->where('relationship', 'Father')->first()->firstname;
                            $this->father_mname = StudentGuardian::where('student_information_id', $this->info_id)->where('relationship', 'Father')->first()->middlename;
                            $this->father_lname = StudentGuardian::where('student_information_id', $this->info_id)->where('relationship', 'Father')->first()->lastname;
                            $this->father_occupation = StudentGuardian::where('student_information_id', $this->info_id)->where('relationship', 'Father')->first()->occupation;
                            $this->father_contact = StudentGuardian::where('student_information_id', $this->info_id)->where('relationship', 'Father')->first()->contact_number;

                            $this->mother_fname = StudentGuardian::where('student_information_id', $this->info_id)->where('relationship', 'Mother')->first()->firstname;
                            $this->mother_mname = StudentGuardian::where('student_information_id', $this->info_id)->where('relationship', 'Mother')->first()->middlename;
                            $this->mother_lname = StudentGuardian::where('student_information_id', $this->info_id)->where('relationship', 'Mother')->first()->lastname;
                            $this->mother_occupation = StudentGuardian::where('student_information_id', $this->info_id)->where('relationship', 'Mother')->first()->occupation;
                            $this->mother_contact = StudentGuardian::where('student_information_id', $this->info_id)->where('relationship', 'Mother')->first()->contact_number;


                            $this->province = $record->studentInformation->studentAddress->province;
                            $this->municipality = $record->studentInformation->studentAddress->city;
                            $this->barangay = $record->studentInformation->studentAddress->barangay;
                            $this->street = $record->studentInformation->studentAddress->street;

                            $this->phic_number  = MedicalInformation::where('student_information_id',$this->info_id)->first()->phic_number;
                            $this->vaccine_status = MedicalInformation::where('student_information_id',$this->info_id)->first()->vaccination_status;
                            $this->vaccine_date = MedicalInformation::where('student_information_id',$this->info_id)->first()->date_of_vaccination;
                            $this->vaccine_name = MedicalInformation::where('student_information_id',$this->info_id)->first()->immunization_record;

                            $this->lrn = $record->studentInformation->educationalInformation->lrn;
                            $this->grade_level_id = $record->studentInformation->educationalInformation->gradeLevel->id;
                            $this->student_type = $record->studentInformation->educationalInformation->student_type;
                            $this->record_modal = true;
                        }
                    )
                ])->hidden(auth()->user()->role_id != 3),
            ])
            ->bulkActions([
            ])->emptyStateHeading('No Enrollee yet!')->emptyStateIcon('heroicon-s-user-plus')->emptyStateDescription('Once you write your first data, it will appear here.');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('type')->label('')
                ->options([
                    '1' => 'K-10',
                    '2' => 'Senior High School',
                ])->live()
                ]);

    }

    public function saveMedicalInfo(){
        sleep(1);
        MedicalInformation::where('student_information_id', $this->info_id)->first()->update([
            'phic_number' => $this->phic_number,
            'vaccination_status' => $this->vaccine_status,
            'date_of_vaccination' => Carbon::parse($this->vaccine_date),
            'immunization_record' => $this->vaccine_name,
        ]);
    }

    public function saveStudentInfo(){
        sleep(1);
        $data = StudentInformation::where('id', $this->info_id)->first();
        $data->update([
            'lastname' => $this->lname,
            'firstname' => $this->fname,
           'middlename' => $this->mname,
           'middlename_is_null' => $this->mname == null? true : false,
           'suffix' => $this->suffix,
            'birthdate' => Carbon::parse($this->dob),
            'gender' => $this->gender,
            'age' => $this->age,
            'email' => $this->email,
        ]);
    }

    public function saveGuardianInfo(){
        sleep(1);
        StudentGuardian::where('student_information_id', $this->info_id)->where('relationship', 'Father')->first()->update([
            'firstname' => $this->father_fname,
           'middlename' => $this->father_mname,
            'lastname' => $this->father_lname,
            'occupation' => $this->father_occupation,
            'contact_number' => $this->father_contact,
        ]);
        StudentGuardian::where('student_information_id', $this->info_id)->where('relationship', 'Mother')->first()->update([
            'firstname' => $this->mother_fname,
           'middlename' => $this->mother_mname,
            'lastname' => $this->mother_lname,
            'occupation' => $this->mother_occupation,
            'contact_number' => $this->mother_contact,
        ]);
    }

    public function saveAddressInfo(){
        sleep(1);
        StudentAddress::where('student_information_id', $this->info_id)->first()->update([
            'province' => $this->province,
            'city' => $this->municipality,
            'barangay' => $this->barangay,
           'street' => $this->street,
        ]);
    }

    public function saveEducationalInfo(){
        sleep(1);
        EducationalInformation::where('student_information_id', $this->info_id)->first()->update([
            'lrn' => $this->lrn,
            'grade_level_id' => $this->grade_level_id,
           'student_type' => $this->student_type,
        ]);
    }

    public function render()
    {
        return view('livewire.admin.enrollee-list',[
            'grade_level' => GradeLevel::all(),
        ]);
    }
}
