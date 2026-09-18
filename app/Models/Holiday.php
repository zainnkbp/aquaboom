<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Holiday extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date',
        'start_date',
        'end_date',
        'type',
        'is_active',
        'note',
    ];

    protected $attributes = [
        'sort_order' => 1,
        'is_active' => true,
        'type' => 'national_holiday',
    ];

    protected $casts = [
        'date' => 'date:Y-m-d',
        'start_date' => 'date:Y-m-d',
        'end_date' => 'date:Y-m-d',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Check if a specific date (Y-m-d) is a registered holiday or peak season.
     */
    public static function getHolidayForDate(string $dateString): ?self
    {
        $parsed = Carbon::parse($dateString)->format('Y-m-d');

        return static::active()
            ->where(function ($query) use ($parsed) {
                $query->whereDate('date', $parsed)
                    ->orWhere(function ($q) use ($parsed) {
                        $q->whereDate('start_date', '<=', $parsed)
                          ->whereDate('end_date', '>=', $parsed);
                    });
            })
            ->first();
    }

    /**
     * Returns true if date is holiday or peak season.
     */
    public static function isHolidayOrPeakSeason(string $dateString): bool
    {
        return static::getHolidayForDate($dateString) !== null;
    }

    /**
     * Sync Indonesian national holidays from official Google Calendar Indonesian Holiday feed.
     * Contains all ~28 national holidays, religious observances, and official Cuti Bersama.
     */
    public static function syncFromNationalApi(int $year): array
    {
        $imported = 0;
        $url = 'https://calendar.google.com/calendar/ical/id.indonesian%23holiday%40group.v.calendar.google.com/public/basic.ics';

        try {
            $response = Http::timeout(12)->get($url);
            if ($response->successful()) {
                $body = $response->body();
                preg_match_all('/BEGIN:VEVENT(.*?)END:VEVENT/s', $body, $matches);

                foreach ($matches[1] as $eventBlock) {
                    if (preg_match('/DTSTART(?:;VALUE=DATE)?:(\d{4})(\d{2})(\d{2})/', $eventBlock, $dateMatch) &&
                        preg_match('/SUMMARY:(.*?)(?:\r?\n|$)/', $eventBlock, $summaryMatch)) {
                        
                        $eventYear = (int) $dateMatch[1];
                        if ($eventYear !== $year) {
                            continue;
                        }

                        $holidayDate = "{$dateMatch[1]}-{$dateMatch[2]}-{$dateMatch[3]}";
                        $name = trim($summaryMatch[1]);
                        
                        // Clean any escaped characters (like \, or \;)
                        $name = str_replace(['\,', '\;'], [',', ';'], $name);

                        // Determine category: Cuti Bersama vs Hari Libur Nasional
                        $isCutiBersama = stripos($name, 'cuti bersama') !== false;
                        $type = $isCutiBersama ? 'joint_leave' : 'national_holiday';
                        $note = $isCutiBersama 
                            ? "Cuti Bersama Resmi {$year}. Berlaku tarif Weekend & Rekreasi."
                            : "Hari Libur Nasional Indonesia {$year}. Berlaku tarif Weekend & Liburan.";

                        static::updateOrCreate(
                            ['date' => $holidayDate],
                            [
                                'name' => $name,
                                'type' => $type,
                                'is_active' => true,
                                'note' => $note,
                            ]
                        );
                        $imported++;
                    }
                }
            }
        } catch (\Throwable $e) {
            Log::warning("Failed syncing holidays from Google feed for year {$year}: " . $e->getMessage());
        }

        // Fallback to Nager.date if Google Calendar was somehow unreachable
        if ($imported === 0) {
            try {
                $nagerUrl = "https://date.nager.at/api/v3/PublicHolidays/{$year}/ID";
                $nagerRes = Http::timeout(8)->get($nagerUrl);
                if ($nagerRes->successful()) {
                    foreach ($nagerRes->json() as $item) {
                        $holidayDate = $item['date'] ?? null;
                        $name = $item['localName'] ?? $item['name'] ?? 'Hari Libur Nasional';
                        if ($holidayDate) {
                            static::updateOrCreate(
                                ['date' => $holidayDate],
                                [
                                    'name' => $name,
                                    'type' => 'national_holiday',
                                    'is_active' => true,
                                    'note' => 'Kalender Libur Nasional Indonesia ' . $year,
                                ]
                            );
                            $imported++;
                        }
                    }
                }
            } catch (\Throwable $e) {
                Log::warning("Fallback Nager API failed: " . $e->getMessage());
            }
        }

        return [
            'success' => true,
            'imported' => $imported,
            'year' => $year,
        ];
    }
}
