<?php

namespace App\Filament\Resources\Properties\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PropertiesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('slug')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('category.name')
                    ->label('Category')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('location.city')
                    ->label('Location')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('bedroom')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('bathroom')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('price_daily')
                    ->money('IDR', locale: 'id')
                    ->sortable(),
                TextColumn::make('price_weekly')
                    ->money('IDR', locale: 'id')
                    ->sortable(),
                TextColumn::make('price_monthly')
                    ->money('IDR', locale: 'id')
                    ->sortable(),
                TextColumn::make('price_yearly')
                    ->money('IDR', locale: 'id')
                    ->sortable(),
                IconColumn::make('is_available')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
