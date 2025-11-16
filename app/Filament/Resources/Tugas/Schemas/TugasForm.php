<?php

namespace App\Filament\Resources\Tugas\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;

class TugasForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            TextInput::make('judul')
                ->label('Judul Tugas')
                ->required(),

            Textarea::make('deskripsi')
                ->label('Deskripsi Tugas')
                ->columnSpanFull(),

            Select::make('kelas_id')
                ->label('Kelas')
                ->relationship('kelas', 'nama')
                ->searchable()
                ->preload()
                ->required(),

            Select::make('guru_id')
                ->label('Guru Pembuat')
                ->relationship('guru', 'nama')
                ->searchable()
                ->preload()
                ->required(),

            DateTimePicker::make('deadline')
                ->label('Deadline Tugas')
                ->required()
                ->timezone('Asia/Jakarta'),

            FileUpload::make('lampiran')
                ->label('Lampiran (Opsional)')
                ->directory('tugas/lampiran')
                ->downloadable()
                ->previewable(false),
        ]);
    }
}
