<?php

namespace App\Filament\Resources\GatheringEventResource\Pages;

use App\Filament\Resources\GatheringEventResource;
use Filament\Resources\Pages\CreateRecord;

class CreateGatheringEvent extends CreateRecord
{
    protected static string $resource = GatheringEventResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
