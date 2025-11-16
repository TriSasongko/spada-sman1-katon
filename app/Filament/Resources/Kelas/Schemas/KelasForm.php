<?php

namespace App\Filament\Resources\Kelas\Schemas;

use App\Models\Guru;
use App\Models\Jurusan;
use App\Models\Siswa;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class KelasForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            TextInput::make('nama')
                ->label('Nama Kelas')
                ->required(),

            Select::make('jurusan_id')
                ->label('Jurusan')
                ->relationship('jurusan', 'nama')
                ->searchable()
                ->preload()
                ->required(),

            Select::make('guru_id')
                ->label('Wali Kelas')
                ->relationship('guru', 'nama')
                ->searchable()
                ->preload()
                ->required(),

            Select::make('siswas')
                ->label('Daftar Siswa')
                ->multiple()
                ->relationship('siswas', 'nama')
                ->searchable()
                ->preload()
                ->columnSpanFull(),

        ]);
    }
}
