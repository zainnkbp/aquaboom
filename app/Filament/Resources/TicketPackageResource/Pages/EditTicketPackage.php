<?php

namespace App\Filament\Resources\TicketPackageResource\Pages;

use App\Filament\Resources\TicketPackageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTicketPackage extends EditRecord
{
    protected static string $resource = TicketPackageResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        foreach (['image_url', 'banner_image'] as $key) {
            if (isset($data[$key]) && (str_starts_with($data[$key], 'http://') || str_starts_with($data[$key], 'https://') || str_starts_with($data[$key], 'assets/'))) {
                $data[$key] = null;
            }
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
