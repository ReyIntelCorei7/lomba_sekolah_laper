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
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('abbreviation')->nullable(); // singkatan, e.g: OSIS, MPK
            $table->text('description')->nullable();
            $table->string('logo')->nullable(); // logo organisasi
            $table->string('image')->nullable(); // gambar kegiatan/cover
            $table->string('category')->default('other'); // osis, mpk, pramuka, pmr, etc
            $table->string('advisor')->nullable(); // pembina
            $table->text('vision')->nullable(); // visi
            $table->text('mission')->nullable(); // misi
            $table->text('achievements')->nullable(); // prestasi
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
        Schema::dropIfExists('organizations');
    }
};
