<?php

namespace App\Filament\Admin\Resources\Rektors;

use App\Filament\Admin\Resources\Rektors\Pages\CreateRektor;
use App\Filament\Resources\RektorResource\Pages;
use App\Filament\Admin\Resources\Rektors\Pages\EditRektor;
use App\Filament\Admin\Resources\Rektors\Pages\ListRektors;
use App\Filament\Admin\Resources\Rektors\Pages\ViewRektor;
use App\Filament\Admin\Resources\Rektors\Schemas\RektorForm;
use App\Filament\Admin\Resources\Rektors\Schemas\RektorInfolist;
use App\Filament\Admin\Resources\Rektors\Tables\RektorsTable;
use App\Models\Rektor;
use Filament\Forms;
use Filament\Forms\Form;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables;
use Filament\Tables\Table;

class RektorResource extends Resource
{
    protected static ?string $model = Rektor::class;

    protected static ?string $navigationLabel = 'Pimpinan';
    protected static ?string $modelLabel = 'Pimpinan';
    protected static ?string $pluralModelLabel = 'Pimpinan';
    protected static string|\UnitEnum|null $navigationGroup = 'Manajemen SDM';
    protected static ?int $navigationSort = 3;


    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Rektor';

    public static function form(Schema $schema): Schema
{
    return $schema
        ->components([
            Forms\Components\TextInput::make('nama')
                ->label('Nama Lengkap')
                ->required()
                ->maxLength(255)
                ->placeholder('contoh: Prof. Dr. H. Maman Suherman, M.Pd.'),

            Forms\Components\TextInput::make('jabatan')
                ->label('Jabatan')
                ->required()
                ->maxLength(255)
                ->placeholder('contoh: Rektor / Wakil Rektor I / Wakil Rektor II')
                ->helperText('Tuliskan jabatan struktural di pimpinan universitas.'),

            Forms\Components\FileUpload::make('image')
                ->label('Foto')
                ->image()
                ->directory('rektors')
                ->visibility('public')
                ->imagePreviewHeight('200')
                ->maxSize(2048)
                ->required()
                ->helperText('Upload foto formal dengan latar polos. Format: JPG, PNG. Maks 2MB.')
                ->columnSpanFull(),
        ])
        ->columns(2);
}

    public static function infolist(Schema $schema): Schema
    {
        return RektorInfolist::configure($schema);
    }

   public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\ImageColumn::make('image')
                ->label('Foto')
                ->disk('public')
                ->height(80)
                ->circular(),

            Tables\Columns\TextColumn::make('nama')
                ->label('Nama Lengkap')
                ->searchable()
                ->sortable()
                ->weight('bold'),

            Tables\Columns\TextColumn::make('jabatan')
                ->label('Jabatan')
                ->searchable()
                ->sortable()
                ->badge()
                ->color('warning'),

            Tables\Columns\TextColumn::make('created_at')
                ->label('Ditambahkan')
                ->dateTime('d M Y H:i')
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),

            Tables\Columns\TextColumn::make('updated_at')
                ->label('Diperbarui')
                ->dateTime('d M Y H:i')
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
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
        ->defaultSort('id', 'asc');
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
            'index' => ListRektors::route('/'),
            'create' => CreateRektor::route('/create'),
            'view' => ViewRektor::route('/{record}'),
            'edit' => EditRektor::route('/{record}/edit'),
        ];
    }
}
