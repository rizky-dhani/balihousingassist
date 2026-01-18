<?php

namespace App\Filament\Resources\Properties\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PropertyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('type')
                    ->required(),
                TextInput::make('location')
                    ->required(),
                Textarea::make('address')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('price_daily')
                    ->numeric()
                    ->default(null),
                TextInput::make('price_weekly')
                    ->numeric()
                    ->default(null),
                TextInput::make('price_monthly')
                    ->numeric()
                    ->default(null),
                TextInput::make('price_yearly')
                    ->numeric()
                    ->default(null),
                Toggle::make('is_available')
                    ->required(),
            ]);
    }
}
