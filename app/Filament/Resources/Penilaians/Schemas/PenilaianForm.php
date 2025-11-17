<?php

namespace App\Filament\Resources\Penilaians\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PenilaianForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('guru_id')
                    ->relationship('guru', 'nama')
                    ->required(),

                Select::make('siswa_id')
                    ->relationship('siswa', 'nama')
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('kelas_id')
                    ->relationship('kelas', 'nama')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('mapel_id')
                    ->relationship('mapel', 'nama_mapel')
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('kategori') // ganti TextInput jadi Select
                    ->options([
                        'Ulangan Harian' => 'Ulangan Harian',
                        'Tugas' => 'Tugas',
                        'Praktek' => 'Praktek',
                        'UTS' => 'UTS',
                        'UAS' => 'UAS',
                    ])
                    ->required(),

                TextInput::make('nilai')
                    ->numeric()
                    ->default(null),

                Textarea::make('deskripsi')
                    ->default(null)
                    ->columnSpanFull(),

                DatePicker::make('tanggal'),
            ]);
    }
}
