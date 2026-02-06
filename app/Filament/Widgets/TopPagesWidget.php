<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\Period;

class TopPagesWidget extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    protected static ?string $heading = 'Most Visited Pages (Last 7 Days)';

    public function table(Table $table): Table
    {
        return $table
            ->query(fn () => \App\Models\User::query()->where('id', 0)) // Satisfy the requirement for a query
            ->records(function () {
                try {
                    return Analytics::fetchMostVisitedPages(Period::days(7), 10);
                } catch (\Exception $e) {
                    return collect();
                }
            })
            ->columns([
                Tables\Columns\TextColumn::make('pageTitle')
                    ->label('Page Title'),
                Tables\Columns\TextColumn::make('pagePath')
                    ->label('URL'),
                Tables\Columns\TextColumn::make('screenPageViews')
                    ->label('Views')
                    ->badge()
                    ->color('info'),
            ])
            ->paginated(false);
    }
}
