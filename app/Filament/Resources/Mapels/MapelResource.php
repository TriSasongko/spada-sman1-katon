<?php

namespace App\Filament\Resources\Mapels;

use App\Filament\Resources\Mapels\Pages\CreateMapel;
use App\Filament\Resources\Mapels\Pages\EditMapel;
use App\Filament\Resources\Mapels\Pages\ListMapels;
use App\Filament\Resources\Mapels\Schemas\MapelForm;
use App\Filament\Resources\Mapels\Tables\MapelsTable;
use App\Models\Mapel;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Support\Icons\Heroicon;
use BackedEnum;

class MapelResource extends Resource
{
    protected static ?string $model = Mapel::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBookOpen;

    protected static ?string $recordTitleAttribute = 'nama_mapel';

    protected static ?string $navigationLabel = 'Mata Pelajaran';

    protected static ?string $pluralLabel = 'Mata Pelajaran';

    protected static ?string $slug = 'mapels';

    public static function getNavigationGroup(): ?string
    {
        return 'Menu Akademik';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->schema(
            MapelForm::schema()
        );
    }

    public static function table(Table $table): Table
    {
        return MapelsTable::table($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMapels::route('/'),
            'create' => CreateMapel::route('/create'),
            'edit' => EditMapel::route('/{record}/edit'),
        ];
    }
}
