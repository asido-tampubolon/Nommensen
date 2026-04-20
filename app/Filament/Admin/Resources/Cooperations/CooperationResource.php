<?php

namespace App\Filament\Admin\Resources\Cooperations;

use App\Filament\Admin\Resources\Cooperations\Pages\CreateCooperation;
use App\Filament\Admin\Resources\Cooperations\Pages\EditCooperation;
use App\Filament\Admin\Resources\Cooperations\Pages\ListCooperations;
use App\Filament\Admin\Resources\Cooperations\Pages\ViewCooperation;
use App\Filament\Admin\Resources\Cooperations\Schemas\CooperationForm;
use App\Filament\Admin\Resources\Cooperations\Schemas\CooperationInfolist;
use App\Filament\Admin\Resources\Cooperations\Tables\CooperationsTable;
use App\Models\Cooperation;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CooperationResource extends Resource
{
    protected static ?string $model = Cooperation::class;

    protected static ?string $navigationLabel = 'Kerja Sama';
    protected static ?string $modelLabel = 'Kerja Sama';
    protected static ?string $pluralModelLabel = 'Kerja Sama';
    protected static string|\UnitEnum|null $navigationGroup = 'Manajemen Konten';
    protected static ?int $navigationSort = 1;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingLibrary;

    protected static ?string $recordTitleAttribute = 'Cooperation';

    public static function form(Schema $schema): Schema
    {
        return CooperationForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CooperationInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CooperationsTable::configure($table);
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
            'index' => ListCooperations::route('/'),
            'create' => CreateCooperation::route('/create'),
            'view' => ViewCooperation::route('/{record}'),
            'edit' => EditCooperation::route('/{record}/edit'),
        ];
    }
}
