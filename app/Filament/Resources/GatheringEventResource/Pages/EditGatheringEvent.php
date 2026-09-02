<?php

namespace App\Filament\Resources\GatheringEventResource\Pages;

use App\Filament\Resources\GatheringEventResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGatheringEvent extends EditRecord
{
    protected static string $resource = GatheringEventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
