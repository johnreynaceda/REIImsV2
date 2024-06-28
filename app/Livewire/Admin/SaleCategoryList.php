<?php

namespace App\Livewire\Admin;

use App\Models\SaleCategory;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\HeaderActionsPosition;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class SaleCategoryList extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;


    public function table(Table $table): Table
    {
        return $table
            ->query(SaleCategory::query())->headerActions([
                CreateAction::make('category')->label('New Sale Category')->icon('heroicon-s-plus')->form([
                    TextInput::make('name')->required(),
                ])->modalWidth('xl')
            ], position: HeaderActionsPosition::Bottom)
            ->columns([
                TextColumn::make('name')->formatStateUsing(
                    function($record){
                        return strtoupper($record->name);
                    }
                ),
            ])
            ->filters([
                // ...
            ])
            ->actions([
               EditAction::make('edit')->color('success')->form([
                TextInput::make('name')->required(),
               ])->modalWidth('xl'),
               DeleteAction::make('delete'),
            ])
            ->bulkActions([
                // ...
            ])->emptyStateHeading('No Sale Category yet!')->emptyStateIcon('heroicon-s-document-text')->emptyStateDescription('Once you write your first data, it will appear here.');;
    }

    public function render()
    {
        return view('livewire.admin.sale-category-list');
    }
}
