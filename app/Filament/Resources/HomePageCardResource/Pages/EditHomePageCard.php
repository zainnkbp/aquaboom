<?php

namespace App\Filament\Resources\HomePageCardResource\Pages;

use App\Filament\Resources\HomePageCardResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHomePageCard extends EditRecord
{
    protected static string $resource = HomePageCardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
