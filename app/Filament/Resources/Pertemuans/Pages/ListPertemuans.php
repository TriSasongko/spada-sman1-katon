<?php

namespace App\Filament\Resources\Pertemuans\Pages;

use App\Filament\Resources\Pertemuans\PertemuanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPertemuans extends ListRecords
{
    protected static string $resource = PertemuanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
