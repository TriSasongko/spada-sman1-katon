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
use Filament\Actions\EditAction;

class MapelsTable
{
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_mapel')
                    ->label('Nama Mata Pelajaran')
                    ->sortable()
                    ->searchable()
                    ->weight('medium'),

                Tables\Columns\TextColumn::make('kode_mapel')
                    ->label('Kode')
                    ->sortable()
                    ->searchable()
                    ->badge()
                    ->color('primary'),

                Tables\Columns\TagsColumn::make('gurus.nama')
                    ->label('Guru Pengampu')
                    ->separator(',')
                    ->limit(3)
                    ->searchable(),

                Tables\Columns\TextColumn::make('gurus_count')
                    ->label('Jumlah Guru')
                    ->counts('gurus')
                    ->badge()
                    ->color('success')
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\Filter::make('has_guru')
                    ->label('Memiliki Guru')
                    ->query(fn ($query) => $query->has('gurus'))
                    ->toggle(),

                Tables\Filters\Filter::make('no_guru')
                    ->label('Belum Ada Guru')
                    ->query(fn ($query) => $query->doesntHave('gurus'))
                    ->toggle(),
            ])
            ->actions([
                EditAction::make(),
                ActionsDeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    BulkAction::make('delete')
                        ->label('Hapus Terpilih')
                        ->requiresConfirmation()
                        ->action(fn ($records) => $records->each->delete())
                        ->color('danger')
                        ->icon('heroicon-o-trash'),
                ]),
            ])
            ->emptyStateHeading('Belum ada mata pelajaran')
            ->emptyStateDescription('Mulai dengan menambahkan mata pelajaran baru.')
            ->emptyStateIcon('heroicon-o-book-open');
    }
}
