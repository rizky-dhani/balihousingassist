<?php

namespace App\Filament\Widgets;

use App\Services\AnalyticsService;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Spatie\Analytics\Period;

class ActiveUsersWidget extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        try {
            $analytics = app(AnalyticsService::class);
            $analyticsData = $analytics->fetchTotalVisitorsAndPageViews(Period::days(30));

            $totalVisitors = $analyticsData->sum('visitors');
            $totalPageViews = $analyticsData->sum('pageViews');

            $chartData = $analyticsData->take(7)->pluck('visitors')->toArray();
            $pageViewChartData = $analyticsData->take(7)->pluck('pageViews')->toArray();

            return [
                Stat::make('Total Visitors', number_format($totalVisitors))
                    ->description('Last 30 days')
                    ->descriptionIcon('heroicon-m-users')
                    ->chart($chartData)
                    ->color('success'),
                Stat::make('Page Views', number_format($totalPageViews))
                    ->description('Last 30 days')
                    ->descriptionIcon('heroicon-m-eye')
                    ->chart($pageViewChartData)
                    ->color('primary'),
                Stat::make('Avg. Pages/Session', $totalVisitors > 0 ? number_format($totalPageViews / $totalVisitors, 1) : '0')
                    ->description('Engagement rate')
                    ->descriptionIcon('heroicon-m-chart-bar')
                    ->color('info'),
            ];
        } catch (\Throwable $e) {
            return [
                Stat::make('Analytics Error', $e->getMessage())
                    ->description('Unable to fetch data from Google Analytics')
                    ->descriptionIcon('heroicon-m-exclamation-triangle')
                    ->color('danger'),
            ];
        }
    }
}
