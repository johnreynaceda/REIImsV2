<?php

namespace App\Livewire\Admin;

use App\Models\GradeLevel;
use App\Models\GradeLevelFee;
use App\Models\PaymentTransaction;
use App\Models\SchoolFee;
use App\Models\Strand;
use App\Models\StudentPayment;
use App\Models\StudentTransaction;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
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

class SchoolFeeList extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(SchoolFee::query())->headerActions([
            CreateAction::make('school_fee')->label('New School Fee')->icon('heroicon-s-squares-plus')->action(
                function($record, $data){



                 $fee =   SchoolFee::create([
                    'name' => $data['name'],
                    'amount' => $data['amount'],
                    'description' => $data['description'],
                   ]);

                   if ($data['is_assign'] == true) {
                     foreach (GradeLevel::all() as $key => $value) {
                        GradeLevelFee::create([
                            'school_fee_id' => $fee->id,
                            'grade_level_id' => $value->id
                        ]);
                     }

                   }else{
                    foreach ($data['grade_level_id'] as $key => $value) {
                        GradeLevelFee::create([
                           'school_fee_id' => $fee->id,
                            'grade_level_id' => $value,
                            'strand_id' => $data['strand'] != null ? $data['strand'] : null,
                        ]);
                    }
                   }

                }
            )->form(
                function ($data) {
                    return [
                        Grid::make(2)->schema([
                            TextInput::make('name')->required(),
                            TextInput::make('amount')->numeric()->required()->prefix('₱')->placeholder('0.00'),
                            Textarea::make('description')->required()->columnSpan(2),
                            Toggle::make('is_assign')->label('Assign to all Grade level')->onIcon('heroicon-m-bolt')->onColor('success')->offColor('danger')->offIcon('heroicon-m-user-plus')->columnSpan(2),
                            CheckboxList::make('grade_level_id')->label('Grade Levels')
                                ->options(GradeLevel::pluck('name', 'id'))
                                ->columns(4)->columnSpan(2),
                            Select::make('strand')->options(
                                Strand::all()->pluck('name', 'id'),
                            )
                        ]),
                    ];
                }
            ),
        ], position: HeaderActionsPosition::Bottom)
            ->columns([
                TextColumn::make('name')->label('NAME')->searchable()->formatStateUsing(
                    function($record){
                        return strtoupper($record->name);
                    }
                ),
                TextColumn::make('description')->label('DESCRIPTION')->searchable(),
                TextColumn::make('amount')->label('AMOUNT')->formatStateUsing(
                    function($record){
                        return '₱'.number_format($record->amount,2);
                    }
                )->searchable(),
                TextColumn::make('grade_level_fees.grade_level.name')->label('ASSIGNED GRADE LEVEL')->searchable()->words(6),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                EditAction::make('edit')->label('Edit')->color('success')->action(
                    function($record,$data){
                        $grade_level = [];

                        if ($record->name == 'Books') {
                           foreach ($record->grade_level_fees as $key => $value) {
                            $grade_level[] = $value->grade_level_id;
                        }

                        $students = StudentPayment::whereHas('student', function($s) use ($grade_level){
                            $s->whereHas('studentInformation', function($i) use ($grade_level){
                                $i->whereHas('educationalInformation', function($e) use ($grade_level){
                                    $e->whereIn('grade_level_id', $grade_level);
                                });
                            });
                        })->get();

                        foreach ($students as $key => $value)  {
                          $value->update([
                            'total_book' => ($data['amount'] - $value->total_book),
                            'book_fee_updated' => true,
                            'total_payables' => $value->total_payables + ($data['amount'] - $value->total_book),
                          ]);
                          $record->update([
                            'amount' => $data['amount'],
                          ]);
                        }
                        }else{
                            $record->update([
                                'amount' => $data['amount'],
                              ]);
                        }



                    }
                )->form([
                    TextInput::make('name')->required(),
                    TextInput::make('amount')->numeric()->required()->prefix('₱')->placeholder('0.00'),
                    Textarea::make('description')->required()->columnSpan(2),

            ])->modalWidth('xl'),
                DeleteAction::make('delete'),
            ])
            ->bulkActions([
                // ...
            ])->emptyStateHeading('No School Fee yet!')->emptyStateIcon('heroicon-s-squares-plus')->emptyStateDescription('Once you write your first data, it will appear here.');
    }

    public function render()
    {
        return view('livewire.admin.school-fee-list');
    }
}
