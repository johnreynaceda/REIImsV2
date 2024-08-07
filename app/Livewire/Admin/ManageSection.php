<?php

namespace App\Livewire\Admin;

use App\Models\Student;
use App\Models\StudentSection;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
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

    public $section_id;
    public $section_name;

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

                        $already_in_section = StudentSection::where('section_id', $this->section_id)->pluck('student_id')->toArray();

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
        return view('livewire.admin.manage-section');
    }
}
