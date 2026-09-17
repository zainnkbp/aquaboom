<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        if (isset($data['avatar_url']) && (str_starts_with($data['avatar_url'], 'http://') || str_starts_with($data['avatar_url'], 'https://') || str_starts_with($data['avatar_url'], 'assets/'))) {
            $data['avatar_url'] = null;
        }

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
