<?php

namespace App\Filament\Resources\PublicacionesResource\Pages;

use App\Filament\Resources\PublicacionesResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePublicaciones extends CreateRecord
{
    protected static string $resource = PublicacionesResource::class;

    protected function getRedirectUrl(): string
    {
        // Asegúrate que esta ruta coincida con la de tu página FeedPublicaciones
        return route('filament.dashboard.pages.feed-publicaciones');
    }
}