<?php

namespace App\Filament\Admin\Resources\Histories\Pages;

use App\Filament\Admin\Resources\Histories\HistoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHistories extends ListRecords
{
    protected static string $resource = HistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
