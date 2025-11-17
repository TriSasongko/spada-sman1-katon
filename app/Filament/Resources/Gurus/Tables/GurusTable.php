<?php

namespace App\Filament\Resources\Gurus\Tables;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\Action;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkActionGroup;

class GurusTable
{
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')->label('Nama Guru')->sortable()->searchable()->weight('medium'),
                Tables\Columns\TextColumn::make('nip')->label('NIP')->searchable()->toggleable()->copyable()->copyMessage('NIP disalin!')->placeholder('—'),
                Tables\Columns\TextColumn::make('jenis_kelamin')
                    ->label('Jenis Kelamin')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'L' => 'info',
                        'P' => 'danger',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                    })
                    ->alignCenter(),
                Tables\Columns\TagsColumn::make('mapels.nama_mapel')->label('Mata Pelajaran')->separator(',')->limit(3)->searchable(),
                Tables\Columns\TextColumn::make('mapels_count')->label('Jumlah Mapel')->counts('mapels')->badge()->color('success')->alignCenter(),
                Tables\Columns\TextColumn::make('telepon')->label('Telepon')->icon('heroicon-m-phone')->toggleable(isToggledHiddenByDefault: true)->placeholder('—'),
                Tables\Columns\TextColumn::make('email')->label('Email')->icon('heroicon-m-envelope')->toggleable(isToggledHiddenByDefault: true)->copyable()->placeholder('—'),
                Tables\Columns\TextColumn::make('created_at')->label('Dibuat')->dateTime('d M Y H:i')->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('jenis_kelamin')
                    ->label('Jenis Kelamin')
                    ->options([
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                    ])
                    ->multiple(),
                Tables\Filters\Filter::make('has_mapel')->label('Memiliki Mapel')->query(fn($query) => $query->has('mapels'))->toggle(),
                Tables\Filters\Filter::make('no_mapel')->label('Belum Ada Mapel')->query(fn($query) => $query->doesntHave('mapels'))->toggle(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
                Action::make('reset_password')
                    ->label('Reset Password')
                    ->color('warning')
                    ->icon('heroicon-o-key')
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        // Reset password, misal default 'password123'
                        $record->user->password = bcrypt('password123');
                        $record->user->save();
                    }),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('Belum ada data guru')
            ->emptyStateDescription('Mulai dengan menambahkan data guru baru.')
            ->emptyStateIcon('heroicon-o-academic-cap');
    }
}
