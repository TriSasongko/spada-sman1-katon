<?php

namespace App\Filament\Resources\Mapels\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section as ComponentsSection;

class MapelForm
{
    public static function schema(): array
    {
        return [
            ComponentsSection::make('Data Mapel')
                ->schema([
                    TextInput::make('nama_mapel')
                        ->label('Nama Mapel')
                        ->required()
                        ->maxLength(255)
                        ->placeholder('Contoh: Matematika'),

                    TextInput::make('kode_mapel')
                        ->label('Kode Mapel')
                        ->required()
                        ->maxLength(20)
                        ->placeholder('Contoh: MTK'),
                ]),
        ];
    }
}
