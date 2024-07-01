<?php

namespace App\Livewire\Admin;

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
                   Action::make('view_profile')->icon('heroicon-o-eye')->color('warning'),
                   EditAction::make('edit')->label('Edit Record')->color('success')->form([

                   ])->modalWidth('3xl'),
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

    public function render()
    {
        return view('livewire.admin.enrollee-list');
    }
}
