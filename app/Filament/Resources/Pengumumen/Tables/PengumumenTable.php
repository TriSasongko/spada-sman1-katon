<?php

namespace App\Filament\Resources\Pengumumen\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class PengumumenTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('judul')
                    ->label('Judul')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('published_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y H:i')
                    ->sortable(),

                IconColumn::make('tampilkan')
                    ->label('Ditampilkan')
                    ->boolean(),

                TextColumn::make('file_path')
                    ->label('Lampiran')
                    ->formatStateUsing(fn ($state) => $state ? 'Download' : '-')
                    ->url(fn ($record) => $record->file_path ? asset('storage/' . $record->file_path) : null)
                    ->openUrlInNewTab()
                    ->color(fn ($state) => $state ? 'primary' : 'gray'),

                TextColumn::make('kelas.nama')
                    ->label('Kelas')
                    ->sortable()
                    ->searchable(),

                IconColumn::make('kirim_notifikasi')
                    ->label('Notif')
                    ->boolean()
                    ->toggleable(),
            ])

            ->recordActions([
                EditAction::make(),
                DeleteAction::make()              // ← Tambahkan Delete
                    ->label('Hapus')
                    ->color('danger')
                    ->icon('heroicon-o-trash'),
            ])

            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
