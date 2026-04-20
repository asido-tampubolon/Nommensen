<?php

namespace App\Filament\Admin\Resources\Histories\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class HistoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('content')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('image')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
