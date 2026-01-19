<?php

namespace App\Filament\Resources\Navigations\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;

class NavigationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('label')
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('url')
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('parent.label')
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('order')
                    ->numeric()
                    ->sortable(),
                \Filament\Tables\Columns\IconColumn::make('new_tab')
                    ->boolean()
                    ->sortable(),
            ])
            ->defaultSort('order', 'asc')
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
