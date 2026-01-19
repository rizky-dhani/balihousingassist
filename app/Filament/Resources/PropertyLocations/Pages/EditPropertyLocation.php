<?php

namespace App\Filament\Resources\PropertyLocations\Pages;

use App\Filament\Resources\PropertyLocations\PropertyLocationResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPropertyLocation extends EditRecord
{
    protected static string $resource = PropertyLocationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
