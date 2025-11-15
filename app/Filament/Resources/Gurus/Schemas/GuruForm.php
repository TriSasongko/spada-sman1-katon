<?php

namespace App\Filament\Resources\Gurus\Schemas;

use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;

class GuruForm
{
    public static function schema(): array
    {
        return [
            TextInput::make('nama')
                ->label('Nama Guru')
                ->required()
                ->maxLength(255),

            TextInput::make('nip')
                ->label('NIP')
                ->numeric()
                ->maxLength(18),

            Select::make('jenis_kelamin')
                ->label('Jenis Kelamin')
                ->options([
                    'L' => 'Laki-laki',
                    'P' => 'Perempuan',
                ])
                ->required(),

            TextInput::make('telepon')
                ->label('Telepon')
                ->tel(),

            TextInput::make('email')
                ->label('Email')
                ->email(),

            Select::make('mapels')
                ->relationship('mapels', 'nama')
                ->multiple()
                ->preload()
                ->required(),
        ];
    }
}
