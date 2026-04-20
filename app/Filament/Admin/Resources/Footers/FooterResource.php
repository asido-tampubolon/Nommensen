<?php

namespace App\Filament\Admin\Resources\Footers;

use App\Filament\Admin\Resources\Footers\Pages\CreateFooter;
use App\Filament\Admin\Resources\Footers\Pages\EditFooter;
use App\Filament\Admin\Resources\Footers\Pages\ListFooters;
use App\Filament\Admin\Resources\Footers\Pages\ViewFooter;
use App\Filament\Admin\Resources\Footers\Schemas\FooterForm;
use App\Filament\Admin\Resources\Footers\Schemas\FooterInfolist;
use App\Filament\Admin\Resources\Footers\Tables\FootersTable;
use App\Models\Footer;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FooterResource extends Resource
{
    protected static ?string $model = Footer::class;

    protected static ?string $navigationLabel = 'Pengaturan Footer';
    protected static ?string $modelLabel = 'Pengaturan Footer';
    protected static ?string $pluralModelLabel = 'Pengaturan Footer';
    protected static string|\UnitEnum|null $navigationGroup = 'Pengaturan';
    protected static ?int $navigationSort = 1;


    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Footer';

    public static function form(Schema $schema): Schema
    {
        return FooterForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return FooterInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FootersTable::configure($table);
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
            'index' => ListFooters::route('/'),
            'create' => CreateFooter::route('/create'),
            'view' => ViewFooter::route('/{record}'),
            'edit' => EditFooter::route('/{record}/edit'),
        ];
    }
}
