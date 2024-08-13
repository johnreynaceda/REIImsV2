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

class OtherPaymentStudentList extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public $otherPaymentId;

    public function mount(){
        $this->otherPaymentId = request('id');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(OtherPaymentStudent::query()->where('other_payment_id', $this->otherPaymentId))->columns([
                TextColumn::make('student.student_information_id')->label('STUDENT NAME')->formatStateUsing(
                    fn($record) => $record->student->studentInformation->lastname. ', '. $record->student->studentInformation->firstname
                ),



            ])
            ->filters([
                // ...
            ])
            ->actions([
               DeleteAction::make('delete'),
            ])
            ->bulkActions([
                // ...
            ])->emptyStateHeading('No Assigned Students yet!')->emptyStateIcon('heroicon-s-document-text')->emptyStateDescription('Once you assign a student, it will appear here.');;
    }

    public function render()
    {
        return view('livewire.admin.other-payment-student-list');
    }
}
