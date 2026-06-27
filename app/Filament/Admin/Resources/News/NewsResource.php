<?php

namespace App\Filament\Admin\Resources\News;

use App\Filament\Admin\Resources\News\Pages\CreateNews;
use App\Filament\Admin\Resources\News\Pages\EditNews;
use App\Filament\Admin\Resources\News\Pages\ListNews;
use App\Filament\Admin\Resources\News\Pages\ViewNews;
use App\Filament\Admin\Resources\News\Schemas\NewsForm;
use App\Filament\Admin\Resources\News\Schemas\NewsInfolist;
use App\Filament\Admin\Resources\News\Tables\NewsTable;
use App\Models\News;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Forms;
use Filament\Tables;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    protected static ?string $navigationLabel = 'Berita';
    protected static ?string $modelLabel = 'Berita';
    protected static ?string $pluralModelLabel = 'Berita';
    protected static string|\UnitEnum|null $navigationGroup = 'Publikasi';
    protected static ?int $navigationSort = 2;


    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'News';

    public static function form(Schema $schema): Schema
{
    return $schema
        ->components([
            Forms\Components\TextInput::make('title')
                ->label('Judul Berita')
                ->required()
                ->maxLength(255)
                ->placeholder('contoh: B University Raih Akreditasi Unggul')
                ->helperText('Slug URL akan dibuat otomatis dari judul ini.')
                ->columnSpanFull(),

            Forms\Components\RichEditor::make('content')
                ->label('Isi Berita')
                ->toolbarButtons([
                    'bold',
                    'italic',
                    'underline',
                    'bulletList',
                    'orderedList',
                    'link',
                    'h2',
                    'h3',
                ])
                ->required()
                ->columnSpanFull(),

            Forms\Components\FileUpload::make('image')
                ->label('Foto Berita')
                ->image()
                ->directory('news')
                ->visibility('public')
                ->imagePreviewHeight('200')
                ->maxSize(3072)
                ->required()
                ->helperText('Foto utama berita. Format: JPG, PNG. Maks 3MB.')
                ->columnSpanFull(),

            Forms\Components\Hidden::make('slug'),
            Forms\Components\Hidden::make('users_id'),
        ]);
}

    public static function infolist(Schema $schema): Schema
    {
        return NewsInfolist::configure($schema);
    }

    public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\ImageColumn::make('image')
                ->label('Foto')
                ->disk('public')
                ->height(60),

            Tables\Columns\TextColumn::make('title')
                ->label('Judul')
                ->searchable()
                ->sortable()
                ->weight('bold')
                ->limit(45)
                ->tooltip(fn (?string $state): ?string => $state),

            Tables\Columns\TextColumn::make('content')
                ->label('Cuplikan')
                ->formatStateUsing(fn (?string $state): string => Str::limit(strip_tags($state ?? ''), 60))
                ->wrap()
                ->toggleable(),

            Tables\Columns\TextColumn::make('user.name')
                ->label('Penulis')
                ->badge()
                ->color('success')
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
            'index' => ListNews::route('/'),
            'create' => CreateNews::route('/create'),
            'view' => ViewNews::route('/{record}'),
            'edit' => EditNews::route('/{record}/edit'),
        ];
    }
}
