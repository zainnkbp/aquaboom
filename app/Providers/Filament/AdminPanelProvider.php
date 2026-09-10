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
            ->brandLogo(fn () => view('filament.components.brand-logo'))
            ->brandLogoHeight('2.6rem')
            ->favicon(asset('logo/favicon-96x96.png'))
            ->sidebarCollapsibleOnDesktop()
            ->collapsibleNavigationGroups()
            ->navigationGroups([
                \Filament\Navigation\NavigationGroup::make('Operasional Gate')
                    ->icon('heroicon-o-qr-code')
                    ->collapsible(),
                \Filament\Navigation\NavigationGroup::make('Transaksi & Penjualan')
                    ->icon('heroicon-o-banknotes')
                    ->collapsible(),
                \Filament\Navigation\NavigationGroup::make('Manajemen Pengunjung')
                    ->icon('heroicon-o-user-group')
                    ->collapsible(),
                \Filament\Navigation\NavigationGroup::make('CMS & Konten Web')
                    ->icon('heroicon-o-globe-alt')
                    ->collapsible(),
                \Filament\Navigation\NavigationGroup::make('Sistem & Keamanan')
                    ->icon('heroicon-o-shield-check')
                    ->collapsible(),
            ])
            ->renderHook(
                PanelsRenderHook::SIDEBAR_NAV_START,
                fn (): string => Blade::render('@include("filament.components.sidebar-user-card")')
            )
            ->renderHook(
                PanelsRenderHook::SIDEBAR_FOOTER,
                fn (): string => Blade::render('@include("filament.components.sidebar-footer")')
            )
            ->renderHook(
                PanelsRenderHook::USER_MENU_BEFORE,
                fn (): string => Blade::render('@include("filament.components.topbar-actions")')
            )
            ->renderHook(
                PanelsRenderHook::HEAD_END,
                fn (): string => Blade::render('
                    <style>
                        :root {
                            --fi-border-radius: 1.25rem !important;
                        }
                        
                        /* Backgrounds */
                        .fi-body {
                            background-color: #f8fafc !important;
                        }
                        .dark .fi-body {
                            background-color: #090614 !important;
                        }
                        
                        /* Topbar Compact & Frosted Styling */
                        .fi-topbar {
                            background: rgba(255, 255, 255, 0.88) !important;
                            backdrop-filter: blur(20px) !important;
                            -webkit-backdrop-filter: blur(20px) !important;
                            border-bottom: 1px solid rgba(0, 0, 0, 0.06) !important;
                            min-height: 3.5rem !important;
                        }
                        .dark .fi-topbar {
                            background: rgba(14, 10, 28, 0.9) !important;
                            backdrop-filter: blur(20px) !important;
                            -webkit-backdrop-filter: blur(20px) !important;
                            border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
                            min-height: 3.5rem !important;
                        }

                        /* Sidebar Ultra-Modern Dark Styling */
                        .fi-sidebar {
                            background: rgba(255, 255, 255, 0.95) !important;
                            border-right: 1px solid rgba(0, 0, 0, 0.06) !important;
                            overflow-x: hidden !important;
                        }
                        .dark .fi-sidebar {
                            background: rgba(11, 8, 22, 0.96) !important;
                            border-right: 1px solid rgba(255, 255, 255, 0.08) !important;
                            overflow-x: hidden !important;
                        }

                        /* Compact Sidebar Nav Spacing */
                        .fi-sidebar-nav {
                            gap: 0.4rem !important;
                            padding-top: 0.5rem !important;
                            padding-bottom: 0.5rem !important;
                        }

                        .fi-sidebar-group {
                            gap: 0.2rem !important;
                            margin-bottom: 0.15rem !important;
                        }

                        /* Sidebar Group Headers & Accordions */
                        .fi-sidebar-group-label {
                            font-size: 0.66rem !important;
                            font-weight: 800 !important;
                            text-transform: uppercase !important;
                            letter-spacing: 0.08em !important;
                            color: #64748b !important;
                            padding-top: 0.25rem !important;
                            padding-bottom: 0.25rem !important;
                        }

                        .fi-sidebar-group-btn {
                            padding-top: 0.25rem !important;
                            padding-bottom: 0.25rem !important;
                            border-radius: 0.6rem !important;
                            transition: all 0.2s ease !important;
                        }
                        .fi-sidebar-group-btn:hover {
                            background: rgba(255, 255, 255, 0.04) !important;
                        }

                        /* Navigation Items & Hover */
                        .fi-sidebar-item > a {
                            border-radius: 0.65rem !important;
                            padding-top: 0.45rem !important;
                            padding-bottom: 0.45rem !important;
                            font-size: 0.815rem !important;
                            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
                            border: 1px solid transparent !important;
                        }
                        .fi-sidebar-item > a:hover {
                            background: rgba(255, 255, 255, 0.05) !important;
                            transform: translateX(3px) !important;
                        }
                        
                        /* Floating Sidebar Active States */
                        .fi-sidebar-item-active > a {
                            background: linear-gradient(135deg, rgba(244, 63, 94, 0.15), rgba(225, 29, 72, 0.08)) !important;
                            border: 1px solid rgba(244, 63, 94, 0.3) !important;
                            color: #ffffff !important;
                            font-weight: 700 !important;
                        }
                        .dark .fi-sidebar-item-active > a {
                            background: linear-gradient(135deg, rgba(244, 63, 94, 0.22), rgba(139, 92, 246, 0.16)) !important;
                            border: 1px solid rgba(244, 63, 94, 0.45) !important;
                            color: #ffffff !important;
                            box-shadow: 0 4px 20px -3px rgba(244, 63, 94, 0.3) !important;
                            font-weight: 700 !important;
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

                        @keyframes pulse {
                            0%, 100% { opacity: 1; transform: scale(1); }
                            50% { opacity: 0.5; transform: scale(1.15); }
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
                \Filament\Navigation\NavigationItem::make('Kunjungan Hari Ini')
                    ->url(fn (): string => route('filament.admin.resources.transactions.index', ['activeTab' => 'today']))
                    ->icon('heroicon-o-calendar-days')
                    ->badge(fn (): ?string => ($count = \App\Models\Transaction::whereDate('visit_date', today())->whereIn('status', ['paid', 'scanned'])->count()) > 0 ? (string) $count : null, color: 'success')
                    ->sort(-2)
                    ->visible(fn (): bool => auth()->user()?->hasPermission('transactions') ?? false),

                \Filament\Navigation\NavigationItem::make('Kunjungan Expired')
                    ->url(fn (): string => route('filament.admin.resources.transactions.index', ['activeTab' => 'expired']))
                    ->icon('heroicon-o-clock')
                    ->badge(fn (): ?string => ($count = \App\Models\Transaction::whereDate('visit_date', '<', today())->where('is_redeemed', false)->where('status', 'paid')->count()) > 0 ? (string) $count : null, color: 'danger')
                    ->sort(-1)
                    ->visible(fn (): bool => auth()->user()?->hasPermission('transactions') ?? false),

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
