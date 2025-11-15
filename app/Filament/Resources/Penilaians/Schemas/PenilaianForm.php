<?php

namespace App\Filament\Resources\Penilaians\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PenilaianForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('guru_id')
                    ->required()
                    ->numeric(),
                TextInput::make('siswa_id')
                    ->required()
                    ->numeric(),
                TextInput::make('kelas_id')
                    ->required()
                    ->numeric(),
                TextInput::make('kategori')
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
