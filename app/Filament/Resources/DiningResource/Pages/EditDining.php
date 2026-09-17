<?php

namespace App\Filament\Resources\DiningResource\Pages;

use App\Filament\Resources\DiningResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDining extends EditRecord
{
    protected static string $resource = DiningResource::class;

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
