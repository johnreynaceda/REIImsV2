<?php

namespace App\Livewire\Admin;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\ExpenseCategoryTransaction;
use App\Models\Shop\Product;
use App\Models\User;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\ViewAction;
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
                CreateAction::make('create')->icon('heroicon-o-plus')->action(
                    function($record, $data){


                        $total_expenses = 0;
                        $expense = Expense::create([
                            'voucher_number' => $data['voucher_number'],
                            'name' => $data['name'],
                            'note' => $data['note'],
                            'date_of_transaction' => $data['date_of_transaction'],

                        ]);

                         foreach($data['category'] as $category){
                             ExpenseCategoryTransaction::create([
                                'expense_id' => $expense->id,
                                'expense_category_id' => $category['expense_category'],
                                'amount' => $category['amount'],
                            ]);
                            $total_expenses += $category['amount'];

                         }

                         $expense->update([
                            'total_payment' => $total_expenses,
                         ]);

                    }
                )->form([
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
                TextColumn::make('voucher_number')->label('VOUCHER NUMBER')->searchable(),
                TextColumn::make('name')->label('NAME')->searchable(),
                TextColumn::make('note')->label('NOTE')->searchable(),
                TextColumn::make('total_payment')->label('TOTAL AMOUNT')->searchable()->formatStateUsing(
                    fn($record) => '₱'.number_format($record->total_payment,2)),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                ViewAction::make('view')->label('VIEW TRANSACTION')->color('warning')->form([
                    ViewField::make('rating')
                    ->view('filament.form.expense_transactions')
                ])->modalWidth('xl')->modalHeading('TRANSACTION DETAILS'),
                DeleteAction::make('delete')
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
