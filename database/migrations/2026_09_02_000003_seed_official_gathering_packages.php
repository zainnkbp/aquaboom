<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\TicketPackage;
use Illuminate\Support\Facades\Log;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $packages = [
            [
                'name' => 'Paket Corporate Gathering & Outing',
                'name_en' => 'Corporate Gathering & Outing Package',
                'description' => 'Tingkatkan kekompakan dan sinergi tim kerja dengan program ice breaking water games seru, pemandu games profesional, panggung sambutan, sound system nirkabel, dan sajian buffet lezat di venue rooftop prestisius.',
                'description_en' => 'Boost team synergy with fun team building ice breaking water games, professional MC, private gazebo, sound system, and lunch buffet at our rooftop venue.',
                'terms_and_conditions' => "• Minimum pemesanan 10 orang/pax.\n• Sudah termasuk tiket all-access seluruh wahana.\n• Fasilitas sound system nirkabel & mikrofon.\n• Area gazebo privat rombongan.\n• Paket konsumsi buffet / lunch box dapat disesuaikan.",
                'terms_and_conditions_en' => "• Minimum 10 pax.\n• Includes all-access waterpark admission.\n• Wireless sound system & mic.\n• Private group gazebo.\n• Customizable buffet/lunch box menu.",
                'price' => 150000,
                'discount_price' => null,
                'discount_type' => 'amount',
                'type' => 'gathering',
                'image_url' => 'assets/img/gathering-corporate.jpg',
                'inquiry_type' => 'whatsapp',
                'is_active' => true,
                'is_featured_home' => true,
                'validity_type' => 'all_days',
            ],
            [
                'name' => 'Paket Family Gathering & Arisan',
                'name_en' => 'Family Gathering & Reunion Package',
                'description' => 'Ciptakan momen kebersamaan hangat bersama keluarga besar, reuni sekolah, atau arisan komunitas. Tersedia gazebo santai, kolam dangkal aman untuk balita, kolam arus santai, dan seluncuran seru untuk dewasa.',
                'description_en' => 'Create warm memories with big family, school reunion, or community gathering. Includes relaxed gazebo, shallow kids pool, lazy river, and slides.',
                'terms_and_conditions' => "• Minimum pemesanan 10 orang/pax.\n• Sudah termasuk tiket all-access seluruh wahana.\n• Complimentary sewa gazebo eksklusif.\n• Free sewa ban pelampung.\n• Diskon khusus rombongan keluarga.",
                'terms_and_conditions_en' => "• Minimum 10 pax.\n• Includes all-access waterpark admission.\n• Complimentary exclusive gazebo.\n• Free swimming tube / floats.\n• Special family group discount.",
                'price' => 120000,
                'discount_price' => null,
                'discount_type' => 'amount',
                'type' => 'gathering',
                'image_url' => 'assets/img/gathering-family.jpg',
                'inquiry_type' => 'whatsapp',
                'is_active' => true,
                'is_featured_home' => true,
                'validity_type' => 'all_days',
            ],
            [
                'name' => 'Paket School Field Trip & Edu-Tour',
                'name_en' => 'School Field Trip & Edu-Tour Package',
                'description' => 'Paket rekreasi edukatif untuk siswa PAUD, TK, SD, SMP, SMA, dan universitas. Mengedepankan keselamatan maksimal dengan edukasi renang aman dan pengawasan intensif tim lifeguard bersertifikat.',
                'description_en' => 'Educational fun water trip for preschool, elementary, junior/senior high, and university students. Focuses on water safety and certified lifeguard supervision.',
                'terms_and_conditions' => "• Minimum pemesanan 15 siswa.\n• Gratis tiket masuk untuk guru / pembina pendamping.\n• Sesi edukasi keselamatan air (water safety briefing).\n• Pengawasan penuh oleh tim lifeguard bersertifikat.",
                'terms_and_conditions_en' => "• Minimum 15 students.\n• Free admission for accompanying teachers.\n• Water safety briefing session.\n• Certified lifeguard supervision.",
                'price' => 75000,
                'discount_price' => null,
                'discount_type' => 'amount',
                'type' => 'gathering',
                'image_url' => 'assets/img/gathering-school.jpg',
                'inquiry_type' => 'whatsapp',
                'is_active' => true,
                'is_featured_home' => false,
                'validity_type' => 'all_days',
            ],
            [
                'name' => 'Paket Birthday & Private Pool Party',
                'name_en' => 'Birthday & Private Pool Party Package',
                'description' => 'Pesta ulang tahun impian di tepi kolam renang rooftop dengan pemandangan kota. Dilengkapi dekorasi balon warna-warni, paket kids meal, pemutaran lagu ulang tahun, dan spot foto yang Instagrammable.',
                'description_en' => 'Dream rooftop poolside birthday party with city views. Features colorful balloon setup, kids meal, birthday song sound system, and photo spot.',
                'terms_and_conditions' => "• Paket berlaku untuk 10 orang anak + pendamping.\n• Dekorasi tematik poolside & backdrop ulang tahun.\n• Sound system pemutaran lagu ulang tahun & mic.\n• Paket kids meal lezat + goodie bag area.",
                'terms_and_conditions_en' => "• Package for 10 kids + chaperones.\n• Thematic poolside backdrop & balloon arch.\n• Birthday sound system & mic.\n• Kids meals + goodie bag spot.",
                'price' => 1800000,
                'discount_price' => null,
                'discount_type' => 'amount',
                'type' => 'gathering',
                'image_url' => 'assets/img/gathering-birthday.jpg',
                'inquiry_type' => 'whatsapp',
                'is_active' => true,
                'is_featured_home' => true,
                'validity_type' => 'all_days',
            ],
        ];

        foreach ($packages as $data) {
            try {
                // Find existing by similar name or create new
                $existing = TicketPackage::where('name', $data['name'])
                    ->orWhere('name', 'LIKE', '%' . explode(' ', $data['name'])[1] . '%')
                    ->first();

                if ($existing) {
                    $existing->update($data);
                } else {
                    $nextId = ((int) TicketPackage::max('id')) + 1;
                    $pkg = new TicketPackage();
                    $pkg->id = $nextId;
                    $pkg->fill($data);
                    $pkg->save();
                }
            } catch (\Throwable $e) {
                Log::warning('Seeding gathering package error: ' . $e->getMessage());
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
