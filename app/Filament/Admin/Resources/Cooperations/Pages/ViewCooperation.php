<?php

namespace App\Filament\Admin\Resources\Cooperations\Pages;

use App\Filament\Admin\Resources\Cooperations\CooperationResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCooperation extends ViewRecord
{
    protected static string $resource = CooperationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
