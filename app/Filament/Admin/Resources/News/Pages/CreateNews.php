<?php

namespace App\Filament\Admin\Resources\News\Pages;

use App\Filament\Admin\Resources\News\NewsResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CreateNews extends CreateRecord
{
    protected static string $resource = NewsResource::class;

    /**
     * Mengisi slug otomatis dari judul dan users_id dari admin yang login.
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['slug']     = Str::slug($data['title']) . '-' . time();
        $data['users_id'] = Auth::id();

        return $data;
    }
}