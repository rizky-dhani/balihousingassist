<?php

namespace App\Filament\Widgets;

use App\Services\AnalyticsService;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Spatie\Analytics\Period;

class TopReferrersWidget extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    protected static ?int $sort = 7;

    public ?string $filter = '30';

    protected function getTableHeading(): string
    {
        return 'Top Referrers (Last '.($this->filter ?? 30).' Days)';
    }

    protected function getFilters(): array
    {
        return [
            '7' => 'Last 7 days',
            '30' => 'Last 30 days',
            '90' => 'Last 90 days',
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(fn () => \App\Models\User::query()->where('id', 0))
            ->records(function () {
                try {
                    $days = (int) ($this->filter ?? 30);
                    $analytics = app(AnalyticsService::class);

                    return $analytics->fetchTopReferrers(Period::days($days), 15);
                } catch (\Throwable $e) {
                    return collect();
                }
            })
            ->columns([
                Tables\Columns\TextColumn::make('pageReferrer')
                    ->label('Referrer')
                    ->weight('medium')
                    ->formatStateUsing(fn ($state) => $state ?: '(Direct / None)')
                    ->copyable()
                    ->copyMessage('Referrer copied!'),
                Tables\Columns\TextColumn::make('screenPageViews')
                    ->label('Views')
                    ->badge()
                    ->color('success')
                    ->formatStateUsing(fn ($state) => number_format($state))
                    ->sortable(),
            ])
            ->paginated(false);
    }
}
