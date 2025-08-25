<?php

namespace App\Filament\Pages;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Auth\Login as BaseLogin;

class Login extends BaseLogin
{
    public function form(Form $form): Form
    {
        return $form->schema([
            // Forms\Components\TextInput::make('username')
            //     ->label('Usuario')
            //     ->required(),

            // Forms\Components\TextInput::make('password')
            //     ->label('Contraseña')
            //     ->password()
            //     ->required(),
        ]);
    }
    public function getFormActions(): array
    {
        return [];
    }
}
