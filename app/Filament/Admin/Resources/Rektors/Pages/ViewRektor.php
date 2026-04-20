<?php

namespace App\Filament\Admin\Resources\Rektors\Pages;

use App\Filament\Admin\Resources\Rektors\RektorResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewRektor extends ViewRecord
{
    protected static string $resource = RektorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
