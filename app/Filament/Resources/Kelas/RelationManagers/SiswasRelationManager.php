<?php

namespace App\Filament\Resources\KelasResource\RelationManagers;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions;

class SiswasRelationManager extends RelationManager
{
    protected static string $relationship = 'siswas';

    protected static ?string $title = 'Daftar Siswa';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nama')
            ->columns([
                Tables\Columns\TextColumn::make('nama')->label('Nama Siswa')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('nis')->label('NIS')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('jenis_kelamin')->label('Jenis Kelamin')->sortable(),
            ])
            ->headerActions([
                Actions\AttachAction::make()
                    ->label('Tambah Siswa ke Kelas')
                    ->preloadRecordSelect()
                    ->recordSelectSearchColumns(['nama', 'nis']),
            ])
            ->actions([
                Actions\DetachAction::make()
                    ->label('Keluarkan dari Kelas')
                    ->requiresConfirmation(),
            ])
            ->bulkActions([
                Actions\DetachBulkAction::make()
                    ->label('Keluarkan yang dipilih'),
            ]);
    }
}
