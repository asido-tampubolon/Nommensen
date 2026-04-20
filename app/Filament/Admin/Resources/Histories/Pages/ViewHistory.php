<?php

namespace App\Filament\Admin\Resources\Histories\Pages;

use App\Filament\Admin\Resources\Histories\HistoryResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewHistory extends ViewRecord
{
    protected static string $resource = HistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
