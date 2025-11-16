<?php

namespace App\Filament\Resources\Siswas\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;

use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\Action;

use Illuminate\Support\Facades\Hash;
use App\Models\Siswa;

class SiswasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                ImageColumn::make('foto')
                    ->label('Foto')
                    ->circular(),

                TextColumn::make('nama')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('nis')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('kelas.nama')
                    ->label('Kelas')
                    ->sortable()
                    ->searchable(),

                // ✔ FIX: email diambil dari relasi user
                TextColumn::make('user.email')
                    ->label('Email')
                    ->searchable(),

                IconColumn::make('aktif')
                    ->label('Aktif')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y'),
            ])

            ->recordActions([

                EditAction::make(),

                DeleteAction::make()
                    ->label('Hapus')
                    ->color('danger')
                    ->icon('heroicon-o-trash'),

                // ⭐ RESET PASSWORD
                Action::make('reset_password')
                    ->label('Reset Password')
                    ->icon('heroicon-o-key')
                    ->color('warning')
                    ->requiresConfirmation()
                    ->action(function (Siswa $record) {
                        if ($record->user) {
                            $record->user->update([
                                'password' => Hash::make('password123'),
                            ]);
                        }
                    })
                    ->hidden(fn (Siswa $record) => !$record->user),
            ])

            ->bulkActions([
                BulkActionGroup::make([

                    DeleteBulkAction::make(),

                    // ⭐ RESET PASSWORD MASSAL
                    BulkAction::make('reset_password_bulk')
                        ->label('Reset Password Terpilih')
                        ->icon('heroicon-o-key')
                        ->color('warning')
                        ->requiresConfirmation()
                        ->action(function ($records) {
                            foreach ($records as $siswa) {
                                if ($siswa->user) {
                                    $siswa->user->update([
                                        'password' => Hash::make('password123'),
                                    ]);
                                }
                            }
                        }),
                ]),
            ]);
    }
}
