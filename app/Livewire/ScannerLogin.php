<?php

namespace App\Livewire;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ScannerLogin extends Component
{
    public $pin = '';

    public function mount()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->hasRole(User::ROLE_SUPER_ADMIN, User::ROLE_ADMIN, User::ROLE_VALIDATOR)) {
                return redirect()->route('scanner.app');
            }
        }
    }

    public function updatedPin()
    {
        if (strlen($this->pin) === 6) {
            $this->login();
        }
    }

    public function login()
    {
        $user = User::where('pin', $this->pin)->first();

        if ($user && $user->hasRole(User::ROLE_SUPER_ADMIN, User::ROLE_ADMIN, User::ROLE_VALIDATOR)) {
            Auth::login($user, remember: true);
            return redirect()->route('scanner.app');
        }

        $this->addError('pin', 'PIN tidak valid atau tidak memiliki izin validator.');
        $this->pin = ''; // Reset pin on failure
    }

    public function render()
    {
        return view('livewire.scanner-login')->layout('components.scanner-layout');
    }
}
