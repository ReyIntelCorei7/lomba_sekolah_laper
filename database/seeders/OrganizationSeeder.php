<?php

namespace Database\Seeders;

use App\Models\Organization;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'name' => 'OSIS SMK Metland',
                'slug' => 'osis',
                'abbreviation' => 'OSIS',
                'description' => 'Organisasi Siswa Intra Sekolah adalah wadah organisasi tertinggi siswa di SMK Metland. OSIS bertanggung jawab menyelenggarakan berbagai kegiatan dan program untuk mengembangkan potensi siswa.',
                'category' => 'osis',
                'advisor' => 'Pak Ahmad Wijaya',
                'vision' => 'Menjadi organisasi siswa yang kreatif, inovatif, dan berkarakter dalam membangun generasi muda Indonesia yang berkualitas.',
                'mission' => "Mengembangkan potensi siswa melalui kegiatan yang bermanfaat\nMenyelenggarakan program kerja yang inovatif dan kreatif\nMembina hubungan yang harmonis antar warga sekolah\nMeningkatkan prestasi akademik dan non-akademik siswa",
                'achievements' => "OSIS Terbaik Tingkat Kota Tangerang 2025\nPenyelenggara Event Sekolah Terbaik 2024",
                'is_active' => true,
                'order' => 1,
            ],
            [
                'name' => 'Majelis Perwakilan Kelas',
                'slug' => 'mpk',
                'abbreviation' => 'MPK',
                'description' => 'Majelis Perwakilan Kelas adalah lembaga legislatif siswa yang bertugas mengawasi kinerja OSIS dan menjadi wadah aspirasi siswa.',
                'category' => 'mpk',
                'advisor' => 'Bu Dewi Sartika',
                'vision' => 'Menjadi lembaga perwakilan siswa yang aspiratif, kritis, dan bertanggung jawab.',
                'mission' => "Menampung dan menyalurkan aspirasi siswa\nMengawasi kinerja OSIS\nMendorong terciptanya suasana demokratis di sekolah",
                'achievements' => "Penyelenggara Forum Siswa Terbaik 2025",
                'is_active' => true,
                'order' => 2,
            ],
            [
                'name' => 'Gerakan Pramuka SMK Metland',
                'slug' => 'pramuka',
                'abbreviation' => 'Pramuka',
                'description' => 'Gerakan Pramuka adalah organisasi kepanduan yang mendidik siswa untuk mandiri, disiplin, dan bertanggung jawab melalui berbagai kegiatan alam terbuka.',
                'category' => 'pramuka',
                'advisor' => 'Pak Budi Hartono',
                'vision' => 'Membentuk generasi muda yang berkarakter, mandiri, dan cinta tanah air.',
                'mission' => "Melaksanakan kegiatan kepramukaan secara rutin\nMengembangkan keterampilan survival dan kepemimpinan\nMenanamkan nilai-nilai Pancasila dan cinta tanah air",
                'achievements' => "Juara 2 Lomba Pramuka Tingkat Provinsi 2025\nJuara 1 Kemah Pramuka Kota Tangerang 2024",
                'is_active' => true,
                'order' => 3,
            ],
            [
                'name' => 'Palang Merah Remaja',
                'slug' => 'pmr',
                'abbreviation' => 'PMR',
                'description' => 'Palang Merah Remaja adalah organisasi kemanusiaan yang melatih siswa dalam bidang pertolongan pertama dan kegiatan sosial.',
                'category' => 'pmr',
                'advisor' => 'Bu Siti Nurjanah',
                'vision' => 'Menjadi organisasi kemanusiaan remaja yang profesional dan peduli sesama.',
                'mission' => "Memberikan pelatihan pertolongan pertama kepada anggota\nMelaksanakan kegiatan sosial dan donor darah\nMembantu korban bencana",
                'achievements' => "Juara 1 Lomba PP PMR Tingkat Kota 2025\nPenyelenggara Donor Darah Terbaik 2024",
                'is_active' => true,
                'order' => 4,
            ],
            [
                'name' => 'Pasukan Pengibar Bendera',
                'slug' => 'paskibra',
                'abbreviation' => 'PASKIBRA',
                'description' => 'Pasukan Pengibar Bendera adalah organisasi yang melatih kedisiplinan, ketangkasan, dan jiwa patriotisme melalui baris-berbaris.',
                'category' => 'paskibra',
                'advisor' => 'Pak Rudi Santoso',
                'vision' => 'Menjadi pasukan pengibar bendera yang disiplin, tangguh, dan berprestasi.',
                'mission' => "Melatih kedisiplinan melalui baris-berbaris\nMengibarkan bendera dengan penuh kebanggaan\nMengikuti berbagai kompetisi paskibra",
                'achievements' => "Paskibra Tingkat Kecamatan 2025\nJuara 3 Lomba Paskibra Kota Tangerang 2024",
                'is_active' => true,
                'order' => 5,
            ],
        ];

        foreach ($data as $item) {
            Organization::updateOrCreate(
                ['slug' => $item['slug']],
                $item
            );
        }
    }
}
