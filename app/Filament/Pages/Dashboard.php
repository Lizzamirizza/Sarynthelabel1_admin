<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use App\Filament\Widgets\SalesOverviewWidget;


class Dashboard extends BaseDashboard
{
    protected function getHeaderWidgets(): array
    {
        return [
            SalesOverviewWidget::class,
        ];
    }
}
