<?php

namespace App\Livewire\Admin;

use App\Models\PaymentTerms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\ToggleColumn;
use Livewire\Component;
use App\Models\ActiveSemester as Semester;
use App\Models\Shop\Product;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;

class ActiveSemester extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public $active;
    public $terms;

    public function table(Table $table): Table
    {
        return $table
            ->query(PaymentTerms::query())->headerActions([
                CreateAction::make('create')->form([
                    TextInput::make('terms')->numeric()->required(),
                    Toggle::make('is_active')
                ])->modalWidth('xl')
            ])
            ->columns([
                TextColumn::make('terms')->label('TERMS'),
                ToggleColumn::make('is_active')->label('IS ACTIVE'),
            ])
            ->filters([
                // ...
            ])
            ->actions([
               DeleteAction::make('delete')
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function updatedActive(){
        Semester::first()->update([
            'active' => $this->active
        ]);
    }

    public function render()
    {
        $this->active = Semester::first()->active;


        return view('livewire.admin.active-semester');
    }
}
