<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ResourceOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 0;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Pengguna', '1.2K')
                ->description('32k peningkatan dalam 7 hari')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Total Postingan', '192')
                ->description('7% penurunan dalam 7 hari')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),
            Stat::make('Kunjungan Hari Ini', '3.4K')
                ->description('Kunjungan tertinggi')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('info'),
        ];
    }
}
