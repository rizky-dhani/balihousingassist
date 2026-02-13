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

    protected function mutateFormDataBeforeFill(array $data): array
    {
        if ($this->record->seo) {
            $data['seo_title'] = $this->record->seo->title;
            $data['seo_description'] = $this->record->seo->description;
        }

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $user = filament()->getCurrentPanel()->getAuth()->user();
        
        $seoData = [
            'title' => $data['seo_title'] ?? $this->record->name,
            'description' => $data['seo_description'] ?? null,
            'author' => $user?->name,
            'robots' => 'index, follow',
        ];

        $this->record->seo()->updateOrCreate([], $seoData);

        unset($data['seo_title'], $data['seo_description']);

        return $data;
    }
}
