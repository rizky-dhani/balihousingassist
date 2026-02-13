<?php

namespace App\Filament\Resources\PropertyLocations\Pages;

use App\Filament\Resources\PropertyLocations\PropertyLocationResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePropertyLocation extends CreateRecord
{
    protected static string $resource = PropertyLocationResource::class;

    protected function afterCreate(): void
    {
        $user = filament()->getCurrentPanel()->getAuth()->user();

        $this->record->seo()->create([
            'title' => $this->record->name,
            'description' => null,
            'author' => $user?->name,
            'robots' => 'index, follow',
        ]);
    }
}
