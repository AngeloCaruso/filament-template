<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StartsOverview extends BaseWidget
{
    protected function getStats(): array
{
    return [
        Stat::make('Datos iniciales', '50%')
            ->description('32k increase')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->chart([7, 2, 10, 3, 15, 12, 12])
            ->color('success'),
        Stat::make('Datos intermedios', '21%')
            ->description('7% increase')
            ->descriptionIcon('heroicon-m-arrow-trending-down')
            ->chart([7, 5, 10, 3, 15, 8, 15])
            ->color('danger'),
        Stat::make('Datos finales', '80%')
            ->description('3% increase')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->chart([7, 8, 10, 3, 15, 4, 17])
            ->color('success'),
    ];
}
}
