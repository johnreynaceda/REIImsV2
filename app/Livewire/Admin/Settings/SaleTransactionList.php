<?php

namespace App\Livewire\Admin\Settings;

use App\Models\ActiveSemester;
use App\Models\EducationalInformation;
use App\Models\PaymentTransaction;
use App\Models\SaleCategory;
use App\Models\StudentInformation;
use App\Models\StudentTransaction;
use App\Models\TransactionLog;
use Carbon\Carbon;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\HeaderActionsPosition;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class SaleTransactionList extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;


    public function table(Table $table): Table
    {
        return $table
            ->query(StudentTransaction::query())->headerActions([
                CreateAction::make('sales')->label('New Sales Transaction')->icon('heroicon-s-plus')->action(
                    function($data){

                        $department = EducationalInformation::where('student_information_id', $data['student_id'])->first()->gradeLevel->department;

                        $total = 0;
                        foreach ($data['payments'] as $key => $value) {

                           $total += $value['amount'];
                        }

                        $payment = StudentTransaction::create([
                            'student_information_id' => $data['student_id'],
                            'transaction_number' => 'TR'. Carbon::parse(now())->format('Ymd'). '000'. StudentTransaction::count() + 1,
                            'or_number' => $data['or_number'],
                            'total_amount' => $total,
                            'active_semester' => $department == 'SHS' ? ActiveSemester::first()->active : '1st Semester'
                        ]);
                        TransactionLog::create([
                            'student_transaction_id' => $payment->id,
                            'user_name' => auth()->user()->name,
                        ]);

                         foreach ($data['payments'] as $key => $value) {
                            PaymentTransaction::create([
                                'student_transaction_id' => $payment->id,
                                'sale_category_id' => $value['category'],
                                'paid_amount' => $value['amount'],

                            ]);
                         }

                         sweetalert('Added Successfully.');

                    }
                )->form([
                   Fieldset::make('...')->schema([
                    Select::make('student_id')->label('STUDENT NAME')->required()->searchable()->options(
                        StudentInformation::all()->mapWithKeys(function($record){
                            return [$record->id => strtoupper($record->lastname.', ' . $record->firstname . ' '. ($record->middlename_is_null == true ? '' : $record->middlename[0].'. '))];
                        })
                    ),
                    TextInput::make('or_number')->label('OR number')->numeric()->required()
                   ])->columns(2),
                   Fieldset::make('TRANSACTION DETAILS')->schema([
                    Repeater::make('payments')->label('')->createItemButtonLabel('Add Payment')->live()
                ->schema([
                    Select::make('category')->searchable()
                        ->options(SaleCategory::all()->pluck('name', 'id'))
                        ->required(),
                    TextInput::make('amount')->numeric(),
                ])
                ->columns(2),
                   ])->columns(1),
                ])->modalHeading('NEW TRANSACTION')
            ], position: HeaderActionsPosition::Bottom)
            ->columns([
                TextColumn::make('id')->label('STUDENT NAME')->formatStateUsing(
                    function($record){
                        if ($record->student_payment_id != null) {
                            $name = $record->studentPayment->student->studentInformation;
                            return strtoupper($name->lastname.', '. $name->firstname);
                        }else{
                            return strtoupper(($record->studentInformation->lastname ?? '').', '.($record->studentInformation->firstname ?? ''));
                        }
                    }
                ),
                TextColumn::make('or_number')->label('OR NUMBER')->searchable(),
                TextColumn::make('total_amount')->formatStateUsing(
                    function($record){
                        return '₱'.number_format($record->total_amount,2);
                    }
                )->label('TOTAL PAYMENT'),
                TextColumn::make('created_at')->date()->label('DOP'),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                ViewAction::make('view')->label('VIEW TRANSACTION')->color('warning')->form([
                    ViewField::make('rating')
                    ->view('filament.form.transactions')
                ])->modalWidth('xl')->modalHeading('TRANSACTION DETAILS'),
                EditAction::make('edit')->color('success')->action(
                    function($record, $data){
                        $record->update([
                            'or_number' => $data['or_number'],
                        ]);
                    }
                )->form([
                TextInput::make('or_number')->required(),
               ])->modalWidth('xl')->visible(auth()->user()->role_id == 1),
               DeleteAction::make('delete')->visible(auth()->user()->role_id == 1),
            ])
            ->bulkActions([
                // ...
            ])->emptyStateHeading('No Sale Transaction yet!')->emptyStateIcon('heroicon-s-document-text')->emptyStateDescription('Once you write your first data, it will appear here.');;
    }

    public function render()
    {
        return view('livewire.admin.settings.sale-transaction-list');
    }
}
