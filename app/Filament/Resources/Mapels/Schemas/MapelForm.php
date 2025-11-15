<?php

namespace App\Filament\Resources\Mapels\Schemas;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\CheckboxList;
use Filament\Schemas\Components\Section as ComponentsSection;

class MapelForm
{
    public static function schema(): array
    {
        return [
            ComponentsSection::make('Informasi Mata Pelajaran')
                ->description('Masukkan data mata pelajaran')
                ->schema([
                    TextInput::make('nama_mapel')
                        ->label('Nama Mata Pelajaran')
                        ->required()
                        ->maxLength(255)
                        ->placeholder('Contoh: Matematika')
                        ->columnSpanFull(),

                    TextInput::make('kode_mapel')
                        ->label('Kode Mata Pelajaran')
                        ->required()
                        ->maxLength(20)
                        ->placeholder('Contoh: MTK')
                        ->unique(ignoreRecord: true)
                        ->helperText('Kode unik untuk mata pelajaran'),
                ])
                ->columns(2),

            ComponentsSection::make('Guru Pengampu')
                ->description('Pilih guru yang mengampu mata pelajaran ini')
                ->schema([
                    CheckboxList::make('gurus')
                        ->relationship('gurus', 'nama')
                        ->label('Daftar Guru')
                        ->searchable()
                        ->bulkToggleable()
                        ->gridDirection('row')
                        ->columns(2)
                        ->helperText('Pilih satu atau lebih guru yang mengajar mata pelajaran ini'),
                ])
                ->collapsible(),
        ];
    }
}
