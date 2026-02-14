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
                TextColumn::make('bed_bath')
                    ->label('Beds/Baths')
                    ->getStateUsing(function ($record) {
                        return $record->bedroom . ' Bed / ' . $record->bathroom . ' Bath';
                    }),
                TextColumn::make('pricing')
                    ->label('Pricing')
                    ->getStateUsing(function ($record) {
                        $prices = [];
                        if ($record->price_daily) {
                            $prices[] = 'Daily: ' . number_format($record->price_daily, 0, ',', '.');
                        }
                        if ($record->price_weekly) {
                            $prices[] = 'Weekly: ' . number_format($record->price_weekly, 0, ',', '.');
                        }
                        if ($record->price_monthly) {
                            $prices[] = 'Monthly: ' . number_format($record->price_monthly, 0, ',', '.');
                        }
                        if ($record->price_yearly) {
                            $prices[] = 'Yearly: ' . number_format($record->price_yearly, 0, ',', '.');
                        }
                        return implode("\n", $prices);
                    })
                    ->html(),
                IconColumn::make('is_available')
                    ->label('Availability')
                    ->boolean(),
                IconColumn::make('is_featured')
                    ->label('Featured')
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
