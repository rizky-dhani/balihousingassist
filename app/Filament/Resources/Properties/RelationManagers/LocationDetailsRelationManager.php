<?php

namespace App\Filament\Resources\Properties\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LocationDetailsRelationManager extends RelationManager
{
    protected static string $relationship = 'location_details';

    protected static ?string $title = 'Location Details';

    protected static ?string $recordTitleAttribute = 'address_line_1';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('address_line_1')
                    ->required()
                    ->maxLength(255),
                TextInput::make('address_line_2')
                    ->maxLength(255),
                TextInput::make('city')
                    ->required()
                    ->maxLength(255),
                TextInput::make('state')
                    ->maxLength(255),
                TextInput::make('zip_code')
                    ->maxLength(255),
                TextInput::make('country')
                    ->required()
                    ->default('Indonesia')
                    ->maxLength(255),
                TextInput::make('latitude')
                    ->numeric(),
                TextInput::make('longitude')
                    ->numeric(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('address_line_1'),
                TextColumn::make('city'),
                TextColumn::make('country'),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
