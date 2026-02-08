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
        Schema::create('alumni', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->year('graduation_year');
            $table->string('program'); // Jurusan: Perhotelan, DKV, PPLG, Kuliner, Akuntansi
            $table->string('photo')->nullable();
            $table->string('current_position')->nullable(); // Pekerjaan/Kuliah sekarang
            $table->string('company_or_university')->nullable();
            $table->text('testimonial')->nullable();
            $table->boolean('is_featured')->default(false);
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
        Schema::dropIfExists('alumni');
    }
};
