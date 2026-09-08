<?php

namespace App\Livewire;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ScannerLogin extends Component
{
    public string $mode = 'pin'; // 'pin' or 'credentials'
    public string $pin = '';
    public string $email = '';
    public string $password = '';

    public function mount()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->canValidateTickets()) {
                return redirect()->route('scanner.app');
            }
        }
    }

    public function setMode(string $mode)
    {
        $this->mode = $mode;
        $this->resetErrorBag();
    }

    public function updatedPin()
    {
        if (strlen($this->pin) === 6) {
            $this->login();
        }
    }

    public function login()
    {
        $this->validate([
            'pin' => 'required|numeric|digits:6',
        ]);

        $user = User::where('pin', $this->pin)->first();

        if ($user && $user->canValidateTickets()) {
            Auth::login($user, remember: true);
            return redirect()->route('scanner.app');
        }

        $this->addError('pin', 'PIN 6-digit tidak valid atau akun Anda belum diberikan hak akses scanner.');
        $this->pin = '';
    }

    public function loginWithCredentials()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], remember: true)) {
            $user = Auth::user();
            if ($user->canValidateTickets()) {
                return redirect()->route('scanner.app');
            }

            Auth::logout();
            $this->addError('email', 'Akun ini berhasil masuk, namun tidak memiliki izin akses Scanner Gate.');
            return;
        }

        $this->addError('email', 'Email atau password tidak sesuai.');
    }

    public function render()
    {
        return view('livewire.scanner-login')->layout('components.scanner-layout');
    }
}
