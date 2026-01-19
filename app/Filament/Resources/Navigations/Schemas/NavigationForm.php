<?php

namespace App\Filament\Resources\Navigations\Schemas;

use Filament\Schemas\Schema;

class NavigationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make()
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('label')
                            ->required()
                            ->maxLength(255),
                        \Filament\Forms\Components\TextInput::make('url')
                            ->maxLength(255),
                        \Filament\Forms\Components\Select::make('parent_id')
                            ->relationship('parent', 'label')
                            ->searchable()
                            ->preload(),
                        \Filament\Forms\Components\TextInput::make('order')
                            ->numeric()
                            ->default(0),
                        \Filament\Forms\Components\Toggle::make('new_tab')
                            ->label('Open in new tab'),
                    ]),
            ]);
    }
}
