<?php

namespace App\Livewire\Admin;

use App\Models\GradeLevel;
use App\Models\SchoolYear;
use App\Models\Section;
use App\Models\Shop\Product;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\HeaderActionsPosition;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class SectionList extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(Section::query())->headerActions([
                Action::make('section')->label('New Section')->icon('heroicon-c-tag')->action(
                    function($record, $data){
                        Section::create([
                            'name' => $data['name'],
                            'grade_level_id' => $data['grade_level'],
                        ]);
                    }
                )->form([
                   TextInput::make('name')->required(),
                   Select::make('grade_level')->options(GradeLevel::all()->pluck('name', 'id')),
                ])->modalWidth('2xl'),
            ], position: HeaderActionsPosition::Bottom)
            ->columns([
                TextColumn::make('name')->label('NAME')->searchable(),
                TextColumn::make('gradeLevel.name')->label('GRADE LEVEL')->searchable(),
                TextColumn::make('id')->label('NO. OF STUDENTS')->searchable()->formatStateUsing(
                    fn($record) => $record->studentSections->count()
                ),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                Action::make('view')->label('View Students')->button()->icon('heroicon-o-eye')->url(fn (Section $record): string => route('admin.sections.manage', $record))
                ->openUrlInNewTab(),
                ActionGroup::make([
                    EditAction::make('edit')->label('Edit')->color('success')->form([
                        TextInput::make('name')->required(),
                       Select::make('grade_level_id')->label('Grade Level')->options(GradeLevel::all()->pluck('name', 'id')),
                    ])->modalWidth('2xl'),
                    DeleteAction::make('delete'),
                ])
            ])
            ->bulkActions([
                // ...
            ])->emptyStateHeading('No Section yet!')->emptyStateIcon('heroicon-c-tag')->emptyStateDescription('Once you add your first data, it will appear here.');
    }
    public function render()
    {
        return view('livewire.admin.section-list');
    }
}
