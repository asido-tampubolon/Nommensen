<?php

namespace App\Filament\Admin\Resources\Greetings\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class GreetingForm
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
