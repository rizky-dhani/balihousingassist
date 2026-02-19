<?php

namespace App\Filament\Widgets;

use App\Services\AnalyticsService;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Spatie\Analytics\Period;

class PageViewsWidget extends ChartWidget
{
    protected ?string $heading = 'Visitors & Page Views';

    protected ?string $maxHeight = '300px';

    protected static ?int $sort = 2;

    public ?string $filter = '30';

    protected function getFilters(): array
    {
        return [
            '7' => 'Last 7 days',
            '30' => 'Last 30 days',
            '90' => 'Last 90 days',
        ];
    }

    protected function getData(): array
    {
        try {
            $days = (int) ($this->filter ?? 30);
            $analytics = app(AnalyticsService::class);
            $data = $analytics->fetchTotalVisitorsAndPageViews(Period::days($days));

            return [
                'datasets' => [
                    [
                        'label' => 'Visitors',
                        'data' => $data->pluck('visitors')->toArray(),
                        'borderColor' => 'rgb(59, 130, 246)',
                        'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                        'fill' => true,
                        'tension' => 0.4,
                    ],
                    [
                        'label' => 'Page Views',
                        'data' => $data->pluck('pageViews')->toArray(),
                        'borderColor' => 'rgb(16, 185, 129)',
                        'backgroundColor' => 'rgba(16, 185, 129, 0.1)',
                        'fill' => true,
                        'tension' => 0.4,
                    ],
                ],
                'labels' => $data->map(fn (array $row) => Carbon::parse($row['date'])->format('M j'))->toArray(),
            ];
        } catch (\Throwable $e) {
            return [
                'datasets' => [],
                'labels' => [],
            ];
        }
    }

    protected function getType(): string
    {
        return 'line';
    }
}
