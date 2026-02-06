<?php

namespace App\Filament\Resources\PropertyLocations\Schemas;

use Filament\Schemas\Schema;
use RalphJSmit\Filament\SEO\SEO;

class PropertyLocationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make('General Information')
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        \Filament\Forms\Components\Select::make('parent_id')
                            ->relationship('parent', 'name')
                            ->searchable()
                            ->preload(),
                    ])->columns(2),

                \Filament\Schemas\Components\Section::make('SEO')
                    ->schema([
                        SEO::make(),
                    ]),
            ]);
    }
}
