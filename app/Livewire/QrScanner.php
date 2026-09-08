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

    // Self-service PIN / Password Modal
    public bool $showProfileModal = false;
    public string $newPin = '';
    public string $newPin_confirmation = '';
    public string $currentPassword = '';
    public string $newPassword = '';
    public string $newPassword_confirmation = '';
    public string $profileSuccessMessage = '';

    public function mount()
    {
        // Must be authenticated and authorized to access scanner
        if (!auth()->check() || !auth()->user()->canValidateTickets()) {
            return redirect()->route('scanner.login');
        }
    }

    public function openProfileModal()
    {
        $this->showProfileModal = true;
        $this->newPin = '';
        $this->newPin_confirmation = '';
        $this->currentPassword = '';
        $this->newPassword = '';
        $this->newPassword_confirmation = '';
        $this->profileSuccessMessage = '';
        $this->resetErrorBag();
    }

    public function closeProfileModal()
    {
        $this->showProfileModal = false;
    }

    public function updatePin()
    {
        $this->validate([
            'newPin' => 'required|numeric|digits:6|confirmed',
        ], [
            'newPin.required' => 'Ketik 6 digit PIN baru.',
            'newPin.numeric' => 'PIN harus berupa angka.',
            'newPin.digits' => 'PIN harus tepat 6 digit.',
            'newPin.confirmed' => 'Konfirmasi PIN tidak cocok.',
        ]);

        $user = auth()->user();
        $user->pin = $this->newPin;
        $user->save();

        $this->profileSuccessMessage = 'PIN 6-digit berhasil diperbarui!';
        $this->newPin = '';
        $this->newPin_confirmation = '';
    }

    public function updatePassword()
    {
        $this->validate([
            'currentPassword' => 'required|current_password',
            'newPassword' => 'required|min:8|confirmed',
        ], [
            'currentPassword.required' => 'Ketik password saat ini.',
            'currentPassword.current_password' => 'Password saat ini tidak sesuai.',
            'newPassword.required' => 'Ketik password baru minimal 8 karakter.',
            'newPassword.min' => 'Password baru minimal 8 karakter.',
            'newPassword.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        $user = auth()->user();
        $user->password = \Illuminate\Support\Facades\Hash::make($this->newPassword);
        $user->save();

        $this->profileSuccessMessage = 'Password akun berhasil diperbarui!';
        $this->currentPassword = '';
        $this->newPassword = '';
        $this->newPassword_confirmation = '';
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

        if ($transaction->status !== 'paid' && $transaction->status !== 'scanned') {
            $this->scanResult = 'unpaid';
            $this->errorMessage = "Tiket belum lunas (Status: " . strtoupper($transaction->status) . ")";
            return;
        }

        if ($transaction->is_redeemed) {
            $this->scanResult = 'already_redeemed';
            $this->errorMessage = "Tiket sudah digunakan masuk pada " . ($transaction->redeemed_at ? $transaction->redeemed_at->format('d M Y H:i') : '-');
            return;
        }

        // Valid -> Redeem
        $transaction->is_redeemed = true;
        $transaction->redeemed_at = now();
        $transaction->status = 'scanned';
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
