<?php

namespace App\Livewire\Admin\Enrollee;

use App\Models\EducationalInformation;
use App\Models\Enrollee;
use App\Models\GradeLevel;
use App\Models\MedicalInformation;
use App\Models\PhilippineBarangay;
use App\Models\PhilippineCity;
use App\Models\PhilippineProvince;
use App\Models\Post;
use App\Models\StudentAddress;
use App\Models\StudentGuardian;
use App\Models\StudentInformation;
use Carbon\Carbon;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Support\RawJs;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\HtmlString;
use Livewire\Component;

class NewEnrollee extends Component implements HasForms
{
    use InteractsWithForms;

    public $firstname, $middlename, $lastname, $suffix, $date_of_birth, $gender, $age, $email;

  //parents/guardian
  public $father_firstname, $father_middlename, $father_lastname, $father_occupation, $father_contact_number;
  public $mother_firstname, $mother_middlename, $mother_lastname, $mother_occupation, $mother_contact_number;

  //medical
  public $phic_number, $vaccination_status, $vaccination_date, $immunization = [], $vaccine_name;

  //educational

  public $lrn, $grade_level, $student_type;
  public $last_grade_level_completed, $last_school_year, $last_school_name, $last_school_address;



  //address
  public $province_id, $city_id, $barangay_id, $street;

  public $add_province, $add_city, $add_barangay, $add_street;

  public $no_middlename = false;



  public function updatedDateOfBirth(){
    $this->age = Carbon::parse($this->date_of_birth)->age;
  }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('ENROLLEE INFORMATION')->icon('heroicon-s-identification')
                        ->schema([
                          Grid::make(2)->schema([
                            TextInput::make('firstname')->required(),
                            ViewField::make('middlename')
                            ->view('filament.form.middlename'),
                            TextInput::make('lastname')->required(),
                            TextInput::make('suffix'),
                            DatePicker::make('date_of_birth')->reactive()->required(),
                            Select::make('gender')->label('Gender')->required()
                              ->options([
                                'Male' => 'Male',
                                'Female' => 'Female',
                              ]),
                            TextInput::make('age')->required(),
                            TextInput::make('email')->email()->required(),
                          ])
                        ]),
                    Wizard\Step::make('PARENTS/GUARDIAN')->icon('heroicon-c-user-group')
                        ->schema([

                            Section::make("Father's Information")
                            ->icon('heroicon-m-information-circle')
                            ->schema([
                                TextInput::make('father_firstname')->label('Firstname')->required(),
                                    TextInput::make('father_middlename')->label('Middlename')->hintIcon('heroicon-o-information-circle', tooltip: 'This field is not required. you can leave it blank'),
                                    TextInput::make('father_lastname')->label('Lastname')->required(),
                                    TextInput::make('father_occupation')->label('Occupation')->required(),
                                    TextInput::make('father_contact_number')->label('Contact Number')->required(),
                            ])
                            ->columns(3),
                              Section::make("Mother's Information")->icon('heroicon-m-information-circle')->schema([
                                TextInput::make('mother_firstname')->label('Firstname')->required(),
                                TextInput::make('mother_middlename')->label('Middlename')->hintIcon('heroicon-o-information-circle', tooltip: 'This field is not required. you can leave it blank'),
                                TextInput::make('mother_lastname')->label('Lastname')->required(),
                                TextInput::make('mother_occupation')->label('Occupation')->required(),
                                TextInput::make('mother_contact_number')->label('Contact Number')->required(),
                              ])->columns(3),
                        ]),
                    Wizard\Step::make('ADDRESS INFORMATION')->icon('heroicon-s-map')
                        ->schema([
                           Grid::make(2)->schema([
                            Select::make('province_id')->label('Province')->reactive()->searchable()
                            ->options(PhilippineProvince::pluck('province_description', 'province_code')),
                          Select::make('city_id')->label('City/Municipality')->reactive()
                            ->options(PhilippineCity::where('province_code', $this->province_id)->pluck('city_municipality_description', 'city_municipality_code')),
                          Select::make('barangay_id')->label('Barangay')
                            ->options(PhilippineBarangay::where('city_municipality_code', $this->city_id)->pluck('barangay_description', 'barangay_code')),
                          TextInput::make('street')->label('Street ')->required(),
                           ])
                        ]),
                        Wizard\Step::make('MEDICAL INFORMATION')->icon('heroicon-c-heart')
                        ->schema([
                           Grid::make(3)->schema([
                            TextInput::make('phic_number')->label('PHIC Number')->numeric()
                            ->mask(RawJs::make(<<<'JS'
                            '999999999999'
                        JS)),
                          Select::make('vaccination_status')->label('Vaccination Status')
                            ->options([
                              '1ST DOSE' => '1ST DOSE',
                              '2ND DOSE' => '2ND DOSE',
                              'WITH BOOSTER' => 'WITH BOOSTER',
                            ]),
                          DatePicker::make('vaccination_date'),
                        //   CheckboxList::make('immunization')->label('Immunization/Vaccination')
                        //     ->options([
                        //       'Chicken Pox (Varicella) Vaccine' => 'Chicken Pox (Varicella) Vaccine',
                        //       'Hepatitis A Vaccine (HepA)' => 'Hepatitis A Vaccine (HepA)',
                        //       'Influenza Vaccine' => 'Influenza Vaccine',
                        //       'Measles' => 'Measles',
                        //       'Mumps' => 'Mumps',
                        //       'Rubella Vaccine (MMR)' => 'Rubella Vaccine (MMR)',
                        //       'Polio Vaccine' => 'Polio Vaccine',
                        //       'Haemophilus Influenzae Type B (Hib) Vaccine' => 'Haemophilus Influenzae Type B (Hib) Vaccine',

                        //     ])
                        //     ->columns(2)
                        TextInput::make('vaccine_name')->label('Name of Vaccine')
                           ])
                        ]),
                        Wizard\Step::make('EDUCATIONAL INFORMATION')->icon('heroicon-c-academic-cap')
                        ->schema([
                           Grid::make(3)->schema([
                            TextInput::make('lrn')->label('Learners Reference Number(LRN)')->required(),
                            Select::make('grade_level')->label('Grade Level')->options(
                              GradeLevel::pluck('name', 'id')
                            )->required(),
                            Select::make('student_type')->label('Student Type')->reactive()->options([
                              'NEW' => 'NEW',
                            //   'TRANSFEREE' => 'TRANSFEREE',
                              'OLD' => 'OLD',
                            ])->required(),

                            Fieldset::make('TRANSFEREES ONLY')->schema([
                              TextInput::make('last_grade_level_completed')->label('Last Grade Level Completed')->required(),
                              TextInput::make('last_school_year')->label('School Year')->required(),
                              TextInput::make('last_school_name')->label('Name of School')->required(),
                              TextInput::make('last_school_address')->label('School Address')->required(),
                            ])->columns(2)->hidden(
                                fn() => $this->student_type != 'TRANSFEREE'
                              ),
                           ])
                        ]),
                        Wizard\Step::make('SUMMARY')->icon('heroicon-c-queue-list')
                        ->schema([
                            ViewField::make('rating')
                            ->view('filament.form.summary')
                        ]),
                ])->submitAction(view('filament.form.button'))
            ]);

    }

    public function updatedProvinceId(){
        $this->add_province = PhilippineProvince::where('province_code', $this->province_id)->first()->province_description;

    }

    public function updatedCityId(){
        $this->add_city     = PhilippineCity::where(
            'city_municipality_code',
            $this->city_id
          )->first()->city_municipality_description;

    }

    public function updatedBarangayId(){
        $this->add_barangay = PhilippineBarangay::where('barangay_code', $this->barangay_id)->first()->barangay_description;

    }

    public function updatedStreet(){
        $this->add_street  = $this->street;
    }

    public function updatedNoMiddlename(){
        if ($this->no_middlename == true) {
            $this->middlename = '';
        }else{

        }
    }

    public function submitEnrollee(){

        DB::beginTransaction();
        $info = StudentInformation::create([
            'lastname' => $this->lastname,
            'firstname' => $this->firstname,
            'middlename' => $this->middlename,
            'middlename_is_null' => $this->no_middlename == true ? true : false,
            'suffix' => $this->suffix,
            'birthdate' => Carbon::parse($this->date_of_birth),
            'gender' => $this->gender,
            'age' => $this->age,
            'email' => $this->email
        ]);

        Enrollee::create([
            'student_information_id' => $info->id,

        ]);

        $mother = StudentGuardian::create([
            'lastname' => $this->mother_lastname,
            'firstname' => $this->mother_firstname,
            'middlename' => $this->mother_middlename,
            'relationship' => 'Mother',
            'occupation' => $this->mother_occupation,
            'contact_number' => $this->mother_contact_number,
            'student_information_id' => $info->id,
        ]);
        $father = StudentGuardian::create([
            'lastname' => $this->father_lastname,
            'firstname' => $this->father_firstname,
            'middlename' => $this->father_middlename,
            'relationship' => 'Father',
            'occupation' => $this->father_occupation,
            'contact_number' => $this->father_contact_number,
            'student_information_id' => $info->id,
        ]);
        // $province = PhilippineProvince::where('province_code', $this->province_id)->first()->province_description;
        // // $city = PhilippineCity::where('city_municipality_code', )
        $province = PhilippineProvince::where('province_code', $this->province_id)->first()->province_description;
        $city     = PhilippineCity::where(
          'city_municipality_code',
          $this->city_id
        )->first()->city_municipality_description;
        $barangay = PhilippineBarangay::where('barangay_code', $this->barangay_id)->first()->barangay_description;

        StudentAddress::create([
          'student_information_id' => $info->id,
          'province' => $province,
          'city' => $city,
          'barangay' => $barangay,
          'street' => $this->street,
        ]);

        MedicalInformation::create([
          'student_information_id' => $info->id,
          'phic_number' => $this->phic_number,
          'vaccination_status' => $this->vaccination_status,
          'date_of_vaccination' => $this->vaccination_date,
          'immunization_record' => $this->vaccine_name,
        ]);

        EducationalInformation::create([

          'student_information_id' => $info->id,
          'lrn' => $this->lrn,
          'grade_level_id' => $this->grade_level,
          'student_type' => $this->student_type,
          'last_grade_completed' => $this->last_grade_level_completed,
          'last_school_year' => $this->last_school_year,
          'last_school_name' => $this->last_school_name,
          'last_school_address' => $this->last_school_address,
        ]);

        DB::commit();

        if (auth()->user()->role_id == 1) {
            return redirect()->route('admin.enrollee');
        }else{
            return redirect()->route('teacher.dashboard');
        }
    }

    public function render()
    {

        return view('livewire.admin.enrollee.new-enrollee');

    }
}
