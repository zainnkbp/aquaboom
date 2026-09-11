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
     * Sync Indonesian national holidays from official public API.
     */
    public static function syncFromNationalApi(int $year): array
    {
        $imported = 0;
        $url = "https://date.nager.at/api/v3/PublicHolidays/{$year}/ID";

        try {
            $response = Http::timeout(10)->get($url);
            if ($response->successful()) {
                $holidays = $response->json();
                foreach ($holidays as $item) {
                    $holidayDate = $item['date'] ?? null;
                    $name = $item['localName'] ?? $item['name'] ?? 'Hari Libur Nasional';

                    if ($holidayDate) {
                        static::updateOrCreate(
                            ['date' => $holidayDate],
                            [
                                'name' => $name,
                                'type' => 'national_holiday',
                                'is_active' => true,
                                'note' => 'Otomatis diimpor dari Kalender Libur Nasional Indonesia ' . $year,
                            ]
                        );
                        $imported++;
                    }
                }
            }
        } catch (\Throwable $e) {
            Log::warning("Failed syncing holidays from Nager API for year {$year}: " . $e->getMessage());
        }

        return [
            'success' => true,
            'imported' => $imported,
            'year' => $year,
        ];
    }
}
