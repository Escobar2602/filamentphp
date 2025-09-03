<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Login;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Filament\Navigation\NavigationItem;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationBuilder;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Swis\Filament\Backgrounds\FilamentBackgroundsPlugin;
use Swis\Filament\Backgrounds\ImageProviders\MyImages;

class DashboardPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('dashboard')
            ->path('dashboard')
            ->login(Login::class)
            ->brandLogo(asset('images2/LOGO.png'))
            ->brandLogoHeight('4rem')
            ->darkMode(true)
            ->colors([
                'primary' => Color::Blue,
            ])
            ->databaseNotifications()

            ->navigation(function (\Filament\Navigation\NavigationBuilder $builder) {
                return $builder
                    ->groups([
                        //importante
                        NavigationGroup::make('Dashboard')
                            ->items([
                                NavigationItem::make('Dashboard')
                                    ->icon('heroicon-o-home')
                                    ->url('/dashboard'),

                                NavigationItem::make('users')
                                    ->icon('heroicon-o-users')
                                    ->url('/dashboard/users'),

                                    NavigationItem::make('Creacion de publicaciones')
                                    ->icon('heroicon-o-megaphone')
                                    ->url('/dashboard/publicaciones'),

                            ]),

                        // Grupo: Gestión Personal
                        NavigationGroup::make('Gestión Personal')
                            ->items([
                                NavigationItem::make('Comprobante de pago')
                                    ->icon('heroicon-o-document-text')
                                    ->url('/dashboard/comprobante-pago'),

                                NavigationItem::make('Asistencia COTECMAR')
                                    ->icon('heroicon-o-clock')
                                    ->url('/dashboard/asistencia-tiempo'),

                                NavigationItem::make('Solicitudes')
                                    ->icon('heroicon-o-paper-airplane')
                                    ->url('/dashboard/solicitudes'),
                            ]),

                        // Grupo: Eventos y Comunicación
                        NavigationGroup::make('Eventos y Comunicación')
                            ->items([
                                NavigationItem::make('Calendario corporativo')
                                    ->icon('heroicon-o-calendar')
                                    ->url('/dashboard/eventos-calendario'),

                                NavigationItem::make('Chat personal')
                                    ->icon('heroicon-o-chat-bubble-left-right')
                                    ->url('/dashboard/chat-personal'),

                                NavigationItem::make('Publicaciones internas')
                                    ->icon('heroicon-o-megaphone')
                                    ->url('/dashboard/feed-publicaciones'),
                            ]),

                        // Grupo: Desarrollo
                        NavigationGroup::make('Desarrollo')
                            ->items([
                                NavigationItem::make('Formación cotecmarino')
                                    ->icon('heroicon-o-academic-cap')
                                    ->url('/dashboard/formacion-desarrollo'),
                            ]),

                        // Grupo: Gestión Corporativa
                        NavigationGroup::make('Gestión Corporativa')
                            ->items([
                                NavigationItem::make('Gestión contractual')
                                    ->icon('heroicon-o-document-check')
                                    ->url('/dashboard/gestion-contractual'),

                                NavigationItem::make('Gestión de activos')
                                    ->icon('heroicon-o-building-office')
                                    ->url('/dashboard/gestion-activos'),

                                NavigationItem::make('Movilidad y transporte')
                                    ->icon('heroicon-o-truck')
                                    ->url('/dashboard/movilidad-transporte'),
                            ]),
                    ]);
            })
            ->font('roboto')
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
                // \App\Filament\Pages\Solicitudes::class,
                    \App\Filament\Pages\FeedPublicaciones::class,



            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                \App\Http\Middleware\RedirectAfterSocialLogin::class,
            ])
            ->plugins([
                \ChrisReedIO\Socialment\SocialmentPlugin::make()
                    ->registerProvider('microsoft', 'fab-microsoft', 'Microsoft'),
                FilamentBackgroundsPlugin::make()
                    ->imageProvider(
                        MyImages::make()
                            ->directory('images/swisnl/filament-backgrounds/curated-by-swis')
                    ),
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}