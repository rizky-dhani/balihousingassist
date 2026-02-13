<?php

namespace App\Filament\Resources\PropertyLocations\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PropertyLocationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make('General Information')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (\Filament\Schemas\Components\Utilities\Set $set, ?string $state) => $set('slug', \Illuminate\Support\Str::slug($state))),
                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true),
                        \Filament\Forms\Components\Select::make('parent_id')
                            ->relationship('parent', 'name')
                            ->searchable()
                            ->preload(),
                        TextInput::make('latitude')
                            ->numeric()
                            ->step(0.00000001),
                        TextInput::make('longitude')
                            ->numeric()
                            ->step(0.00000001),
                    ])->columns(2),

                \Filament\Schemas\Components\Section::make('SEO')
                    ->schema([
                        TextInput::make('seo_title')
                            ->label('SEO Title')
                            ->placeholder(fn ($record) => $record?->name ?? 'Defaults to Location Name')
                            ->columnSpanFull(),
                        Textarea::make('seo_description')
                            ->label('SEO Description')
                            ->placeholder('Defaults to location description')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
