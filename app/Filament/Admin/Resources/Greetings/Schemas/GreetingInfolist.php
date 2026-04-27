<?php

namespace App\Filament\Admin\Resources\Greetings\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class GreetingInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('content')
                    ->label('Isi Sambutan')
                    ->html()
                    ->columnSpanFull(),

                ImageEntry::make('image')
                    ->label('Foto Pimpinan')
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