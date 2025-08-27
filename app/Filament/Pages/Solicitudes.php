<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Contracts\View\View;

class Solicitudes extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-paper-airplane';
    protected static ?string $title = 'Solicitudes';
    protected static ?string $navigationLabel = 'Solicitudes';
    protected static ?int $navigationSort = 3;

    public function render(): View
    {
        return view('filament::components.page', [
            'slot' => fn () => <<<'HTML'
                <h1 class="text-2xl font-bold">Solicitudes</h1>
                <p class="mt-2">Este contenido está renderizado directamente sin Blade propio.</p>
            HTML,
        ]);
    }
}
