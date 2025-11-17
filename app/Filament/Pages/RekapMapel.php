<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use App\Models\Presensi;
use App\Models\Mapel;

class RekapMapel extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedBookOpen;

    protected static ?string $navigationLabel = 'Rekap Mapel';
    protected static ?string $title = 'Rekap Presensi per Mapel';

    public static function getNavigationGroup(): ?string
    {
        return 'Rekap Presensi';
    }

    // penting → non-static
    protected string $view = 'filament.pages.rekap-mapel';

    public $tanggal;
    public $mapel_id;

    public $mapels;

    public function mount()
    {
        $this->tanggal = now()->toDateString();
        $this->mapels = Mapel::orderBy('nama_mapel')->get();
    }

    public function getRekapProperty()
    {
        return Presensi::with(['kelas', 'mapel', 'guru', 'siswa'])
            ->when($this->mapel_id, fn ($q) => $q->where('mapel_id', $this->mapel_id))
            ->when($this->tanggal, fn ($q) => $q->where('tanggal', $this->tanggal))
            ->orderBy('kelas_id')
            ->get();
    }
}
