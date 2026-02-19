<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\ActiveUsersWidget;
use App\Filament\Widgets\PageViewsWidget;
use App\Filament\Widgets\TopBrowsersWidget;
use App\Filament\Widgets\TopCountriesChartWidget;
use App\Filament\Widgets\TopOperatingSystemsWidget;
use App\Filament\Widgets\TopPagesWidget;
use App\Filament\Widgets\TopReferrersWidget;
use BackedEnum;
use Filament\Pages\Page;
use UnitEnum;

class Analytics extends Page
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-chart-bar';

    protected string $view = 'filament.pages.analytics';

    protected static string|UnitEnum|null $navigationGroup = 'Site Management';

    protected static ?string $title = 'Google Analytics';

    protected static ?int $navigationSort = 1;

    public static function canAccess(): bool
    {
        return auth()->user()?->can('view_analytics') ||
               auth()->user()?->hasRole('admin') ||
               auth()->user()?->hasRole('Super Admin');
    }

    protected function getHeaderWidgets(): array
    {
        return [
            ActiveUsersWidget::class,
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            PageViewsWidget::class,
            TopCountriesChartWidget::class,
            TopBrowsersWidget::class,
            TopOperatingSystemsWidget::class,
            TopPagesWidget::class,
            TopReferrersWidget::class,
        ];
    }

    public function getFooterWidgetsColumns(): int|array
    {
        return [
            'sm' => 1,
            'md' => 2,
            'lg' => 2,
            'xl' => 2,
        ];
    }
}
