<?php

namespace App\Filament\Resources\Siswas\Pages;

use App\Filament\Resources\Siswas\SiswaResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Resources\Pages\ListRecords;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
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
                ->form([
                    Forms\Components\FileUpload::make('file')
                        ->label('File Excel')
                        ->directory('imports/siswa') // folder penyimpanan
                        ->disk('local')              // pakai storage/app (default)
                        ->required()
                        ->acceptedFileTypes([
                            'application/vnd.ms-excel',
                            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                        ]),
                ])
                ->action(function ($data) {

                    // Ambil file path lengkap dari storage/app/
                    $path = Storage::disk('local')->path($data['file']);

                    Excel::import(new SiswaImport, $path);
                })
                ->modalHeading('Import Data Siswa')
                ->modalSubmitActionLabel('Import'),
        ];
    }
}
