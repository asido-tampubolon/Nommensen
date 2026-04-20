<?php

namespace App\Filament\Admin\Resources\Visimisis\Pages;

use App\Filament\Admin\Resources\Visimisis\VisimisiResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewVisimisi extends ViewRecord
{
    protected static string $resource = VisimisiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
