<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Models\Transaction;

class DokuService
{
    protected string $clientId;
    protected string $secretKey;
    protected string $baseUrl;

    public function __construct()
    {
        $this->clientId = config('services.doku.client_id') ?? '';
        $this->secretKey = config('services.doku.secret_key') ?? '';
        $this->baseUrl = config('services.doku.env') === 'production'
            ? 'https://api.doku.com'
            : 'https://api-sandbox.doku.com';
    }

    /**
     * Membuat Sesi Pembayaran DOKU Checkout dan mendapatkan URL Pembayaran.
     */
    public function createCheckoutSession(Transaction $transaction): ?array
    {
        if (empty($this->clientId) || empty($this->secretKey)) {
            Log::error('DOKU Integration Error: Credentials not configured in .env');
            return null;
        }

        $target = '/checkout/v1/payment';
        $requestId = (string) Str::uuid();
        $timestamp = gmdate('Y-m-d\TH:i:s\Z');
        
        // Hilangkan strip agar aman untuk validasi invoice di semua payment channel DOKU
        $invoiceNumber = str_replace('-', '', $transaction->order_id);

        $payload = [
            'order' => [
                'invoice_number' => $invoiceNumber,
                'amount' => (int) round($transaction->total_price),
                'callback_url' => route('payment.doku.redirect', ['order_id' => $transaction->order_id, 'invoice_number' => $invoiceNumber]),
                'auto_redirect' => true,
            ],
            'payment' => [
                'payment_due_date' => 60
            ],
            'customer' => [
                'name' => $transaction->customer_name,
                'email' => $transaction->customer_email,
                'phone' => $transaction->customer_phone,
            ]
        ];

        $jsonBody = json_encode($payload);
        
        // Generate Digest
        $digest = base64_encode(hash('sha256', $jsonBody, true));

        // Generate Signature Component
        $component = "Client-Id:" . $this->clientId . "\n" .
                     "Request-Id:" . $requestId . "\n" .
                     "Request-Timestamp:" . $timestamp . "\n" .
                     "Request-Target:" . $target . "\n" .
                     "Digest:" . $digest;

        // Generate HMAC-SHA256 Signature
        $signature = 'HMACSHA256=' . base64_encode(hash_hmac('sha256', $component, $this->secretKey, true));

        Log::info('DOKU Checkout Request:', [
            'url' => $this->baseUrl . $target,
            'invoice' => $invoiceNumber,
            'amount' => $payload['order']['amount']
        ]);

        try {
            $response = Http::withHeaders([
                'Client-Id' => $this->clientId,
                'Request-Id' => $requestId,
                'Request-Timestamp' => $timestamp,
                'Signature' => $signature,
                'Content-Type' => 'application/json',
            ])->post($this->baseUrl . $target, $payload);

            if ($response->successful()) {
                Log::info('DOKU Checkout Response Success.');
                return $response->json();
            }

            Log::error('DOKU Checkout API Failed:', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);
        } catch (\Exception $e) {
            Log::error('DOKU Checkout Connection Exception: ' . $e->getMessage());
        }

        return null;
    }

    /**
     * Validasi Signature dari notifikasi Webhook DOKU.
     */
    public function validateNotificationSignature(array $headers, string $requestBody, string $targetPath): bool
    {
        $clientId = $headers['client-id'][0] ?? $headers['client-id'] ?? '';
        $requestId = $headers['request-id'][0] ?? $headers['request-id'] ?? '';
        $timestamp = $headers['request-timestamp'][0] ?? $headers['request-timestamp'] ?? '';
        $incomingSignature = $headers['signature'][0] ?? $headers['signature'] ?? '';

        if (!$clientId || !$requestId || !$timestamp || !$incomingSignature) {
            Log::warning('DOKU Callback Validation: Missing required headers.');
            return false;
        }

        $digest = base64_encode(hash('sha256', $requestBody, true));

        $component = "Client-Id:" . $clientId . "\n" .
                     "Request-Id:" . $requestId . "\n" .
                     "Request-Timestamp:" . $timestamp . "\n" .
                     "Request-Target:" . $targetPath . "\n" .
                     "Digest:" . $digest;

        $expectedSignature = 'HMACSHA256=' . base64_encode(hash_hmac('sha256', $component, $this->secretKey, true));

        return hash_equals($expectedSignature, $incomingSignature);
    }
}
