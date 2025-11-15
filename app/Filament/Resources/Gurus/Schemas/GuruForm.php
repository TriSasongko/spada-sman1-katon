<?php

namespace App\Filament\Resources\Gurus\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\CheckboxList;
use Filament\Schemas\Components\Section;

class GuruForm
{
    public static function schema(): array
    {
        return [
            Section::make('Data Pribadi')
                ->description('Informasi data pribadi guru')
                ->schema([
                    TextInput::make('nama')
                        ->label('Nama Guru')
                        ->required()
                        ->maxLength(255)
                        ->placeholder('Nama lengkap guru'),

                    TextInput::make('nip')
                        ->label('NIP')
                        ->numeric()
                        ->maxLength(18)
                        ->placeholder('Nomor Induk Pegawai')
                        ->unique(ignoreRecord: true),

                    Select::make('jenis_kelamin')
                        ->label('Jenis Kelamin')
                        ->options([
                            'L' => 'Laki-laki',
                            'P' => 'Perempuan',
                        ])
                        ->required()
                        ->native(false),
                ])
                ->columns(3),

            Section::make('Kontak')
                ->description('Informasi kontak guru')
                ->schema([
                    TextInput::make('telepon')
                        ->label('Nomor Telepon')
                        ->tel()
                        ->placeholder('08xxxxxxxxxx')
                        ->maxLength(15),

                    TextInput::make('email')
                        ->label('Email')
                        ->email()
                        ->placeholder('email@example.com')
                        ->maxLength(255),
                ])
                ->columns(2),

            Section::make('Mata Pelajaran')
                ->description('Mata pelajaran yang diampu')
                ->schema([
                    // Opsi 1: Menggunakan Select (Multi-select dropdown)
                    Select::make('mapels')
                        ->relationship('mapels', 'nama_mapel')
                        ->multiple()
                        ->preload()
                        ->required()
                        ->searchable()
                        ->label('Pilih Mata Pelajaran')
                        ->helperText('Pilih satu atau lebih mata pelajaran'),

                    // Opsi 2: Menggunakan CheckboxList (uncomment jika ingin pakai)
                    // CheckboxList::make('mapels')
                    //     ->relationship('mapels', 'nama_mapel')
                    //     ->label('Daftar Mata Pelajaran')
                    //     ->searchable()
                    //     ->bulkToggleable()
                    //     ->required()
                    //     ->gridDirection('row')
                    //     ->columns(2)
                    //     ->helperText('Pilih mata pelajaran yang diampu'),
                ])
                ->collapsible(),
        ];
    }
}
