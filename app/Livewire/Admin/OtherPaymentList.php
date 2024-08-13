<?php

namespace App\Livewire\Admin;

use App\Models\GradeLevel;
use App\Models\OtherPayment;
use App\Models\OtherPaymentStudent;
use App\Models\SaleCategory;
use App\Models\Student;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\Action;
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

class OtherPaymentList extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(OtherPayment::query())->headerActions([
                CreateAction::make('category')->label('New Other Payments')->icon('heroicon-s-plus')->action(
                    function($record, $data){
                        OtherPayment::create([
                            'sale_category_id' => $data['sale_category_id'],
                            'amount' => $data['amount'],
                            'grade_level' => json_encode(array_map('intval', $data['grade_level'])),
                        ]);
                    }
                )->form([
                    Select::make('sale_category_id')->label('Sale Category')->options(SaleCategory::all()->pluck('name', 'id')),
                    TextInput::make('amount')->label('Amount')->required()->numeric(),
                    Select::make('grade_level')->options(GradeLevel::all()->pluck('name', 'id'))->multiple(),
                ])->modalWidth('xl')
            ], position: HeaderActionsPosition::Bottom)
            ->columns([
                TextColumn::make('id')->label('SALE CATEGORY')->formatStateUsing(
                    function($record){
                        return strtoupper($record->saleCategory->name);
                    }
                ),
                TextColumn::make('amount')->label('AMOUNT')->formatStateUsing(
                    function($record){
                        return '₱'.number_format($record->amount,2);
                    }
                ),
                TextColumn::make('grade_level')->label('GRADE LEVEL')->words(5)->formatStateUsing(
                    function($record){
                        $gradeLevels = $record->grade_level;

                         $gradeLevelNames = GradeLevel::whereIn('id', json_decode($gradeLevels))->pluck('name')->toArray();
                         return implode(', ', $gradeLevelNames);
                    }
                ),

            ])
            ->filters([
                // ...
            ])
            ->actions([
                Action::make('view_students')->color('success')->icon('heroicon-o-eye')->button()->url(fn (OtherPayment $record): string => route('admin.other-payment-students', $record))
                ->openUrlInNewTab(),
                Action::make('view')->label('Assign Students')->button()->action(
                    function($record, $data){
                       foreach ($data['student_id'] as $key => $value) {
                            OtherPaymentStudent::create([
                                'other_payment_id' => $record->id,
                                'student_id' => $value,
                            ]);
                       }
                    }
                )->form([
                    Select::make('student_id')->label('Student')->multiple()->searchable()->options(
                        function($record){
                            $student_ids = OtherPaymentStudent::where('other_payment_id', $record->id)->pluck('student_id')->toArray();

                           $students = Student::whereNotIn('id', $student_ids)->get();

                           return $students->mapWithKeys(function($record){
                            return [$record->id => strtoupper($record->studentInformation->lastname.', '. $record->studentInformation->firstname)];
                           });
                        }
                    )
                ]),
               DeleteAction::make('delete'),
            ])
            ->bulkActions([
                // ...
            ])->emptyStateHeading('No Other Payments yet!')->emptyStateIcon('heroicon-s-document-text')->emptyStateDescription('Once you write your first data, it will appear here.');;
    }

    public function render()
    {
        return view('livewire.admin.other-payment-list');
    }
}
