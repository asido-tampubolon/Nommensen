<?php

namespace App\Filament\Admin\Resources\Aboutmes\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;


class AboutmeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('content')
                    ->label('Deskripsi Profil')
                    ->required()
                    ->rows(5)
                    ->columnSpanFull(),

               FileUpload::make('image')
                    ->image()
                    ->multiple()
                    ->reorderable()
                    ->maxFiles(5)
                    ->directory('aboutmes')
                    ->visibility('public')
                    ->required()
                        ]);
    }
}