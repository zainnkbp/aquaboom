<?php

namespace App\Filament\Resources\HomePageCardResource\Pages;

use App\Filament\Resources\HomePageCardResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHomePageCards extends ListRecords
{
    protected static string $resource = HomePageCardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
