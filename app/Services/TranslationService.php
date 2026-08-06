<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TranslationService
{
    /**
     * Translate text from one language to another using free Google Translate API.
     */
    public static function translate(?string $text, string $from = 'id', string $to = 'en'): string
    {
        if (empty($text)) {
            return '';
        }

        try {
            // Convert HTML to simple text if it contains tags to prevent Google Translate from breaking them,
            // or send directly. Since we might have HTML from RichEditor, we can strip tags for S&K or translate,
            // but Google Translate gtx client handles HTML tags reasonably well if they are simple.
            $response = Http::get('https://translate.googleapis.com/translate_a/single', [
                'client' => 'gtx',
                'sl' => $from,
                'tl' => $to,
                'dt' => 't',
                'q' => $text,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                if (isset($data[0])) {
                    $translatedText = '';
                    foreach ($data[0] as $sentence) {
                        $translatedText .= $sentence[0] ?? '';
                    }
                    return trim($translatedText);
                }
            }
        } catch (\Exception $e) {
            logger()->error('Google Translate API error: ' . $e->getMessage());
        }

        return $text ?? '';
    }
}
