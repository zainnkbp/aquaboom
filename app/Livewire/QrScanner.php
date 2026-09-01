<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\Transaction;

class QrScanner extends Component
{
    public $orderId = '';
    public $scanResult = null; // 'success', 'not_found', 'unpaid', 'already_redeemed'
    public $ticketDetails = [];
    public $errorMessage = '';

    public function mount()
    {
        // Must be authenticated to access
        if (!auth()->check()) {
            return redirect()->route('scanner.login');
        }
    }

    public function processScan($code)
    {
        $rawCode = strtoupper(trim($code));
        $this->scanResult = null;
        $this->errorMessage = '';
        $this->ticketDetails = [];

        if (empty($rawCode)) {
            return;
        }

        // Ekstraksi format AQB-XXXX-XXXX-XXXX atau UUID jika memindai format URL
        if (preg_match('/AQB-[0-9A-Z]{4}-[0-9A-Z]{4}-[0-9A-Z]{4}/i', $rawCode, $matches)) {
            $this->orderId = strtoupper($matches[0]);
        } elseif (preg_match('/[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{12}/', $rawCode, $matches)) {
            $this->orderId = $matches[0];
        } else {
            $this->orderId = $rawCode;
        }

        // Pembersihan karakter strip dan spasi untuk pencocokan fleksibel
        $normalized = str_replace(['-', ' ', '_'], '', strtoupper($this->orderId));
        $normalizedWithoutPrefix = str_replace('AQB', '', $normalized);

        $transaction = Transaction::with(['items.ticketPackage', 'addOns.addOn'])
            ->where('order_id', $this->orderId)
            ->orWhereRaw("UPPER(order_id::text) = ?", [strtoupper($this->orderId)])
            ->orWhereRaw("UPPER(replace(order_id::text, '-', '')) = ?", [$normalized])
            ->orWhereRaw("UPPER(replace(replace(order_id::text, '-', ''), 'AQB', '')) = ?", [$normalizedWithoutPrefix])
            ->first();

        if (!$transaction) {
            $this->scanResult = 'not_found';
            $this->errorMessage = "Tiket tidak ditemukan!";
            return;
        }

        if ($transaction->status !== 'paid') {
            $this->scanResult = 'unpaid';
            $this->errorMessage = "Tiket belum lunas (Status: " . strtoupper($transaction->status) . ")";
            return;
        }

        if ($transaction->is_redeemed) {
            $this->scanResult = 'already_redeemed';
            $this->errorMessage = "Tiket sudah hangus/dipakai pada " . $transaction->redeemed_at->format('d M Y H:i');
            return;
        }

        // Valid -> Redeem
        $transaction->is_redeemed = true;
        $transaction->redeemed_at = now();
        $transaction->save();

        $totalTickets = 0;
        $ticketList = [];
        foreach ($transaction->items as $item) {
            $name = $item->ticketPackage ? $item->ticketPackage->name : 'Tiket Masuk';
            $ticketList[] = [
                'qty' => $item->quantity,
                'name' => $name,
            ];
            $totalTickets += $item->quantity;
        }

        $addonList = [];
        foreach ($transaction->addOns as $item) {
            $name = $item->addOn ? $item->addOn->name : 'Fasilitas Tambahan';
            $addonList[] = [
                'qty' => $item->quantity,
                'name' => $name,
            ];
        }

        $this->ticketDetails = [
            'order_id' => $transaction->order_id,
            'customer' => $transaction->customer_name,
            'email' => $transaction->customer_email,
            'phone' => $transaction->customer_phone,
            'visit_date' => \Carbon\Carbon::parse($transaction->visit_date)->translatedFormat('d F Y'),
            'total' => $totalTickets,
            'tickets' => $ticketList,
            'addons' => $addonList,
            'redeemed_at' => $transaction->redeemed_at->format('d M Y H:i'),
        ];

        $this->scanResult = 'success';
    }

    public function resetScan()
    {
        $this->scanResult = null;
        $this->orderId = '';
        $this->errorMessage = '';
        $this->ticketDetails = [];
        $this->dispatch('restart-scanner');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('scanner.login');
    }

    public function render()
    {
        return view('livewire.qr-scanner')->layout('components.scanner-layout');
    }
}
