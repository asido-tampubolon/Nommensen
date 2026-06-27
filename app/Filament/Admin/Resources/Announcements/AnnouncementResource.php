<?php

namespace App\Filament\Admin\Resources\Announcements;

use App\Filament\Admin\Resources\Announcements\Pages\CreateAnnouncement;
use App\Filament\Admin\Resources\Announcements\Pages\EditAnnouncement;
use App\Filament\Admin\Resources\Announcements\Pages\ListAnnouncements;
use App\Filament\Admin\Resources\Announcements\Pages\ViewAnnouncement;
use App\Filament\Admin\Resources\Announcements\Schemas\AnnouncementForm;
use App\Filament\Admin\Resources\Announcements\Schemas\AnnouncementInfolist;
use App\Filament\Admin\Resources\Announcements\Tables\AnnouncementsTable;
use App\Models\Announcement;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Forms;
use Filament\Tables;

class AnnouncementResource extends Resource
{
    protected static ?string $model = Announcement::class;

    protected static ?string $navigationLabel = 'Pengumuman';
    protected static ?string $modelLabel = 'Pengumuman';
    protected static ?string $pluralModelLabel = 'Pengumuman';
    protected static string|\UnitEnum|null $navigationGroup = 'Publikasi';
    protected static ?int $navigationSort = 1;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Announcement';

    public static function form(Schema $schema): Schema
{
    return $schema
        ->components([
            Forms\Components\TextInput::make('title')
                ->label('Judul Pengumuman')
                ->required()
                ->maxLength(255)
                ->placeholder('contoh: Jadwal UAS Semester Ganjil 2025/2026')
                ->helperText('Slug URL akan dibuat otomatis dari judul ini.')
                ->columnSpanFull(),

            Forms\Components\RichEditor::make('content')
                ->label('Isi Pengumuman')
                ->toolbarButtons([
                    'bold',
                    'italic',
                    'underline',
                    'bulletList',
                    'orderedList',
                    'link',
                ])
                ->required()
                ->columnSpanFull(),

            Forms\Components\Hidden::make('slug'),
            Forms\Components\Hidden::make('users_id'),
        ]);
}

    public static function infolist(Schema $schema): Schema
    {
        return AnnouncementInfolist::configure($schema);
    }

    public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('title')
                ->label('Judul')
                ->searchable()
                ->sortable()
                ->weight('bold')
                ->limit(50)
                ->tooltip(fn (?string $state): ?string => $state),

            Tables\Columns\TextColumn::make('content')
                ->label('Cuplikan')
                ->formatStateUsing(fn (?string $state): string => Str::limit(strip_tags($state ?? ''), 60))
                ->wrap()
                ->toggleable(),

            Tables\Columns\TextColumn::make('user.name')
                ->label('Dibuat Oleh')
                ->badge()
                ->color('info')
                ->sortable(),

            Tables\Columns\TextColumn::make('slug')
                ->label('Slug')
                ->copyable()
                ->copyMessage('Slug disalin!')
                ->limit(35)
                ->toggleable(isToggledHiddenByDefault: true),

            Tables\Columns\TextColumn::make('created_at')
                ->label('Diterbitkan')
                ->dateTime('d M Y H:i')
                ->sortable(),
        ])
        ->filters([
            //
        ])
        ->recordActions([
            \Filament\Actions\EditAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ])
        ->toolbarActions([
            \Filament\Actions\BulkActionGroup::make([
                \Filament\Actions\DeleteBulkAction::make(),
            ]),
        ])
        ->defaultSort('created_at', 'desc');
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
            'index' => ListAnnouncements::route('/'),
            'create' => CreateAnnouncement::route('/create'),
            'view' => ViewAnnouncement::route('/{record}'),
            'edit' => EditAnnouncement::route('/{record}/edit'),
        ];
    }
}
