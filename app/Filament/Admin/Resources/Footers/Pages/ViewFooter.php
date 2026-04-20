<?php

namespace App\Filament\Admin\Resources\Footers\Pages;

use App\Filament\Admin\Resources\Footers\FooterResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewFooter extends ViewRecord
{
    protected static string $resource = FooterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
