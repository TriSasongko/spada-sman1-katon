<?php

namespace App\Filament\Resources\Siswas\Pages;

use App\Filament\Resources\Siswas\SiswaResource;
use Filament\Resources\Pages\EditRecord;

class EditSiswa extends EditRecord
{
    protected static string $resource = SiswaResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $siswa = $this->record;

        if (!empty($data['email'])) {
            $siswa->user->update([
                'email' => $data['email'],
            ]);
        }

        unset($data['email']);

        return $data;
    }
}
