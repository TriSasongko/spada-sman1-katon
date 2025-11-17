<?php

namespace App\Filament\Resources\Gurus\Pages;

use App\Filament\Resources\Gurus\GuruResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditGuru extends EditRecord
{
    protected static string $resource = GuruResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $record = parent::handleRecordUpdate($record, $data);

        // Sync the many-to-many relationship for 'kelasDiajar'
        if (isset($data['kelasDiajar'])) {
            $record->kelasDiajar()->sync($data['kelasDiajar']);
        }

        // Sync the many-to-many relationship for 'mapels'
        if (isset($data['mapels'])) {
            $record->mapels()->sync($data['mapels']);
        }

        return $record;
    }
}
