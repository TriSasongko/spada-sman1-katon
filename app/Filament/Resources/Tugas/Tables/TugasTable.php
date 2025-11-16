<?php

namespace App\Filament\Resources\Tugas\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class TugasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('judul')
                    ->label('Judul Tugas')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('kelas.nama')
                    ->label('Kelas')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('guru.nama')
                    ->label('Guru Pembuat')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('deadline')
                    ->label('Deadline')
                    ->dateTime()
                    ->sortable(),
            ])

            ->recordActions([
                EditAction::make(),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
