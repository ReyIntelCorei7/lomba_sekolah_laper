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
        Schema::create('program_careers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_keahlian_id')->constrained('program_keahlians')->cascadeOnDelete();
            $table->string('name');                          // Staff Akuntansi
            $table->text('description');                     // Deskripsi karir
            $table->string('icon')->nullable();              // Emoji atau SVG
            $table->string('gradient_from')->default('indigo-500');
            $table->string('gradient_to')->default('purple-600');
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_careers');
    }
};
