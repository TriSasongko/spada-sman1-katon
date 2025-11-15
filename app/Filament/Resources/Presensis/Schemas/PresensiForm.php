<?php

namespace App\Filament\Resources\Presensis\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PresensiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('pertemuan_id')
                    ->required()
                    ->numeric(),
                TextInput::make('siswa_id')
                    ->required()
                    ->numeric(),
                Select::make('status')
                    ->options(['hadir' => 'Hadir', 'izin' => 'Izin', 'sakit' => 'Sakit'])
                    ->default('hadir')
                    ->required(),
                TextInput::make('metode')
                    ->default(null),
            ]);
    }
}
