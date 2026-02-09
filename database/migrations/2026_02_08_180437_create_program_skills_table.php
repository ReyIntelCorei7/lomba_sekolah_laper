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
        Schema::create('program_skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_keahlian_id')->constrained('program_keahlians')->cascadeOnDelete();
            $table->string('name');                          // Akuntansi Keuangan
            $table->text('description');                     // Deskripsi skill
            $table->string('icon')->nullable();              // Emoji atau SVG
            $table->string('gradient_from')->default('blue-500');
            $table->string('gradient_to')->default('indigo-600');
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_skills');
    }
};
