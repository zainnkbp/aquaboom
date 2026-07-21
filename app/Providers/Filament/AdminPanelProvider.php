<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\Facades\Blade;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Pink,
                'gray' => Color::Slate,
            ])
            ->font('Inter')
            ->brandName('Aquaboom CMS')
            ->sidebarCollapsibleOnDesktop()
            ->renderHook(
                PanelsRenderHook::HEAD_END,
                fn (): string => Blade::render('
                    <style>
                        /* Apple-esque Glassmorphism for Filament */
                        :root {
                            --fi-border-radius: 1.5rem !important; /* rounded-3xl */
                        }
                        
                        /* Clean Backgrounds */
                        .fi-body {
                            background-color: #f8fafc !important; /* slate-50 */
                        }
                        .dark .fi-body {
                            background-color: #0f172a !important; /* slate-900 */
                        }
                        
                        /* Glassy Cards */
                        .fi-ta-ctn, .fi-wi, .fi-fo-fieldset, .fi-section {
                            background: rgba(255, 255, 255, 0.7) !important;
                            backdrop-filter: blur(16px) !important;
                            -webkit-backdrop-filter: blur(16px) !important;
                            border: 1px solid rgba(255, 255, 255, 0.4) !important;
                            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.05), 0 4px 6px -4px rgb(0 0 0 / 0.05) !important;
                        }
                        
                        .dark .fi-ta-ctn, .dark .fi-wi, .dark .fi-fo-fieldset, .dark .fi-section {
                            background: rgba(30, 41, 59, 0.7) !important;
                            border: 1px solid rgba(255, 255, 255, 0.05) !important;
                            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.3) !important;
                        }

                        /* Softer Input Borders */
                        .fi-input-wrp {
                            border-radius: 1rem !important;
                        }
                        
                        /* Floating Sidebar Active States */
                        .fi-sidebar-item-active > a {
                            background: linear-gradient(135deg, rgba(236, 72, 153, 0.1), rgba(225, 29, 72, 0.05)) !important;
                            border-radius: 1rem !important;
                        }
                        
                        .dark .fi-sidebar-item-active > a {
                            background: linear-gradient(135deg, rgba(236, 72, 153, 0.15), rgba(225, 29, 72, 0.1)) !important;
                        }
                    </style>
                ')
            )
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
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
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
