<?php

namespace App\Livewire;

use App\Models\ActiveSemester;
use App\Models\Enrollee;
use App\Models\GradeLevel;
use App\Models\GradeLevelFee;
use App\Models\SchoolFee;
use App\Models\SchoolYear;
use App\Models\Strand;
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
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use WireUi\Traits\Actions;

class ShsEnrollee extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;
    use Actions;


    public function table(Table $table): Table
    {
        return $table
            ->query(Enrollee::query()->whereHas('studentInformation.educationalInformation.gradeLevel', function ($query) {
                $query->where('department', 'SHS');
            }))->columns([
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
                // ...
            ])
            ->actions([
                ActionGroup::make([
                    Action::make('enroll')->label('ENROLL STUDENT')->icon("heroicon-c-academic-cap")->color('success')->action(
                        function($record){
                            $data = ActiveSemester::first()->active;
                            if ($data != '2nd Semester') {
                                $this->dialog()->info(
                                    $title = '2nd Semester has not ben changed',
                                    $description = 'Please contact the admin to update active semester.'
                                );
                            }else{
                                return redirect()->route('admin.enrollee.enroll-shs', ['id' => $record->id]);
                            }
                        }
                    ),
                    EditAction::make('edit')->color('warning'),
                    DeleteAction::make('delete'),
                ])
            ])
            ->bulkActions([
            ])->emptyStateHeading('No SHS Enrollee yet!')->emptyStateIcon('heroicon-s-user-plus')->emptyStateDescription('Once you write your first data, it will appear here.');
    }

    public function render()
    {
        return view('livewire.shs-enrollee');
    }
}
