<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use App\Models\Presensi;
use App\Models\Mapel;
use App\Models\Kelas;
use App\Models\Siswa;

class RekapPresensi extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedChartBar;
    protected static ?string $navigationLabel = 'Rekap Presensi';
    protected static ?string $title = 'Rekap Presensi';

    public static function getNavigationGroup(): ?string
    {
        return 'Rekap';
    }

    protected string $view = 'filament.pages.rekap-presensi';

    // MODE
    public $mode = 'tanggal';

    // FILTER
    public $tanggal;
    public $bulan;
    public $tahun;
    public $mapel_id;
    public $kelas_id;
    public $siswa_id;

    // Data tambahan (dropdown dynamic)
    public $mapels;
    public $kelasList;
    public $siswaList;

    public function mount()
    {
        $this->tanggal = now()->toDateString();
        $this->bulan = now()->format('m');
        $this->tahun = now()->format('Y');

        $this->mapels = Mapel::orderBy('nama_mapel')->get();
        $this->kelasList = Kelas::orderBy('nama')->get();
        $this->siswaList = Siswa::orderBy('nama')->get();
    }

    public function getRekapProperty()
    {
        $query = Presensi::with(['kelas', 'mapel', 'guru', 'siswa']);

        switch ($this->mode) {
            case 'tanggal':   // Harian
                $query->where('tanggal', $this->tanggal);
                break;

            case 'bulan':     // Bulanan
                $query->whereYear('tanggal', $this->tahun)
                      ->whereMonth('tanggal', $this->bulan);
                break;

            case 'mapel':     // Per mapel
                if ($this->mapel_id) {
                    $query->where('mapel_id', $this->mapel_id);
                }
                if ($this->tanggal) {
                    $query->where('tanggal', $this->tanggal);
                }
                break;

            case 'kelas':
                if ($this->kelas_id) {
                    $query->where('kelas_id', $this->kelas_id);
                }
                break;

            case 'siswa':
                if ($this->siswa_id) {
                    $query->where('siswa_id', $this->siswa_id);
                }
                break;
        }

        return $query
            ->orderBy('tanggal')
            ->orderBy('kelas_id')
            ->orderBy('mapel_id')
            ->get();
    }
}
