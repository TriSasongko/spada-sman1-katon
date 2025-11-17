<?php

namespace App\Filament\Widgets;

use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Materi;
use App\Models\Pengumuman;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Guru', Guru::count())
                ->description('Jumlah total guru terdaftar')
                ->color('primary'),
            Stat::make('Total Siswa', Siswa::count())
                ->description('Jumlah total siswa terdaftar')
                ->color('success'),
            Stat::make('Total Pengumuman', Pengumuman::count())
                ->description('Jumlah total pengumuman yang dipublikasikan')
                ->color('warning'),
        ];
    }
}
