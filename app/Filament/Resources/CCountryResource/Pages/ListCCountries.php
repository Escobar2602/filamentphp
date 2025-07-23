<?php

namespace App\Filament\Resources\CCountryResource\Pages;

use App\Filament\Resources\CCountryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCCountries extends ListRecords
{
    protected static string $resource = CCountryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
