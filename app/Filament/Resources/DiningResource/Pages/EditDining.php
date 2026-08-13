<?php

namespace App\Filament\Resources\DiningResource\Pages;

use App\Filament\Resources\DiningResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDining extends EditRecord
{
    protected static string $resource = DiningResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
