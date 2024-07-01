<?php

namespace App\Livewire\Admin;

use App\Models\EducationalInformation;
use App\Models\GradeLevel;
use App\Models\MedicalInformation;
use App\Models\Shop\Product;
use App\Models\Student;
use App\Models\StudentAddress;
use App\Models\StudentGuardian;
use App\Models\StudentInformation;
use Carbon\Carbon;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class StudentsList extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

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
            ->query(Student::query())
            ->columns([
                TextColumn::make('studentInformation.lastname')->formatStateUsing(
                    function($record){
                        return strtoupper($record->studentInformation->lastname);
                    }
                )->label('LASTNAME')->searchable(),
                TextColumn::make('studentInformation.firstname')->formatStateUsing(
                    function($record){
                        return strtoupper($record->studentInformation->firstname);
                    }
                )->label('FIRSTNAME')->searchable(),
                TextColumn::make('studentInformation.middlename')->formatStateUsing(
                    function($record){
                        return strtoupper($record->studentInformation->middlename ?? 'NO MIDDLENAME');
                    }
                )->label('MIDDLENAME')->searchable(),
                TextColumn::make('id_number')->label('ID NUMBER')->searchable(),
                TextColumn::make('studentInformation.educationalInformation.lrn')->label('LRN')->searchable(),
                TextColumn::make('studentInformation.educationalInformation.gradeLevel.name')->label('GRADE LEVEL')->searchable(),
                TextColumn::make('grant_as')->label('')->searchable(),
            ])
            ->filters([

            ])
            ->actions([
                ActionGroup::make([
                    Action::make('view')->label('View Record')->color('warning')->icon('heroicon-c-link')->url(fn (Student $record): string => route('admin.students.record', $record))
                    ->openUrlInNewTab(),
                    Action::make('edit')->icon('heroicon-m-pencil-square')->color('success')->action(
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
                    ),
                    DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                // ...
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
        return view('livewire.admin.students-list',[
            'grade_level' => GradeLevel::all(),
        ]);
    }
}
