<?php

namespace App\Filament\Admin\Resources\Lectures\Pages;

use App\Filament\Admin\Resources\Lectures\LectureResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewLecture extends ViewRecord
{
    protected static string $resource = LectureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
