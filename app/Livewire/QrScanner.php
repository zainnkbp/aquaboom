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

        $transaction = Transaction::with('items.ticketPackage')
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
        $details = [];
        foreach ($transaction->items as $item) {
            $details[] = $item->quantity . 'x ' . ($item->ticketPackage ? $item->ticketPackage->name : 'Tiket');
            $totalTickets += $item->quantity;
        }

        $this->ticketDetails = [
            'total' => $totalTickets,
            'items' => implode(', ', $details),
            'customer' => $transaction->customer_name
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
