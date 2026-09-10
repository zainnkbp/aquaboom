<?php

namespace App\Filament\Pages;

use App\Models\AuditLog;
use App\Models\PromoCode;
use App\Models\TicketPackage;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wahana;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Collection;

class TrashManager extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-trash';

    protected static ?string $navigationGroup = 'Sistem & Keamanan';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationLabel = 'Pusat Sampah & Pemulihan';

    protected static ?string $title = 'Pusat Arsip Sampah & Pemulihan Data (Trash Center)';

    protected static string $view = 'filament.pages.trash-manager';

    public string $activeTab = 'all';

    public string $search = '';

    public ?array $selectedDetail = null;

    public static function canAccess(): bool
    {
        return auth()->user()?->isSuperAdmin() ?? false;
    }

    public static function getNavigationBadge(): ?string
    {
        if (! auth()->user()?->isSuperAdmin()) {
            return null;
        }

        $count = static::getTotalTrashCount();
        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'danger';
    }

    public static function getTotalTrashCount(): int
    {
        return PromoCode::onlyTrashed()->count()
            + TicketPackage::onlyTrashed()->count()
            + Wahana::onlyTrashed()->count()
            + Transaction::onlyTrashed()->count()
            + User::onlyTrashed()->count();
    }

    public function setTab(string $tab): void
    {
        $this->activeTab = $tab;
    }

    public function getTrashCountsProperty(): array
    {
        return [
            'all' => static::getTotalTrashCount(),
            'promo_codes' => PromoCode::onlyTrashed()->count(),
            'ticket_packages' => TicketPackage::onlyTrashed()->count(),
            'wahanas' => Wahana::onlyTrashed()->count(),
            'transactions' => Transaction::onlyTrashed()->count(),
            'users' => User::onlyTrashed()->count(),
        ];
    }

    public function getTrashItemsProperty(): Collection
    {
        $items = collect();

        if (in_array($this->activeTab, ['all', 'promo_codes'])) {
            $promos = PromoCode::onlyTrashed()->latest('deleted_at')->get();
            foreach ($promos as $item) {
                $discount = $item->discount_percentage ? $item->discount_percentage . '%' : ($item->discount_amount ? 'Rp ' . number_format($item->discount_amount, 0, ',', '.') : '-');
                $items->push($this->formatTrashItem($item, 'Kode Promo', PromoCode::class, 'heroicon-o-ticket', 'warning', $item->code, 'Diskon: ' . $discount . ' • Pemakaian: ' . $item->used_count . 'x'));
            }
        }

        if (in_array($this->activeTab, ['all', 'ticket_packages'])) {
            $packages = TicketPackage::onlyTrashed()->latest('deleted_at')->get();
            foreach ($packages as $item) {
                $price = 'Rp ' . number_format($item->price, 0, ',', '.');
                $items->push($this->formatTrashItem($item, 'Paket Tiket', TicketPackage::class, 'heroicon-o-user-group', 'primary', $item->name, 'Harga: ' . $price . ' • Kuota: ' . ($item->daily_quota ?? '∞')));
            }
        }

        if (in_array($this->activeTab, ['all', 'wahanas'])) {
            $wahanas = Wahana::onlyTrashed()->latest('deleted_at')->get();
            foreach ($wahanas as $item) {
                $items->push($this->formatTrashItem($item, 'Wahana & Atraksi', Wahana::class, 'heroicon-o-sparkles', 'info', $item->name, 'Kategori: ' . ($item->category ?? 'Umum')));
            }
        }

        if (in_array($this->activeTab, ['all', 'transactions'])) {
            $transactions = Transaction::onlyTrashed()->latest('deleted_at')->get();
            foreach ($transactions as $item) {
                $total = 'Rp ' . number_format($item->total_price, 0, ',', '.');
                $items->push($this->formatTrashItem($item, 'Transaksi', Transaction::class, 'heroicon-o-banknotes', 'success', $item->order_id, 'Pemesan: ' . $item->customer_name . ' • Total: ' . $total));
            }
        }

        if (in_array($this->activeTab, ['all', 'users'])) {
            $users = User::onlyTrashed()->latest('deleted_at')->get();
            foreach ($users as $item) {
                $items->push($this->formatTrashItem($item, 'Akun Pengguna', User::class, 'heroicon-o-shield-check', 'danger', $item->name, 'Email: ' . $item->email . ' • Role: ' . $item->role));
            }
        }

        // Apply search filter if present
        if (! empty($this->search)) {
            $q = strtolower($this->search);
            $items = $items->filter(function ($item) use ($q) {
                return str_contains(strtolower($item['name']), $q)
                    || str_contains(strtolower($item['module']), $q)
                    || str_contains(strtolower($item['info']), $q)
                    || str_contains(strtolower($item['deleted_by_name']), $q);
            });
        }

        return $items->sortByDesc('deleted_at');
    }

    protected function formatTrashItem($model, string $moduleName, string $modelClass, string $icon, string $badgeColor, string $name, string $info): array
    {
        $deleterName = 'Sistem';

        // Check if there is an audit log record for deletion
        $log = AuditLog::where('model_type', $modelClass)
            ->where('model_id', $model->id)
            ->where('action', 'deleted')
            ->latest('id')
            ->first();

        if ($log && $log->user) {
            $deleterName = $log->user->name . ' (' . strtoupper($log->user->role) . ')';
        } elseif (! empty($model->updated_by)) {
            $deleter = User::find($model->updated_by);
            if ($deleter) {
                $deleterName = $deleter->name . ' (' . strtoupper($deleter->role) . ')';
            }
        }

        return [
            'id' => $model->id,
            'model_class' => $modelClass,
            'module' => $moduleName,
            'icon' => $icon,
            'badge_color' => $badgeColor,
            'name' => $name,
            'info' => $info,
            'deleted_at' => $model->deleted_at,
            'deleted_at_formatted' => $model->deleted_at ? $model->deleted_at->translatedFormat('d M Y H:i') : '-',
            'deleted_at_diff' => $model->deleted_at ? $model->deleted_at->diffForHumans() : '',
            'deleted_by_name' => $deleterName,
            'attributes' => $model->toArray(),
        ];
    }

    public function restore(string $modelClass, int|string $id): void
    {
        if (! auth()->user()?->isSuperAdmin()) {
            abort(403);
        }

        if (! class_exists($modelClass)) {
            return;
        }

        $record = $modelClass::onlyTrashed()->find($id);

        if ($record) {
            $name = $record->name ?? $record->code ?? $record->order_id ?? ('ID #' . $record->id);
            $record->restore();

            Notification::make()
                ->title('Data Berhasil Dipulihkan (Restored)')
                ->body("Data '{$name}' telah dikembalikan dan aktif kembali di sistem.")
                ->success()
                ->send();
        }
    }

    public function forceDelete(string $modelClass, int|string $id): void
    {
        if (! auth()->user()?->isSuperAdmin()) {
            abort(403);
        }

        if (! class_exists($modelClass)) {
            return;
        }

        $record = $modelClass::onlyTrashed()->find($id);

        if ($record) {
            $name = $record->name ?? $record->code ?? $record->order_id ?? ('ID #' . $record->id);
            $record->forceDelete();

            Notification::make()
                ->title('Data Dihapus Permanen')
                ->body("Data '{$name}' telah dihapus permanen dari basis data.")
                ->danger()
                ->send();
        }
    }

    public function viewDetails(string $modelClass, int|string $id): void
    {
        if (! class_exists($modelClass)) {
            return;
        }

        $record = $modelClass::onlyTrashed()->find($id);

        if ($record) {
            $this->selectedDetail = [
                'model' => class_basename($modelClass),
                'id' => $record->id,
                'name' => $record->name ?? $record->code ?? $record->order_id ?? ('ID #' . $record->id),
                'deleted_at' => $record->deleted_at?->translatedFormat('d F Y H:i:s'),
                'attributes' => $record->toArray(),
            ];
        }
    }

    public function closeDetails(): void
    {
        $this->selectedDetail = null;
    }
}
