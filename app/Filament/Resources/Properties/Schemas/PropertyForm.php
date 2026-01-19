<?php

namespace App\Filament\Resources\Properties\Schemas;

use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;

class PropertyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    Step::make('Basic Information')
                        ->schema([
                            TextInput::make('name')
                                ->columnSpanFull()
                                ->required(),
                            Select::make('property_category_id')
                                ->relationship('category', 'name')
                                ->required(),
                            Select::make('property_location_id')
                                ->relationship('location', 'name')
                                ->searchable()
                                ->preload()
                                ->required(),
                            Textarea::make('description')
                                ->default(null)
                                ->columnSpanFull(),
                        ])->columns(2),
                    Step::make('Details & Amenities')
                        ->schema([
                            Grid::make(2)
                                ->schema([
                                    TextInput::make('bedroom')
                                        ->numeric()
                                        ->default(0),
                                    TextInput::make('bathroom')
                                        ->numeric()
                                        ->step(0.1)
                                        ->default(0),
                                ]),
                            Section::make('Amenities')
                                ->schema([
                                    CheckboxList::make('amenities')
                                        ->relationship('amenities', 'name')
                                        ->searchable()
                                        ->columns(4),
                                ]),
                        ]),
                    Step::make('Pricing & Images')
                        ->schema([
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
                                ]),
                            FileUpload::make('images')
                                ->multiple()
                                ->reorderable()
                                ->image()
                                ->directory('properties')
                                ->columnSpanFull(),
                            Toggle::make('is_available')
                                ->required(),
                        ]),
                ])->columnSpanFull(),
            ]);
    }
}
