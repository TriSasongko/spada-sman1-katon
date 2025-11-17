<?php

namespace App\Filament\Resources\Siswas\Pages;

use App\Filament\Resources\Siswas\SiswaResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Resources\Pages\ListRecords;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Imports\SiswaImport;

class ListSiswas extends ListRecords
{
    protected static string $resource = SiswaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),

            Action::make('import')
                ->label('Import Excel')
                ->icon('heroicon-o-arrow-up-tray')
                ->color('success')
                ->form([
                    Forms\Components\FileUpload::make('file')
                        ->label('File Excel')
                        ->helperText('Format: nama, email, nis, kelas')
                        ->directory('imports/siswa')
                        ->disk('local')
                        ->required()
                        ->acceptedFileTypes([
                            'application/vnd.ms-excel',
                            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                        ]),
                ])
                ->action(function ($data) {
                    try {
                        $path = Storage::disk('local')->path($data['file']);

                        if (!file_exists($path)) {
                            throw new \Exception("File tidak ditemukan di: {$path}");
                        }

                        Log::info('=== MULAI IMPORT SISWA ===', [
                            'path' => $path,
                            'file_size' => filesize($path) . ' bytes'
                        ]);

                        Excel::import(new SiswaImport, $path);

                        Log::info('=== IMPORT SELESAI ===');

                        \Filament\Notifications\Notification::make()
                            ->success()
                            ->title('✅ Import Berhasil')
                            ->body('Data siswa berhasil diimport ke database')
                            ->duration(5000)
                            ->send();

                    } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                        $failures = $e->failures();

                        Log::error('=== IMPORT GAGAL - VALIDASI ===', [
                            'total_errors' => count($failures)
                        ]);

                        foreach ($failures as $failure) {
                            Log::error('Error baris ' . $failure->row(), [
                                'attribute' => $failure->attribute(),
                                'errors' => $failure->errors(),
                                'values' => $failure->values()
                            ]);

                            \Filament\Notifications\Notification::make()
                                ->danger()
                                ->title("❌ Error Baris {$failure->row()}")
                                ->body(
                                    "**{$failure->attribute()}**: " .
                                    implode(', ', $failure->errors())
                                )
                                ->persistent()
                                ->send();
                        }

                    } catch (\Exception $e) {
                        Log::error('=== IMPORT GAGAL - EXCEPTION ===', [
                            'error' => $e->getMessage(),
                            'file' => $e->getFile(),
                            'line' => $e->getLine(),
                            'trace' => $e->getTraceAsString()
                        ]);

                        \Filament\Notifications\Notification::make()
                            ->danger()
                            ->title('❌ Import Gagal')
                            ->body($e->getMessage())
                            ->persistent()
                            ->send();
                    }
                })
                ->modalHeading('Import Data Siswa')
                ->modalDescription('Upload file Excel dengan format: nama, email, nis, kelas')
                ->modalSubmitActionLabel('Import Sekarang')
                ->modalWidth('md'),
        ];
    }
}
