<?php

namespace App\Filament\Widgets;

use App\Services\AnalyticsService;
use Filament\Widgets\ChartWidget;
use Spatie\Analytics\Period;

class TopCountriesChartWidget extends ChartWidget
{
    protected ?string $heading = 'Visitors by Country';

    protected ?string $maxHeight = '300px';

    protected static ?int $sort = 3;

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
            $data = $analytics->fetchTopCountries(Period::days($days), 10);

            return [
                'datasets' => [
                    [
                        'label' => 'Visitors',
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
                            'rgba(239, 68, 68, 0.8)',
                            'rgba(107, 114, 128, 0.8)',
                        ],
                    ],
                ],
                'labels' => $data->pluck('country')->toArray(),
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
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'indexAxis' => 'y',
            'plugins' => [
                'legend' => [
                    'display' => false,
                ],
            ],
        ];
    }
}
