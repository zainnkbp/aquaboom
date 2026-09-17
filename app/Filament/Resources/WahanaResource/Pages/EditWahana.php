<?php

namespace App\Filament\Resources\WahanaResource\Pages;

use App\Filament\Resources\WahanaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWahana extends EditRecord
{
    protected static string $resource = WahanaResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        if (isset($data['image_url']) && (str_starts_with($data['image_url'], 'http://') || str_starts_with($data['image_url'], 'https://') || str_starts_with($data['image_url'], 'assets/'))) {
            $data['image_url'] = null;
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
