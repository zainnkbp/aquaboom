<?php

use Illuminate\Support\Facades\Route;
use App\Models\Wahana;
use App\Models\Transaction;

use App\Livewire\ScannerLogin;
use App\Livewire\QrScanner;

use App\Models\Setting;
use App\Models\HomePageCard;
use App\Models\Facility;
use App\Models\Award;
use App\Models\Faq;

Route::get('/', function () {
    $wahanas = Wahana::orderBy('order_column')->get();
    $homeCards = HomePageCard::orderBy('sort_order')->get();
    $settings = Setting::pluck('value', 'key');
    
    // Featured Tickets & Promo Deals for Home Page
    $now = now();
    $featuredPackages = \App\Models\TicketPackage::where('is_active', true)
        ->where(function ($query) use ($now) {
            $query->whereNull('sales_start')->orWhere('sales_start', '<=', $now);
        })
        ->where(function ($query) use ($now) {
            $query->whereNull('sales_end')->orWhere('sales_end', '>=', $now);
        })
        ->orderByRaw('is_featured_home DESC, id ASC')
        ->take(4)
        ->get();

    return view('welcome', compact('wahanas', 'homeCards', 'settings', 'featuredPackages'));
})->name('home');

Route::get('/gatherings', function () {
    $now = now();
    $gatheringPackages = \App\Models\TicketPackage::where('is_active', true)
        ->where('type', 'gathering')
        ->where(function ($query) use ($now) {
            $query->whereNull('sales_start')->orWhere('sales_start', '<=', $now);
        })
        ->where(function ($query) use ($now) {
            $query->whereNull('sales_end')->orWhere('sales_end', '>=', $now);
        })
        ->get();
    $gatheringEvents = \App\Models\GatheringEvent::where('is_active', true)->orderBy('sort_order')->get();
    $settings = Setting::pluck('value', 'key');
    return view('gatherings', compact('gatheringPackages', 'gatheringEvents', 'settings'));
})->name('gatherings');

Route::get('/corporate-gathering', function () {
    return redirect()->route('gatherings');
});

Route::get('/group-events', function () {
    return redirect()->route('gatherings');
});

Route::get('/v0', function () {
    $wahanas = Wahana::orderBy('order_column')->get();
    return view('v0.welcome', compact('wahanas'));
});

Route::get('/ticket/{order_id}', function ($order_id) {
    $transaction = Transaction::where('order_id', $order_id)->firstOrFail();
    return view('ticket', compact('transaction'));
})->name('ticket.show');

Route::get('/book', function () {
    return redirect()->route('ticket.buy');
})->name('book');

Route::get('/checkout', function () {
    return redirect()->route('ticket.buy');
})->name('checkout');

Route::get('/ticket', function () {
    $now = now();
    $specialPackages = \App\Models\TicketPackage::where('is_active', true)
        ->whereIn('type', ['bundle', 'flash_sale'])
        ->where(function ($query) use ($now) {
            $query->whereNull('sales_start')
                  ->orWhere('sales_start', '<=', $now);
        })
        ->where(function ($query) use ($now) {
            $query->whereNull('sales_end')
                  ->orWhere('sales_end', '>=', $now);
        })
        ->orderBy('id', 'asc')
        ->get();

    return view('ticket-buy', compact('specialPackages'));
})->name('ticket.buy');

Route::get('/packages', function () {
    $now = now();
    $packages = \App\Models\TicketPackage::where('is_active', true)
        ->whereIn('type', ['bundle', 'flash_sale'])
        ->where(function ($query) use ($now) {
            $query->whereNull('sales_start')
                  ->orWhere('sales_start', '<=', $now);
        })
        ->where(function ($query) use ($now) {
            $query->whereNull('sales_end')
                  ->orWhere('sales_end', '>=', $now);
        })
        ->get();
    return view('packages', compact('packages'));
})->name('packages');

Route::get('/explore', function () {
    $wahanas = Wahana::orderBy('order_column')->get();
    return view('explore', compact('wahanas'));
})->name('explore');

Route::get('/facilities', function () {
    $facilities = Facility::where('type', '!=', 'dining')
        ->where('is_active', true)
        ->get();
    return view('facilities', compact('facilities'));
})->name('facilities');

Route::get('/dining', function () {
    $dinings = Facility::where('type', 'dining')->get();
    return view('dining', compact('dinings'));
})->name('dining');

Route::get('/about', function () {
    $awards = Award::orderBy('sort_order')->get();
    $settings = Setting::pluck('value', 'key');
    return view('about', compact('awards', 'settings'));
})->name('about');

Route::get('/faq', function () {
    $faqs = Faq::orderBy('sort_order')->get();
    return view('faq', compact('faqs'));
})->name('faq');

// Scanner App Routes
Route::get('/scanner/login', ScannerLogin::class)->name('scanner.login');
Route::get('/scanner', QrScanner::class)->name('scanner.app')->middleware('auth');

// Language Switcher Route
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['id', 'en'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');

// Account Activation Routes
Route::get('/activate-account', function (Illuminate\Http\Request $request) {
    $email = $request->get('email');
    $user = \App\Models\User::where('email', $email)->firstOrFail();
    return view('activate-account', compact('user'));
})->name('activate.account');

Route::post('/activate-account', function (Illuminate\Http\Request $request) {
    $request->validate([
        'email' => 'required|email|exists:users,email',
        'password' => 'required|string|min:8|confirmed',
    ]);

    $user = \App\Models\User::where('email', $request->email)->first();
    $user->update([
        'password' => Illuminate\Support\Facades\Hash::make($request->password),
    ]);

    auth()->login($user);

    return redirect()->route('ticket.buy')->with('success', 'Akun Anda berhasil diaktifkan!');
})->name('activate.account.submit');

// Customer Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::post('/login', function (Illuminate\Http\Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Illuminate\Support\Facades\Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('ticket.buy'));
        }

        return back()->withErrors([
            'email' => 'Email atau password salah / Email or password incorrect.',
        ])->onlyInput('email');
    })->name('login.submit');

    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');

    Route::post('/register', function (Illuminate\Http\Request $request) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Illuminate\Support\Facades\Hash::make($request->password),
            'role' => 'customer',
        ]);

        Illuminate\Support\Facades\Auth::login($user);

        return redirect()->route('ticket.buy')->with('success', 'Pendaftaran berhasil!');
    })->name('register.submit');
});

Route::any('/logout', function (Illuminate\Http\Request $request) {
    Illuminate\Support\Facades\Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// Customer Dashboard
Route::middleware('auth')->group(function () {
    Route::get('/my-tickets', function () {
        $transactions = Transaction::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();
        return view('my-tickets', compact('transactions'));
    })->name('my.tickets');
});

// DOKU Payment Gateway Routes
Route::get('/payment/doku/pay/{order_id}', [\App\Http\Controllers\PaymentController::class, 'redirectToPayment'])->name('payment.doku.pay');
Route::post('/payment/doku/notification', [\App\Http\Controllers\PaymentController::class, 'handleNotification'])->name('payment.doku.notification');
Route::get('/payment/doku/redirect', [\App\Http\Controllers\PaymentController::class, 'paymentRedirect'])->name('payment.doku.redirect');

