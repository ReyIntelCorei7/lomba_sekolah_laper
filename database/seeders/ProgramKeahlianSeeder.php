<?php

namespace Database\Seeders;

use App\Models\ProgramKeahlian;
use App\Models\ProgramSkill;
use App\Models\ProgramCareer;
use Illuminate\Database\Seeder;

class ProgramKeahlianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programs = [
            // 1. AKUNTANSI
            [
                'name' => 'Akuntansi & Keuangan Lembaga',
                'short_name' => 'AKL',
                'slug' => 'akuntansi',
                'description' => 'Kuasai siklus akuntansi, komputer akuntansi, dan administrasi pajak untuk menjadi akuntan profesional yang handal dan siap kerja.',
                'short_description' => 'Kuasai siklus akuntansi, komputer akuntansi, dan administrasi pajak untuk menjadi akuntan profesional.',
                'color_theme' => 'indigo',
                'icon' => '💰',
                'stat_competencies' => 7,
                'stat_employment' => 95,
                'stat_partners' => 10,
                'salary_range' => 'Rp 5-15 Jt',
                'overview_content' => 'Program keahlian Akuntansi dan Keuangan Lembaga membekali siswa dengan kemampuan mengelola keuangan, menyusun laporan keuangan, dan administrasi perpajakan. Lulusan siap bekerja di berbagai sektor industri dan lembaga keuangan.',
                'skills' => [
                    ['name' => 'Akuntansi Keuangan', 'description' => 'Menyusun laporan keuangan sesuai SAK', 'icon' => '📊', 'gradient_from' => 'blue-500', 'gradient_to' => 'indigo-600'],
                    ['name' => 'Komputer Akuntansi', 'description' => 'Mengoperasikan software MYOB & Accurate', 'icon' => '💻', 'gradient_from' => 'indigo-500', 'gradient_to' => 'purple-600'],
                    ['name' => 'Administrasi Pajak', 'description' => 'Mengelola SPT dan perpajakan', 'icon' => '📝', 'gradient_from' => 'purple-500', 'gradient_to' => 'violet-600'],
                    ['name' => 'Spreadsheet', 'description' => 'Mahir Excel untuk analisis data', 'icon' => '📈', 'gradient_from' => 'green-500', 'gradient_to' => 'emerald-600'],
                    ['name' => 'Etika Profesi', 'description' => 'Standar profesional akuntan', 'icon' => '⚖️', 'gradient_from' => 'amber-500', 'gradient_to' => 'orange-600'],
                    ['name' => 'Perbankan Dasar', 'description' => 'Operasional perbankan', 'icon' => '🏦', 'gradient_from' => 'sky-500', 'gradient_to' => 'blue-600'],
                ],
                'careers' => [
                    ['name' => 'Staff Akuntansi', 'description' => 'Mengelola pembukuan perusahaan', 'icon' => '👨‍💼', 'gradient_from' => 'blue-500', 'gradient_to' => 'indigo-600'],
                    ['name' => 'Staff Pajak', 'description' => 'Mengelola administrasi perpajakan', 'icon' => '📋', 'gradient_from' => 'indigo-500', 'gradient_to' => 'purple-600'],
                    ['name' => 'Kasir Bank', 'description' => 'Teller di lembaga keuangan', 'icon' => '🏧', 'gradient_from' => 'purple-500', 'gradient_to' => 'pink-600'],
                    ['name' => 'Auditor Junior', 'description' => 'Pemeriksaan keuangan perusahaan', 'icon' => '🔍', 'gradient_from' => 'emerald-500', 'gradient_to' => 'teal-600'],
                ],
            ],
            // 2. DKV
            [
                'name' => 'Desain Komunikasi Visual',
                'short_name' => 'DKV',
                'slug' => 'dkv',
                'description' => 'Kuasai desain grafis, multimedia, videografi, dan animasi untuk menjadi kreator visual profesional.',
                'short_description' => 'Kuasai desain grafis, multimedia, videografi, dan animasi untuk menjadi kreator visual profesional.',
                'color_theme' => 'purple',
                'icon' => '🎨',
                'stat_competencies' => 8,
                'stat_employment' => 92,
                'stat_partners' => 12,
                'salary_range' => 'Rp 6-20 Jt',
                'overview_content' => 'Program keahlian Desain Komunikasi Visual membekali siswa dengan kemampuan kreasi visual untuk berbagai media. Dari desain grafis, fotografi, hingga produksi video dan animasi.',
                'skills' => [
                    ['name' => 'Desain Grafis', 'description' => 'Photoshop, Illustrator, CorelDraw', 'icon' => '🖌️', 'gradient_from' => 'purple-500', 'gradient_to' => 'pink-600'],
                    ['name' => 'Video Editing', 'description' => 'Premiere Pro, DaVinci Resolve', 'icon' => '🎬', 'gradient_from' => 'pink-500', 'gradient_to' => 'rose-600'],
                    ['name' => 'Motion Graphics', 'description' => 'After Effects, animasi digital', 'icon' => '✨', 'gradient_from' => 'violet-500', 'gradient_to' => 'purple-600'],
                    ['name' => 'Fotografi', 'description' => 'Teknik foto dan lighting', 'icon' => '📷', 'gradient_from' => 'blue-500', 'gradient_to' => 'indigo-600'],
                    ['name' => 'UI/UX Design', 'description' => 'Figma, desain interface', 'icon' => '📱', 'gradient_from' => 'cyan-500', 'gradient_to' => 'blue-600'],
                    ['name' => 'Branding', 'description' => 'Identitas visual & logo', 'icon' => '🏷️', 'gradient_from' => 'amber-500', 'gradient_to' => 'orange-600'],
                ],
                'careers' => [
                    ['name' => 'Graphic Designer', 'description' => 'Desainer di agency kreatif', 'icon' => '🎨', 'gradient_from' => 'purple-500', 'gradient_to' => 'pink-600'],
                    ['name' => 'Video Editor', 'description' => 'Editor konten video', 'icon' => '🎥', 'gradient_from' => 'pink-500', 'gradient_to' => 'rose-600'],
                    ['name' => 'UI Designer', 'description' => 'Desainer antarmuka aplikasi', 'icon' => '📱', 'gradient_from' => 'blue-500', 'gradient_to' => 'indigo-600'],
                    ['name' => 'Content Creator', 'description' => 'Kreator konten digital', 'icon' => '📸', 'gradient_from' => 'orange-500', 'gradient_to' => 'amber-600'],
                ],
            ],
            // 3. PPLG
            [
                'name' => 'Pengembangan Perangkat Lunak & Gim',
                'short_name' => 'PPLG',
                'slug' => 'pplg',
                'description' => 'Pelajari coding, pengembangan web, aplikasi mobile, dan game development dengan teknologi terkini.',
                'short_description' => 'Pelajari coding, pengembangan web, aplikasi mobile, dan game development dengan teknologi terkini.',
                'color_theme' => 'emerald',
                'icon' => '💻',
                'stat_competencies' => 10,
                'stat_employment' => 98,
                'stat_partners' => 15,
                'salary_range' => 'Rp 8-30 Jt',
                'overview_content' => 'Program keahlian PPLG membekali siswa dengan kemampuan pemrograman dan pengembangan software. Dari web development, mobile apps, hingga game development.',
                'skills' => [
                    ['name' => 'Web Development', 'description' => 'HTML, CSS, JavaScript, Laravel', 'icon' => '🌐', 'gradient_from' => 'emerald-500', 'gradient_to' => 'teal-600'],
                    ['name' => 'Mobile Development', 'description' => 'Flutter, React Native', 'icon' => '📱', 'gradient_from' => 'teal-500', 'gradient_to' => 'cyan-600'],
                    ['name' => 'Game Development', 'description' => 'Unity, Unreal Engine', 'icon' => '🎮', 'gradient_from' => 'purple-500', 'gradient_to' => 'violet-600'],
                    ['name' => 'Database', 'description' => 'MySQL, MongoDB', 'icon' => '🗄️', 'gradient_from' => 'blue-500', 'gradient_to' => 'indigo-600'],
                    ['name' => 'Version Control', 'description' => 'Git, GitHub', 'icon' => '🔄', 'gradient_from' => 'orange-500', 'gradient_to' => 'amber-600'],
                    ['name' => 'Problem Solving', 'description' => 'Algoritma & logika', 'icon' => '🧩', 'gradient_from' => 'pink-500', 'gradient_to' => 'rose-600'],
                ],
                'careers' => [
                    ['name' => 'Web Developer', 'description' => 'Pengembang website profesional', 'icon' => '💻', 'gradient_from' => 'emerald-500', 'gradient_to' => 'teal-600'],
                    ['name' => 'Mobile Developer', 'description' => 'Pengembang aplikasi mobile', 'icon' => '📱', 'gradient_from' => 'teal-500', 'gradient_to' => 'cyan-600'],
                    ['name' => 'Game Developer', 'description' => 'Pengembang game', 'icon' => '🎮', 'gradient_from' => 'purple-500', 'gradient_to' => 'violet-600'],
                    ['name' => 'Software Engineer', 'description' => 'Engineer di tech company', 'icon' => '👨‍💻', 'gradient_from' => 'blue-500', 'gradient_to' => 'indigo-600'],
                ],
            ],
            // 4. KULINER
            [
                'name' => 'Kuliner / Tata Boga',
                'short_name' => 'Kuliner',
                'slug' => 'kuliner',
                'description' => 'Kuasai teknik memasak, pastry, dan manajemen dapur untuk menjadi chef profesional.',
                'short_description' => 'Kuasai teknik memasak, pastry, dan manajemen dapur untuk menjadi chef profesional di industri kuliner.',
                'color_theme' => 'orange',
                'icon' => '👨‍🍳',
                'stat_competencies' => 8,
                'stat_employment' => 90,
                'stat_partners' => 18,
                'salary_range' => 'Rp 5-20 Jt',
                'overview_content' => 'Program keahlian Kuliner membekali siswa dengan kemampuan memasak berbagai masakan Indonesia dan internasional, serta manajemen dapur profesional.',
                'skills' => [
                    ['name' => 'Indonesian Cuisine', 'description' => 'Masakan nusantara', 'icon' => '🍛', 'gradient_from' => 'orange-500', 'gradient_to' => 'amber-600'],
                    ['name' => 'Western Cuisine', 'description' => 'Masakan continental', 'icon' => '🍝', 'gradient_from' => 'amber-500', 'gradient_to' => 'yellow-600'],
                    ['name' => 'Pastry & Bakery', 'description' => 'Kue dan roti artisan', 'icon' => '🧁', 'gradient_from' => 'pink-500', 'gradient_to' => 'rose-600'],
                    ['name' => 'Food Plating', 'description' => 'Presentasi makanan', 'icon' => '🍽️', 'gradient_from' => 'red-500', 'gradient_to' => 'orange-600'],
                    ['name' => 'Kitchen Management', 'description' => 'Manajemen dapur', 'icon' => '📋', 'gradient_from' => 'emerald-500', 'gradient_to' => 'teal-600'],
                    ['name' => 'Food Safety', 'description' => 'Hygiene & sanitasi', 'icon' => '🧤', 'gradient_from' => 'blue-500', 'gradient_to' => 'indigo-600'],
                ],
                'careers' => [
                    ['name' => 'Chef', 'description' => 'Juru masak profesional', 'icon' => '👨‍🍳', 'gradient_from' => 'orange-500', 'gradient_to' => 'amber-600'],
                    ['name' => 'Pastry Chef', 'description' => 'Spesialis pastry', 'icon' => '🧁', 'gradient_from' => 'pink-500', 'gradient_to' => 'rose-600'],
                    ['name' => 'Food Stylist', 'description' => 'Penata makanan', 'icon' => '📸', 'gradient_from' => 'purple-500', 'gradient_to' => 'violet-600'],
                    ['name' => 'Restaurant Owner', 'description' => 'Wirausaha kuliner', 'icon' => '🏪', 'gradient_from' => 'emerald-500', 'gradient_to' => 'teal-600'],
                ],
            ],
            // 5. HOTEL
            [
                'name' => 'Perhotelan & Hospitality',
                'short_name' => 'Hotel',
                'slug' => 'hotel',
                'description' => 'Pelajari manajemen hotel, front office, housekeeping, dan layanan tamu profesional.',
                'short_description' => 'Pelajari manajemen hotel, front office, housekeeping, dan layanan tamu profesional.',
                'color_theme' => 'cyan',
                'icon' => '🏨',
                'stat_competencies' => 7,
                'stat_employment' => 88,
                'stat_partners' => 20,
                'salary_range' => 'Rp 5-18 Jt',
                'overview_content' => 'Program keahlian Perhotelan membekali siswa dengan kemampuan pelayanan tamu, manajemen hotel, dan hospitality industri kelas dunia.',
                'skills' => [
                    ['name' => 'Front Office', 'description' => 'Resepsionis dan check-in/out', 'icon' => '🛎️', 'gradient_from' => 'cyan-500', 'gradient_to' => 'sky-600'],
                    ['name' => 'Housekeeping', 'description' => 'Manajemen kamar', 'icon' => '🛏️', 'gradient_from' => 'sky-500', 'gradient_to' => 'blue-600'],
                    ['name' => 'F&B Service', 'description' => 'Layanan makanan & minuman', 'icon' => '🍽️', 'gradient_from' => 'blue-500', 'gradient_to' => 'indigo-600'],
                    ['name' => 'Guest Relation', 'description' => 'Hubungan tamu', 'icon' => '🤝', 'gradient_from' => 'emerald-500', 'gradient_to' => 'teal-600'],
                    ['name' => 'MICE', 'description' => 'Event & convention', 'icon' => '🎪', 'gradient_from' => 'purple-500', 'gradient_to' => 'violet-600'],
                    ['name' => 'Communication', 'description' => 'Bahasa asing', 'icon' => '🗣️', 'gradient_from' => 'amber-500', 'gradient_to' => 'orange-600'],
                ],
                'careers' => [
                    ['name' => 'Front Desk Agent', 'description' => 'Petugas resepsionis hotel', 'icon' => '🛎️', 'gradient_from' => 'cyan-500', 'gradient_to' => 'sky-600'],
                    ['name' => 'Concierge', 'description' => 'Layanan tamu VIP', 'icon' => '🎩', 'gradient_from' => 'amber-500', 'gradient_to' => 'yellow-600'],
                    ['name' => 'Event Coordinator', 'description' => 'Koordinator acara', 'icon' => '📅', 'gradient_from' => 'purple-500', 'gradient_to' => 'violet-600'],
                    ['name' => 'Hotel Manager', 'description' => 'Manajer hotel', 'icon' => '👔', 'gradient_from' => 'blue-500', 'gradient_to' => 'indigo-600'],
                ],
            ],
        ];

        foreach ($programs as $index => $programData) {
            $skills = $programData['skills'];
            $careers = $programData['careers'];
            unset($programData['skills'], $programData['careers']);
            
            $programData['order'] = $index;
            $programData['is_active'] = true;
            
            $program = ProgramKeahlian::create($programData);

            // Create skills
            foreach ($skills as $skillIndex => $skill) {
                $skill['order'] = $skillIndex;
                $program->skills()->create($skill);
            }

            // Create careers
            foreach ($careers as $careerIndex => $career) {
                $career['order'] = $careerIndex;
                $program->careers()->create($career);
            }
        }
    }
}
