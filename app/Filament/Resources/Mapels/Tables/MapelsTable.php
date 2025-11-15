<?php

namespace App\Filament\Resources\Mapels\Tables;

use Filament\Actions\Action as ActionsAction;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\BulkAction;
use Filament\Actions\DeleteAction as ActionsDeleteAction;

class MapelsTable
{
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_mapel')
                    ->label('Nama Mapel')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('kode_mapel')
                    ->label('Kode')
                    ->sortable()
                    ->searchable(),
            ])
            ->actions([
                ActionsAction::make('edit')
                    ->label('Edit')
                    ->url(fn ($record) => route('filament.admin.resources.mapels.edit', $record)),

                ActionsDeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    BulkAction::make('delete')
                        ->label('Hapus Terpilih')
                        ->requiresConfirmation()
                        ->action(fn ($records) => $records->each->delete()),
                ]),
            ]);
    }
}
