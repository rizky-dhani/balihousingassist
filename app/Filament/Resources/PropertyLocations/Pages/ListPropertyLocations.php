<?php

namespace App\Filament\Resources\PropertyLocations\Pages;

use App\Filament\Resources\PropertyLocations\PropertyLocationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPropertyLocations extends ListRecords
{
    protected static string $resource = PropertyLocationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
