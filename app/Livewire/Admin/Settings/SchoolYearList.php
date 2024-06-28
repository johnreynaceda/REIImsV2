<?php

namespace App\Livewire\Admin\Settings;

use App\Models\SchoolYear;
use App\Models\Shop\Product;
use App\Models\User;
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

class SchoolYearList extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(SchoolYear::query())->headerActions([
                Action::make('school_year')->label('New School Year')->icon('heroicon-m-calendar-days')->action(
                    function($record, $data){
                        SchoolYear::create([
                            'year' => $data['year'],
                        ]);
                    }
                )->form([
                    TextInput::make('year'),
                ])->modalWidth('xl'),
            ], position: HeaderActionsPosition::Bottom)
            ->columns([
                TextColumn::make('year')->label('SCHOOL YEAR')->searchable(),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                EditAction::make('edit')->label('Edit')->color('success'),
                DeleteAction::make('delete'),
            ])
            ->bulkActions([
                // ...
            ])->emptyStateHeading('No School Year yet!')->emptyStateIcon('heroicon-m-calendar-days')->emptyStateDescription('Once you write your first data, it will appear here.');
    }

    public function render()
    {
        return view('livewire.admin.settings.school-year-list');
    }
}
