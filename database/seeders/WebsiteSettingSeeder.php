<?php

namespace Database\Seeders;

use App\Models\WebsiteSetting;
use Illuminate\Database\Seeder;

class WebsiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $settings = [
            // General Settings
            [
                'key' => 'site_name',
                'value' => 'SMK Pariwisata Metland School',
                'type' => 'text',
                'group' => 'general',
                'label' => 'Site Name',
                'description' => 'The name of the website'
            ],
            [
                'key' => 'site_description',
                'value' => 'Sekolah Menengah Kejuruan Pariwisata terbaik dengan fasilitas modern dan tenaga pengajar profesional.',
                'type' => 'textarea',
                'group' => 'general',
                'label' => 'Site Description',
                'description' => 'Brief description of the school'
            ],
            
            // Contact Settings
            [
                'key' => 'contact_phone',
                'value' => '+62 21 1234 5678',
                'type' => 'text',
                'group' => 'contact',
                'label' => 'Contact Phone',
                'description' => 'Main contact phone number'
            ],
            [
                'key' => 'contact_email',
                'value' => 'info@smkmetland.sch.id',
                'type' => 'text',
                'group' => 'contact',
                'label' => 'Contact Email',
                'description' => 'Main contact email address'
            ],
            [
                'key' => 'contact_address',
                'value' => 'Jl. Metland Cyber City, Cikupa, Tangerang, Banten',
                'type' => 'textarea',
                'group' => 'contact',
                'label' => 'School Address',
                'description' => 'Complete school address'
            ],
            
            // Hero Section
            [
                'key' => 'hero_title',
                'value' => 'Bridging the Gap Between Education and Industry',
                'type' => 'text',
                'group' => 'hero',
                'label' => 'Hero Title',
                'description' => 'Main title in hero section'
            ],
            [
                'key' => 'hero_subtitle',
                'value' => 'Metland School: The High Standard in Vocational Education',
                'type' => 'text',
                'group' => 'hero',
                'label' => 'Hero Subtitle',
                'description' => 'Subtitle in hero section'
            ],
            [
                'key' => 'hero_description',
                'value' => 'Bergabunglah dengan SMK Pariwisata Metland School dan raih masa depan gemilang di industri pariwisata dengan fasilitas modern dan tenaga pengajar profesional.',
                'type' => 'textarea',
                'group' => 'hero',
                'label' => 'Hero Description',
                'description' => 'Description text in hero section'
            ],
            [
                'key' => 'hero_image_1',
                'value' => 'image/sekolahsmkmetland4.png',
                'type' => 'image',
                'group' => 'hero',
                'label' => 'Hero Image 1',
                'description' => 'First hero slider image'
            ],
            [
                'key' => 'hero_image_2',
                'value' => 'image/sekolahsmkmetland3.png',
                'type' => 'image',
                'group' => 'hero',
                'label' => 'Hero Image 2',
                'description' => 'Second hero slider image'
            ],
            [
                'key' => 'hero_image_3',
                'value' => 'image/sekolahsmkmetland.png',
                'type' => 'image',
                'group' => 'hero',
                'label' => 'Hero Image 3',
                'description' => 'Third hero slider image'
            ],
            [
                'key' => 'logo_image',
                'value' => 'image/logometland.png',
                'type' => 'image',
                'group' => 'general',
                'label' => 'School Logo',
                'description' => 'Main school logo'
            ],
            
            // About Section
            [
                'key' => 'about_title',
                'value' => 'Tentang SMK Metland',
                'type' => 'text',
                'group' => 'about',
                'label' => 'About Title',
                'description' => 'Title for about section'
            ],
            [
                'key' => 'about_description',
                'value' => 'SMK Pariwisata Metland School adalah institusi pendidikan kejuruan yang berfokus pada pengembangan sumber daya manusia di bidang pariwisata. Dengan fasilitas modern dan kurikulum yang sesuai dengan kebutuhan industri, kami berkomitmen untuk mencetak lulusan yang kompeten dan siap kerja.',
                'type' => 'textarea',
                'group' => 'about',
                'label' => 'About Description',
                'description' => 'Description for about section'
            ],
            
            // Statistics
            [
                'key' => 'stat_students',
                'value' => '683',
                'type' => 'text',
                'group' => 'stats',
                'label' => 'Total Students',
                'description' => 'Number of students'
            ],
            [
                'key' => 'stat_teachers',
                'value' => '54',
                'type' => 'text',
                'group' => 'stats',
                'label' => 'Total Teachers',
                'description' => 'Number of teachers'
            ],
            [
                'key' => 'stat_staff',
                'value' => '41',
                'type' => 'text',
                'group' => 'stats',
                'label' => 'Total Staff',
                'description' => 'Number of staff'
            ],
            
            // Program Section
            [
                'key' => 'program_title',
                'value' => 'Program Keahlian',
                'type' => 'text',
                'group' => 'programs',
                'label' => 'Program Section Title',
                'description' => 'Title for programs section'
            ],
            [
                'key' => 'program_description',
                'value' => 'Pilih jurusan sesuai minat dan bakatmu untuk masa depan yang lebih cerah',
                'type' => 'text',
                'group' => 'programs',
                'label' => 'Program Section Description',
                'description' => 'Description for programs section'
            ],
            [
                'key' => 'program_bg_color',
                'value' => '#1E2188',
                'type' => 'color',
                'group' => 'programs',
                'label' => 'Program Section Background Color',
                'description' => 'Background color for programs section'
            ],
            
            // News Section
            [
                'key' => 'news_title',
                'value' => 'Berita Sekolah',
                'type' => 'text',
                'group' => 'news',
                'label' => 'News Section Title',
                'description' => 'Title for news section'
            ],
            [
                'key' => 'news_description',
                'value' => 'Informasi dan kegiatan terbaru dari sekolah SMK Metland',
                'type' => 'text',
                'group' => 'news',
                'label' => 'News Section Description',
                'description' => 'Description for news section'
            ],
            
            // PPDB Settings
            [
                'key' => 'ppdb_open',
                'value' => 'true',
                'type' => 'boolean',
                'group' => 'ppdb',
                'label' => 'PPDB Open',
                'description' => 'Whether PPDB registration is open'
            ],
            [
                'key' => 'ppdb_start_date',
                'value' => '2026-03-01',
                'type' => 'date',
                'group' => 'ppdb',
                'label' => 'PPDB Start Date',
                'description' => 'PPDB registration start date'
            ],
            [
                'key' => 'ppdb_end_date',
                'value' => '2026-06-30',
                'type' => 'date',
                'group' => 'ppdb',
                'label' => 'PPDB End Date',
                'description' => 'PPDB registration end date'
            ],
            
            // Social Media Settings
            [
                'key' => 'social_facebook',
                'value' => 'https://facebook.com/smkmetland',
                'type' => 'text',
                'group' => 'social',
                'label' => 'Facebook URL',
                'description' => 'Facebook page URL'
            ],
            [
                'key' => 'social_instagram',
                'value' => 'https://instagram.com/smkmetland',
                'type' => 'text',
                'group' => 'social',
                'label' => 'Instagram URL',
                'description' => 'Instagram profile URL'
            ],
            [
                'key' => 'social_youtube',
                'value' => 'https://youtube.com/@smkmetland',
                'type' => 'text',
                'group' => 'social',
                'label' => 'YouTube URL',
                'description' => 'YouTube channel URL'
            ],
            [
                'key' => 'social_whatsapp',
                'value' => '+6281234567890',
                'type' => 'text',
                'group' => 'social',
                'label' => 'WhatsApp Number',
                'description' => 'WhatsApp contact number'
            ],
            [
                'key' => 'social_tiktok',
                'value' => 'https://tiktok.com/@smkmetland',
                'type' => 'text',
                'group' => 'social',
                'label' => 'TikTok URL',
                'description' => 'TikTok profile URL'
            ],
            [
                'key' => 'social_twitter',
                'value' => 'https://twitter.com/smkmetland',
                'type' => 'text',
                'group' => 'social',
                'label' => 'X (Twitter) URL',
                'description' => 'X (formerly Twitter) profile URL'
            ],
        ];

        foreach ($settings as $setting) {
            WebsiteSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}