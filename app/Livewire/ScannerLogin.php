<?php

namespace App\Livewire;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ScannerLogin extends Component
{
    public $pin = '';

    public function updatedPin()
    {
        if (strlen($this->pin) === 6) {
            $this->login();
        }
    }

    public function login()
    {
        $user = User::where('pin', $this->pin)->first();

        if ($user) {
            Auth::login($user);
            return redirect()->route('scanner.app');
        }

        $this->addError('pin', 'PIN tidak valid.');
        $this->pin = ''; // Reset pin on failure
    }

    public function render()
    {
        return view('livewire.scanner-login')->layout('components.layouts.app');
    }
}
