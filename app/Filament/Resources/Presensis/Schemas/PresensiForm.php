<?php

namespace App\Filament\Resources\Presensis\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PresensiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Select::make('kelas_id')
                ->relationship('kelas', 'nama')
                ->searchable()
                ->required(),

            Select::make('mapel_id')
                ->relationship('mapel', 'nama_mapel')
                ->searchable()
                ->required(),

            Select::make('guru_id')
                ->relationship('guru', 'nama')
                ->required(),

            Select::make('siswa_id')
                ->relationship('siswa', 'nama')
                ->searchable()
                ->required(),

            DatePicker::make('tanggal')
                ->required(),

            Select::make('status')
                ->options([
                    'hadir' => 'Hadir',
                    'izin' => 'Izin',
                    'sakit' => 'Sakit'
                ])
                ->default('hadir'),

            TextInput::make('metode')
                ->placeholder('Contoh: QR Code, Manual, dll'),
        ]);
    }
}
