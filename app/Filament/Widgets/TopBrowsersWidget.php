<?php

namespace App\Filament\Widgets;

use App\Services\AnalyticsService;
use Filament\Widgets\ChartWidget;
use Spatie\Analytics\Period;

class TopBrowsersWidget extends ChartWidget
{
    protected ?string $heading = 'Browsers';

    protected ?string $maxHeight = '250px';

    protected static ?int $sort = 4;

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
            $data = $analytics->fetchTopBrowsers(Period::days($days), 8);

            return [
                'datasets' => [
                    [
                        'data' => $data->pluck('screenPageViews')->toArray(),
                        'backgroundColor' => [
                            'rgba(59, 130, 246, 0.8)',
                            'rgba(16, 185, 129, 0.8)',
                            'rgba(249, 115, 22, 0.8)',
                            'rgba(139, 92, 246, 0.8)',
                            'rgba(236, 72, 153, 0.8)',
                            'rgba(20, 184, 166, 0.8)',
                            'rgba(245, 158, 11, 0.8)',
                            'rgba(99, 102, 241, 0.8)',
                        ],
                    ],
                ],
                'labels' => $data->pluck('browser')->toArray(),
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
        return 'doughnut';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'position' => 'right',
                ],
            ],
        ];
    }
}
