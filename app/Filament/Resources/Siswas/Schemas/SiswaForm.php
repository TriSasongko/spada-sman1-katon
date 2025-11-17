<?php

namespace App\Filament\Resources\Siswas\Schemas;

use Filament\Forms;
use Filament\Schemas\Schema;

class SiswaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([

            Forms\Components\TextInput::make('nama')
                ->required()
                ->label('Nama Siswa'),

            Forms\Components\TextInput::make('nis')
                ->required()
                ->unique(ignoreRecord: true)
                ->label('NIS'),

            Forms\Components\Select::make('kelas_id')
                ->relationship('kelas', 'nama')
                ->searchable()
                ->preload()
                ->label('Kelas'),

            Forms\Components\TextInput::make('email')
                ->label('Email')
                ->email()
                ->required()
                ->rule('unique:users,email')
                ->rule(fn($record) => $record ? "unique:users,email,{$record->user_id}" : null),

            Forms\Components\TextInput::make('password')
                ->password()
                ->label('Password')
                ->required(fn($livewire) => $livewire instanceof \App\Filament\Resources\Siswas\Pages\CreateSiswa)
                ->dehydrateStateUsing(fn($state) => $state ? bcrypt($state) : null)
                ->hidden(fn($livewire) => $livewire instanceof \App\Filament\Resources\Siswas\Pages\EditSiswa),

            Forms\Components\FileUpload::make('foto')
                ->label('Foto')
                ->image()
                ->directory('foto_siswa'),

            Forms\Components\Toggle::make('aktif')
                ->default(true)
                ->label('Status Aktif'),
        ]);
    }
}
