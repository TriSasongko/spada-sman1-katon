<?php

namespace App\Filament\Resources\Pengumumen\Pages;

use App\Filament\Resources\Pengumumen\PengumumanResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\DeleteAction;

class EditPengumuman extends EditRecord
{
    protected static string $resource = PengumumanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
