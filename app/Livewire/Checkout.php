<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\TicketPackage;
use App\Models\PromoCode;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Mail\TicketSent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class Checkout extends Component
{
    public $visit_date;
    public $customer_name;
    public $customer_email;
    public $customer_phone;
    
    // Instead of single package, track quantities for each package
    public $quantities = []; 

    public $promo_code = '';
    public $termsAccepted = false;

    public $packages;
    public $appliedPromo = null;
    public $promoError = '';

    public $locale = 'id';
    public $addon_quantities = [];
    public $addons;

    public function mount()
    {
        $this->visit_date = date('Y-m-d');
        $this->refreshPackages();
        
        $this->addons = \App\Models\AddOn::where('is_active', true)->get();
        foreach ($this->addons as $addon) {
            $this->addon_quantities[$addon->id] = 0;
        }

        if (auth()->check()) {
            $user = auth()->user();
            $this->customer_name = $user->name;
            $this->customer_email = $user->email;
            $this->customer_phone = $user->phone_number ?? $user->phone ?? '';
        }
    }

    public function updatedVisitDate($value)
    {
        $this->refreshPackages();
    }

    public function refreshPackages()
    {
        $allPackages = TicketPackage::where('is_active', true)->where('inquiry_type', 'none')->get();
        
        $this->packages = $allPackages->filter(function ($pkg) {
            return $pkg->isValidForDate($this->visit_date);
        })->values();

        // Initialize or preserve quantities
        $newQuantities = [];
        foreach ($this->packages as $pkg) {
            $newQuantities[$pkg->id] = $this->quantities[$pkg->id] ?? 0;
        }
        $this->quantities = $newQuantities;
    }

    public function incrementQuantity($packageId)
    {
        if (isset($this->quantities[$packageId]) && $this->quantities[$packageId] < 20) {
            $this->quantities[$packageId]++;
        }
    }

    public function decrementQuantity($packageId)
    {
        if (isset($this->quantities[$packageId]) && $this->quantities[$packageId] > 0) {
            $this->quantities[$packageId]--;
        }
    }

    public function incrementAddonQuantity($addonId)
    {
        if (isset($this->addon_quantities[$addonId]) && $this->addon_quantities[$addonId] < 10) {
            $this->addon_quantities[$addonId]++;
        }
    }

    public function decrementAddonQuantity($addonId)
    {
        if (isset($this->addon_quantities[$addonId]) && $this->addon_quantities[$addonId] > 0) {
            $this->addon_quantities[$addonId]--;
        }
    }

    public function setLocale($lang)
    {
        if (in_array($lang, ['id', 'en'])) {
            $this->locale = $lang;
        }
    }

    public function applyPromo()
    {
        $this->promoError = '';
        $this->appliedPromo = null;

        if (empty($this->promo_code)) {
            return;
        }

        $this->appliedPromo = $this->resolvePromo($this->promo_code, $error);

        if (! $this->appliedPromo) {
            $this->promoError = $error;
        }
    }

    /**
     * Look up a promo code and validate that it is currently usable.
     * Returns the PromoCode model, or null with $error set to the reason.
     */
    protected function resolvePromo(?string $code, ?string &$error = null): ?PromoCode
    {
        $error = null;

        if (empty($code)) {
            return null;
        }

        $promo = PromoCode::where('code', strtoupper(trim($code)))
            ->where('is_active', true)
            ->where(function ($query) {
                $query->whereNull('valid_from')->orWhere('valid_from', '<=', now());
            })
            ->where(function ($query) {
                $query->whereNull('valid_until')->orWhere('valid_until', '>=', now());
            })
            ->first();

        if (! $promo) {
            $error = 'Kode voucher tidak ditemukan atau sudah tidak aktif.';
            return null;
        }

        if ($promo->max_uses && $promo->used_count >= $promo->max_uses) {
            $error = 'Kode voucher sudah mencapai batas penggunaan.';
            return null;
        }

        return $promo;
    }

    public function removePromo()
    {
        $this->promo_code = '';
        $this->appliedPromo = null;
        $this->promoError = '';
    }

    public function getTicketSubtotalProperty()
    {
        $subtotal = 0;
        if ($this->packages) {
            foreach ($this->packages as $pkg) {
                $qty = $this->quantities[$pkg->id] ?? 0;
                $subtotal += $pkg->effective_price * $qty;
            }
        }
        return $subtotal;
    }

    public function getAddonSubtotalProperty()
    {
        $subtotal = 0;
        if ($this->addons) {
            foreach ($this->addons as $addon) {
                $qty = $this->addon_quantities[$addon->id] ?? 0;
                $subtotal += $addon->price * $qty;
            }
        }
        return $subtotal;
    }

    public function getSubtotalProperty()
    {
        return $this->ticketSubtotal + $this->addonSubtotal;
    }

    public function getDiscountAmountProperty()
    {
        if (!$this->appliedPromo) return 0;

        return $this->calculateDiscount($this->appliedPromo, $this->ticketSubtotal);
    }

    /**
     * Compute the Rupiah discount for a promo against a given subtotal.
     * Percentage takes precedence, then a flat nominal amount. The discount
     * can never exceed the subtotal.
     */
    protected function calculateDiscount(PromoCode $promo, float $subtotal): float
    {
        if ($promo->discount_percentage) {
            $discount = ($subtotal * (float) $promo->discount_percentage) / 100;
        } elseif ($promo->discount_amount) {
            $discount = (float) $promo->discount_amount;
        } else {
            $discount = 0;
        }

        return round(min($discount, $subtotal), 2);
    }

    /**
     * Whether the given promo is still active, within its validity window and
     * under its usage cap.
     */
    protected function promoStillValid(PromoCode $promo): bool
    {
        if (! $promo->is_active) {
            return false;
        }

        if ($promo->valid_from && $promo->valid_from->isFuture()) {
            return false;
        }

        if ($promo->valid_until && $promo->valid_until->isPast()) {
            return false;
        }

        if ($promo->max_uses && $promo->used_count >= $promo->max_uses) {
            return false;
        }

        return true;
    }

    public function getTotalPriceProperty()
    {
        return max(0, $this->ticketSubtotal - $this->discountAmount + $this->addonSubtotal);
    }

    public function getTotalTicketsProperty()
    {
        return array_sum($this->quantities);
    }

    public function submit()
    {
        $this->validate([
            'visit_date' => 'required|date|after_or_equal:today',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'termsAccepted' => 'accepted',
        ], [
            'termsAccepted.accepted' => 'Anda harus menyetujui Syarat & Ketentuan serta Kebijakan Privasi.',
        ]);

        if ($this->totalTickets <= 0) {
            $this->addError('quantities', 'Please select at least one ticket.');
            return;
        }

        // Validate all selected packages against the date
        $selectedPackages = [];
        foreach ($this->quantities as $pkgId => $qty) {
            if ($qty > 0) {
                $pkg = TicketPackage::findOrFail($pkgId);
                if (!$pkg->isValidForDate($this->visit_date)) {
                    $this->addError('visit_date', "Paket tiket {$pkg->name} tidak berlaku untuk tanggal ini.");
                    return;
                }
                $selectedPackages[] = [
                    'package' => $pkg,
                    'quantity' => $qty,
                ];
            }
        }

        $order_id = (string) Str::uuid();
        $ticketSubtotal = $this->ticketSubtotal;
        $addonSubtotal = $this->addonSubtotal;
        $subtotal = $this->subtotal;

        // Selected AddOns list
        $selectedAddOns = [];
        foreach ($this->addon_quantities as $addonId => $qty) {
            if ($qty > 0) {
                $addon = \App\Models\AddOn::findOrFail($addonId);
                $selectedAddOns[] = [
                    'addon' => $addon,
                    'quantity' => $qty,
                ];
            }
        }

        $transaction = DB::transaction(function () use ($order_id, $ticketSubtotal, $addonSubtotal, $subtotal, $selectedPackages, $selectedAddOns) {
            $discountAmount = 0;
            $promoId = null;

            // Re-validate the promo at submit time and lock the row so two
            // simultaneous checkouts can't push used_count past max_uses.
            if ($this->appliedPromo) {
                $promo = PromoCode::where('id', $this->appliedPromo->id)
                    ->lockForUpdate()
                    ->first();

                if ($promo && $this->promoStillValid($promo)) {
                    $discountAmount = $this->calculateDiscount($promo, $ticketSubtotal);
                    $promo->increment('used_count');
                    $promoId = $promo->id;
                } else {
                    // Promo became invalid between apply and submit.
                    $this->appliedPromo = null;
                    $this->promoError = 'Kode voucher tidak lagi berlaku, diskon dibatalkan.';
                }
            }

            $totalPrice = max(0, $ticketSubtotal - $discountAmount + $addonSubtotal);

            // Auto-align Postgres sequences defensively to prevent any duplicate key errors
            \App\Services\PostgresSequenceFixer::fix();

            // Hybrid Account Flow: Check or auto-create User
            $userId = null;
            if (auth()->check()) {
                $userId = auth()->id();
            } else {
                $user = \App\Models\User::where('email', $this->customer_email)->first();
                if (!$user) {
                    $user = \App\Models\User::create([
                        'name' => $this->customer_name,
                        'email' => $this->customer_email,
                        'password' => \Illuminate\Support\Facades\Hash::make(\Illuminate\Support\Str::random(16)),
                        'role' => 'customer',
                    ]);
                }
                $userId = $user->id;
            }

            // DOKU INTEGRATION: Create transaction with status 'pending'
            $transaction = Transaction::create([
                'user_id' => $userId,
                'order_id' => $order_id,
                'customer_name' => $this->customer_name,
                'customer_email' => $this->customer_email,
                'customer_phone' => $this->customer_phone,
                'visit_date' => $this->visit_date,
                'subtotal' => $subtotal,
                'discount_amount' => $discountAmount,
                'total_price' => $totalPrice,
                'status' => 'pending',
                'promo_code_id' => $promoId,
            ]);

            foreach ($selectedPackages as $item) {
                $itemSubtotal = $item['package']->effective_price * $item['quantity'];
                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'ticket_package_id' => $item['package']->id,
                    'quantity' => $item['quantity'],
                    'price' => $item['package']->effective_price,
                    'subtotal' => $itemSubtotal,
                ]);
            }

            foreach ($selectedAddOns as $item) {
                $itemSubtotal = $item['addon']->price * $item['quantity'];
                \App\Models\TransactionAddOn::create([
                    'transaction_id' => $transaction->id,
                    'add_on_id' => $item['addon']->id,
                    'quantity' => $item['quantity'],
                    'price' => $item['addon']->price,
                    'subtotal' => $itemSubtotal,
                ]);
            }

            return $transaction;
        });

        // Redirect to Doku Payment Route
        return redirect()->route('payment.doku.pay', ['order_id' => $order_id]);
    }

    public function render()
    {
        $this->locale = app()->getLocale();
        return view('livewire.checkout');
    }
}

