<?php

namespace App\Livewire\Admin;

use App\Models\GradeLevel;
use App\Models\SchoolYear;
use App\Models\Shop\Product;
use App\Models\User;
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
use Livewire\Component;

class GradeLevelList extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(GradeLevel::query())->headerActions([
                Action::make('grade_level')->label('New Grade Level')->icon('heroicon-c-tag')->action(
                    function($record, $data){
                        GradeLevel::create([
                            'name' => $data['name'],
                            'department' => $data['department'],
                        ]);
                    }
                )->form([
                   TextInput::make('name')->required(),
                   Select::make('department')->options([
                    'K-10' => 'K-10',
                    'SHS' => 'SHS'
                   ]),
                ])->modalWidth('2xl'),
            ], position: HeaderActionsPosition::Bottom)
            ->columns([
                TextColumn::make('name')->label('NAME')->searchable(),
                TextColumn::make('department')->label('DEPARTMENT')->searchable(),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                EditAction::make('edit')->label('Edit')->color('success')->form([
                    TextInput::make('name')->required(),
                    Select::make('department')->options([
                     'K-10' => 'K-10',
                     'SHS' => 'SHS'
                    ]),
                ])->modalWidth('2xl'),
                DeleteAction::make('delete'),
            ])
            ->bulkActions([
                // ...
            ])->emptyStateHeading('No Grade Level yet!')->emptyStateIcon('heroicon-c-tag')->emptyStateDescription('Once you write your first data, it will appear here.');
    }

    public function render()
    {
        return view('livewire.admin.grade-level-list');
    }
}
