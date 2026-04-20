<?php

namespace App\Filament\Admin\Resources\Visimisis\Pages;

use App\Filament\Admin\Resources\Visimisis\VisimisiResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditVisimisi extends EditRecord
{
    protected static string $resource = VisimisiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
