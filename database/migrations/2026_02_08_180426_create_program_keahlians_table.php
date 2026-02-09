<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('program_keahlians', function (Blueprint $table) {
            $table->id();
            $table->string('name');                          // Akuntansi & Keuangan Lembaga
            $table->string('short_name');                    // AKL
            $table->string('slug')->unique();                // akuntansi
            $table->text('description');                     // Deskripsi lengkap
            $table->text('short_description');               // Untuk card di index
            $table->string('color_theme')->default('indigo'); // indigo, purple, emerald, orange, cyan
            $table->string('hero_image')->nullable();        // Gambar hero
            $table->string('overview_image')->nullable();    // Gambar overview section
            $table->string('icon')->nullable();              // Icon emoji atau path ke SVG
            $table->integer('stat_competencies')->default(0); // 7+ kompetensi
            $table->integer('stat_employment')->default(0);   // 95% kerja
            $table->integer('stat_partners')->default(0);     // 10+ mitra
            $table->string('stat_label_1')->default('Kompetensi');
            $table->string('stat_label_2')->default('Kerja/Kuliah');
            $table->string('stat_label_3')->default('Mitra Industri');
            $table->string('salary_range')->nullable();       // Rp 5-15 Jt
            $table->string('salary_label')->default('Gaji Awal Lulusan');
            $table->text('overview_content')->nullable();     // Konten overview
            $table->json('features')->nullable();             // Array feature highlights
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_keahlians');
    }
};
