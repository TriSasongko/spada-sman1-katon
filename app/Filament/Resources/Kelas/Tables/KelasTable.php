<?php

namespace App\Filament\Resources\Kelas\Tables;

use Filament\Tables\Table;
use Filament\Tables;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction as ActionsDeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class KelasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Kelas')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('jurusan.nama')
                    ->label('Jurusan')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('guru.nama')
                    ->label('Wali Kelas')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('siswas_count')
                    ->label('Jumlah Siswa')
                    ->counts('siswas')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diupdate')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])

            ->actions([
                EditAction::make(),
                ActionsDeleteAction::make(),   // ← TOMBOL DELETE MUNCUL
            ])

            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),   // ← DELETE MASSAL
                ]),
            ]);
    }
}
