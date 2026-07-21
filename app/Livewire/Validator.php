<?php

namespace App\Livewire;

use App\Models\Transaction;
use Carbon\Carbon;
use Livewire\Component;

class Validator extends Component
{
    public function processTicket($orderId)
    {
        // Add a slight delay to prevent abuse or rapid fire scanning issues
        sleep(1);

        $transaction = Transaction::where('order_id', $orderId)->first();

        if (!$transaction) {
            $this->dispatch('ticket-result', status: 'error', message: 'Tiket tidak ditemukan di sistem!');
            return;
        }

        if ($transaction->status === 'scanned') {
            $this->dispatch('ticket-result', status: 'error', message: 'Tiket SUDAH DIGUNAKAN sebelumnya!');
            return;
        }

        if ($transaction->status !== 'paid') {
            $this->dispatch('ticket-result', status: 'error', message: 'Tiket BELUM LUNAS atau dibatalkan!');
            return;
        }

        // Tiket valid
        $transaction->update(['status' => 'scanned']);

        $message = "Tiket Valid!<br>";
        $message .= "<b>Nama:</b> {$transaction->customer_name}<br>";
        $message .= "<b>Jumlah:</b> " . \App\Models\TransactionItem::where('transaction_id', $transaction->id)->sum('quantity') . " Pax<br>";
        $message .= "<b>Tanggal:</b> " . Carbon::parse($transaction->visit_date)->translatedFormat('d M Y');

        $this->dispatch('ticket-result', status: 'success', message: $message);
    }

    public function render()
    {
        return view('livewire.validator')->layout('components.layouts.app');
    }
}
