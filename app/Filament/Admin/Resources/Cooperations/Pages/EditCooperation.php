<?php

namespace App\Filament\Admin\Resources\Cooperations\Pages;

use App\Filament\Admin\Resources\Cooperations\CooperationResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditCooperation extends EditRecord
{
    protected static string $resource = CooperationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
