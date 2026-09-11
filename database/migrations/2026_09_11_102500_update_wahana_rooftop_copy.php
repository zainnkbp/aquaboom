<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Wahana;

return new class extends Migration
{
    public function up(): void
    {
        Wahana::where('id', 2)->orWhere('name', 'like', '%Rooftop%')->update([
            'name' => 'Splash & Leisure Pool',
            'name_en' => 'Splash & Leisure Pool',
            'description' => 'Nikmati sensasi berenang santai yang menyenangkan di 7F - Shared Common Area for Astara Hotel & Pentacity Hotel Balikpapan dengan pemandangan kota Balikpapan.',
            'description_en' => 'Enjoy the sensation of relaxing swimming on 7F - Shared Common Area for Astara Hotel & Pentacity Hotel Balikpapan with Balikpapan city views.',
        ]);
    }

    public function down(): void
    {
    }
};
