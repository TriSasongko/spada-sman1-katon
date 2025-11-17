<?php

namespace App\Filament\Resources\Penilaians\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PenilaiansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('guru.nama')->label('Guru'),
                TextColumn::make('siswa.nama')->label('Siswa')->searchable(),
                TextColumn::make('kelas.nama')->label('Kelas')->sortable(),
                TextColumn::make('mapel.nama_mapel')->label('Mapel')->sortable(),
                TextColumn::make('kategori')->searchable(),
                TextColumn::make('nilai')->numeric()->sortable(),
                TextColumn::make('tanggal')->date()->sortable(),
                TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(), // <-- tombol hapus per baris
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
