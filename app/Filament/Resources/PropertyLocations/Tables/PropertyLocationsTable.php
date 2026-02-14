<?php

namespace App\Filament\Resources\PropertyLocations\Tables;

use App\Filament\Resources\PropertyLocations\Schemas\PropertyLocationForm;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;

class PropertyLocationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('slug')
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('parent.name')
                    ->label('Parent Location')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()
                    ->form(PropertyLocationForm::configure(...)),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->headerActions([
                CreateAction::make()
                    ->form(PropertyLocationForm::configure(...)),
            ]);
    }
}
