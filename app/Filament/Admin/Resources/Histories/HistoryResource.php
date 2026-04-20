<?php

namespace App\Filament\Admin\Resources\Histories;

use App\Filament\Admin\Resources\Histories\Pages\CreateHistory;
use App\Filament\Admin\Resources\Histories\Pages\EditHistory;
use App\Filament\Admin\Resources\Histories\Pages\ListHistories;
use App\Filament\Admin\Resources\Histories\Pages\ViewHistory;
use App\Filament\Admin\Resources\Histories\Schemas\HistoryForm;
use App\Filament\Admin\Resources\Histories\Schemas\HistoryInfolist;
use App\Filament\Admin\Resources\Histories\Tables\HistoriesTable;
use App\Models\History;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class HistoryResource extends Resource
{
    protected static ?string $model = History::class;

    protected static ?string $navigationLabel = 'Sejarah';
    protected static ?string $modelLabel = 'Sejarah';
    protected static ?string $pluralModelLabel = 'Sejarah';
    protected static string|\UnitEnum|null $navigationGroup = 'Profil Universitas';
    protected static ?int $navigationSort = 2;


    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'History';

    public static function form(Schema $schema): Schema
    {
        return HistoryForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return HistoryInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HistoriesTable::configure($table);
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
            'index' => ListHistories::route('/'),
            'create' => CreateHistory::route('/create'),
            'view' => ViewHistory::route('/{record}'),
            'edit' => EditHistory::route('/{record}/edit'),
        ];
    }
}
