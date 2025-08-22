<?php

namespace App\Providers;

use App\Interfaces\FolderRepositoryInterface;
use App\Repositories\FolderRepository;
use Filament\Support\Facades\FilamentView;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Event;
use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

       LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch
                ->locales(['es','en','fr']); 
        });



        FilamentView::registerRenderHook(
    'panels::auth.login.form.after',
    fn (): string => Blade::render("@vite('resources/css/custom-login.css')")
);


        // Asegura que Laravel siempre use la APP_URL para generar URLs absolutas
        URL::forceRootUrl(config('app.url'));

        // Fuerza el esquema HTTPS si no estamos en entorno local
        if (config('app.env') !== 'local') {
            URL::forceScheme('https');
        }

        // Configuración de Socialite para Microsoft
        Event::listen(function (\SocialiteProviders\Manager\SocialiteWasCalled $event) {
            $event->extendSocialite('microsoft', \SocialiteProviders\Microsoft\Provider::class);
        });

        
    }
}
