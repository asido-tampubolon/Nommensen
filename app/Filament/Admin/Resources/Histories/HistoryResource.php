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
use Illuminate\Support\Str;
use Filament\Tables;
use Filament\Forms;

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
    return $schema
        ->components([
            Forms\Components\RichEditor::make('content')
                ->label('Isi Sejarah')
                ->toolbarButtons([
                    'bold',
                    'italic',
                    'underline',
                    'bulletList',
                    'orderedList',
                    'link',
                    'h3',
                ])
                ->required()
                ->helperText('Ceritakan sejarah pendirian dan perkembangan universitas.')
                ->columnSpanFull(),

            Forms\Components\FileUpload::make('image')
                ->label('Foto Bersejarah')
                ->image()
                ->directory('histories')
                ->visibility('public')
                ->imagePreviewHeight('200')
                ->maxSize(2048)
                ->required()
                ->helperText('Foto gedung lama / momen bersejarah. Format: JPG, PNG. Maks 2MB.')
                ->columnSpanFull(),
        ]);
}

    public static function infolist(Schema $schema): Schema
    {
        return HistoryInfolist::configure($schema);
    }

    public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\ImageColumn::make('image')
                ->label('Foto')
                ->disk('public')
                ->height(60),

            Tables\Columns\TextColumn::make('content')
                ->label('Cuplikan Sejarah')
                ->formatStateUsing(fn (?string $state): string => Str::limit(strip_tags($state ?? ''), 100))
                ->wrap()
                ->searchable(),

            Tables\Columns\TextColumn::make('created_at')
                ->label('Ditambahkan')
                ->dateTime('d M Y H:i')
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),

            Tables\Columns\TextColumn::make('updated_at')
                ->label('Diperbarui')
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
        ->defaultSort('updated_at', 'desc');
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
