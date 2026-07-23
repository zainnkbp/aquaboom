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
        $this->orderId = trim($code);
        $this->scanResult = null;
        $this->errorMessage = '';
        $this->ticketDetails = [];

        if (empty($this->orderId)) {
            return;
        }

        $transaction = Transaction::with('items.ticketPackage')->where('order_id', $this->orderId)->first();

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
        return view('livewire.qr-scanner')->layout('components.layouts.app');
    }
}
