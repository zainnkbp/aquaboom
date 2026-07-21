<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\TicketPackage;
use App\Models\PromoCode;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Mail\TicketSent;
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

    public $packages;
    public $selectedPackage = null;
    public $appliedPromo = null;
    public $promoError = '';

    public function mount()
    {
        $this->visit_date = date('Y-m-d');
        $this->packages = TicketPackage::where('is_active', true)->get();
        if ($this->packages->isNotEmpty()) {
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

        $promo = PromoCode::where('code', strtoupper($this->promo_code))
            ->where('is_active', true)
            ->where(function ($query) {
                $query->whereNull('valid_from')->orWhere('valid_from', '<=', now());
            })
            ->where(function ($query) {
                $query->whereNull('valid_until')->orWhere('valid_until', '>=', now());
            })
            ->first();

        if (!$promo) {
            $this->promoError = 'Kode voucher tidak ditemukan atau sudah tidak aktif.';
            return;
        }

        if ($promo->max_uses && $promo->used_count >= $promo->max_uses) {
            $this->promoError = 'Kode voucher sudah mencapai batas penggunaan.';
            return;
        }

        $this->appliedPromo = $promo;
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
        
        $price = $this->selectedPackage->discount_price ?? $this->selectedPackage->price;
        return $price * $this->quantity;
    }

    public function getDiscountAmountProperty()
    {
        if (!$this->appliedPromo) return 0;

        if ($this->appliedPromo->discount_percentage) {
            return ($this->subtotal * $this->appliedPromo->discount_percentage) / 100;
        }

        if ($this->appliedPromo->discount_amount) {
            return min($this->appliedPromo->discount_amount, $this->subtotal); // Max discount is subtotal
        }

        return 0;
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
        ]);

        // MOCK PAYMENT: Create transaction with status 'paid'
        $order_id = (string) Str::uuid();

        $transaction = Transaction::create([
            'order_id' => $order_id,
            'customer_name' => $this->customer_name,
            'customer_email' => $this->customer_email,
            'customer_phone' => $this->customer_phone,
            'visit_date' => $this->visit_date,
            'subtotal' => $this->subtotal,
            'discount_amount' => $this->discountAmount,
            'total_price' => $this->totalPrice,
            'status' => 'paid', // MOCK: Auto Paid!
            'promo_code_id' => $this->appliedPromo ? $this->appliedPromo->id : null,
        ]);

        $price = $this->selectedPackage->discount_price ?? $this->selectedPackage->price;

        TransactionItem::create([
            'transaction_id' => $transaction->id,
            'ticket_package_id' => $this->selectedPackage->id,
            'quantity' => $this->quantity,
            'price' => $price,
            'subtotal' => $this->subtotal,
        ]);

        if ($this->appliedPromo) {
            $this->appliedPromo->increment('used_count');
        }

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
