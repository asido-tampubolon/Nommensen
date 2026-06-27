<?php

namespace App\Filament\Admin\Resources\News\Pages;

use App\Filament\Admin\Resources\News\NewsResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Str;

class EditNews extends EditRecord
{
    protected static string $resource = NewsResource::class;

    protected function getHeaderActions(): array
    {
        return [
             \Filament\Actions\DeleteAction::make(),
        ];
    }

    /**
     * (Opsional) Regenerasi slug saat judul diubah.
     * Konsekuensi: URL lama tidak berlaku lagi.
     */
    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['slug'] = Str::slug($data['title']) . '-' . time();

        return $data;
    }
}
