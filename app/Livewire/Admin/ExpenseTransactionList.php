<?php

namespace App\Livewire\Admin;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\Shop\Product;
use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ExpenseTransactionList extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(Expense::query())->headerActions([
                CreateAction::make('create')->icon('heroicon-o-plus')->form([
                    Grid::make(3)->schema([
                        TextInput::make('voucher_number')->required()->prefix('#'),
                        DatePicker::make('date_of_transaction')->required(),
                    ]),
                    Fieldset::make('')->schema([
                        TextInput::make('name')->required(),
                        Textarea::make('note')->required(),
                        Repeater::make('category')->label('Category Selection')
                    ->schema([
                        Select::make('expense_category')
                            ->options(ExpenseCategory::all()->pluck('name', 'id'))->searchable()
                            ->required(),
                            TextInput::make('amount')->numeric()->required()->prefix('₱'),
                    ])
                    ->columns(2)
                    ])->columns(1)
                ])
            ])
            ->columns([
                TextColumn::make('name'),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                // ...
            ])
            ->bulkActions([
                // ...
            ]);
    }
    public function render()
    {
        return view('livewire.admin.expense-transaction-list');
    }
}
