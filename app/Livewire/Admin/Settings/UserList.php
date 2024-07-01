<?php

namespace App\Livewire\Admin\Settings;

use App\Models\Shop\Product;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\HeaderActionsPosition;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class UserList extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(User::query())->headerActions([
                Action::make('user')->label('New User')->icon('heroicon-s-user-plus')->action(
                    function($record,$data){
                        User::create([
                            'name' => $data['name'],
                            'email' => $data['email'],
                            'password' => bcrypt($data['password']),
                            'role_id' => $data['role_id'],
                        ]);
                    }
                )->form([
                    TextInput::make('name'),
                    TextInput::make('email')->email(),
                    TextInput::make('password')->password(),
                    Select::make('role_id')->label('Role')->options([
                        2 => 'Business Office',
                        3 => 'Teacher'
                    ]),

                ])->modalWidth('xl'),
            ], position: HeaderActionsPosition::Bottom)
            ->columns([
                TextColumn::make('name')->label('NAME')->searchable(),
                TextColumn::make('email')->label('EMAIL')->searchable(),
                TextColumn::make('role.name')->label('ROLE')->searchable(),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                EditAction::make('edit')->label('Edit')->color('success')
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function render()
    {
        return view('livewire.admin.settings.user-list');
    }
}
