<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Change photo, certificate, transcript columns from string to longText
     * to support base64-encoded file storage (required for Vercel deployment).
     */
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->longText('photo')->nullable()->change();
            $table->longText('certificate')->nullable()->change();
            $table->longText('transcript')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('photo')->nullable()->change();
            $table->string('certificate')->nullable()->change();
            $table->string('transcript')->nullable()->change();
        });
    }
};
