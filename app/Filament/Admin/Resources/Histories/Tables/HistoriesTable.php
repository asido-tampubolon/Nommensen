<?php

namespace App\Filament\Admin\Resources\Histories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Support\Str;

class HistoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
    ImageColumn::make('image')
        ->label('Foto')
        ->disk('public')
        ->height(60),

    TextColumn::make('content')
        ->label('Cuplikan Sejarah')
        ->formatStateUsing(
            fn (?string $state): string =>
                Str::limit(strip_tags($state ?? ''), 100)
        )
        ->wrap()
        ->searchable(),

    TextColumn::make('created_at')
        ->label('Ditambahkan')
        ->dateTime('d M Y H:i')
        ->sortable()
        ->toggleable(isToggledHiddenByDefault: true),

    TextColumn::make('updated_at')
        ->label('Diperbarui')
        ->dateTime('d M Y H:i')
        ->sortable(),
])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
