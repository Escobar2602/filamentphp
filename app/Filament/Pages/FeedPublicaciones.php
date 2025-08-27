<?php
namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Publicaciones;

class FeedPublicaciones extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static string $view = 'filament.pages.feed-publicaciones';

    public $publicaciones;

    public function mount()
    {
        $this->publicaciones = Publicaciones::with(['user', 'comentarios'])->latest()->get();
    }
}