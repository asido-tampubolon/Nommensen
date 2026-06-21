<?php

namespace App\Filament\Admin\Resources\Aboutmes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Support\Str;

class AboutmesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
    ImageColumn::make('image')
        ->label('Foto')
        ->disk('public')
        ->stacked()
        ->limit(3),

    TextColumn::make('content')
        ->label('Deskripsi')
        ->formatStateUsing(
            fn (?string $state): string =>
                Str::limit(strip_tags($state ?? ''), 100)
        )
        ->wrap()
        ->searchable(),

    TextColumn::make('updated_at')
        ->dateTime('d M Y H:i')
        ->sortable(),

    TextColumn::make('created_at')
        ->dateTime('d M Y H:i')
        ->sortable()
        ->toggleable(isToggledHiddenByDefault: true),
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
