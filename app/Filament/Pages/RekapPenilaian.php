<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use App\Models\Penilaian;

class RekapPenilaian extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedChartBar;

    protected static ?string $navigationLabel = 'Rekap Penilaian';
    protected static ?string $title = 'Rekap Penilaian';

    public static function getNavigationGroup(): ?string
    {
        return 'Rekap';
    }

    protected string $view = 'filament.pages.rekap-penilaian';

    // FILTER MODE
    public $mode = 'tanggal';

    // FILTER FIELDS
    public $tanggal;
    public $bulan;
    public $tahun;
    public $kelas_id;
    public $siswa_id;
    public $kategori;

    public function mount()
    {
        $this->tanggal = now()->toDateString();
        $this->bulan   = now()->format('m');
        $this->tahun   = now()->format('Y');
    }

    public function getRekapProperty()
    {
        // Ambil relasi yang memang ADA pada tabel
        $query = Penilaian::with(['guru','siswa','kelas']);

        switch ($this->mode) {

            case 'tanggal':
                $query->where('tanggal', $this->tanggal);
                break;

            case 'bulan':
                $query->whereYear('tanggal', $this->tahun)
                      ->whereMonth('tanggal', $this->bulan);
                break;

            case 'tahun':
                $query->whereYear('tanggal', $this->tahun);
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

            case 'kategori':
                if ($this->kategori) {
                    $query->where('kategori', $this->kategori);
                }
                break;
        }

        return $query
            ->orderBy('tanggal')
            ->orderBy('kelas_id')
            ->orderBy('siswa_id')
            ->get();
    }
}
