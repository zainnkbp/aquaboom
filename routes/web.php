<?php

use Illuminate\Support\Facades\Route;
use App\Models\Wahana;
use App\Models\Transaction;

use App\Livewire\ScannerLogin;
use App\Livewire\QrScanner;

Route::get('/', function () {
    $wahanas = Wahana::orderBy('order_column')->get();
    
    // Default dummy data if database is empty
    if ($wahanas->isEmpty()) {
        $wahanas = collect([
            (object)[
                'name' => 'Tornado Slide',
                'description' => 'Adrenalin tinggi dengan putaran kencang. Berani coba tantangan ekstrem ini bersama kerabat?',
                'image_url' => 'https://aquaboombsb.com/wp-content/uploads/2023/12/V1.jpg',
            ],
            (object)[
                'name' => 'Lazy River',
                'description' => 'Bersantai sejenak mengikuti arus tenang nan sejuk di atas ban, mengitari seluruh area taman air.',
                'image_url' => 'https://aquaboombsb.com/wp-content/uploads/2023/12/V2.jpg',
            ],
            (object)[
                'name' => 'Kids Splash',
                'description' => 'Area bermain super aman dengan seluncuran mini dan ember tumpah khusus anak.',
                'image_url' => 'https://aquaboombsb.com/wp-content/uploads/2023/12/V3.jpg',
            ],
        ]);
    }
    
    return view('welcome', compact('wahanas'));
});

Route::get('/ticket/{order_id}', function ($order_id) {
    $transaction = Transaction::where('order_id', $order_id)->firstOrFail();
    return view('ticket', compact('transaction'));
})->name('ticket.show');

// Scanner App Routes
Route::get('/scanner/login', ScannerLogin::class)->name('scanner.login')->middleware('guest');
Route::get('/scanner', QrScanner::class)->name('scanner.app')->middleware('auth');
