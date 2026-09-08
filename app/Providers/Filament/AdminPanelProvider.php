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
            ->profile(\App\Filament\Pages\EditProfile::class)
            ->colors([
                'primary' => Color::Pink,
                'gray' => Color::Slate,
            ])
            ->font('Inter')
            ->brandName('Aquaboom CMS')
            ->favicon(asset('logo/favicon-96x96.png'))
            ->sidebarCollapsibleOnDesktop()
            ->renderHook(
                PanelsRenderHook::HEAD_END,
                fn (): string => Blade::render('
                    <style>
                        /* Modern Glassmorphism Design System for Aquaboom CMS */
                        :root {
                            --fi-border-radius: 1.25rem !important;
                        }
                        
                        /* Backgrounds */
                        .fi-body {
                            background-color: #f8fafc !important;
                        }
                        .dark .fi-body {
                            background-color: #0c091a !important;
                        }
                        
                        /* Unset generic widget wrapper to avoid double borders */
                        .fi-wi {
                            background: transparent !important;
                            border: none !important;
                            box-shadow: none !important;
                        }

                        /* Glassy Cards: Tables, Sections, Forms */
                        .fi-ta-ctn, .fi-section, .fi-fo-fieldset {
                            background: rgba(255, 255, 255, 0.85) !important;
                            backdrop-filter: blur(16px) !important;
                            -webkit-backdrop-filter: blur(16px) !important;
                            border: 1px solid rgba(0, 0, 0, 0.06) !important;
                            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.04) !important;
                            border-radius: 1.25rem !important;
                        }
                        
                        .dark .fi-ta-ctn, .dark .fi-section, .dark .fi-fo-fieldset {
                            background: rgba(22, 17, 44, 0.85) !important;
                            border: 1px solid rgba(255, 255, 255, 0.08) !important;
                            box-shadow: 0 15px 30px -10px rgba(0, 0, 0, 0.5) !important;
                            border-radius: 1.25rem !important;
                        }

                        /* Chart Containers */
                        .dark .fi-wi-chart {
                            background: rgba(22, 17, 44, 0.85) !important;
                            border: 1px solid rgba(255, 255, 255, 0.08) !important;
                            border-radius: 1.25rem !important;
                            padding: 1.25rem !important;
                            box-shadow: 0 15px 30px -10px rgba(0, 0, 0, 0.5) !important;
                        }

                        /* Softer Input Borders */
                        .fi-input-wrp {
                            border-radius: 0.875rem !important;
                        }
                        
                        /* Floating Sidebar Active States */
                        .fi-sidebar-item-active > a {
                            background: linear-gradient(135deg, rgba(236, 72, 153, 0.12), rgba(225, 29, 72, 0.06)) !important;
                            border-radius: 0.875rem !important;
                            border: 1px solid rgba(236, 72, 153, 0.2) !important;
                        }
                        
                        .dark .fi-sidebar-item-active > a {
                            background: linear-gradient(135deg, rgba(236, 72, 153, 0.18), rgba(225, 29, 72, 0.1)) !important;
                            border-radius: 0.875rem !important;
                            border: 1px solid rgba(236, 72, 153, 0.3) !important;
                        }
                    </style>
                ')
            )
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                \App\Filament\Pages\Dashboard::class,
            ])
            ->navigationItems([
                \Filament\Navigation\NavigationItem::make('Dashboard Glass (V2)')
                    ->url(fn (): string => route('dashboard.v2'), shouldOpenInNewTab: false)
                    ->icon('heroicon-o-sparkles')
                    ->group('Tampilan Baru')
                    ->sort(0),
                \Filament\Navigation\NavigationItem::make('Scanner Tiket (Security)')
                    ->url(fn (): string => route('scanner.app'), shouldOpenInNewTab: true)
                    ->icon('heroicon-o-qr-code')
                    ->group('Operasional Gate')
                    ->sort(1)
                    ->visible(fn (): bool => auth()->user()?->canValidateTickets() ?? false),
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                // Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class, // Removed to clean up "Filament" branding
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
