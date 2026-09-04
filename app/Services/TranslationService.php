<?php

namespace App\Services;

use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TranslationService
{
    /**
     * Browser user-agent to avoid automated bot blocking on public endpoints.
     */
    protected const USER_AGENT = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36';

    /**
     * Translate text from one language to another using multi-engine fallback (Google POST -> Google GET -> MyMemory).
     */
    public static function translate(?string $text, string $from = 'id', string $to = 'en', bool $returnOriginalOnFailure = false): string
    {
        if ($text === null || trim($text) === '' || trim(strip_tags($text)) === '') {
            return '';
        }

        $trimmed = trim($text);

        // 1. Try Google Translate via POST (supports large payloads, avoids URL length limits)
        $translated = self::translateWithGooglePost($trimmed, $from, $to);
        if (self::isValidTranslation($translated, $trimmed)) {
            return $translated;
        }

        // 2. Try Google Translate via GET (standard gtx client)
        $translated = self::translateWithGoogleGet($trimmed, $from, $to);
        if (self::isValidTranslation($translated, $trimmed)) {
            return $translated;
        }

        // 3. Fallback: MyMemory Translated API (reliable for cloud / datacenter IPs)
        $translated = self::translateWithMyMemory($trimmed, $from, $to);
        if (self::isValidTranslation($translated, $trimmed)) {
            return $translated;
        }

        Log::warning("Translation failed across all engines for text: " . mb_substr(strip_tags($trimmed), 0, 80));

        return $returnOriginalOnFailure ? $text : '';
    }

    /**
     * Translate a form field in Filament, update target field, and send user-facing Notification.
     */
    public static function translateField(callable $set, ?string $state, string $targetField, string $fieldLabel = 'Teks', string $from = 'id', string $to = 'en'): void
    {
        if ($state === null || trim(strip_tags($state)) === '') {
            Notification::make()
                ->title('Teks Sumber Kosong')
                ->body("Silakan ketik {$fieldLabel} terlebih dahulu sebelum menerjemahkan.")
                ->warning()
                ->send();
            return;
        }

        $translated = self::translate($state, $from, $to);

        if (!empty($translated)) {
            $set($targetField, $translated);

            Notification::make()
                ->title('Berhasil Diterjemahkan')
                ->body("{$fieldLabel} berhasil diterjemahkan ke Bahasa Inggris.")
                ->success()
                ->send();
        } else {
            Notification::make()
                ->title('Gagal Menerjemahkan')
                ->body("Layanan terjemahan sedang sibuk atau tidak dapat dijangkau. Kolom Bahasa Inggris tidak diubah.")
                ->danger()
                ->send();
        }
    }

    /**
     * Translate array of strings (e.g. features list) in Filament.
     */
    public static function translateArrayField(callable $set, ?array $state, string $targetField, string $fieldLabel = 'Fitur', string $from = 'id', string $to = 'en'): void
    {
        if (empty($state) || !is_array($state)) {
            Notification::make()
                ->title('Daftar Kosong')
                ->body("Silakan tambahkan setidaknya satu {$fieldLabel} terlebih dahulu.")
                ->warning()
                ->send();
            return;
        }

        $translatedList = [];
        $failedCount = 0;

        foreach ($state as $item) {
            if (is_string($item) && trim($item) !== '') {
                $translated = self::translate($item, $from, $to);
                if (!empty($translated)) {
                    $translatedList[] = $translated;
                } else {
                    $translatedList[] = $item;
                    $failedCount++;
                }
            }
        }

        if (!empty($translatedList)) {
            $set($targetField, $translatedList);

            if ($failedCount === 0) {
                Notification::make()
                    ->title('Berhasil Diterjemahkan')
                    ->body("Semua {$fieldLabel} berhasil diterjemahkan ke Bahasa Inggris.")
                    ->success()
                    ->send();
            } else {
                Notification::make()
                    ->title('Terjemahan Sebagian')
                    ->body("Sebagian {$fieldLabel} berhasil diterjemahkan, namun beberapa item gagal.")
                    ->warning()
                    ->send();
            }
        }
    }

    /**
     * Google Translate via POST request.
     */
    protected static function translateWithGooglePost(string $text, string $from, string $to): ?string
    {
        try {
            $response = Http::asForm()
                ->withHeaders([
                    'User-Agent' => self::USER_AGENT,
                    'Accept' => '*/*',
                ])
                ->timeout(6)
                ->post("https://translate.googleapis.com/translate_a/single?client=gtx&sl={$from}&tl={$to}&dt=t", [
                    'q' => $text,
                ]);

            if ($response->successful()) {
                $data = $response->json();
                if (isset($data[0]) && is_array($data[0])) {
                    $result = '';
                    foreach ($data[0] as $sentence) {
                        $result .= $sentence[0] ?? '';
                    }
                    return trim($result);
                }
            }
        } catch (\Throwable $e) {
            Log::debug('Google POST translate error: ' . $e->getMessage());
        }

        return null;
    }

    /**
     * Google Translate via GET request.
     */
    protected static function translateWithGoogleGet(string $text, string $from, string $to): ?string
    {
        try {
            $response = Http::withHeaders([
                'User-Agent' => self::USER_AGENT,
                'Accept' => '*/*',
            ])
                ->timeout(5)
                ->get('https://translate.googleapis.com/translate_a/single', [
                    'client' => 'gtx',
                    'sl' => $from,
                    'tl' => $to,
                    'dt' => 't',
                    'q' => $text,
                ]);

            if ($response->successful()) {
                $data = $response->json();
                if (isset($data[0]) && is_array($data[0])) {
                    $result = '';
                    foreach ($data[0] as $sentence) {
                        $result .= $sentence[0] ?? '';
                    }
                    return trim($result);
                }
            }
        } catch (\Throwable $e) {
            Log::debug('Google GET translate error: ' . $e->getMessage());
        }

        return null;
    }

    /**
     * MyMemory Translated API fallback.
     */
    protected static function translateWithMyMemory(string $text, string $from, string $to): ?string
    {
        try {
            $response = Http::withHeaders([
                'User-Agent' => self::USER_AGENT,
            ])
                ->timeout(6)
                ->get('https://api.mymemory.translated.net/get', [
                    'q' => $text,
                    'langpair' => "{$from}|{$to}",
                ]);

            if ($response->successful()) {
                $translated = $response->json('responseData.translatedText');
                if (!empty($translated)) {
                    // MyMemory returns HTML-encoded entities like &#39;
                    $decoded = html_entity_decode($translated, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                    return trim($decoded);
                }
            }
        } catch (\Throwable $e) {
            Log::debug('MyMemory translate error: ' . $e->getMessage());
        }

        return null;
    }

    /**
     * Verify that translation returned valid text and didn't just echo back untranslated source.
     */
    protected static function isValidTranslation(?string $translated, string $original): bool
    {
        if (empty($translated)) {
            return false;
        }

        // Strip tags and whitespace to compare semantic equality
        $cleanTranslated = strtolower(trim(strip_tags($translated)));
        $cleanOriginal = strtolower(trim(strip_tags($original)));

        // If it's a long sentence and returned the exact identical text, it failed to translate
        if (mb_strlen($cleanOriginal) > 15 && $cleanTranslated === $cleanOriginal) {
            return false;
        }

        return true;
    }
}
