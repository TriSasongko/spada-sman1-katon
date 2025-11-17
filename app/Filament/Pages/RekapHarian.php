<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use App\Models\Presensi;

class RekapHarian extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedCalendarDays;

    protected static ?string $navigationLabel = 'Rekap Harian';
    protected static ?string $title = 'Rekap Presensi Harian';

    public static function getNavigationGroup(): ?string
    {
        return 'Rekap Presensi';
    }

    // PERHATIKAN INI ↓↓↓ (non static)
    protected string $view = 'filament.pages.rekap-harian';

    public $tanggal;

    public function mount()
    {
        $this->tanggal = now()->toDateString();
    }

    public function getRekapProperty()
    {
        return Presensi::with(['kelas', 'mapel', 'guru', 'siswa'])
            ->where('tanggal', $this->tanggal)
            ->orderBy('kelas_id')
            ->orderBy('mapel_id')
            ->get();
    }
}
