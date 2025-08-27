<?php

namespace App\Filament\Resources\PublicacionesResource\Pages;

use App\Filament\Resources\PublicacionesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPublicaciones extends EditRecord
{
    protected static string $resource = PublicacionesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
