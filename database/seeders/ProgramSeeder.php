<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $programs = [
            [
                'name' => 'Akuntansi dan Keuangan Lembaga',
                'code' => 'AKL',
                'description' => 'Program keahlian yang mempelajari tentang pencatatan, penggolongan, dan peringkasan transaksi keuangan serta penyusunan laporan keuangan.',
                'capacity' => 36,
                'current_students' => 0,
                'is_active' => true,
            ],
            [
                'name' => 'Desain Komunikasi Visual',
                'code' => 'DKV',
                'description' => 'Program keahlian yang mempelajari tentang desain grafis, multimedia, dan komunikasi visual untuk berbagai media.',
                'capacity' => 36,
                'current_students' => 0,
                'is_active' => true,
            ],
            [
                'name' => 'Pengembangan Perangkat Lunak dan Gim',
                'code' => 'PPLG',
                'description' => 'Program keahlian yang mempelajari tentang pemrograman, pengembangan aplikasi, dan pembuatan game.',
                'capacity' => 36,
                'current_students' => 0,
                'is_active' => true,
            ],
            [
                'name' => 'Kuliner',
                'code' => 'KLN',
                'description' => 'Program keahlian yang mempelajari tentang seni memasak, manajemen dapur, dan kewirausahaan kuliner.',
                'capacity' => 36,
                'current_students' => 0,
                'is_active' => true,
            ],
            [
                'name' => 'Perhotelan',
                'code' => 'HTL',
                'description' => 'Program keahlian yang mempelajari tentang manajemen hotel, pelayanan tamu, dan industri pariwisata.',
                'capacity' => 36,
                'current_students' => 0,
                'is_active' => true,
            ],
        ];

        foreach ($programs as $program) {
            Program::create($program);
        }
    }
}