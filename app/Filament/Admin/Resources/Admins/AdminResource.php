<?php

namespace App\Filament\Admin\Resources\Admins;

use App\Filament\Admin\Resources\Admins\Pages\CreateAdmin;
use App\Filament\Admin\Resources\Admins\Pages\EditAdmin;
use App\Filament\Admin\Resources\Admins\Pages\ListAdmins;
use App\Filament\Admin\Resources\Admins\Pages\ViewAdmin;
use App\Filament\Admin\Resources\Admins\Schemas\AdminInfolist;
use App\Models\Admin;
use Filament\Support\Icons\Heroicon;
use Filament\Resources\Resource;
use Filament\Forms;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Schemas\Schema;

class AdminResource extends Resource
{
    protected static ?string $model = Admin::class;

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedUserCircle;
    protected static ?string $navigationLabel = 'Admin / Staf';
    protected static ?string $modelLabel = 'Admin';
    protected static ?string $pluralModelLabel = 'Admin / Staf';
    protected static string|\UnitEnum|null $navigationGroup = 'Manajemen SDM';
    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'Admin';

    public static function form(Schema  $schema ): Schema 
{
    return $schema 
        ->components([
            Forms\Components\TextInput::make('nama')
                ->label('Nama Lengkap')
                ->required()
                ->maxLength(255)
                ->placeholder('contoh: Drs. Budi Santoso, M.M.'),

            Forms\Components\TextInput::make('nip')
                ->label('NIP')
                ->required()
                ->maxLength(255)
                ->placeholder('contoh: 197505102001011001')
                ->helperText('Nomor Induk Pegawai (boleh berupa NIP atau NIPK).'),

            Forms\Components\TextInput::make('jabatan')
                ->label('Jabatan')
                ->required()
                ->maxLength(255)
                ->placeholder('contoh: Kepala Tata Usaha'),

            Forms\Components\FileUpload::make('image')
                ->label('Foto')
                ->image()
                ->directory('admins')
                ->visibility('public')
                ->imagePreviewHeight('150')
                ->maxSize(2048)
                ->required()
                ->helperText('Upload foto formal. Format: JPG, PNG. Maks 2MB.')
                ->columnSpanFull(),
        ])
        ->columns(2);
}

    public static function infolist(Schema $schema): Schema
    {
        return AdminInfolist::configure($schema);
    }

    public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\ImageColumn::make('image')
                ->label('Foto')
                ->disk('public')
                ->height(60)
                ->circular(),

            Tables\Columns\TextColumn::make('nama')
                ->label('Nama Lengkap')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('nip')
                ->label('NIP')
                ->searchable()
                ->copyable()
                ->copyMessage('NIP berhasil disalin!'),

            Tables\Columns\TextColumn::make('jabatan')
                ->label('Jabatan')
                ->searchable()
                ->sortable()
                ->badge()
                ->color('info'),

            Tables\Columns\TextColumn::make('created_at')
                ->label('Ditambahkan')
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
        ->defaultSort('nama', 'asc');
}

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAdmins::route('/'),
            'create' => CreateAdmin::route('/create'),
            'view' => ViewAdmin::route('/{record}'),
            'edit' => EditAdmin::route('/{record}/edit'),
        ];
    }
}