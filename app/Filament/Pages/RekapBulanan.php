<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use App\Models\Presensi;

class RekapBulanan extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedChartBar;

    protected static ?string $navigationLabel = 'Rekap Bulanan';
    protected static ?string $title = 'Rekap Presensi Bulanan';

    public static function getNavigationGroup(): ?string
    {
        return 'Rekap Presensi';
    }

    // WAJIB non static
    protected string $view = 'filament.pages.rekap-bulanan';

    public $bulan;
    public $tahun;

    public function mount()
    {
        $this->bulan = now()->format('m');   // default bulan sekarang
        $this->tahun = now()->format('Y');   // default tahun sekarang
    }

    public function getRekapProperty()
    {
        return Presensi::with(['kelas', 'mapel', 'guru', 'siswa'])
            ->whereMonth('tanggal', $this->bulan)
            ->whereYear('tanggal', $this->tahun)
            ->orderBy('tanggal')
            ->orderBy('kelas_id')
            ->get();
    }
}
