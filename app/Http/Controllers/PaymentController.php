<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Services\DokuService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketSent;

class PaymentController extends Controller
{
    protected DokuService $dokuService;

    public function __construct(DokuService $dokuService)
    {
        $this->dokuService = $dokuService;
    }

    /**
     * Memulai transaksi DOKU dan mengalihkan pembeli ke halaman pembayaran DOKU.
     */
    public function redirectToPayment($order_id)
    {
        $transaction = Transaction::where('order_id', $order_id)->firstOrFail();

        // Jika transaksi sudah dibayar, langsung alihkan ke halaman tiket
        if ($transaction->status === 'paid') {
            return redirect()->route('ticket.show', ['order_id' => $transaction->order_id]);
        }

        // Dapatkan sesi pembayaran baru dari DOKU
        $session = $this->dokuService->createCheckoutSession($transaction);

        if ($session && isset($session['response']['payment']['url'])) {
            $paymentUrl = $session['response']['payment']['url'];
            $paymentToken = $session['response']['uuid'] ?? null;

            // Simpan URL dan token pembayaran ke database
            $transaction->update([
                'payment_url' => $paymentUrl,
                'payment_token' => $paymentToken,
            ]);

            return redirect()->away($paymentUrl);
        }

        Log::error('DOKU Redirect Failed for Order ID: ' . $order_id);
        
        return redirect()->route('ticket.buy')->with('error', 'Gagal memproses sesi pembayaran DOKU. Pastikan kredensial DOKU di file .env sudah lengkap.');
    }

    /**
     * Menerima notifikasi asinkron (Webhook Web) dari DOKU.
     */
    public function handleNotification(Request $request)
    {
        $headers = array_change_key_case($request->headers->all(), CASE_LOWER);
        $body = $request->getContent();
        
        Log::info('DOKU Notification Received:', [
            'headers' => $headers,
            'body' => $body
        ]);

        // Validasi keaslian signature notifikasi
        if (!$this->dokuService->validateNotificationSignature($headers, $body, '/payment/doku/notification')) {
            Log::warning('DOKU Notification: Invalid signature from IP: ' . $request->ip());
            return response()->json(['message' => 'Invalid signature'], 400);
        }

        $data = $request->json()->all();
        $invoiceNumber = $data['order']['invoice_number'] ?? '';
        $transactionStatus = $data['transaction']['status'] ?? '';

        if (empty($invoiceNumber)) {
            Log::warning('DOKU Notification: Invoice number is missing in payload.');
            return response()->json(['message' => 'Invoice number missing'], 400);
        }

        // Cari transaksi dengan mencocokkan invoice yang dihilangkan tanda hubungnya
        $transaction = Transaction::whereRaw("replace(order_id::text, '-', '') = ?", [$invoiceNumber])->first();

        if (!$transaction) {
            Log::error('DOKU Notification: Transaction not found for invoice: ' . $invoiceNumber);
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        // Proses status pembayaran
        if (strtoupper($transactionStatus) === 'SUCCESS') {
            if ($transaction->status === 'pending') {
                $transaction->update(['status' => 'paid']);

                // Kirim e-ticket secara otomatis
                try {
                    Mail::to($transaction->customer_email)->send(new TicketSent($transaction));
                    Log::info('DOKU Notification: Payment success processed, E-Ticket email sent to ' . $transaction->customer_email);
                } catch (\Exception $e) {
                    Log::error('DOKU Notification: Failed to send E-Ticket email: ' . $e->getMessage());
                }
            }
            return response()->json(['message' => 'OK']);
        }

        if (in_array(strtoupper($transactionStatus), ['FAILED', 'EXPIRED'])) {
            $transaction->update(['status' => 'failed']);
            Log::info('DOKU Notification: Transaction marked as failed.');
        }

        return response()->json(['message' => 'OK']);
    }

    /**
     * Mengarahkan pengguna kembali ke halaman web pasca bayar (Return URL).
     */
    public function paymentRedirect(Request $request)
    {
        $orderId = $request->query('order_id');
        $invoiceNumber = $request->query('invoice_number') 
            ?? $request->query('INVOICE') 
            ?? $request->query('transidmerchant');

        $transaction = null;

        if ($orderId) {
            $transaction = Transaction::where('order_id', $orderId)->first();
        }

        if (!$transaction && $invoiceNumber) {
            $transaction = Transaction::whereRaw("replace(order_id::text, '-', '') = ?", [$invoiceNumber])->first();
        }

        if ($transaction) {
            // Selesaikan transaksi & kirim email e-ticket jika status masih pending
            if ($transaction->status === 'pending') {
                $transaction->update(['status' => 'paid']);
                try {
                    Mail::to($transaction->customer_email)->send(new TicketSent($transaction));
                    Log::info('PaymentRedirect: Transaction settled and E-Ticket sent to ' . $transaction->customer_email);
                } catch (\Exception $e) {
                    Log::error('PaymentRedirect: Failed sending E-Ticket email: ' . $e->getMessage());
                }
            }

            return redirect()->route('ticket.show', ['order_id' => $transaction->order_id])
                ->with('success', 'Pembayaran Anda berhasil! Berikut adalah E-Ticket Anda.');
        }

        return redirect()->route('ticket.buy')->with('info', 'Transaksi telah diproses. Silakan cek email Anda untuk e-ticket.');
    }
}
