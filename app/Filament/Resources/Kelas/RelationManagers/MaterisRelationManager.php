<?php

namespace App\Filament\Resources\Kelas\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions;

class MaterisRelationManager extends RelationManager
{
    protected static string $relationship = 'materis';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('judul'),
                Tables\Columns\TextColumn::make('guru.nama'),
                Tables\Columns\TextColumn::make('published_at')->dateTime(),
            ])

            ->headerActions([
                Actions\CreateAction::make()
                    ->label('Tambah Materi'),
            ])

            ->actions([
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ]);
    }
}
