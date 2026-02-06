<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\Period;

class ActiveUsersWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        try {
            $analyticsData = Analytics::fetchTotalVisitorsAndPageViews(Period::days(7));

            $totalVisitors = $analyticsData->sum('visitors');
            $totalPageViews = $analyticsData->sum('pageViews');

            // For real-time active users (last 30 mins)
            // GA4 API via Spatie Analytics has some limitations on real-time,
            // but we can at least show trends.

            return [
                Stat::make('Total Visitors', number_format($totalVisitors))
                    ->description('Last 7 days')
                    ->descriptionIcon('heroicon-m-users')
                    ->chart([7, 3, 4, 5, 6, 3, 5, 2])
                    ->color('success'),
                Stat::make('Page Views', number_format($totalPageViews))
                    ->description('Last 7 days')
                    ->descriptionIcon('heroicon-m-eye')
                    ->color('primary'),
            ];
        } catch (\Exception $e) {
            return [
                Stat::make('Analytics', 'Not Configured')
                    ->description('Please check your .env settings')
                    ->color('danger'),
            ];
        }
    }
}
