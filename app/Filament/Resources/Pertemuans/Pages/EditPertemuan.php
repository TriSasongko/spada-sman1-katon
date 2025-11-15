<?php

namespace App\Filament\Resources\Pertemuans\Pages;

use App\Filament\Resources\Pertemuans\PertemuanResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPertemuan extends EditRecord
{
    protected static string $resource = PertemuanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
