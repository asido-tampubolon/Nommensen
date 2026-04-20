<?php

namespace App\Filament\Admin\Resources\Greetings\Pages;

use App\Filament\Admin\Resources\Greetings\GreetingResource;
use Filament\Resources\Pages\CreateRecord;

class CreateGreeting extends CreateRecord
{
    protected static string $resource = GreetingResource::class;
}
