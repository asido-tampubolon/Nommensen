<?php

namespace App\Filament\Admin\Resources\Visimisis\Pages;

use App\Filament\Admin\Resources\Visimisis\VisimisiResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListVisimisis extends ListRecords
{
    protected static string $resource = VisimisiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
