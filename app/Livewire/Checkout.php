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
    public $ticket_package_id;
    public $quantity = 1;
    public $promo_code = '';
    public $termsAccepted = false;

    public $packages;
    public $selectedPackage = null;
    public $appliedPromo = null;
    public $promoError = '';

    public function mount()
    {
        $this->visit_date = date('Y-m-d');
        $this->refreshPackages();
    }

    public function updatedVisitDate($value)
    {
        $this->refreshPackages();
    }

    public function refreshPackages()
    {
        $allPackages = TicketPackage::where('is_active', true)->get();
        
        $this->packages = $allPackages->filter(function ($pkg) {
            return $pkg->isValidForDate($this->visit_date);
        })->values();

        // Check if current selected is still valid
        if ($this->selectedPackage && !$this->selectedPackage->isValidForDate($this->visit_date)) {
            $this->selectedPackage = null;
            $this->ticket_package_id = null;
        }

        if (!$this->selectedPackage && $this->packages->isNotEmpty()) {
            $this->ticket_package_id = $this->packages->first()->id;
            $this->selectedPackage = $this->packages->first();
        }
    }

    public function updatedTicketPackageId($value)
    {
        $this->selectedPackage = TicketPackage::find($value);
    }

    public function incrementQuantity()
    {
        if ($this->quantity < 20) {
            $this->quantity++;
        }
    }

    public function decrementQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
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

    public function getSubtotalProperty()
    {
        if (!$this->selectedPackage) return 0;

        return $this->selectedPackage->effective_price * $this->quantity;
    }

    public function getDiscountAmountProperty()
    {
        if (!$this->appliedPromo) return 0;

        return $this->calculateDiscount($this->appliedPromo, $this->subtotal);
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
        return max(0, $this->subtotal - $this->discountAmount);
    }

    public function submit()
    {
        $this->validate([
            'visit_date' => 'required|date|after_or_equal:today',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'ticket_package_id' => 'required|exists:ticket_packages,id',
            'quantity' => 'required|integer|min:1|max:20',
            'termsAccepted' => 'accepted',
        ], [
            'termsAccepted.accepted' => 'Anda harus menyetujui Syarat & Ketentuan serta Kebijakan Privasi.',
        ]);

        // Re-fetch the package and validate date
        $this->selectedPackage = TicketPackage::findOrFail($this->ticket_package_id);
        if (!$this->selectedPackage->isValidForDate($this->visit_date)) {
            $this->addError('visit_date', 'Paket tiket tidak berlaku untuk tanggal ini.');
            return;
        }

        $order_id = (string) Str::uuid();
        $unitPrice = $this->selectedPackage->effective_price;
        $subtotal = $unitPrice * $this->quantity;

        $transaction = DB::transaction(function () use ($order_id, $unitPrice, $subtotal) {
            $discountAmount = 0;
            $promoId = null;

            // Re-validate the promo at submit time and lock the row so two
            // simultaneous checkouts can't push used_count past max_uses.
            if ($this->appliedPromo) {
                $promo = PromoCode::where('id', $this->appliedPromo->id)
                    ->lockForUpdate()
                    ->first();

                if ($promo && $this->promoStillValid($promo)) {
                    $discountAmount = $this->calculateDiscount($promo, $subtotal);
                    $promo->increment('used_count');
                    $promoId = $promo->id;
                } else {
                    // Promo became invalid between apply and submit.
                    $this->appliedPromo = null;
                    $this->promoError = 'Kode voucher tidak lagi berlaku, diskon dibatalkan.';
                }
            }

            $totalPrice = max(0, $subtotal - $discountAmount);

            // MOCK PAYMENT: Create transaction with status 'paid'
            $transaction = Transaction::create([
                'order_id' => $order_id,
                'customer_name' => $this->customer_name,
                'customer_email' => $this->customer_email,
                'customer_phone' => $this->customer_phone,
                'visit_date' => $this->visit_date,
                'subtotal' => $subtotal,
                'discount_amount' => $discountAmount,
                'total_price' => $totalPrice,
                'status' => 'paid', // MOCK: Auto Paid!
                'promo_code_id' => $promoId,
            ]);

            TransactionItem::create([
                'transaction_id' => $transaction->id,
                'ticket_package_id' => $this->selectedPackage->id,
                'quantity' => $this->quantity,
                'price' => $unitPrice,
                'subtotal' => $subtotal,
            ]);

            return $transaction;
        });

        // Mock Send Email
        Mail::to($this->customer_email)->send(new TicketSent($transaction));

        // Redirect to E-Ticket page
        return redirect()->route('ticket.show', ['order_id' => $order_id]);
    }

    public function render()
    {
        return view('livewire.checkout');
    }
}
