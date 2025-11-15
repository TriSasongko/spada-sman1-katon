<?php

namespace App\Filament\Resources\Pertemuans;

use App\Filament\Resources\Pertemuans\Pages\CreatePertemuan;
use App\Filament\Resources\Pertemuans\Pages\EditPertemuan;
use App\Filament\Resources\Pertemuans\Pages\ListPertemuans;
use App\Filament\Resources\Pertemuans\Schemas\PertemuanForm;
use App\Filament\Resources\Pertemuans\Tables\PertemuansTable;
use App\Models\Pertemuan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PertemuanResource extends Resource
{
    protected static ?string $model = Pertemuan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'judul';

    public static function form(Schema $schema): Schema
    {
        return PertemuanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PertemuansTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPertemuans::route('/'),
            'create' => CreatePertemuan::route('/create'),
            'edit' => EditPertemuan::route('/{record}/edit'),
        ];
    }
}
