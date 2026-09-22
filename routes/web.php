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
use App\Models\TicketPackage;

// Helper closures for public pages
$showHome = function () {
    $wahanas = Wahana::orderBy('order_column')->get();
    $homeCards = HomePageCard::orderBy('sort_order')->get();
    $settings = Setting::pluck('value', 'key');
    
    $now = now();
    $featuredPackages = TicketPackage::where('is_active', true)
        ->where('price', '>', 0)
        ->where('type', '!=', 'gathering')
        ->where(function ($query) use ($now) {
            $query->whereNull('sales_start')->orWhere('sales_start', '<=', $now);
        })
        ->where(function ($query) use ($now) {
            $query->whereNull('sales_end')->orWhere('sales_end', '>=', $now);
        })
        ->orderByRaw('is_featured_home DESC, sort_order ASC, id ASC')
        ->take(3)
        ->get();

    return view('welcome', compact('wahanas', 'homeCards', 'settings', 'featuredPackages'));
};

$showGatherings = function () {
    $now = now();
    $gatheringPackages = TicketPackage::where('is_active', true)
        ->where('type', 'gathering')
        ->where(function ($query) use ($now) {
            $query->whereNull('sales_start')->orWhere('sales_start', '<=', $now);
        })
        ->where(function ($query) use ($now) {
            $query->whereNull('sales_end')->orWhere('sales_end', '>=', $now);
        })
        ->orderBy('sort_order', 'asc')
        ->orderBy('id', 'asc')
        ->get();
    $settings = Setting::pluck('value', 'key');
    return view('gatherings', compact('gatheringPackages', 'settings'));
};

$showPackages = function () {
    $now = now();
    $packages = TicketPackage::where('is_active', true)
        ->whereIn('type', ['bundle', 'flash_sale'])
        ->where(function ($query) use ($now) {
            $query->whereNull('sales_start')->orWhere('sales_start', '<=', $now);
        })
        ->where(function ($query) use ($now) {
            $query->whereNull('sales_end')->orWhere('sales_end', '>=', $now);
        })
        ->orderBy('sort_order', 'asc')
        ->orderBy('id', 'asc')
        ->get();
    return view('packages', compact('packages'));
};

$showExplore = function () {
    $wahanas = Wahana::orderBy('order_column')->get();
    return view('explore', compact('wahanas'));
};

$showFacilities = function () {
    $facilities = Facility::where('type', '!=', 'dining')
        ->where('is_active', true)
        ->orderBy('sort_order', 'asc')
        ->orderBy('id', 'asc')
        ->get();
    return view('facilities', compact('facilities'));
};

$showDining = function () {
    $dinings = Facility::where('type', 'dining')
        ->where('is_active', true)
        ->orderBy('sort_order', 'asc')
        ->orderBy('id', 'asc')
        ->get();
    return view('dining', compact('dinings'));
};

$showAbout = function () {
    $awards = Award::orderBy('sort_order')->get();
    $settings = Setting::pluck('value', 'key');
    return view('about', compact('awards', 'settings'));
};

$showFaq = function () {
    $faqs = Faq::orderBy('sort_order')->get();
    return view('faq', compact('faqs'));
};

$showTicket = fn() => view('ticket-buy');
$showPrivacy = fn() => view('privacy');
$showTerms = fn() => view('terms');

// Dynamic Sitemap & Robots Route (serves physical files)
Route::get('/sitemap.xml', function () {
    if (file_exists(public_path('sitemap.xml'))) {
        return response(file_get_contents(public_path('sitemap.xml')), 200, ['Content-Type' => 'text/xml']);
    }
    abort(404);
})->name('sitemap');

Route::get('/robots.txt', function () {
    if (file_exists(public_path('robots.txt'))) {
        return response(file_get_contents(public_path('robots.txt')), 200, ['Content-Type' => 'text/plain']);
    }
    abort(404);
})->name('robots');

// Public Indonesian / Root Routes
Route::get('/', $showHome)->name('home');
Route::get('/ticket', $showTicket)->name('ticket.buy');
Route::get('/explore', $showExplore)->name('explore');
Route::get('/facilities', $showFacilities)->name('facilities');
Route::get('/dining', $showDining)->name('dining');
Route::get('/gatherings', $showGatherings)->name('gatherings');
Route::get('/packages', $showPackages)->name('packages');
Route::get('/about', $showAbout)->name('about');
Route::get('/faq', $showFaq)->name('faq');
Route::get('/privacy-policy', $showPrivacy)->name('privacy');
Route::get('/terms-and-conditions', $showTerms)->name('terms');

// English Public Routes (Prefix /en)
Route::prefix('en')->group(function () use ($showHome, $showTicket, $showExplore, $showFacilities, $showDining, $showGatherings, $showPackages, $showAbout, $showFaq, $showPrivacy, $showTerms) {
    Route::get('/', $showHome)->name('en.home');
    Route::get('/ticket', $showTicket)->name('en.ticket.buy');
    Route::get('/explore', $showExplore)->name('en.explore');
    Route::get('/facilities', $showFacilities)->name('en.facilities');
    Route::get('/dining', $showDining)->name('en.dining');
    Route::get('/gatherings', $showGatherings)->name('en.gatherings');
    Route::get('/packages', $showPackages)->name('en.packages');
    Route::get('/about', $showAbout)->name('en.about');
    Route::get('/faq', $showFaq)->name('en.faq');
    Route::get('/privacy-policy', $showPrivacy)->name('en.privacy');
    Route::get('/terms-and-conditions', $showTerms)->name('en.terms');
});

// Legacy & Alias Redirects
Route::get('/corporate-gathering', fn() => redirect()->route('gatherings'));
Route::get('/group-events', fn() => redirect()->route('gatherings'));
Route::get('/book', fn() => redirect()->route('ticket.buy'))->name('book');
Route::get('/checkout', fn() => redirect()->route('ticket.buy'))->name('checkout');
Route::get('/privacy', fn() => redirect()->route('privacy'));
Route::get('/terms', fn() => redirect()->route('terms'));
Route::get('/syarat-ketentuan', fn() => redirect()->route('terms'));

// E-Ticket Voucher Show
Route::get('/ticket/{order_id}', function ($order_id) {
    $transaction = Transaction::where('order_id', $order_id)->firstOrFail();

    // Keamanan: Tiket hanya dapat diakses jika berstatus paid (lunas) atau scanned
    if (!in_array($transaction->status, ['paid', 'scanned'])) {
        if ($transaction->status === 'pending' && !empty($transaction->payment_url)) {
            return redirect()->away($transaction->payment_url);
        }
        return redirect()->route('ticket.buy')->with('warning', 'Pesanan ini belum dibayar atau sedang menunggu penyelesaian pembayaran.');
    }

    return view('ticket', compact('transaction'));
})->name('ticket.show');

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

// Account Activation Routes (Protected: strictly for customer role with rate limiting)
Route::get('/activate-account', function (Illuminate\Http\Request $request) {
    $email = $request->get('email');
    if (!$email) {
        return redirect()->route('login');
    }
    $user = \App\Models\User::where('email', $email)->where('role', \App\Models\User::ROLE_CUSTOMER)->firstOrFail();
    return view('activate-account', compact('user'));
})->name('activate.account');

Route::post('/activate-account', function (Illuminate\Http\Request $request) {
    $request->validate([
        'email' => 'required|email|exists:users,email',
        'password' => 'required|string|min:8|confirmed',
    ]);

    // Strict security check: only customer accounts can be activated via this public endpoint
    $user = \App\Models\User::where('email', $request->email)
        ->where('role', \App\Models\User::ROLE_CUSTOMER)
        ->first();

    if (!$user) {
        abort(403, 'Akses tidak diizinkan. Akun staf atau admin tidak dapat diubah melalui tautan ini.');
    }

    $user->update([
        'password' => Illuminate\Support\Facades\Hash::make($request->password),
    ]);

    auth()->login($user);

    return redirect()->route('ticket.buy')->with('success', 'Akun Anda berhasil diaktifkan!');
})->name('activate.account.submit')->middleware('throttle:6,1');

// Customer Authentication Routes (With Brute-force Throttling)
Route::middleware('guest')->group(function () {
    Route::get('/login', fn() => view('auth.login'))->name('login');

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
    })->name('login.submit')->middleware('throttle:6,1');

    Route::get('/register', fn() => view('auth.register'))->name('register');

    Route::post('/register', function (Illuminate\Http\Request $request) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['nullable', 'string', 'max:25'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Illuminate\Support\Facades\Hash::make($request->password),
            'role' => \App\Models\User::ROLE_CUSTOMER,
        ]);

        try {
            $user->sendEmailVerificationNotification();
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning('Verification email failed to send on registration: ' . $e->getMessage());
        }

        Illuminate\Support\Facades\Auth::login($user);

        return redirect()->route('ticket.buy')->with('success', 'Pendaftaran berhasil! Kami telah mengirimkan email verifikasi untuk mengonfirmasi akun Anda.');
    })->name('register.submit')->middleware('throttle:6,1');

    // Google OAuth Routes
    Route::get('/auth/google', [\App\Http\Controllers\SocialAuthController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('/auth/google/callback', [\App\Http\Controllers\SocialAuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');

    // Forgot & Reset Password Routes
    Route::get('/forgot-password', [\App\Http\Controllers\Auth\PasswordResetController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/forgot-password', [\App\Http\Controllers\Auth\PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email')->middleware('throttle:6,1');
    Route::get('/reset-password/{token}', [\App\Http\Controllers\Auth\PasswordResetController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [\App\Http\Controllers\Auth\PasswordResetController::class, 'reset'])->name('password.update');
});

// Email Verification Routes
Route::middleware('auth')->group(function () {
    Route::get('/email/verify', fn() => view('auth.verify-email'))->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (Illuminate\Foundation\Auth\EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect()->route('ticket.buy')->with('success', 'Alamat email Anda berhasil diverifikasi!');
    })->middleware(['signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Illuminate\Http\Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('status', 'verification-link-sent');
    })->middleware(['throttle:6,1'])->name('verification.send');
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

    Route::post('/my-tickets/change-password', function (Illuminate\Http\Request $request) {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'current_password.current_password' => 'Password saat ini tidak sesuai.',
            'password.min' => 'Password baru minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        $user = auth()->user();
        $user->update([
            'password' => Illuminate\Support\Facades\Hash::make($request->password),
        ]);

        return back()->with('password_success', 'Password Anda berhasil diperbarui!');
    })->name('my.tickets.change_password');
});

// DOKU Payment Gateway Routes
Route::get('/payment/doku/pay/{order_id}', [\App\Http\Controllers\PaymentController::class, 'redirectToPayment'])->name('payment.doku.pay');
Route::post('/payment/doku/notification', [\App\Http\Controllers\PaymentController::class, 'handleNotification'])->name('payment.doku.notification');
Route::get('/payment/doku/redirect', [\App\Http\Controllers\PaymentController::class, 'paymentRedirect'])->name('payment.doku.redirect');
