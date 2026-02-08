<?php

namespace Database\Seeders;

use App\Models\Extracurricular;
use Illuminate\Database\Seeder;

class ExtracurricularSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'name' => 'Futsal',
                'slug' => 'futsal',
                'description' => 'Ekstrakurikuler futsal melatih keterampilan bermain bola dan kerja sama tim. Siswa akan belajar teknik dasar, strategi permainan, dan membangun jiwa sportivitas.',
                'category' => 'olahraga',
                'schedule' => 'Senin & Rabu, 15:00-17:00',
                'coach' => 'Pak Ahmad Rasyid',
                'achievements' => "Juara 1 Liga Futsal Antar SMK Tangerang 2025\nJuara 2 Futsal Cup Banten 2024",
                'is_active' => true,
                'order' => 1,
            ],
            [
                'name' => 'Band Musik',
                'slug' => 'band-musik',
                'description' => 'Wadah untuk mengekspresikan bakat musik. Siswa belajar bermain alat musik, vokal, dan tampil di berbagai acara sekolah.',
                'category' => 'seni',
                'schedule' => 'Selasa & Kamis, 14:00-16:00',
                'coach' => 'Bu Diana Putri',
                'achievements' => "Juara 1 Festival Band Pelajar 2025\nPenampilan terbaik Graduation Ceremony 2024",
                'is_active' => true,
                'order' => 2,
            ],
            [
                'name' => 'English Club',
                'slug' => 'english-club',
                'description' => 'Tingkatkan kemampuan berbahasa Inggris melalui diskusi, debat, dan presentasi. Persiapan untuk kompetisi debat dan speech contest.',
                'category' => 'akademik',
                'schedule' => 'Jumat, 14:00-16:00',
                'coach' => 'Ms. Sarah Johnson',
                'achievements' => "Juara 2 English Debate Competition 2025\nFinalis Speech Contest National Level 2024",
                'is_active' => true,
                'order' => 3,
            ],
            [
                'name' => 'Robotika',
                'slug' => 'robotika',
                'description' => 'Pelajari dasar-dasar pemrograman dan elektronika. Siswa akan membuat dan memprogram robot untuk berbagai kompetisi.',
                'category' => 'teknologi',
                'schedule' => 'Sabtu, 08:00-11:00',
                'coach' => 'Pak Budi Santoso',
                'achievements' => "Juara 3 Kontes Robot Indonesia 2025\nBest Innovation Award Robotic Competition 2024",
                'is_active' => true,
                'order' => 4,
            ],
            [
                'name' => 'Rohis',
                'slug' => 'rohis',
                'description' => 'Organisasi kerohanian Islam yang membantu siswa mendalami agama dan mengembangkan akhlak mulia. Kegiatan meliputi kajian, bakti sosial, dan peringatan hari besar Islam.',
                'category' => 'keagamaan',
                'schedule' => 'Jumat, 12:00-13:00',
                'coach' => 'Ustadz Farid',
                'achievements' => "Juara 1 MTQ Tingkat Kota 2025\nPanitia Terbaik Ramadhan Camp 2024",
                'is_active' => true,
                'order' => 5,
            ],
            [
                'name' => 'Basket',
                'slug' => 'basket',
                'description' => 'Latihan basket intensif untuk pemain pemula hingga tingkat lanjut. Fokus pada teknik dasar, strategi tim, dan kompetisi antar sekolah.',
                'category' => 'olahraga',
                'schedule' => 'Selasa & Kamis, 15:00-17:00',
                'coach' => 'Pak Ryan Wijaya',
                'achievements' => "Juara 2 DBL Banten 2025",
                'is_active' => true,
                'order' => 6,
            ],
        ];

        foreach ($data as $item) {
            Extracurricular::updateOrCreate(
                ['slug' => $item['slug']],
                $item
            );
        }
    }
}
