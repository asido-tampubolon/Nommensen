<?php

namespace App\Filament\Admin\Resources\Lectures;

use App\Filament\Admin\Resources\Lectures\Pages\CreateLecture;
use App\Filament\Admin\Resources\Lectures\Pages\EditLecture;
use App\Filament\Admin\Resources\Lectures\Pages\ListLectures;
use App\Filament\Admin\Resources\Lectures\Pages\ViewLecture;
use App\Filament\Admin\Resources\Lectures\Schemas\LectureForm;
use App\Filament\Admin\Resources\Lectures\Schemas\LectureInfolist;
use App\Filament\Admin\Resources\Lectures\Tables\LecturesTable;
use App\Models\Lecture;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LectureResource extends Resource
{
    protected static ?string $model = Lecture::class;
    
    protected static ?string $navigationLabel = 'Dosen';
    protected static ?string $modelLabel = 'Dosen';
    protected static ?string $pluralModelLabel = 'Dosen';
    protected static string|\UnitEnum|null $navigationGroup = 'Manajemen SDM';
    protected static ?int $navigationSort = 1;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Lecture';

    public static function form(Schema $schema): Schema
    {
        return LectureForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return LectureInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LecturesTable::configure($table);
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
            'index' => ListLectures::route('/'),
            'create' => CreateLecture::route('/create'),
            'view' => ViewLecture::route('/{record}'),
            'edit' => EditLecture::route('/{record}/edit'),
        ];
    }
}
