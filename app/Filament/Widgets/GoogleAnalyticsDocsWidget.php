<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class GoogleAnalyticsDocsWidget extends Widget
{
    protected string $view = 'filament.widgets.google-analytics-docs-widget';

    protected int | string | array $columnSpan = 1;

    public string $docsUrl = '/docs/google-analytics';
}
