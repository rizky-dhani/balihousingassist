<?php

namespace App\Filament\Resources\PropertyLocations;

use App\Filament\Resources\PropertyLocations\Pages\CreatePropertyLocation;
use App\Filament\Resources\PropertyLocations\Pages\EditPropertyLocation;
use App\Filament\Resources\PropertyLocations\Pages\ListPropertyLocations;
use App\Filament\Resources\PropertyLocations\Schemas\PropertyLocationForm;
use App\Filament\Resources\PropertyLocations\Tables\PropertyLocationsTable;
use App\Models\PropertyLocation;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PropertyLocationResource extends Resource
{
    protected static ?string $model = PropertyLocation::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return PropertyLocationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PropertyLocationsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPropertyLocations::route('/'),
            'create' => CreatePropertyLocation::route('/create'),
            'edit' => EditPropertyLocation::route('/{record}/edit'),
        ];
    }
}
