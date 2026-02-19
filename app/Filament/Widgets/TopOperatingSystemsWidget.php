<?php

namespace App\Filament\Widgets;

use App\Services\AnalyticsService;
use Filament\Widgets\ChartWidget;
use Spatie\Analytics\Period;

class TopOperatingSystemsWidget extends ChartWidget
{
    protected ?string $heading = 'Operating Systems';

    protected ?string $maxHeight = '250px';

    protected static ?int $sort = 5;

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
            $data = $analytics->fetchTopOperatingSystems(Period::days($days), 6);

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
                        ],
                    ],
                ],
                'labels' => $data->pluck('operatingSystem')->toArray(),
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
