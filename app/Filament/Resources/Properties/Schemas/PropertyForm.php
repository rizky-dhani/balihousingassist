<?php

namespace App\Filament\Resources\Properties\Schemas;

use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PropertyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->columnSpanFull()
                    ->required(),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('type')
                    ->required(),
                TextInput::make('location')
                    ->required(),
                TextInput::make('bedroom')
                    ->numeric()
                    ->default(0),
                TextInput::make('bathroom')
                    ->numeric()
                    ->step(0.1)
                    ->default(0),
                Textarea::make('address')
                    ->default(null)
                    ->columnSpanFull(),
                Grid::make(2)
                    ->columnSpanFull()
                    ->schema([
                        Section::make('Amenities')
                            ->schema([
                                CheckboxList::make('')
                                    ->relationship('amenities', 'name')
                                    ->searchable()
                                    ->columns(2),
                            ]),
                        Section::make('Pricing')
                            ->columns(2)
                            ->schema([
                                TextInput::make('price_daily')
                                    ->label('Daily')
                                    ->numeric()
                                    ->default(null),
                                TextInput::make('price_weekly')
                                    ->label('Weekly')
                                    ->numeric()
                                    ->default(null),
                                TextInput::make('price_monthly')
                                    ->label('Monthly')
                                    ->numeric()
                                    ->default(null),
                                TextInput::make('price_yearly')
                                    ->label('Yearly')
                                    ->numeric()
                                    ->default(null),
                            ])
                    ]),
                FileUpload::make('images')
                    ->multiple()
                    ->reorderable()
                    ->image()
                    ->directory('properties')
                    ->columnSpanFull(),
                Toggle::make('is_available')
                    ->required(),
            ]);
    }
}
