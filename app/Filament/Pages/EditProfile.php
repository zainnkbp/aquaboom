<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Pages\Auth\EditProfile as BaseEditProfile;

class EditProfile extends BaseEditProfile
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('avatar_url')
                    ->label('Foto Profil')
                    ->avatar()
                    ->directory('avatars')
                    ->imageEditor(),
                $this->getNameFormComponent(),
                $this->getEmailFormComponent(),
                \Filament\Forms\Components\TextInput::make('pin')
                    ->label('PIN Scanner 6 Digit')
                    ->helperText('PIN 6-digit untuk login cepat ke Scanner Tiket Gate masuk.')
                    ->numeric()
                    ->password()
                    ->revealable()
                    ->minLength(6)
                    ->maxLength(6)
                    ->visible(fn (): bool => auth()->user()?->canValidateTickets() ?? false),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
            ]);
    }
}
