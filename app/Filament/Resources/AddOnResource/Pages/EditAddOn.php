<?php

namespace App\Filament\Resources\AddOnResource\Pages;

use App\Filament\Resources\AddOnResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAddOn extends EditRecord
{
    protected static string $resource = AddOnResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        if (isset($data['image']) && (str_starts_with($data['image'], 'http://') || str_starts_with($data['image'], 'https://') || str_starts_with($data['image'], 'assets/'))) {
            $data['image'] = null;
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
