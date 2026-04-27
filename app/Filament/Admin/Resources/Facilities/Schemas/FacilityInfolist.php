<?php

namespace App\Filament\Admin\Resources\Facilities\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class FacilityInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('content')
                    ->label('Deskripsi Fasilitas')
                    ->html()
                    ->columnSpanFull(),

                ImageEntry::make('image')
                    ->label('Foto Fasilitas')
                    ->disk('public')
                    ->columnSpanFull(),

                TextEntry::make('created_at')
                    ->label('Ditambahkan')
                    ->dateTime('d M Y H:i')
                    ->placeholder('-'),

                TextEntry::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y H:i')
                    ->placeholder('-'),
            ]);
    }
}