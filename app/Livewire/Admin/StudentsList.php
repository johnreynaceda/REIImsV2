<?php

namespace App\Livewire\Admin;

use App\Models\GradeLevel;
use App\Models\Shop\Product;
use App\Models\Student;
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
                TextColumn::make('studentInformation.educationalInformation.gradeLevel.name')->label('GRADE LEVEL')->searchable()
            ])
            ->filters([

            ])
            ->actions([
                ActionGroup::make([
                    Action::make('view')->label('View Record')->color('warning')->icon('heroicon-c-link')->url(fn (Student $record): string => route('admin.students.record', $record))
                    ->openUrlInNewTab(),
                    EditAction::make(),
                    DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function render()
    {
        return view('livewire.admin.students-list');
    }
}
