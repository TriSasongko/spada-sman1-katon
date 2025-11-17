<?php

namespace App\Filament\Resources\Presensis\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PresensisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tanggal')->date()->sortable(),

                TextColumn::make('kelas.nama')->label('Kelas')->sortable(),

                TextColumn::make('mapel.nama_mapel')->label('Mapel')->sortable(),

                TextColumn::make('guru.nama')->label('Guru'),

                TextColumn::make('siswa.nama')->label('Siswa')->searchable(),

                TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'success' => 'hadir',
                        'warning' => 'izin',
                        'danger' => 'sakit',
                    ]),

                TextColumn::make('metode'),
            ])

            ->filters([
                SelectFilter::make('kelas_id')->relationship('kelas', 'nama'),
                SelectFilter::make('mapel_id')->relationship('mapel', 'nama_mapel'),
                SelectFilter::make('guru_id')->relationship('guru', 'nama'),
                SelectFilter::make('status')->options([
                    'hadir' => 'Hadir',
                    'izin' => 'Izin',
                    'sakit' => 'Sakit'
                ]),
            ])

            ->recordActions([
                EditAction::make(),
            ]);
    }
}
