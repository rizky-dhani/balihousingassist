<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\Period;

class PageViewsWidget extends ChartWidget
{
    protected ?string $heading = 'Daily Page Views';

    protected function getData(): array
    {
        try {
            $data = Analytics::fetchTotalVisitorsAndPageViews(Period::days(7));

            return [
                'datasets' => [
                    [
                        'label' => 'Page Views',
                        'data' => $data->map(fn (array $dateRow) => $dateRow['pageViews'])->toArray(),
                        'fill' => 'start',
                    ],
                ],
                'labels' => $data->map(fn (array $dateRow) => Carbon::parse($dateRow['date'])->format('D'))->toArray(),
            ];
        } catch (\Exception $e) {
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
