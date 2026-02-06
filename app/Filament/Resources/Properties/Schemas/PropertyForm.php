<?php

namespace App\Filament\Resources\Properties\Schemas;

use App\Forms\Components\MapPicker;
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
use RalphJSmit\Filament\SEO\SEO;

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
                                    Section::make('Bedroom & Bathroom')
                                        ->schema([
                                            TextInput::make('bedroom')
                                                ->numeric()
                                                ->default(0),
                                            TextInput::make('bathroom')
                                                ->numeric()
                                                ->step(0.5)
                                                ->default(0),
                                            Section::make('Amenities')
                                                ->schema([
                                                    CheckboxList::make('amenities')
                                                        ->relationship('amenities', 'name')
                                                        ->searchable()
                                                        ->columns(4),
                                                ]),
                                        ]),
                                    Section::make('Property Location (Map)')
                                        ->description('Drag the marker or click on the map to set the exact coordinates.')
                                        ->schema([
                                            MapPicker::make('location_picker')
                                                ->label('')
                                                ->tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png')
                                                ->latitudeField('latitude')
                                                ->longitudeField('longitude')
                                                ->height('645px')
                                                ->zoom(15)
                                                ->clickable()
                                                ->draggable()
                                                ->columnSpanFull(),
                                            TextInput::make('address')
                                                ->columnSpanFull(),
                                            Grid::make(2)
                                                ->schema([
                                                    TextInput::make('latitude')
                                                        ->numeric()
                                                        ->step(0.00000001)
                                                        ->live()
                                                        ->placeholder('e.g., -8.6478'),
                                                    TextInput::make('longitude')
                                                        ->numeric()
                                                        ->step(0.00000001)
                                                        ->live()
                                                        ->placeholder('e.g., 115.1385'),
                                                ]),
                                        ]),
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
                    Step::make('SEO')
                        ->schema([
                            SEO::make(),
                        ]),
                ])->columnSpanFull(),
            ]);
    }
}
