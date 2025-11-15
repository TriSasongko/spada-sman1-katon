<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\ForumTopic;
use App\Models\Pertemuan; // Import the new model
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ResourceOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 0;

    protected function getStats(): array
    {
        // Fetch real data from the database
        $totalUsers = User::count();
        $totalTopics = ForumTopic::count();
        $totalPertemuan = Pertemuan::count(); // New metric

        return [
            Stat::make('Total Pengguna', $totalUsers)
                ->description('Jumlah total pengguna terdaftar')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('success'),
            Stat::make('Total Postingan Forum', $totalTopics)
                ->description('Jumlah total topik forum yang dibuat')
                ->descriptionIcon('heroicon-m-chat-bubble-left-right')
                ->color('danger'),
            Stat::make('Total Pertemuan', $totalPertemuan) // Replaced metric
                ->description('Jumlah total pertemuan yang telah dijadwalkan')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('info'),
        ];
    }
}
