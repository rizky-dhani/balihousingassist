<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\ActiveUsersWidget;
use App\Filament\Widgets\GoogleAnalyticsDocsWidget;
use App\Filament\Widgets\PageViewsWidget;
use App\Filament\Widgets\TopPagesWidget;
use BackedEnum;
use Filament\Pages\Page;
use UnitEnum;

class Analytics extends Page
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-presentation-chart-line';

    protected string $view = 'filament.pages.analytics';

    protected static string|UnitEnum|null $navigationGroup = 'Site Management';

    public static function canAccess(): bool
    {
        return auth()->user()?->can('view_analytics') ||
               auth()->user()?->hasRole('admin') ||
               auth()->user()?->hasRole('Super Admin');
    }

    protected function getHeaderWidgets(): array
    {
        return [
            GoogleAnalyticsDocsWidget::class,
            ActiveUsersWidget::class,
            PageViewsWidget::class,
            TopPagesWidget::class,
        ];
    }
}